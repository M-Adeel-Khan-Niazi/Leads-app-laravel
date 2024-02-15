<?php

namespace App\Http\Controllers;

use App\Models\FileUploads;
use App\Models\Installer;
use App\Models\LeadDataMatches;
use App\Models\LeadDetails;
use App\Models\LeadMeasureCategories;
use App\Models\LeadMeasureCategoryTypes;
use App\Models\LeadRetrofit;
use App\Models\Leads;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leads = Leads::with('created_by_user', 'agent_details');
        if (Auth::user()->role == 'admin') {
            $leads = $leads->where(function ($query) {
                $query->where('status', '!=', 'draft')
                    ->orWhere('created_by', Auth::id());
            });
        } elseif (Auth::user()->role == 'agent') {
            $leads = $leads->where(function ($query) {
                $query->where('agent_id', Auth::id())
                    ->orWhere('created_by', Auth::id());
            });
        }
        $leads = $leads->when(request()->has('status') && !empty(request('status')), function ($q) {
            if (in_array(request()->status, ['Awaiting', 'Matched', 'Unverified', 'Unmatched']))
                $q->whereHas('data_matched', function ($q) {
                    $q->where('data_match_result', request()->status);
                });
            else
                $q->where('status', request()->status);
        })->when(request()->has('search') && !empty(request('search')), function ($q) {
            $q->where(function ($query) {
                $query->orWhere('house_number', request('search'))->orWhere('street', request('search'))
                    ->orWhere('postal_code', request('search'))->orWhere('town', request('search'));
            });
        })->paginate(10);
        return view('leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agents = User::where('role', 'agent')->get();
        return view('leads.form', compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $is_all_checked = ($request->is_data_sent && $request->is_benefit_proof_sent && $request->is_address_proof_sent);
        if ($is_all_checked) {
            $validation_rules = [
                "agent_id" => 'nullable',
                "source" => 'nullable',
                "house_number" => 'required',
                "street" => 'required',
                "town" => 'required',
                "postal_code" => 'required',
                "is_prev_epc" => 'nullable',
                "epc_rating" => 'required_if:is_prev_epc,true',
                "epc_date" => 'required_if:is_prev_epc,true',
                "is_property_check" => 'nullable',
                'property_check_pictures.*' => 'required_if:is_property_check,true|mimes:jpeg,png|max:2048',
                "gas_safe_results" => 'required',
                "property_type" => 'required',
                "main_wall_type" => 'nullable',
                "extension_wall_type" => 'nullable',
                "resident_first_name" => 'required',
                "resident_mid_name" => 'required',
                "resident_sur_name" => 'required',
                "resident_dob" => 'required',
                "resident_contact" => 'required',
                "resident_email" => 'required',
                "type" => 'required',
                "owner_name" => 'required_if:type,rented',
                "owner_contact" => 'required_if:type,rented',
                "owner_email" => 'required_if:type,rented',
                "benefit_type" => 'required',
                "is_benefit_recipient" => 'nullable',
                "benefit_first_name" => 'required_if:is_benefit_recipient,false',
                "benefit_mid_name" => 'required_if:is_benefit_recipient,false',
                "benefit_sur_name" => 'required_if:is_benefit_recipient,false',
                "benefit_dob" => 'required_if:is_benefit_recipient,false',
                "relationship" => 'required_if:is_benefit_recipient,false',
                "is_data_sent" => 'nullable',
                'data_match_pictures.*' => 'required_if:is_data_sent,true|mimes:jpeg,png|max:2048',
                "is_benefit_proof_sent" => 'nullable',
                'benefit_proof_pictures.*' => 'required_if:is_benefit_proof_sent,true|mimes:jpeg,png|max:2048',
                "is_address_proof_sent" => 'nullable',
                'address_proof_pictures.*' => 'required_if:is_address_proof_sent,true|mimes:jpeg,png|max:2048',
                "is_other_picture" => 'nullable',
                'other_pictures.*' => 'required_if:is_other_picture,true|mimes:jpeg,png|max:2048',
            ];
            $request->validate($validation_rules);
        }
        DB::beginTransaction();
        try {
            $except = $request->except('is_benefit_recipient', 'is_property_check', 'is_prev_epc', 'is_benefit_proof_sent', 'is_address_proof_sent', 'is_data_sent');
            if ($request->lead_id) {
                $lead = Leads::find($request->lead_id);
                $lead->fill($except);
            } else {
                $lead = new Leads($except);
            }
            if ($is_all_checked)
                $lead->status = 'pending';
            $lead->is_benefit_recipient = (boolean)$request->is_benefit_recipient;
            $lead->is_property_check = (boolean)$request->is_property_check;
            $lead->is_prev_epc = (boolean)$request->is_prev_epc;
            $lead->is_benefit_proof_sent = (boolean)$request->is_benefit_proof_sent;
            $lead->is_address_proof_sent = (boolean)$request->is_address_proof_sent;
            $lead->is_data_sent = (boolean)$request->is_data_sent;
            $lead->address_line_one = $request->house_number . '-' . $request->postal_code;
            $lead->created_by = Auth::id();
            $lead->extension_wall_type = $request->extension_wall_type ?? $request->extension_wall_type_other;
            $lead->relationship = $request->relationship ?? $request->other_relationship;
            $lead->save();
            if ($lead->is_property_check && $request->hasFile('property_check_pictures')) {
                $data = $this->uploadFiles($request->file('property_check_pictures'), 'property_check');
                $lead->property_check_pictures()->saveMany($data);
            }
            if ($lead->is_benefit_proof_sent && $request->hasFile('benefit_proof_pictures')) {
                $data = $this->uploadFiles($request->file('benefit_proof_pictures'), 'benefit_proof');
                $lead->benefit_proof_pictures()->saveMany($data);
            }
            if ($lead->is_data_sent && $request->hasFile('data_match_pictures')) {
                $data = $this->uploadFiles($request->file('data_match_pictures'), 'data_match');
                $lead->data_match_pictures()->saveMany($data);
            }
            if ($lead->is_address_proof_sent && $request->hasFile('address_proof_pictures')) {
                $data = $this->uploadFiles($request->file('address_proof_pictures'), 'address_proof');
                $lead->address_proof_pictures()->saveMany($data);
            }
            if ((boolean)$request->is_other_picture && $request->hasFile('other_pictures')) {
                $data = $this->uploadFiles($request->file('other_pictures'), 'other');
                $lead->other_pictures()->saveMany($data);
            }
            DB::commit();
            return redirect()->route('leads.index');
        } catch (\Exception $error) {
            DB::rollBack();
            return redirect()->back()->with('error', $error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Leads $leads
     * @return \Illuminate\Http\Response
     */
    public function show(Leads $leads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Leads $leads
     * @return \Illuminate\Http\Response
     */
    public function edit(Leads $lead)
    {
        $row = $lead;
        $agents = User::where('role', 'agent')->get();
        return view('leads.form', compact('row', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Leads $leads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leads $lead)
    {
        DB::beginTransaction();
        try {
            $details = new LeadDetails($request->except('types', 'is_boiler_replacement', 'is_external_wall_insulation',
                'is_first_time_central_heating', 'is_internal_wall_insulation', 'is_cavity_wall_insulation', 'is_under_floor_insulation',
                'is_loft_insulation', 'is_heating_controls', 'is_solar_pv', 'is_air_source', 'is_storage_heater', 'is_rir'));
            $details->lead_id = $lead->id;
            $details->is_flexible = filter_var($request->is_flexible, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            $details->is_floor_plan_created = filter_var($request->is_floor_plan_created, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            $details->is_rfa_complete = filter_var($request->is_rfa_complete, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            $details->is_customer_informed = filter_var($request->is_customer_informed, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            $details->is_match_sent = filter_var($request->is_match_sent, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            $details->land_reg_matched = filter_var($request->land_reg_matched, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            $details->is_completed_submission = filter_var($request->is_completed_submission, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            if (!$details->is_flexible) {
                $lead->status = 'stop';
                $lead->save();
                $details->save();
                DB::commit();
                return redirect()->route('leads.index');
            }
            $details->is_pibi = $request->is_pibi == 'on';
            $details->is_design = $request->is_design == 'on';
            $details->is_tech_survey = $request->is_tech_survey == 'on';
            $details->is_external_wall_insulation = $request->is_external_wall_insulation == 'on';
            $details->is_first_time_central_heating = $request->is_first_time_central_heating == 'on';
            $details->is_internal_wall_insulation = $request->is_internal_wall_insulation == 'on';
            $details->is_cavity_wall_insulation = $request->is_cavity_wall_insulation == 'on';
            $details->is_under_floor_insulation = $request->is_under_floor_insulation == 'on';
            $details->is_loft_insulation = $request->is_loft_insulation == 'on';
            $details->is_heating_controls = $request->is_heating_controls == 'on';
            $details->is_solar_pv = $request->is_solar_pv == 'on';
            $details->is_air_source = $request->is_air_source == 'on';
            $details->is_storage_heater = $request->is_storage_heater == 'on';
            $details->is_rir = $request->is_rir == 'on';
            $details->save();
            foreach ($request->types as $category) {
                $lead_category = new LeadMeasureCategories($category);
                $lead_category->is_warranty_applied = filter_var($category['is_warranty_applied'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
                $details->measure_categories()->save($lead_category);
                foreach ($category['materials'] as $material) {
                    $category_material = new LeadMeasureCategoryTypes($material);
                    $category_material->type = 'material';
                    $category_material->lead_id = $lead->id;
                    $lead_category->category_types()->save($category_material);
                }
                foreach ($category['installers'] as $installer) {
                    $category_installer = new LeadMeasureCategoryTypes($installer);
                    $category_installer->type = 'installer';
                    $category_installer->lead_id = $lead->id;
                    $lead_category->category_types()->save($category_installer);
                }
            }
            $lead->status = 'completed';
            $lead->save();
            DB::commit();
            return redirect()->route('leads.index');
        } catch (\Exception $error) {
            DB::rollBack();
            dd($error->getMessage());
            return redirect()->back()->with('error', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Leads $leads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Leads $lead)
    {
        if ($request->ajax()) {
            $lead->delete();
            return response()->json(['deleted' => true]);
        }
        return response()->json(['deleted' => false]);
    }

    public function leads_details($type, Leads $lead)
    {
//        $lead->status == 'pending'
        if ($type == 'data-matched') {
            $row = $lead->data_matched()->first();
            return view('leads.data-matched-form', compact('row'));
//            in_array($lead->status, ['approved', 'raBooked', 'raCompleted'])
        } elseif ($type == 'retrofit') {
            $row = $lead->retrofit()->first();
            return view('leads.retrofit-form', compact('row'));
//            in_array($lead->status, ['raLodged', 'installationBooked', 'installationStarted'])
        } elseif ($type == 'measure-install') {
            $installers = Installer::latest()->get();
            $row = LeadDetails::where('lead_id', $lead->id)->first();
            $categories = LeadMeasureCategories::with('category_types')->where('lead_id', $lead->id)->get();
            return view('leads.measure-form', compact('installers', 'row', 'categories'));
//            in_array($lead->status, ['installationCompleted', 'handoverCompleted', 'paperWorkSubmitted', 'paperWorkAccepted', 'paperWorkError'])
        } elseif ($type == 'handover') {
            return view('leads.handover', compact('lead'));
        } elseif ($type == 'summary') {
            $total_ibg = LeadMeasureCategories::where('lead_id', $lead->id)->sum('ibg_cost');
            return view('leads.lead-summary', compact('lead', 'total_ibg'));
        }
    }

    public function data_matched(Request $request, $id)
    {
        $request->validate([
            'land_reg_check' => 'required',
            'land_reg_matched' => 'required',
            'is_match_sent' => 'required',
            'data_match_result' => 'required',
            'status' => 'required',
        ]);
        $lead = Leads::find($id);
        $lead->status = $request->status;
        $lead->save();

        $data = new LeadDataMatches($request->except('_token'));
        $data->is_match_sent = filter_var($request->is_match_sent, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $data->is_land_reg_matched = filter_var($request->is_land_reg_matched, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $data->lead_id = $id;
        $data->save();
        return redirect()->route('leads.index');
    }

    public function retrofit(Request $request, $id)
    {
        $lead = Leads::find($id);
        if ($lead->retrofit()->exists())
            $retrofit = LeadRetrofit::where('lead_id', $id)->first()->fill($request->except('_token'));
        else $retrofit = new LeadRetrofit($request->except('_token'));
        $retrofit->is_floor_plan_created = filter_var($request->is_floor_plan_created, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $retrofit->is_rfa_lodged = filter_var($request->is_rfa_lodged, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $retrofit->is_rfa_complete = filter_var($request->is_rfa_complete, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $retrofit->lead_id = $id;
        $retrofit->save();

        if ($retrofit->rfa_booked_time && $retrofit->rfa_booked_date)
            $lead->status = 'raBooked';
        if ($retrofit->is_rfa_complete)
            $lead->status = 'raCompleted';
        if ($retrofit->is_rfa_lodged)
            $lead->status = 'raLodged';
        $lead->save();
        return redirect()->route('leads.index');
    }

    public function measures(Request $request, $id)
    {
        dd($request->all());
        DB::beginTransaction();
        try {
            $lead = Leads::find($id);

            foreach ($request->types as $category) {
                $lead_category = new LeadMeasureCategories($category);
                $lead_category->is_customer_informed = filter_var($category['is_customer_informed'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
                $lead_category->is_warranty_applied = filter_var($category['is_warranty_applied'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
                $lead_category->is_pibi = isset($category['is_pibi']) == 'on';
                $lead_category->is_design = isset($category['is_design']) == 'on';
                $lead_category->is_tech_survey = isset($category['is_tech_survey']) == 'on';
                $lead_category->lead_id = $id;
                $lead_category->save();
                foreach ($category['materials'] as $material) {
                    $category_material = new LeadMeasureCategoryTypes($material);
                    $category_material->type = 'material';
                    $category_material->lead_id = $id;
                    $category_material->measure_category_id = $lead_category->id;
                    $category_material->save();
                }
                foreach ($category['installers'] as $installer) {
                    $category_installer = new LeadMeasureCategoryTypes($installer);
                    $category_installer->type = 'installer';
                    $category_installer->lead_id = $id;
                    $category_installer->measure_category_id = $lead_category->id;;
                    $category_installer->save();
                }
            }
            // Pending: Update the lead status in the behalf of checking of measures statuses
            if ($lead->details()->exists())
                $details = $lead->details()->first();
            else $details = new LeadDetails();
            $details->is_boiler_replacement = $request->is_boiler_replacement == 'on';
            $details->is_external_wall_insulation = $request->is_external_wall_insulation == 'on';
            $details->is_first_time_central_heating = $request->is_first_time_central_heating == 'on';
            $details->is_internal_wall_insulation = $request->is_internal_wall_insulation == 'on';
            $details->is_cavity_wall_insulation = $request->is_cavity_wall_insulation == 'on';
            $details->is_under_floor_insulation = $request->is_under_floor_insulation == 'on';
            $details->is_loft_insulation = $request->is_loft_insulation == 'on';
            $details->is_heating_controls = $request->is_heating_controls == 'on';
            $details->is_solar_pv = $request->is_solar_pv == 'on';
            $details->is_air_source = $request->is_air_source == 'on';
            $details->is_storage_heater = $request->is_storage_heater == 'on';
            $details->is_rir = $request->is_rir == 'on';
            $details->total_material = $request->total_material;
            $details->total_installer = $request->total_installer;
            $details->sub_total = $request->sub_total;
            $details->lead_id = $id;
            $details->save();
            DB::commit();
            return redirect()->route('leads.index');
        } catch (\Exception $error) {
            DB::rollBack();
            dd($error->getMessage());
            return redirect()->back()->with('error', $error->getMessage());
        }

    }

    public function lead_handover(Request $request, $id)
    {
        //
    }

    public function lead_summary(Request $request, $id)
    {
        $detail = LeadDetails::where('lead_id', $id)->first();
        $detail->fill($request->except('_token'));
        $detail->is_agent_paid = filter_var($request->is_agent_paid, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $detail->is_invoice_paid = filter_var($request->is_invoice_paid, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $detail->save();
        $lead = Leads::find($id);
        if ($request->handover_on)
            $lead->status = 'hanoverCompleted';
        if ($request->status)
            $lead->status = $request->status;
        if ($detail->is_invoice_paid)
            $lead->status = 'invoicePaid';
        $lead->save();
        return redirect()->route('leads.index');
    }

    private function uploadFiles($files, $type)
    {
        $data = [];
        foreach ($files as $file) {
            $path = 'uploads/' . $type . '/';
            $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs($path, $file, $fileName);
            $data[] = new FileUploads(['file_path' => $path . $fileName, 'name' => $fileName, 'type' => $type]);
        }
        return $data;
    }
}
