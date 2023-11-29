@extends('master')
@section('title', isset($row) ? 'Edit Lead': 'Create Lead')
@section('main-content')
        <!-- form start -->
            <form method="POST" action="{{ route('leads.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($row))
                <input type="hidden" name="lead_id" value="{{$row->id}}" />
            @endif
            <div class="row">
                <div class="col-6">
                    <div class="card card-gray">
                        <div class="card-header">
                            <h3 class="card-title">Lead Details</h3>
                        </div>
                        <div class="card-body">
                            @if(auth()->user()->role == 'admin')
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
                            @endif
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="house_number">House# / House Name</label>
                                        <input value="{{ old('house_number', isset($row) ? $row->house_number : '') }}" type="text" class="form-control @error('house_number') is-invalid @enderror" name="house_number" id="house_number" placeholder="Enter House# / House Name">
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
                                            <input class="custom-control-input" name="is_prev_epc" type="checkbox" id="is_prev_epc" value="" {{ old('is_prev_epc') == 'true' ? 'checked' : (isset($row) && $row->is_prev_epc ? 'checked' : '') }}>
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
                                            <input class="custom-control-input" name="is_property_check" type="checkbox" id="is_property_check" value="" {{ old('is_property_check') == 'true' ? 'checked' : (isset($row) && $row->is_property_check ? 'checked' : '') }}>
                                            <label for="is_property_check" class="custom-control-label">Online Pics of Property Check</label>
                                            @error('is_property_check')
                                            <span id="is_property_check" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="property_details" style="display: none">
                                <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="property_check_pic">Pictures</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" multiple class="custom-file-input" name="property_check_pictures[]" id="property_check_pic">
                                                <label class="custom-file-label" for="property_check_pic">Choose pictures</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Comments</label>
                                            <textarea class="form-control @error('comment') is-invalid @enderror" id="is_flexible" rows="4" placeholder="Enter Comments" name="comment">{{ isset($row) ? $row->comment : old('comment') }}</textarea>
                                            @error('comment')
                                            <span id="comment" class="error invalid-feedback">{{ $message }}</span>
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
                                        <select class="form-control @error('property_type') is-invalid @enderror" id="property_type" name="property_type" style="width: 100%;">
                                            <option value="Detached" {{ isset($row) && !$row->property_type ? 'selected': (old('property_type') == 'Detached' ? 'selected': '') }}>Detached</option>
                                            <option value="Semi Detached" {{ isset($row) && $row->property_type ? 'selected': (old('property_type') == 'Semi Detached' ? 'selected': '')}}>Semi Detached</option>
                                            <option value="Mid Terrace" {{ isset($row) && $row->property_type ? 'selected': (old('property_type') == 'Mid Terrace' ? 'selected': '')}}>Mid Terrace</option>
                                            <option value="End Terrace" {{ isset($row) && $row->property_type ? 'selected': (old('property_type') == 'End Terrace' ? 'selected': '')}}>End Terrace</option>
                                            <option value="banglow" {{ isset($row) && $row->property_type ? 'selected': (old('property_type') == 'banglow' ? 'selected': '')}}>Banalow</option>
                                        </select>
                                        @error('property_type')
                                        <span id="property_type" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="main_wall_type">Main Wall Type</label>
                                        <select class="form-control @error('main_wall_type') is-invalid @enderror" id="main_wall_type" name="main_wall_type" style="width: 100%;">
                                            <option value="Solid" {{ isset($row) && !$row->main_wall_type ? 'selected': (old('main_wall_type') == 'Solid' ? 'selected': '') }}>Solid</option>
                                            <option value="Cavity" {{ isset($row) && $row->main_wall_type ? 'selected': (old('main_wall_type') == 'Cavity' ? 'selected': '')}}>Cavity</option>
                                            <option value="Stone" {{ isset($row) && $row->main_wall_type ? 'selected': (old('main_wall_type') == 'Stone' ? 'selected': '')}}>Stone</option>
                                            <option value="Other" {{ isset($row) && $row->main_wall_type ? 'selected': (old('main_wall_type') == 'Other' ? 'selected': '')}}>Other</option>
                                        </select>
                                        @error('main_wall_type')
                                        <span id="main_wall_type" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4" style="display:none;" id="main_wall_other">
                                    <div class="form-group">
                                        <label for="main_wall_type_other">Other</label>
                                        <input value="{{ old('main_wall_type_other', isset($row) ? $row->main_wall_type_other : '') }}" type="text" class="form-control @error('main_wall_type_other') is-invalid @enderror" name="main_wall_type_other" id="main_wall_type_other" placeholder="Enter other">
                                        @error('main_wall_type_other')
                                        <span id="main_wall_type_other" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="extension_wall_type">Extension Wall Type</label>
                                        <select class="form-control @error('extension_wall_type') is-invalid @enderror" id="extension_wall_type" name="extension_wall_type" style="width: 100%;">
                                            <option value="Solid" {{ isset($row) && !$row->extension_wall_type ? 'selected': (old('extension_wall_type') == 'Solid' ? 'selected': '') }}>Solid</option>
                                            <option value="Cavity" {{ isset($row) && $row->extension_wall_type ? 'selected': (old('extension_wall_type') == 'Cavity' ? 'selected': '')}}>Cavity</option>
                                            <option value="Stone" {{ isset($row) && $row->extension_wall_type ? 'selected': (old('extension_wall_type') == 'Stone' ? 'selected': '')}}>Stone</option>
                                            <option value="N/A" {{ isset($row) && $row->extension_wall_type ? 'selected': (old('extension_wall_type') == 'N/A' ? 'selected': '')}}>N/A</option>
                                            <option value="Other" {{ isset($row) && $row->extension_wall_type ? 'selected': (old('extension_wall_type') == 'Other' ? 'selected': '')}}>Other</option>
                                        </select>
                                        @error('extension_wall_type')
                                        <span id="extension_wall_type" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4" style="display:none;" id="extension_wall_other">
                                    <div class="form-group">
                                        <label for="extension_wall_other">Other</label>
                                        <input value="{{ old('extension_wall_other', isset($row) ? $row->extension_wall_other : '') }}" type="text" class="form-control @error('extension_wall_other') is-invalid @enderror" name="extension_wall_other" id="extension_wall_other" placeholder="Enter other">
                                        @error('extension_wall_other')
                                        <span id="extension_wall_other" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="is_data_sent" type="checkbox" id="is_data_sent" value="" {{ old('is_data_sent') == 'true' ? 'checked' : (isset($row) && $row->is_data_sent ? 'checked' : '') }}>
                                            <label for="is_data_sent" class="custom-control-label">Data match sent to Simple Green</label>
                                            @error('is_data_sent')
                                            <span id="is_data_sent" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: none" id="data_match_pic">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="data_match_pic">Pictures</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" multiple class="custom-file-input" name="data_match_pictures[]">
                                                <label class="custom-file-label" for="data_match_pic">Choose pictures</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="is_benefit_proof_sent" type="checkbox" id="is_benefit_proof_sent" value="" {{ old('is_benefit_proof_sent') == 'true' ? 'checked' : (isset($row) && $row->is_benefit_proof_sent ? 'checked' : '') }}>
                                            <label for="is_benefit_proof_sent" class="custom-control-label">Benefit proof sent</label>
                                            @error('is_benefit_proof_sent')
                                            <span id="is_benefit_proof_sent" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: none" id="benefit_proof_pic">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="benefit_proof_pic">Pictures</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" multiple class="custom-file-input" name="benefit_proof_pictures[]">
                                                <label class="custom-file-label" for="benefit_proof_pic">Choose pictures</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="is_address_proof_sent" type="checkbox" id="is_address_proof_sent" value="" {{ old('is_address_proof_sent') == 'true' ? 'checked' : (isset($row) && $row->is_address_proof_sent ? 'checked' : '') }}>
                                            <label for="is_address_proof_sent" class="custom-control-label">Address proof sent</label>
                                            @error('is_address_proof_sent')
                                            <span id="is_address_proof_sent" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: none" id="address_proof_pic">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="address_proof_pic">Pictures</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" multiple class="custom-file-input" name="address_proof_pictures[]">
                                                <label class="custom-file-label" for="address_proof_pic">Choose pictures</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" name="is_other_picture" type="checkbox" id="is_other_picture" value="" {{ old('is_other_picture') == 'true' ? 'checked' : (isset($row) && count($row->other_pictures) ? 'checked' : '') }}>
                                                <label for="is_other_picture" class="custom-control-label">Other picture</label>
                                                @error('is_other_picture')
                                                <span id="is_other_picture" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="row" style="display: none" id="other_pic">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="other_pic">Pictures</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" multiple class="custom-file-input" name="other_pictures[]">
                                                <label class="custom-file-label" for="other_pic">Choose pictures</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                            <label>Notes</label>
                                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" rows="4" placeholder="Enter Notes" name="notes">{{ isset($row) ? $row->notes : old('notes') }}</textarea>
                                            @error('notes')
                                            <span id="notes" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('leads.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary" id="submit-btn">Save</button>
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
                                                <option value="rented" {{ isset($row) && $row->type == 'rented' ? 'selected' : (old('type') == 'rented' ? 'selected' : '') }}>Rented</option>
                                                <option value="owner" {{ isset($row) && $row->type == 'owner' ? 'selected' : (old('type') == 'owner' ? 'selected' : '') }}>Home Owner</option>
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
                                        <label for="benefit_type">Select Benefit Type</label>
                                        <select class="form-control @error('benefit_type') is-invalid @enderror" id="benefit_type" name="benefit_type" style="width: 100%;">
                                            <option value="Income Base Job Seeker’s Allowance (JSA)" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Income Base Job Seeker’s Allowance (JSA)' ? 'selected': '') }}>Income Base Job Seeker’s Allowance (JSA)</option>
                                            <option value="Income Related Employment & Support Allowance (ESA)" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Income Related Employment & Support Allowance (ESA)' ? 'selected': '') }}>Income Related Employment & Support Allowance (ESA)</option>
                                            <option value="income Support (IS)" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'income Support (IS)' ? 'selected': '') }}>Income Support (IS)</option>
                                            <option value="Pension Guarantee Credit" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Pension Guarantee Credit' ? 'selected': '') }}>Pension Guarantee Credit</option>
                                            <option value="Working Tax Credit (WTC)" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Working Tax Credit (WTC)' ? 'selected': '') }}>Working Tax Credit (WTC)</option>
                                            <option value="Child Tax Credit (CTC)" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Child Tax Credit (CTC)' ? 'selected': '') }}>Child Tax Credit (CTC)</option>
                                            <option value="Universal Credit (UC)" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Universal Credit (UC)' ? 'selected': '') }}>Universal Credit (UC)</option>
                                            <option value="Housing Benefit (New Eligible Benefit under EC04)" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Housing Benefit (New Eligible Benefit under EC04)' ? 'selected': '') }}>Housing Benefit (New Eligible Benefit under EC04)</option>
                                            <option value="Pension Savings Credit (New Eligible Under EC04)" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Pension Savings Credit (New Eligible Under EC04)' ? 'selected': '') }}>Pension Savings Credit (New Eligible Under EC04)</option>
                                            <option value="Single Claimant 1 Child - £19,900" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Single Claimant 1 Child - £19,900' ? 'selected': '') }}>Single Claimant 1 Child - £19,900</option>
                                            <option value="Single Claimant 2 Child - £24,800" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Single Claimant 2 Child - £24,800' ? 'selected': '') }}>Single Claimant 2 Child - £24,800</option>
                                            <option value="Single Claimant 3 Child - £29,600" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Single Claimant 3 Child - £29,600' ? 'selected': '') }}>Single Claimant 3 Child - £29,600</option>
                                            <option value="Single Claimant 4 Child - £35,500" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Single Claimant 4 Child - £35,500' ? 'selected': '') }}>Single Claimant 4 Child - £35,500</option>
                                            <option value="Multiple Claimant 1 Child - £27,500" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Multiple Claimant 1 Child - £27,500' ? 'selected': '') }}>Multiple Claimant 1 Child - £27,500</option>
                                            <option value="Multiple Claimant 2 Child - £32,300" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Multiple Claimant 2 Child - £32,300' ? 'selected': '') }}>Multiple Claimant 2 Child - £32,300</option>
                                            <option value="Multiple Claimant 3 Child - £37,200" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Multiple Claimant 3 Child - £37,200' ? 'selected': '') }}>Multiple Claimant 3 Child - £37,200</option>
                                            <option value="Multiple Claimant 4 Child - £42,000" {{ isset($row) && !$row->benefit_type ? 'selected': (old('benefit_type') == 'Multiple Claimant 4 Child - £42,000' ? 'selected': '') }}>Multiple Claimant 4 Child - £42,000</option>
                                        </select>
                                        @error('benefit_type')
                                        <span id="benefit_type" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="is_benefit_recipient">Select Benefit Recipient</label>
                                        <select class="form-control @error('is_benefit_recipient') is-invalid @enderror" id="is_benefit_recipient" name="is_benefit_recipient" style="width: 100%;">
                                            <option value="false" {{ isset($row) && !$row->is_benefit_recipient ? 'selected': (old('is_benefit_recipient') == 'false' ? 'selected': '') }}>Other</option>
                                            <option value="true" {{ isset($row) && $row->is_benefit_recipient ? 'selected': (old('is_benefit_recipient') == 'true' ? 'selected': '')}}>Resident</option>
                                        </select>
                                        @error('is_benefit_recipient')
                                        <span id="is_benefit_recipient" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="benefit_details" style="">
                                <div class="row">
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
                                <div class="row">
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
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="relationship">Relationship</label>
                                            <select class="form-control @error('relationship') is-invalid @enderror" id="relationship" name="relationship" style="width: 100%;">
                                                <option value="father" {{ isset($row) && !$row->relationship ? 'selected': (old('relationship') == 'father' ? 'selected': '') }}>Father</option>
                                                <option value="mother" {{ isset($row) && $row->relationship ? 'selected': (old('relationship') == 'mother' ? 'selected': '')}}>Mother</option>
                                                <option value="son" {{ isset($row) && $row->relationship ? 'selected': (old('relationship') == 'son' ? 'selected': '')}}>Son</option>
                                                <option value="daughter" {{ isset($row) && $row->relationship ? 'selected': (old('relationship') == 'daughter' ? 'selected': '')}}>Daughter</option>
                                            </select>
                                            @error('relationship')
                                            <span id="relationship" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
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
        if ($(this).is(':checked')) {
            $(this).attr('value', 'true');
            $("#epc_details").show()
        } else {
            $(this).attr('value', 'false');
            $("#epc_details").hide()
        }
    }).change();
    $("#is_property_check").on('change', function () {
        if ($(this).is(':checked')) {
            $(this).attr('value', 'true');
            $(".property_details").show()
        } else {
            $(this).attr('value', 'false');
            $(".property_details").hide()
        }
    }).change();
    $("#is_data_sent").on('change', function() {
        if ($(this).is(':checked')) {
            $("#data_match_pic").show()
            $(this).attr('value', 'true');
        } else {
            $("#data_match_pic").hide()
            $(this).attr('value', 'false');
        }
        checkAll();
    }).change();
    $("#is_benefit_proof_sent").on('change', function() {
        if ($(this).is(':checked')) {
            $("#benefit_proof_pic").show()
            $(this).attr('value', 'true');
        } else {
            $("#benefit_proof_pic").hide()
            $(this).attr('value', 'false');
        }
        checkAll()
    }).change();
    $("#is_address_proof_sent").on('change', function() {
        if ($(this).is(':checked')) {
            $("#address_proof_pic").show()
            $(this).attr('value', 'true');
        } else {
            $("#address_proof_pic").hide()
            $(this).attr('value', 'false');
        }
        checkAll()
    }).change();
    $('input:file').change(function(e) {
        const fileNames = Object.values(e.target.files).map(file => file.name).join(', ');
        $(this).siblings().html(fileNames)
    });
    $("#is_other_picture").on('change', function() {
        if ($(this).is(':checked')) {
            $("#other_pic").show()
            $(this).attr('value', 'true');
        } else {
            $("#other_pic").hide()
            $(this).attr('value', 'false');
        }
    }).change();
    $("#type").on('change', function() {
        if($(this).val() === 'owner')
            $("#landlord_details").hide()
        else
            $("#landlord_details").show()
    }).change()
    $("#extension_wall_type").on('change', function() {
        if($(this).val() === 'Other')
            $("#extension_wall_other").show()
        else
            $("#extension_wall_other").hide()
    }).change();
    $("#main_wall_type").on('change', function() {
        if($(this).val() === 'Other')
            $("#main_wall_other").show()
        else
            $("#main_wall_other").hide()
    }).change();
    $("#is_benefit_recipient").on('change', function() {
        if($(this).val() == 'true')
            $(".benefit_details").hide()
        else
            $(".benefit_details").show()
    }).change();
    function checkAll() {
        if ($("#is_benefit_proof_sent").val() == 'true' && $("#is_data_sent").val() == 'true' && $("#is_address_proof_sent").val() == 'true')
            $('#submit-btn').html('Submit');
        else
            $('#submit-btn').html('Save');
    }
</script>
@endpush
