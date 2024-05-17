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
use ZipArchive;

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
                "is_property_check" => 'nullable',
                'property_check_pictures.*' => 'required_if:is_property_check,true|max:2048',
                "gas_safe_results" => 'required',
                "property_type" => 'required',
                "main_wall_type" => 'nullable',
                "extension_wall_type" => 'nullable',
                "resident_first_name" => 'required',
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
                "benefit_sur_name" => 'required_if:is_benefit_recipient,false',
                "benefit_dob" => 'required_if:is_benefit_recipient,false',
                "relationship" => 'required_if:is_benefit_recipient,false',
                "is_data_sent" => 'nullable',
                'data_match_pictures.*' => 'required_if:is_data_sent,true|max:2048',
                "is_benefit_proof_sent" => 'nullable',
                'benefit_proof_pictures.*' => 'required_if:is_benefit_proof_sent,true|max:2048',
                "is_address_proof_sent" => 'nullable',
                'address_proof_pictures.*' => 'required_if:is_address_proof_sent,true|max:2048',
                "is_other_picture" => 'nullable',
                'other_pictures.*' => 'required_if:is_other_picture,true|max:2048',
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
                $lead->created_by = Auth::id();
            }
            if ($is_all_checked && $lead->status == 'draft')
                $lead->status = 'pending';
            $lead->is_benefit_recipient = filter_var($request->is_benefit_recipient, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);;
            $lead->is_property_check = filter_var($request->is_property_check, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);;
            $lead->is_prev_epc = filter_var($request->is_prev_epc, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);;
            $lead->is_benefit_proof_sent = filter_var($request->is_benefit_proof_sent, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);;
            $lead->is_address_proof_sent = filter_var($request->is_address_proof_sent, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);;
            $lead->is_data_sent = filter_var($request->is_data_sent, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);;
            $lead->address_line_one = $request->house_number . '-' . $request->postal_code;
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
        if ($type == 'data-matched') {
            $row = $lead->data_matched()->first();
            return view('leads.data-matched-form', compact('row', 'lead'));
        } elseif ($type == 'retrofit') {
            $row = $lead->retrofit()->first();
            $files = FileUploads::where('lead_id', $lead->id)->where('type', 'floor_plan')->get();
            return view('leads.retrofit-form', compact('row', 'files', 'lead'));
        } elseif ($type == 'measure-install') {
            $installers = Installer::latest()->get();
            $row = LeadDetails::where('lead_id', $lead->id)->first();
            $categories = LeadMeasureCategories::where('lead_id', $lead->id)->get();
            return view('leads.measure-form', compact('installers', 'row', 'categories', 'lead'));
        } elseif ($type == 'handover') {
            return view('leads.handover', compact('lead'));
        } elseif ($type == 'summary') {
            return view('leads.lead-summary', compact('lead'));
        }
    }

    public function data_matched(Request $request, $id)
    {
        $request->validate([
            'land_reg_check' => 'required',
            'is_land_reg_matched' => 'required',
            'is_match_sent' => 'required',
            'data_match_result' => 'required',
            'status' => 'required',
        ]);
        $lead = Leads::find($id);
//        $lead->status = $request->status;
//        $lead->save();
        $this->updateStatus($lead, $request->status);

        $data = LeadDataMatches::firstOrNew(['lead_id' => $id]);
        $data = $data->fill($request->except('_token'));
        $data->is_match_sent = filter_var($request->is_match_sent, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $data->is_land_reg_matched = filter_var($request->is_land_reg_matched, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $data->lead_id = $id;
        $data->save();
        return redirect()->route('leads.index');
    }

    public function retrofit(Request $request, $id)
    {
        $retrofit = LeadRetrofit::firstOrNew(['lead_id' => $id]);
        $retrofit = $retrofit->fill($request->except('_token'));
        $retrofit->is_floor_plan_created = filter_var($request->is_floor_plan_created, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $retrofit->is_rfa_lodged = filter_var($request->is_rfa_lodged, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $retrofit->is_rfa_complete = filter_var($request->is_rfa_complete, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $retrofit->lead_id = $id;
        $retrofit->save();

        $lead = Leads::find($id);
        if ($request->hasFile('floor_plan_pictures')) {
            $data = $this->uploadFiles($request->file('floor_plan_pictures'), 'floor_plan');
            $lead->property_check_pictures()->saveMany($data);
        }
//        if ($retrofit->is_rfa_complete)
//            $lead->status = 'raCompleted';
//        if ($retrofit->is_rfa_lodged)
//            $lead->status = 'raLodged';
//        if ($retrofit->rfa_booked_time && $retrofit->rfa_booked_date && (!$retrofit->is_rfa_complete || !$retrofit->is_rfa_lodged))
//            $lead->status = 'raBooked';
//        $lead->save();
        $this->updateStatus($lead);
        return redirect()->route('leads.index');
    }

    public function measures(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            LeadMeasureCategories::where('lead_id', $id)->delete();
            $statuses = [];
            if ($request->types) {
                foreach ($request->types as $category) {
                    $lead_category = new LeadMeasureCategories($category);
                    $lead_category->is_customer_informed = filter_var($category['is_customer_informed'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
                    $lead_category->is_pibi = isset($category['is_pibi']) == 'on';
                    $lead_category->is_design = isset($category['is_design']) == 'on';
                    $lead_category->is_tech_survey = isset($category['is_tech_survey']) == 'on';
                    $lead_category->lead_id = $id;
                    $lead_category->save();
                    $statuses[] = $category['measure_status'];
                }
            }
            // Pending: Update the lead status in the behalf of checking of measures statuses
            $details = LeadDetails::firstOrNew(['lead_id' => $id]);
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
            $details->lead_id = $id;
            $details->save();

//            if (count(array_unique($statuses)) == 1 && array_unique($statuses)[0] == 'Completed') {
//                Leads::where('id', $id)->update(['status' => 'installationCompleted']);
//            }
//            if (count(array_unique($statuses)) == 1 && array_unique($statuses)[0] == 'Booked') {
//                Leads::where('id', $id)->update(['status' => 'installationBooked']);
//            }
//            if (count(array_unique($statuses)) == 1 && array_unique($statuses)[0] == 'Started') {
//                Leads::where('id', $id)->update(['status' => 'installationStarted']);
//            }
            DB::commit();
            $lead = Leads::find($id);
            $this->updateStatus($lead);
            return redirect()->route('leads.index');
        } catch (\Exception $error) {
            DB::rollBack();
            return redirect()->back()->with('error', $error->getMessage());
        }

    }

    public function lead_handover(Request $request, $id)
    {
        $details = LeadDetails::firstOrNew(['lead_id' => $id]);
        $details->is_handover_emailed = filter_var($request->is_handover_emailed, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $details->is_warranty_applied = filter_var($request->is_warranty_applied, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $details->is_agent_paid = filter_var($request->is_agent_paid, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $details->is_invoice_paid = filter_var($request->is_invoice_paid, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $details->handover_on = $request->handover_on;
        $details->lead_id = $id;
        $details->save();
        $lead = Leads::find($id);
//        if ($request->handover_on)
//            $lead->status = 'handoverCompleted';
//        if ($request->status)
//            $lead->status = $request->status;
//        $lead->save();
        $this->updateStatus($lead, $request->status);
        return redirect()->route('leads.index');
    }

    public function lead_summary(Request $request, $id)
    {
        $retrofit = LeadRetrofit::firstOrNew(['lead_id' => $id]);
        $retrofit->wall_type = $request->wall_type;
        $retrofit->floor_area = $request->floor_area;
        $retrofit->pre_epr_result = $request->pre_epr_result;
        $retrofit->post_epr_result = $request->post_epr_result;
        $retrofit->save();
        LeadMeasureCategoryTypes::where('lead_id', $id)->delete();
        foreach ($request->installers as $installer) {
            $type = new LeadMeasureCategoryTypes($installer);
            $type->type = 'installer';
            $type->lead_id = $id;
            $type->save();
        }
        foreach ($request->materials as $material) {
            $type = new LeadMeasureCategoryTypes($material);
            $type->lead_id = $id;
            $type->type = 'material';
            $type->save();
        }
        $detail = LeadDetails::firstOrNew(['lead_id' => $id]);
        $detail->fill($request->except('_token'));
        $detail->save();
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

    public function download_files($id, $type)
    {
        $zip = new ZipArchive();
        $files = FileUploads::where('lead_id', $id)->where('type', $type)->get();
        if (!count($files)) return redirect()->back()->with('error', 'Files not found!');
        $zipFileName = 'files.zip';
        if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file) {
                $filePath = storage_path('app/' . $file->file_path);
                $zip->addFile($filePath, $file->name);
            }
            $zip->close();
            return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
        }
    }

    private function updateStatus($lead, $status = null)
    {
        $statuses = LeadMeasureCategories::where('lead_id', $lead->id)->pluck('measure_status')->toArray();
        if ($lead->retrofit && $lead->retrofit->rfa_booked_time && $lead->retrofit->rfa_booked_date)
            $lead->status = 'raBooked';
        if ($lead->retrofit && $lead->retrofit->is_rfa_complete)
            $lead->status = 'raCompleted';
        if ($lead->retrofit && $lead->retrofit->is_rfa_lodged)
            $lead->status = 'raLodged';
        if (count(array_unique($statuses)) == 1 && array_unique($statuses)[0] == 'Completed') {
            $lead->status = 'installationCompleted';
        }
        if (count(array_unique($statuses)) == 1 && array_unique($statuses)[0] == 'Booked') {
            $lead->status = 'installationBooked';
        }
        if (in_array('Started', $statuses)) {
            $lead->status = 'installationStarted';
        }
        if ($lead->details && $lead->details->handover_on)
            $lead->status = 'handoverCompleted';
        if ($status)
            $lead->status = $status;
        if ($lead->details && $lead->details->is_invoice_paid)
            $lead->status = 'invoicePaid';
        if ($lead->details && $lead->details->is_agent_paid)
            $lead->status = 'agentPaid';
        $lead->save();
    }
}
