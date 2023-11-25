<?php

namespace App\Http\Controllers;

use App\Models\Installer;
use App\Models\Leads;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leads = Leads::with('created_by_user', 'agent_details')->when(Auth::user()->role == 'admin', function ($q) {
            $q->where('status', '!=', 'draft')->orWhere('created_by', Auth::id());
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
        if ($request->is_data_sent && $request->is_proof_sent) {
            $validation_rules = [
                "agent_id" => 'nullable',
                "source" => 'nullable',
                "address_line_one" => 'required',
                "house_number" => 'required',
                "street" => 'required',
                "town" => 'required',
                "postal_code" => 'required',
                "is_prev_epc" => 'nullable',
                "epc_rating" => 'required_if:is_prev_epc,true',
                "epc_date" => 'required_if:is_prev_epc,true',
                "is_property_check" => 'nullable',
                "gas_safe_results" => 'required',
                "property_type" => 'required',
                "main_wall_type" => 'required',
                "extension_wall_type" => 'required',
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
            ];
            $request->validate($validation_rules);
        }
        $lead = new Leads($request->except('is_benefit_recipient', 'is_property_check', 'is_prev_epc', 'is_proof_sent', 'is_data_sent'));
        if ($request->is_data_sent && $request->is_proof_sent)
            $lead->status = 'pending';
        $lead->is_benefit_recipient = (boolean)$request->is_benefit_recipient;
        $lead->is_property_check = (boolean)$request->is_property_check;
        $lead->is_prev_epc = (boolean)$request->is_prev_epc;
        $lead->is_proof_sent = (boolean)$request->is_proof_sent;
        $lead->is_data_sent = (boolean)$request->is_data_sent;
        $lead->created_by = Auth::id();
        $lead->save();
        return redirect()->route('leads.index');
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
    public function update(Request $request, Leads $leads)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Leads $leads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leads $leads)
    {
        //
    }

    public function leads_details(Leads $leads)
    {
        $installers = Installer::latest()->get();
        return view('leads.lead-details', compact('installers'));
    }
}
