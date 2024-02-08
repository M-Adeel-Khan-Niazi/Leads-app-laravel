@extends('master')
@section('title', 'Lead Details')
@section('main-content')
    <div class="card card-primary">
        <!-- form start -->
        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error')}}
            </div>
        @endif
        <form method="POST" action="{{ route('leads.update', $lead->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body p-0">
                <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                        <!-- your steps here -->
                        <div class="step" data-target="#part-1">
                            <button type="button" class="step-trigger" role="tab" aria-controls="part-1" id="part-1-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Data Match & Land Registry</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#part-2">
                            <button type="button" class="step-trigger" role="tab" aria-controls="part-2" id="part-2-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Lead Status</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#part-3">
                            <button type="button" class="step-trigger" role="tab" aria-controls="part-3" id="part-3-trigger">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Retrofit Assessment / Findings</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#part-4">
                            <button type="button" class="step-trigger" role="tab" aria-controls="part-4" id="part-4-trigger">
                                <span class="bs-stepper-circle">4</span>
                                <span class="bs-stepper-label">Measures to install</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#part-5">
                            <button type="button" class="step-trigger" role="tab" aria-controls="part-5" id="part-5-trigger">
                                <span class="bs-stepper-circle">5</span>
                                <span class="bs-stepper-label">Additional Costs</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#part-6">
                            <button type="button" class="step-trigger" role="tab" aria-controls="part-6" id="part-6-trigger">
                                <span class="bs-stepper-circle">6</span>
                                <span class="bs-stepper-label">Summary</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <!-- PART 1 -->
                        <div id="part-1" class="content" role="tabpanel" aria-labelledby="part-1-trigger">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="land_reg_check">Land Registry Check</label>
                                        <select class="form-control @error('land_reg_check') is-invalid @enderror" id="land_reg_check" name="land_reg_check" style="width: 100%;">
                                            <option value="Downloaded" {{ isset($row) && $row->land_reg_check == 'Downloaded' ? 'selected' : (old('land_reg_check') == 'Downloaded' ? 'selected': '')}}>Downloaded</option>
                                            <option value="Not Available" {{ isset($row) && $row->land_reg_check == 'Not Available' ? 'selected' : (old('land_reg_check') == 'Not Available' ? 'selected': '') }}>Not Available</option>
                                        </select>
                                        @error('land_reg_check')
                                        <span id="land_reg_check" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="land_reg_matched">Land Registry Matched</label>
                                        <select class="form-control @error('land_reg_matched') is-invalid @enderror" id="land_reg_matched" name="land_reg_matched" style="width: 100%;">
                                            <option value="true" {{ isset($row) && $row->land_reg_matched ? 'selected' : (old('land_reg_matched') ? 'selected': '')}}>Yes</option>
                                            <option value="false" {{ isset($row) && !$row->land_reg_matched ? 'selected' : (old('land_reg_matched') == 'false' ? 'selected': '') }}>No</option>
                                        </select>
                                        @error('land_reg_matched')
                                        <span id="land_reg_matched" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="is_match_sent">Data Match Request Sent</label>
                                        <select class="form-control @error('is_match_sent') is-invalid @enderror" id="is_match_sent" name="is_match_sent" style="width: 100%;">
                                            <option value="true" {{ isset($row) && $row->is_match_sent ? 'selected' : (old('is_match_sent') ? 'selected': '')}}>Yes</option>
                                            <option value="false" {{ isset($row) && !$row->is_match_sent ? 'selected' : (old('is_match_sent') == 'false' ? 'selected': '') }}>No</option>
                                        </select>
                                        @error('is_match_sent')
                                        <span id="is_match_sent" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="data_match_result">Data Match Result</label>
                                        <select class="form-control @error('data_match_result') is-invalid @enderror" id="data_match_result" name="data_match_result" style="width: 100%;">
                                            <option value="Awaiting" {{ isset($row) && $row->data_match_result == 'Awaiting' ? 'selected' : (old('data_match_result') == 'Awaiting' ? 'selected': '')}}>Awaiting</option>
                                            <option value="Matched" {{ isset($row) && $row->data_match_result == 'Matched' ? 'selected' : (old('data_match_result') == 'Matched' ? 'selected': '')}}>Matched</option>
                                            <option value="Unmatched" {{ isset($row) && $row->data_match_result == 'Unmatched' ? 'selected' : (old('data_match_result') == 'Unmatched' ? 'selected': '')}}>Unmatched</option>
                                            <option value="Unverified" {{ isset($row) && $row->data_match_result == 'Unverified' ? 'selected' : (old('data_match_result') == 'Unverified' ? 'selected': '')}}>Unverified</option>
                                        </select>
                                        @error('data_match_result')
                                        <span id="data_match_result" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="stepper.next()" style="">Next</button>
                        </div>
                        <!-- PART 2 -->
                        <div id="part-2" class="content" role="tabpanel" aria-labelledby="part-2-trigger">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">Lead Status</label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" style="width: 100%;">
                                            <option value="Approved" {{ isset($row) && $row->status == 'Approved' ? 'selected' : (old('status') == 'Approved' ? 'selected': '')}}>Approved</option>
                                            <option value="Rejected" {{ isset($row) && $row->status == 'Rejected' ? 'selected' : (old('status') == 'Rejected' ? 'selected': '') }}>Rejected</option>
                                            <option value="On Hold" {{ isset($row) && $row->status == 'On Hold' ? 'selected' : (old('status') == 'On Hold' ? 'selected': '') }}>On Hold</option>
                                        </select>
                                        @error('status')
                                        <span id="status" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Comments</label>
                                        <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" rows="4" placeholder="Enter Comments" name="comment">{{ isset($row) ? $row->comment : old('comment') }}</textarea>
                                        @error('comment')
                                        <span id="comment" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                            <button type="button" class="btn btn-primary next_btn" onclick="stepper.next()" style="">Next</button>
                            <button type="submit" class="btn btn-primary submit_btn" style="display: none">Submit</button>
                        </div>
                        <!-- PART 3 -->
                        <div id="part-3" class="content" role="tabpanel" aria-labelledby="part-3-trigger">

                            <button type="button" class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                            <button type="button" class="btn btn-primary" onclick="stepper.next()" style="">Next</button>
                        </div>
                        <!-- PART 4 -->
                        <div id="part-4" class="content" role="tabpanel" aria-labelledby="part-4-trigger">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" onchange="addMeasureForm('Non Condensing Boiler Replacement')" name="is_boiler_replacement" type="checkbox" id="is_boiler_replacement" {{ old('is_boiler_replacement') == 'true' ? 'checked' : (isset($row) && $row->is_boiler_replacement ? 'checked' : '') }}>
                                            <label for="is_boiler_replacement" class="custom-control-label">Non Condensing Boiler Replacement</label>
                                            @error('is_boiler_replacement')
                                            <span id="is_boiler_replacement" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" onchange="addMeasureForm('External wall insulation')" name="is_external_wall_insulation" type="checkbox" id="is_external_wall_insulation" {{ old('is_external_wall_insulation') == 'true' ? 'checked' : (isset($row) && $row->is_external_wall_insulation ? 'checked' : '') }}>
                                            <label for="is_external_wall_insulation" class="custom-control-label">External wall insulation</label>
                                            @error('is_external_wall_insulation')
                                            <span id="is_external_wall_insulation" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" onchange="addMeasureForm('First Time Central Heating')" name="is_first_time_central_heating" type="checkbox" id="is_first_time_central_heating" {{ old('is_first_time_central_heating') == 'true' ? 'checked' : (isset($row) && $row->is_first_time_central_heating ? 'checked' : '') }}>
                                            <label for="is_first_time_central_heating" class="custom-control-label">First Time Central Heating</label>
                                            @error('is_first_time_central_heating')
                                            <span id="is_first_time_central_heating" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" onchange="addMeasureForm('Internal wall insulation')" name="is_internal_wall_insulation" type="checkbox" id="is_internal_wall_insulation" {{ old('is_internal_wall_insulation') == 'true' ? 'checked' : (isset($row) && $row->is_internal_wall_insulation ? 'checked' : '') }}>
                                            <label for="is_internal_wall_insulation" class="custom-control-label">Internal wall insulation</label>
                                            @error('is_internal_wall_insulation')
                                            <span id="is_internal_wall_insulation" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" onchange="addMeasureForm('Cavity Wall insulation')" name="is_cavity_wall_insulation" type="checkbox" id="is_cavity_wall_insulation" {{ old('is_cavity_wall_insulation') == 'true' ? 'checked' : (isset($row) && $row->is_cavity_wall_insulation ? 'checked' : '') }}>
                                            <label for="is_cavity_wall_insulation" class="custom-control-label">Cavity Wall insulation</label>
                                            @error('is_cavity_wall_insulation')
                                            <span id="is_cavity_wall_insulation" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" onchange="addMeasureForm('Under Floor insulation')" name="is_under_floor_insulation" type="checkbox" id="is_under_floor_insulation" {{ old('is_under_floor_insulation') == 'true' ? 'checked' : (isset($row) && $row->is_under_floor_insulation ? 'checked' : '') }}>
                                            <label for="is_under_floor_insulation" class="custom-control-label">Under Floor insulation</label>
                                            @error('is_under_floor_insulation')
                                            <span id="is_under_floor_insulation" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" onchange="addMeasureForm('Loft insulation')" name="is_loft_insulation" type="checkbox" id="is_loft_insulation" {{ old('is_loft_insulation') == 'true' ? 'checked' : (isset($row) && $row->is_under_floor_insulation ? 'checked' : '') }}>
                                            <label for="is_loft_insulation" class="custom-control-label">Loft insulation</label>
                                            @error('is_loft_insulation')
                                            <span id="is_loft_insulation" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" onchange="addMeasureForm('Heating controls')" name="is_heating_controls" type="checkbox" id="is_heating_controls" {{ old('is_heating_controls') == 'true' ? 'checked' : (isset($row) && $row->is_heating_controls ? 'checked' : '') }}>
                                            <label for="is_heating_controls" class="custom-control-label">Heating controls</label>
                                            @error('is_heating_controls')
                                            <span id="is_heating_controls" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" onchange="addMeasureForm('Solar PV')" name="is_solar_pv" type="checkbox" id="is_solar_pv" {{ old('is_solar_pv') == 'true' ? 'checked' : (isset($row) && $row->is_solar_pv ? 'checked' : '') }}>
                                            <label for="is_solar_pv" class="custom-control-label">Solar PV</label>
                                            @error('is_solar_pv')
                                            <span id="is_solar_pv" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" onchange="addMeasureForm('Air Source Heat pump')" name="is_air_source" type="checkbox" id="is_air_source" {{ old('is_air_source') == 'true' ? 'checked' : (isset($row) && $row->is_air_source ? 'checked' : '') }}>
                                            <label for="is_air_source" class="custom-control-label">Air Source Heat pump</label>
                                            @error('is_air_source')
                                            <span id="is_air_source" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" onchange="addMeasureForm('Storage Heater')" name="is_storage_heater" type="checkbox" id="is_storage_heater" {{ old('is_storage_heater') == 'true' ? 'checked' : (isset($row) && $row->is_storage_heater ? 'checked' : '') }}>
                                            <label for="is_storage_heater" class="custom-control-label">Storage Heater</label>
                                            @error('is_storage_heater')
                                            <span id="is_storage_heater" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" onchange="addMeasureForm('RIR')" name="is_rir" type="checkbox" id="is_rir" {{ old('is_rir') == 'true' ? 'checked' : (isset($row) && $row->is_rir ? 'checked' : '') }}>
                                            <label for="is_rir" class="custom-control-label">RIR</label>
                                            @error('is_rir')
                                            <span id="is_rir" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(isset($row))
                                @foreach($row->measure_types as $measure_type)
                                    <div class="measure-type">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="m2">M2</label>
                                                    <input value="{{ old('m2', $measure_type->m2) }}" type="text" class="form-control @error('m2') is-invalid @enderror" name="m2" id="m2" placeholder="Enter M2">
                                                    @error('m2')
                                                    <span id="m2" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="installer_id">Select Installer</label>
                                                    <select class="form-control select2 @error('installer_id') is-invalid @enderror" name="installer_id" style="width: 100%;">
                                                        <option disabled selected value> -- select installer -- </option>
                                                        @foreach($installers as $installer)
                                                            <option value="{{ $installer->id }}" {{ $measure_type->installer_id == $installer->id ? 'selected' : (old('installer_id') == $installer->id ? 'selected': '') }}>
                                                                {{ $installer->first_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('installer_id')
                                                    <span id="installer_id" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="cost">Installer Cost</label>
                                                    <input value="{{ old('cost', $measure_type->cost) }}" type="number" min="0" class="form-control @error('cost') is-invalid @enderror" name="cost" id="cost" placeholder="Enter Installer Cost">
                                                    @error('cost')
                                                    <span id="cost" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="material_cost">Material Cost</label>
                                                    <input value="{{ old('material_cost', $measure_type->material_cost) }}" type="number" min="0" class="form-control @error('material_cost') is-invalid @enderror" name="material_cost" id="material_cost" placeholder="Enter Material Cost">
                                                    @error('material_cost')
                                                    <span id="material_cost" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="start_date">Install Start Date</label>
                                                    <input value="{{ old('start_date', $measure_type->start_date) }}" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date" placeholder="Enter Install Start Date">
                                                    @error('start_date')
                                                    <span id="start_date" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="completion_date">Install Completion Date</label>
                                                    <input value="{{ old('completion_date', $measure_type->completion_date) }}" type="date" class="form-control @error('completion_date') is-invalid @enderror" name="completion_date" id="completion_date" placeholder="Enter Install Completion Date">
                                                    @error('completion_date')
                                                    <span id="completion_date" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="is_warranty_applied">Warranties Applied</label>
                                                    <select class="form-control @error('is_warranty_applied') is-invalid @enderror" id="is_warranty_applied" name="is_warranty_applied" style="width: 100%;">
                                                        <option value="true" {{ $measure_type->is_warranty_applied == 'true' ? 'selected' : (old('is_warranty_applied') == 'true' ? 'selected': '') }}>Yes</option>
                                                        <option value="false" {{ $measure_type->is_warranty_applied == 'false' ? 'selected' : (old('is_warranty_applied') == 'false' ? 'selected': '')}}>No</option>
                                                    </select>
                                                    @error('is_warranty_applied')
                                                    <span id="is_warranty_applied" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="ibg_cost">IBG Cost</label>
                                                    <input value="{{ old('ibg_cost', $measure_type->ibg_cost) }}" type="number" min="0" class="ibg_cost form-control @error('ibg_cost') is-invalid @enderror" name="ibg_cost" id="ibg_cost" placeholder="Enter IBG Cost">
                                                    @error('ibg_cost')
                                                    <span id="ibg_cost" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-4 d-flex justify-content-center align-items-center mt-2">
                                                <button type="button" class="btn btn-primary mx-2" onclick="addType()"><i class="fas fa-plus-square"></i></button>
                                                <button type="button" class="btn btn-danger mx-2 remove_type"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            @else
                                <div id="measure-type"></div>
                            @endif
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="total_material">Total Material Cost</label>
                                        <input value="0" type="number" min="0" readonly class="form-control" id="total_material" name="total_material">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="total_installer">Total Installer Cost</label>
                                        <input value="0" type="number" min="0" readonly class="form-control" id="total_installer" name="total_installer">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="sub_total">Sub Total</label>
                                        <input value="0" type="number" min="0" readonly class="form-control" id="sub_total" name="sub_total">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                            <button type="button" class="btn btn-primary" onclick="stepper.next()">Next</button>
                        </div>
                        <!-- PART 5 -->
                        <div id="part-5" class="content" role="tabpanel" aria-labelledby="part-5-trigger">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="trickle_vents">Trickle Vents</label>
                                        <input value="{{ old('trickle_vents', 0) }}" type="number" min="0" class="form-control @error('trickle_vents') is-invalid @enderror" name="trickle_vents" id="trickle_vents" placeholder="Enter Trickle Vents">
                                        @error('trickle_vents')
                                        <span id="trickle_vents" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="air_brick">Air Brick</label>
                                        <input value="{{ old('air_brick', 0) }}" type="number" min="0" class="form-control @error('air_brick') is-invalid @enderror" name="air_brick" id="air_brick" placeholder="Enter Air Brick">
                                        @error('air_brick')
                                        <span id="air_brick" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="fans">Fans</label>
                                        <input value="{{ old('fans', 0) }}" type="number" min="0" class="form-control @error('fans') is-invalid @enderror" name="fans" id="fans" placeholder="Enter Fans">
                                        @error('fans')
                                        <span id="fans" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="minor_work_cert">Minor Works Cert</label>
                                        <input value="{{ old('minor_work_cert', 0) }}" type="number" min="0" class="form-control @error('minor_work_cert') is-invalid @enderror" name="minor_work_cert" id="minor_work_cert" placeholder="Enter Minor Works Cert">
                                        @error('minor_work_cert')
                                        <span id="minor_work_cert" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="roof_vents">Roof Vents</label>
                                        <input value="{{ old('roof_vents', 0) }}" type="number" min="0" class="form-control @error('roof_vents') is-invalid @enderror" name="roof_vents" id="roof_vents" placeholder="Enter Roof Vents">
                                        @error('roof_vents')
                                        <span id="roof_vents" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="door_undercut">Door Undercut</label>
                                        <input value="{{ old('door_undercut', 0) }}" type="number" min="0" class="form-control @error('door_undercut') is-invalid @enderror" name="door_undercut" id="door_undercut" placeholder="Enter Door Undercut">
                                        @error('door_undercut')
                                        <span id="door_undercut" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="other_ventilation">Other Ventilation</label>
                                        <input value="{{ old('other_ventilation', 0) }}" type="number" min="0" class="form-control @error('other_ventilation') is-invalid @enderror" name="other_ventilation" id="other_ventilation" placeholder="Enter Other Ventilation">
                                        @error('other_ventilation')
                                        <span id="other_ventilation" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="retrofit_coordinator_cost">Retrofit Coordinator Cost</label>
                                        <input value="{{ old('retrofit_coordinator_cost', 0) }}" type="number" min="0" class="form-control @error('retrofit_coordinator_cost') is-invalid @enderror" name="retrofit_coordinator_cost" id="retrofit_coordinator_cost" placeholder="Enter Retrofit Coordinator Cost">
                                        @error('retrofit_coordinator_cost')
                                        <span id="retrofit_coordinator_cost" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="retrofit_assessor_cost">Retrofit Assessor Cost</label>
                                        <input value="{{ old('retrofit_assessor_cost', 0) }}" type="number" min="0" class="form-control @error('retrofit_assessor_cost') is-invalid @enderror" name="retrofit_assessor_cost" id="retrofit_assessor_cost" placeholder="Enter Retrofit Assessor Cost">
                                        @error('retrofit_assessor_cost')
                                        <span id="retrofit_assessor_cost" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="gas_safe_reg">Gas Safe-CPS-land Reg</label>
                                        <input value="{{ old('gas_safe_reg', 0) }}" type="number" min="0" class="form-control @error('gas_safe_reg') is-invalid @enderror" name="gas_safe_reg" id="gas_safe_reg" placeholder="Enter Gas Safe-CPS-land Reg">
                                        @error('gas_safe_reg')
                                        <span id="gas_safe_reg" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="handover_on">Handover Date</label>
                                        <input value="{{ old('handover_on') }}" type="date" class="form-control @error('handover_on') is-invalid @enderror" name="handover_on" id="handover_on" placeholder="Enter Handover date">
                                        @error('handover_on')
                                        <span id="handover_on" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="status">Funder Paper Work</label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" style="width: 100%;">
                                            <option value="" {{ isset($row) && $row->is_completed_submission ? 'selected' : (old('is_completed_submission') == 'true' ? 'selected': '')}}>N/A</option>
                                            <option value="true" {{ isset($row) && $row->is_completed_submission ? 'selected' : (old('is_completed_submission') == 'true' ? 'selected': '')}}>Pending</option>
                                            <option value="false" {{ isset($row) && !$row->is_completed_submission ? 'selected' : (old('is_completed_submission') == 'false' ? 'selected': '') }}>Submitted</option>
                                            <option value="false" {{ isset($row) && !$row->is_completed_submission ? 'selected' : (old('is_completed_submission') == 'false' ? 'selected': '') }}>Error</option>
                                            <option value="false" {{ isset($row) && !$row->is_completed_submission ? 'selected' : (old('is_completed_submission') == 'false' ? 'selected': '') }}>Accepted</option>
                                        </select>
                                        @error('is_completed_submission')
                                        <span id="is_completed_submission" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                            <button type="button" class="btn btn-primary" onclick="summary_calculate()" style="">Next</button>
                        </div>
                        <!-- PART 6 -->
                        <div id="part-6" class="content" role="tabpanel" aria-labelledby="part-6-trigger">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="funding">Funding</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">£</span>
                                            </div>
                                            <input value="0" type="number" disabled class="form-control" id="funding_summary">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="total_cost">Total Cost of Job</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">£</span>
                                            </div>
                                            <input value="0" type="number" name="total_cost" readonly class="form-control" id="total_cost">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="gross_profit">Gross Profit</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">£</span>
                                            </div>
                                            <input value="0" type="number" readonly class="form-control" name="gross_profit" id="gross_profit">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="introducer_share">Introducer Share</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input value="0" type="number" name="introducer_share" min="0" max="100" class="form-control" id="introducer_share">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="introducer_fee">Introducer Fee Payable</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">£</span>
                                            </div>
                                            <input value="0" type="number" readonly class="form-control" name="introducer_fee" id="introducer_fee">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="net_profit">Net Profit</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">£</span>
                                            </div>
                                            <input value="0" type="number" readonly class="form-control" name="net_profit" id="net_profit">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection
@push('scripts')
    <script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
        function fundingCal() {
            const score = $("#abs_score").val();
            const rate = $("#rate").val();
            const funding = score * rate;
            $('#funding').attr('value', funding);
            $('#funding_summary').attr('value', funding);
        }
        function summary_calculate() {
            const funding = parseInt($("#funding").val());
            const sub_total = parseInt($("#sub_total").val());
            const trickle_vents = parseInt($("#trickle_vents").val());
            const air_brick = parseInt($("#air_brick").val());
            const fans = parseInt($("#fans").val());
            const minor_work_cert = parseInt($("#minor_work_cert").val());
            const roof_vents = parseInt($("#roof_vents").val());
            const door_undercut = parseInt($("#door_undercut").val());
            const other_ventilation = parseInt($("#other_ventilation").val());
            const gas_safe_reg = parseInt($("#gas_safe_reg").val());
            const retrofit_coordinator_cost = parseInt($("#retrofit_coordinator_cost").val());
            const retrofit_assessor_cost = parseInt($("#retrofit_assessor_cost").val());
            let total_ibg_cost = 0;
            $(".ibg_cost").each(function() {
                total_ibg_cost += parseFloat(this.value);
            });

            const total_cost = sub_total + trickle_vents + air_brick + fans + minor_work_cert + roof_vents + door_undercut + other_ventilation + gas_safe_reg + retrofit_assessor_cost + retrofit_coordinator_cost + total_ibg_cost;
            const gross_profit = total_cost - funding;
            $('#total_cost').attr('value', total_cost);
            $('#gross_profit').attr('value', gross_profit);
            $('#net_profit').attr('value', gross_profit);
            stepper.next();
        }
        let form_index = 0;
        let material_index = [];
        let installer_index = [];
        function addMaterial(id) {
            material_index[`${id}`]++;
            $("#" + id + " .materials:last").after(`<div class="row materials">
    <div class="col-5">
        <div class="form-group">
            <label for="material_name">Material</label>
            <input value="{{ old('material_name') }}" type="text" class="form-control @error('material_name') is-invalid @enderror" name="types[${form_index}][materials][${material_index[id]}][title]" id="material_name" placeholder="Enter Material Name">
            @error('material_name')
            <span id="material_name" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            </div>
        </div>
        <div class="col-5">
            <div class="form-group">
                <label for="material_cost">Material Cost</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">£</span>
                    </div>
                    <input value="{{ old('material_cost', 0) }}" type="number" min="0" class="form-control m-cost @error('material_cost') is-invalid @enderror" name="types[${form_index}][materials][${material_index[id]}][cost]" id="material_cost" placeholder="Enter Material Cost">
                @error('material_cost')
            <span id="material_cost" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            <div class="input-group-append">
                <span class="input-group-text">.00</span>
            </div>
        </div>
    </div>
</div>
<div class="col-2 d-flex justify-content-center align-items-center mt-2">
    <button type="button" class="btn btn-danger mx-2 remove_material"><i class="fas fa-trash"></i></button>
</div>
</div>`);
        }
        function addInstaller(id) {
            installer_index[`${id}`]++;
            $("#" + id + " .installers:last").after(`<div class="row installers">
    <div class="col-5">
        <div class="form-group">
            <label for="title">Installer</label>
            <input value="{{ old('title') }}" type="text" class="form-control @error('title') is-invalid @enderror" name="types[${form_index}][installers][${installer_index[id]}][title]" id="installer_title" placeholder="Enter Installer">
            @error('title')
            <span id="title" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            </div>
        </div>
        <div class="col-5">
            <div class="form-group">
                <label for="cost">Installer Cost</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">£</span>
                    </div>
                    <input value="{{ old('cost', 0) }}" type="number" min="0" class="form-control i-cost @error('cost') is-invalid @enderror" name="types[${form_index}][installers][${installer_index[id]}][cost]" id="installer_cost" placeholder="Enter Installer Cost">
                @error('cost')
            <span id="cost" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            <div class="input-group-append">
                <span class="input-group-text">.00</span>
            </div>
        </div>
    </div>
</div>
<div class="col-2 d-flex justify-content-center align-items-center mt-2">
    <button type="button" class="btn btn-danger mx-2 remove_installer"><i class="fas fa-trash"></i></button>
</div>
</div>`);
        }
        function convertToSlug(Text) {
            return Text.toLowerCase()
                .replace(/ /g, "-")
                .replace(/[^\w-]+/g, "");
        }

        function addMeasureForm(type) {
            const slug = convertToSlug(type);
            material_index[`${slug}`] = 0;
            installer_index[`${slug}`] = 0;
            form_index = $("#measure-type .card-outline").length;
            if ($('#' + slug).length) {
                $('#' + slug).remove()
                form_index--
            } else {
                $("#measure-type").append(`<div class="card-outline card-primary" id="${slug}">
    <div class="card-header">
        <div class="row">
            <div class="col-6 m-auto">
                <h3 class="card-title">${type}</h3>
            </div>
            <div class="col-6">
                <div class="form-group m-auto">
                    <select class="form-control @error('types[${form_index}][measure_status]') is-invalid @enderror" name="types[${form_index}][measure_status]" style="width: 100%;">
                        <option value="Awaiting Installation" {{ old('measure_status') == 'Awaiting Installation' ? 'selected': '' }}>Awaiting Installation</option>
                        <option value="Booked" {{ old('measure_status') == 'Booked' ? 'selected': '' }}>Booked</option>
                        <option value="Started" {{ old('measure_status') == 'Started' ? 'selected': '' }}>Started</option>
                        <option value="Completed" {{ old('measure_status') == 'Completed' ? 'selected': '' }}>Completed</option>
                    </select>
                    @error('types[${form_index}][measure_status]')
                <span id="types[${form_index}][measure_status]" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>
    </div>
    <div class="card-body">
        <input type="hidden" name="types[${form_index}][category]" value="${type}" />
        <div class="row">
            <div class="col-3 m-auto">
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" name="types[${form_index}][is_pibi]" type="checkbox" id="is_pibi" {{ old('is_pibi') == 'true' ? 'checked' : (isset($row) && $row->is_pibi ? 'checked' : '') }}>
                        <label for="is_pibi" class="custom-control-label">PIBI</label>
                        @error('is_pibi')
                <span id="is_pibi" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                </div>
            </div>
        </div>
        <div class="col-3 m-auto">
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="types[${form_index}][is_design]" type="checkbox" id="is_design" {{ old('is_design') == 'true' ? 'checked' : (isset($row) && $row->is_design ? 'checked' : '') }}>
                        <label for="is_design" class="custom-control-label">Design</label>
                        @error('is_design')
                <span id="is_design" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                </div>
            </div>
        </div>
        <div class="col-3 m-auto">
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="types[${form_index}][is_tech_survey]" type="checkbox" id="is_tech_survey" {{ old('is_tech_survey') == 'true' ? 'checked' : (isset($row) && $row->is_under_floor_insulation ? 'checked' : '') }}>
                        <label for="is_tech_survey" class="custom-control-label">Tech Survey</label>
                        @error('is_tech_survey')
                <span id="is_tech_survey" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="is_customer_informed">Customer Informed of Start</label>
                <select class="form-control @error('is_customer_informed') is-invalid @enderror" id="is_customer_informed" name="is_customer_informed" style="width: 100%;">
                        <option value="true" {{ isset($row) && $row->is_customer_informed ? 'selected' : (old('is_customer_informed') ? 'selected': '')}}>Yes</option>
                        <option value="false" {{ isset($row) && !$row->is_customer_informed ? 'selected' : (old('is_customer_informed') == 'false' ? 'selected': '') }}>No</option>
                    </select>
                    @error('is_customer_informed')
                <span id="is_customer_informed" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="m2">M2</label>
                    <input value="{{ old('m2') }}" type="text" class="form-control @error('m2') is-invalid @enderror" name="types[${form_index}][m2]" id="m2" placeholder="Enter M2">
                    @error('m2')
                <span id="m2" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="installer_id">Select Installer</label>
                    <select class="form-control select2 @error('installer_id') is-invalid @enderror" name="types[${form_index}][installer_id]" style="width: 100%;">
                        <option disabled selected value> -- select installer -- </option>
                        @foreach($installers as $installer)
                <option value="{{ $installer->id }}" {{ old('installer_id') == $installer->id ? 'selected': '' }}>
                            {{ $installer->first_name }}
                </option>
@endforeach
                </select>
@error('installer_id')
                <span id="installer_id" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="start_date">Install Start Date</label>
                    <input value="{{ old('start_date') }}" type="date" class="form-control @error('start_date') is-invalid @enderror" name="types[${form_index}][start_date]" id="start_date" placeholder="Enter Install Start Date">
                    @error('start_date')
                <span id="start_date" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="completion_date">Install Completion Date</label>
                    <input value="{{ old('completion_date') }}" type="date" class="form-control @error('completion_date') is-invalid @enderror" name="types[${form_index}][completion_date]" id="completion_date" placeholder="Enter Install Completion Date">
                    @error('completion_date')
                <span id="completion_date" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="is_warranty_applied">Warranties Applied</label>
                    <select class="form-control @error('is_warranty_applied') is-invalid @enderror" id="is_warranty_applied" name="types[${form_index}][is_warranty_applied]" style="width: 100%;">
                        <option value="true" {{ old('is_warranty_applied') == 'true' ? 'selected': '' }}>Yes</option>
                        <option value="false" {{ old('is_warranty_applied') == 'false' ? 'selected': '' }}>No</option>
                    </select>
                    @error('is_warranty_applied')
                <span id="is_warranty_applied" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="ibg_cost">IBG Cost</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">£</span>
                        </div>
                        <input value="{{ old('ibg_cost', 0) }}" type="number" min="0" class="form-control ibg_cost @error('ibg_cost') is-invalid @enderror" name="types[${form_index}][ibg_cost]" id="ibg_cost" placeholder="Enter IBG Cost">
                        @error('ibg_cost')
                <span id="ibg_cost" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row materials">
    <div class="col-5">
        <div class="form-group">
            <label for="title">Material</label>
            <input value="{{ old('title') }}" type="text" class="form-control @error('title') is-invalid @enderror" name=" types[${form_index}][materials][${material_index[`${slug}`]}][title]" id="material_title" placeholder="Enter Material Name">
                    @error('title')
                <span id="title" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="cost">Material Cost</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">£</span>
                        </div>
                        <input value="{{ old('cost', 0) }}" type="number" min="0" class="form-control m-cost @error('cost') is-invalid @enderror" name="types[${form_index}][materials][${material_index[`${slug}`]}][cost]" id="material_cost" placeholder="Enter Material Cost">
                        @error('cost')
                <span id="cost" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2 d-flex justify-content-center align-items-center mt-2">
        <button type="button" class="btn btn-primary mx-2" onclick="addMaterial('${slug}')"><i class="fas fa-plus-square"></i></button>
            </div>
        </div>
        <div class="row installers">
            <div class="col-5">
                <div class="form-group">
                    <label for="title">Installer</label>
                    <input value="{{ old('title') }}" type="text" class="form-control @error('title') is-invalid @enderror" name="types[${form_index}][installers][${installer_index[`${slug}`]}][title]" id="installer_title" placeholder="Enter Installer">
                    @error('title')
                <span id="title" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="cost">Installer Cost</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">£</span>
                        </div>
                        <input value="{{ old('cost', 0) }}" type="number" min="0" class="form-control i-cost @error('cost') is-invalid @enderror" name="types[${form_index}][installers][${installer_index[`${slug}`]}][cost]" id="installer_cost" placeholder="Enter Installer Cost">
                        @error('cost')
                <span id="cost" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2 d-flex justify-content-center align-items-center mt-2">
        <button type="button" class="btn btn-primary mx-2" onclick="addInstaller('${slug}')"><i class="fas fa-plus-square"></i></button>
            </div>
        </div>
    </div>
</div>`)
            }
        }

        $(document).on('click', '.remove_material', function () {
            $(this).parents('div.materials').remove();
        });
        $(document).on('click', '.remove_installer', function () {
            $(this).parents('div.installers').remove();
        });
        $(document).ready(function ($) {
            $("#status").on('change', function () {
                const flex_check = $(this).val()
                if (flex_check != 'Approved') {
                    $(".next_btn").hide()
                    $(".submit_btn").show()
                } else {
                    $(".next_btn").show()
                    $(".submit_btn").hide()
                }
            }).change();
            $("#introducer_share").on('change', function () {
                const value = $(this).val()
                const gross_profit = parseInt($("#gross_profit").val());
                const fee = (((value / 100) * gross_profit)).toFixed(2);
                $('#introducer_fee').attr('value', fee);
                $('#net_profit').attr('value', (gross_profit - fee).toFixed(2));
            }).change();
            $('body').on('input', '.m-cost', function() {
                var m_price = 0;
                $('.m-cost').each(function(index, el) {
                    const price = parseInt($(el).val());
                    m_price = m_price+price
                });
                $('#total_material').val(m_price)
                const total_installer = parseInt($("#total_installer").val());
                $('#sub_total').val(m_price + total_installer)
            });
            $('body').on('input', '.i-cost', function() {
                var i_price = 0;
                $('.i-cost').each(function(index, el) {
                    const price = parseInt($(el).val());
                    i_price = i_price+price
                });
                $('#total_installer').val(i_price)
                const total_material = parseInt($("#total_material").val());
                $('#sub_total').val(i_price + total_material)
            });
        });
    </script>
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <style>
        .bs-stepper-label {
            font-size: 14px;
        }
    </style>
@endpush
