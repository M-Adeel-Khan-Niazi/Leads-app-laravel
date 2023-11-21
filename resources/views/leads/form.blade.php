@extends('master')
@section('title', isset($row) ? 'Edit Lead': 'Create Lead')
@section('main-content')
        <!-- form start -->
        @if(isset($row))
            <form method="POST" action="{{ route('leads.update', $row->id) }}">
                @method('PUT')
        @else
            <form method="POST" action="{{ route('leads.store') }}">
        @endif
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="card card-gray">
                        <div class="card-header">
                            <h3 class="card-title">Lead Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="agent_id">Select Agent</label>
                                        <select class="form-control select2 @error('agent_id') is-invalid @enderror" name="agent_id" style="width: 100%;">
                                            <option disabled selected value> -- select agent -- </option>
                                            @foreach($agents as $agent)
                                                <option value="{{ $agent->id }}" {{ isset($row) ? $row->agent_id == $agent->id ? 'selected': null : old('agent_id') }}>
                                                    {{ $agent->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('agent_id')
                                        <span id="agent_id" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="source">Other Source</label>
                                        <input value="{{ old('source', isset($row) ? $row->source : '') }}" type="text" class="form-control @error('source') is-invalid @enderror" name="source" id="source" placeholder="Enter Other Source">
                                        @error('source')
                                        <span id="source" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="address_line_one">First Line Address</label>
                                        <input value="{{ old('address_line_one', isset($row) ? $row->address_line_one : '') }}" type="text" class="form-control @error('address_line_one') is-invalid @enderror" name="address_line_one" id="address_line_one" placeholder="Enter Address">
                                        @error('address_line_one')
                                        <span id="address_line_one" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="house_number">House#</label>
                                        <input value="{{ old('house_number', isset($row) ? $row->house_number : '') }}" type="text" class="form-control @error('house_number') is-invalid @enderror" name="house_number" id="house_number" placeholder="Enter House#">
                                        @error('house_number')
                                        <span id="house_number" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="street">Street</label>
                                        <input value="{{ old('street', isset($row) ? $row->street : '') }}" type="text" class="form-control @error('street') is-invalid @enderror" name="street" id="street" placeholder="Enter Street">
                                        @error('street')
                                        <span id="street" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="town">Town</label>
                                        <input value="{{ old('town', isset($row) ? $row->town : '') }}" type="text" class="form-control @error('town') is-invalid @enderror" name="town" id="town" placeholder="Enter Town">
                                        @error('town')
                                        <span id="town" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="postal_code">Postal Code</label>
                                        <input value="{{ old('postal_code', isset($row) ? $row->postal_code : '') }}" type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" id="postal_code" placeholder="Enter Postal Code">
                                        @error('postal_code')
                                        <span id="postal_code" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="is_prev_epc" type="checkbox" id="is_prev_epc" value="{{ old('is_prev_epc', isset($row) ? $row->is_prev_epc : false) }}">
                                            <label for="is_prev_epc" class="custom-control-label">Any Previous EPC's</label>
                                            @error('is_prev_epc')
                                                <span id="is_prev_epc" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="epc_details" style="display: none">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="epc_rating">EPC Rating</label>
                                        <input value="{{ old('epc_rating', isset($row) ? $row->epc_rating : '') }}" type="number" class="form-control @error('epc_rating') is-invalid @enderror" name="epc_rating" id="epc_rating" placeholder="Enter EPC Rating">
                                        @error('epc_rating')
                                        <span id="epc_rating" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="epc_date">EPC Date</label>
                                        <input value="{{ old('epc_date', isset($row) ? $row->epc_date : '') }}" type="date" class="form-control @error('epc_date') is-invalid @enderror" name="epc_date" id="epc_date" placeholder="Enter EPC Date">
                                        @error('epc_date')
                                        <span id="epc_date" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="is_property_check" type="checkbox" id="is_property_check" value="{{ old('is_property_check', isset($row) ? $row->is_property_check : false) }}">
                                            <label for="is_property_check" class="custom-control-label">Online Pics of Property Check</label>
                                            @error('is_property_check')
                                            <span id="is_property_check" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="gas_safe_results">Gas safe results</label>
                                        <input value="{{ old('gas_safe_results', isset($row) ? $row->gas_safe_results : '') }}" type="text" class="form-control @error('gas_safe_results') is-invalid @enderror" name="gas_safe_results" id="gas_safe_results" placeholder="Enter Gas safe results">
                                        @error('gas_safe_results')
                                        <span id="gas_safe_results" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="property_type">Property Type</label>
                                        <input value="{{ old('property_type', isset($row) ? $row->property_type : '') }}" type="text" class="form-control @error('property_type') is-invalid @enderror" name="property_type" id="property_type" placeholder="Enter Property Type">
                                        @error('property_type')
                                        <span id="property_type" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="main_wall_type">Main Wall Type</label>
                                        <input value="{{ old('main_wall_type', isset($row) ? $row->main_wall_type : '') }}" type="text" class="form-control @error('main_wall_type') is-invalid @enderror" name="main_wall_type" id="main_wall_type" placeholder="Enter Main Wall Type">
                                        @error('main_wall_type')
                                        <span id="main_wall_type" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="extension_wall_type">Extension Wall Type</label>
                                        <input value="{{ old('extension_wall_type', isset($row) ? $row->extension_wall_type : '') }}" type="text" class="form-control @error('extension_wall_type') is-invalid @enderror" name="extension_wall_type" id="extension_wall_type" placeholder="Enter Extension Wall Type">
                                        @error('extension_wall_type')
                                        <span id="extension_wall_type" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="is_data_sent" type="checkbox" id="is_data_sent" value="{{ old('is_data_sent', isset($row) ? $row->is_data_sent : false) }}">
                                            <label for="is_data_sent" class="custom-control-label">Data match sent to Simple Green</label>
                                            @error('is_data_sent')
                                            <span id="is_data_sent" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="is_proof_sent" type="checkbox" id="is_proof_sent" value="{{ old('is_proof_sent', isset($row) ? $row->is_proof_sent : false) }}">
                                            <label for="is_proof_sent" class="custom-control-label">Benefit Proof and Proof of address sent</label>
                                            @error('is_proof_sent')
                                            <span id="is_proof_sent" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('leads.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card card-gray">
                        <div class="card-header">
                            <h3 class="card-title">Resident Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="resident_first_name">First Name</label>
                                        <input value="{{ old('resident_first_name', isset($row) ? $row->resident_first_name : '') }}" type="text" class="form-control @error('resident_first_name') is-invalid @enderror" name="resident_first_name" id="resident_first_name" placeholder="Enter First Name">
                                        @error('resident_first_name')
                                        <span id="resident_first_name" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="resident_mid_name">Mid Name</label>
                                        <input value="{{ old('resident_mid_name', isset($row) ? $row->resident_mid_name : '') }}" type="text" class="form-control @error('resident_mid_name') is-invalid @enderror" name="resident_mid_name" id="resident_mid_name" placeholder="Enter Mid Name">
                                        @error('resident_mid_name')
                                        <span id="resident_mid_name" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="resident_sur_name">Sur Name</label>
                                        <input value="{{ old('resident_sur_name', isset($row) ? $row->resident_sur_name : '') }}" type="text" class="form-control @error('resident_sur_name') is-invalid @enderror" name="resident_sur_name" id="resident_sur_name" placeholder="Enter Sur Name">
                                        @error('resident_sur_name')
                                        <span id="resident_sur_name" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="resident_dob">Date of Birth</label>
                                        <input value="{{ old('resident_dob', isset($row) ? $row->resident_dob : '') }}" type="date" class="form-control @error('resident_dob') is-invalid @enderror" name="resident_dob" id="resident_dob" placeholder="Enter Date of Birth">
                                        @error('resident_dob')
                                        <span id="resident_dob" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="resident_contact">Phone Number</label>
                                        <input value="{{ old('resident_contact', isset($row) ? $row->resident_contact : '') }}" type="tel" class="form-control @error('resident_contact') is-invalid @enderror" name="resident_contact" id="resident_contact" placeholder="Enter Phone Number">
                                        @error('resident_contact')
                                        <span id="resident_contact" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="resident_email">Email</label>
                                        <input value="{{ old('resident_email', isset($row) ? $row->resident_email : '') }}" type="email" class="form-control @error('resident_email') is-invalid @enderror" name="resident_email" id="resident_email" placeholder="Enter Email">
                                        @error('resident_email')
                                        <span id="resident_email" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">Select Resident Type</label>
                                        <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" style="width: 100%;">
                                                <option value="rented" {{ isset($row) ? $row->type == 'rented' ? 'selected': null : old('type') }}>Rented</option>
                                                <option value="owner" {{ isset($row) ? $row->type == 'owner' ? 'selected': null : old('type') }}>Home Owner</option>
                                        </select>
                                        @error('type')
                                        <span id="type" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="landlord_details" style="">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="owner_name">Landlord's Name</label>
                                        <input value="{{ old('owner_name', isset($row) ? $row->owner_name : '') }}" type="text" class="form-control @error('owner_name') is-invalid @enderror" name="owner_name" id="owner_name" placeholder="Enter Landlord's Name">
                                        @error('owner_name')
                                        <span id="owner_name" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="owner_contact">Landlord's Contact</label>
                                        <input value="{{ old('owner_contact', isset($row) ? $row->owner_contact : '') }}" type="tel" class="form-control @error('owner_contact') is-invalid @enderror" name="owner_contact" id="owner_contact" placeholder="Enter Landlord's Contact">
                                        @error('owner_contact')
                                        <span id="owner_contact" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="owner_email">Landlord's Email</label>
                                        <input value="{{ old('owner_email', isset($row) ? $row->owner_email : '') }}" type="text" class="form-control @error('owner_email') is-invalid @enderror" name="owner_email" id="owner_email" placeholder="Enter Landlord's Email">
                                        @error('owner_email')
                                        <span id="owner_email" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-gray">
                        <div class="card-header">
                            <h3 class="card-title">Benefit Recipient</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="benefit_type">Benefit Type</label>
                                        <input value="{{ old('benefit_type', isset($row) ? $row->benefit_type : '') }}" type="text" class="form-control @error('benefit_type') is-invalid @enderror" name="benefit_type" id="benefit_type" placeholder="Enter Benefit Type">
                                        @error('benefit_type')
                                        <span id="benefit_type" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="is_benefit_recipient">Select Benefit Recipient</label>
                                        <select class="form-control @error('is_benefit_recipient') is-invalid @enderror" id="is_benefit_recipient" name="is_benefit_recipient" style="width: 100%;">
                                            <option value="false" {{ isset($row) ? !$row->is_benefit_recipient ? 'selected': null : old('is_benefit_recipient') }}>No</option>
                                            <option value="true" {{ isset($row) ? $row->is_benefit_recipient ? 'selected': null : old('is_benefit_recipient') }}>Yes</option>
                                        </select>
                                        @error('is_benefit_recipient')
                                        <span id="is_benefit_recipient" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row benefit_details" style="">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="benefit_first_name">First Name</label>
                                        <input value="{{ old('benefit_first_name', isset($row) ? $row->benefit_first_name : '') }}" type="text" class="form-control @error('benefit_first_name') is-invalid @enderror" name="benefit_first_name" id="benefit_first_name" placeholder="Enter First Name">
                                        @error('benefit_first_name')
                                        <span id="benefit_first_name" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="benefit_mid_name">Mid Name</label>
                                        <input value="{{ old('benefit_mid_name', isset($row) ? $row->benefit_mid_name : '') }}" type="text" class="form-control @error('benefit_mid_name') is-invalid @enderror" name="benefit_mid_name" id="benefit_mid_name" placeholder="Enter Mid Name">
                                        @error('benefit_mid_name')
                                        <span id="benefit_mid_name" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row benefit_details" style="">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="benefit_sur_name">Sur Name</label>
                                        <input value="{{ old('benefit_sur_name', isset($row) ? $row->benefit_sur_name : '') }}" type="text" class="form-control @error('benefit_sur_name') is-invalid @enderror" name="benefit_sur_name" id="benefit_sur_name" placeholder="Enter Sur Name">
                                        @error('benefit_sur_name')
                                        <span id="benefit_sur_name" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="benefit_dob">Date of Birth</label>
                                        <input value="{{ old('benefit_dob', isset($row) ? $row->benefit_dob : '') }}" type="date" class="form-control @error('benefit_dob') is-invalid @enderror" name="benefit_dob" id="benefit_dob" placeholder="Enter Date of Birth">
                                        @error('benefit_dob')
                                        <span id="benefit_dob" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </form>
    <!-- /.card -->
@endsection
@push('scripts')
<script>
    $("#is_prev_epc").on('change', function() {
        if ($(this).is(':checked'))
            $(this).attr('value', 'true');
        else
            $(this).attr('value', 'false');
        $("#epc_details").toggle()
    });
    $("#is_property_check").on('change', function() {
        if ($(this).is(':checked'))
            $(this).attr('value', 'true');
        else
            $(this).attr('value', 'false');
    });
    $("#is_data_sent").on('change', function() {
        if ($(this).is(':checked'))
            $(this).attr('value', 'true');
        else
            $(this).attr('value', 'false');
    });
    $("#is_proof_sent").on('change', function() {
        if ($(this).is(':checked'))
            $(this).attr('value', 'true');
        else
            $(this).attr('value', 'false');
    });
    $("#type").on('change', function() {
        if($(this).val() === 'owner')
            $("#landlord_details").hide()
        else
            $("#landlord_details").show()
    })
    $("#is_benefit_recipient").on('change', function() {
        if($(this).val() == 'true')
            $(".benefit_details").hide()
        else
            $(".benefit_details").show()
    })
</script>
@endpush
