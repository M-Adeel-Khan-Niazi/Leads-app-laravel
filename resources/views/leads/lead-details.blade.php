@extends('master')
@section('title', 'Lead Details')
@section('main-content')
    <div class="card card-primary">
        <!-- form start -->
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
                                <span class="bs-stepper-label">Building Regs check</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#part-2">
                            <button type="button" class="step-trigger" role="tab" aria-controls="part-2" id="part-2-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Data Matched sent</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#part-3">
                            <button type="button" class="step-trigger" role="tab" aria-controls="part-3" id="part-3-trigger">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Data Matched result</span>
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
                            <button type="button" class="step-trigger" role="tab" aria-controls="part-" id="part--trigger">
                                <span class="bs-stepper-circle">5</span>
                                <span class="bs-stepper-label">Finalize</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <!-- PART 1 -->
                        <div id="part-1" class="content" role="tabpanel" aria-labelledby="part-1-trigger">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="is_flexible">Flexible check</label>
                                        <select class="form-control @error('is_flexible') is-invalid @enderror" id="is_flexible" name="is_flexible" style="width: 100%;">
                                            <option value="true" {{ isset($row) && $row->is_flexible ? 'selected' : (old('is_flexible') ? 'selected': '')}}>Flexible</option>
                                            <option value="false" {{ isset($row) && !$row->is_flexible ? 'selected' : (old('is_flexible') == 'false' ? 'selected': '') }}>Non Flexible</option>
                                        </select>
                                        @error('is_flexible')
                                        <span id="is_flexible" class="error invalid-feedback">{{ $message }}</span>
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
                            <button type="button" class="btn btn-primary next_btn" onclick="stepper.next()" style="">Next</button>
                            <button type="submit" class="btn btn-primary submit_btn" style="display: none">Submit</button>
                        </div>
                        <!-- PART 2 -->
                        <div id="part-2" class="content" role="tabpanel" aria-labelledby="part-2-trigger">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="is_match_sent">Data Matched sent</label>
                                        <select class="form-control @error('is_match_sent') is-invalid @enderror" id="is_match_sent" name="is_match_sent" style="width: 100%;">
                                            <option value="true" {{ isset($row) && $row->is_match_sent ? 'selected' : (old('is_match_sent') ? 'selected': '')}}>Yes</option>
                                            <option value="false" {{ isset($row) && !$row->is_match_sent ? 'selected' : (old('is_match_sent') == 'false' ? 'selected': '') }}>No</option>
                                        </select>
                                        @error('is_match_sent')
                                        <span id="is_match_sent" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                            <button type="button" class="btn btn-primary" onclick="stepper.next()" style="">Next</button>
                        </div>
                        <!-- PART 3 -->
                        <div id="part-3" class="content" role="tabpanel" aria-labelledby="part-3-trigger">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="regs_check_result">Building Regs check Result</label>
                                        <select class="form-control @error('regs_check_result') is-invalid @enderror" id="regs_check_result" name="regs_check_result" style="width: 100%;">
                                            <option value="matched" {{ isset($row) && $row->regs_check_result == 'matched' ? 'selected' : (old('regs_check_result') == 'matched' ? 'selected': '') }}>Matched</option>
                                            <option value="un_matched" {{ isset($row) && $row->regs_check_result == 'un_matched' ? 'selected' : (old('regs_check_result') == 'un_matched' ? 'selected': '')}}>Un Matched</option>
                                            <option value="un_verified" {{ isset($row) && $row->regs_check_result == 'un_verified' ? 'selected' : (old('regs_check_result') == 'un_verified' ? 'selected': '')}}>Un Verified</option>
                                        </select>
                                        @error('regs_check_result')
                                        <span id="regs_check_result" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 regs_details" style="">
                                    <div class="form-group">
                                        <label for="ra_name">RA Name</label>
                                        <input value="{{ old('ra_name', isset($row) ? $row->ra_name : '') }}" type="text" class="form-control @error('ra_name') is-invalid @enderror" name="ra_name" id="ra_name" placeholder="Enter RA Name">
                                        @error('ra_name')
                                        <span id="ra_name" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="regs_details" style="">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="rfa_booked_date">RFA Booked Date</label>
                                            <input value="{{ old('rfa_booked_date', isset($row) ? $row->rfa_booked_date : '') }}" type="date" class="form-control @error('rfa_booked_date') is-invalid @enderror" name="rfa_booked_date" id="rfa_booked_date" placeholder="Enter RFA Booked Date">
                                            @error('rfa_booked_date')
                                            <span id="rfa_booked_date" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="rfa_booked_time">RFA Booked Time</label>
                                            <input value="{{ old('rfa_booked_time', isset($row) ? $row->rfa_booked_time : '') }}" type="time" class="form-control @error('rfa_booked_time') is-invalid @enderror" name="rfa_booked_time" id="rfa_booked_time" placeholder="Enter RFA Booked Time">
                                            @error('rfa_booked_time')
                                            <span id="rfa_booked_time" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="is_rfa_complete">RFA Complete</label>
                                            <select class="form-control @error('is_rfa_complete') is-invalid @enderror" id="is_rfa_complete" name="is_rfa_complete" style="width: 100%;">
                                                <option value="false" {{ isset($row) && !$row->is_rfa_complete ? 'selected' : (old('is_rfa_complete') == 'false' ? 'selected': '') }}>No</option>
                                                <option value="true" {{ isset($row) && $row->is_rfa_complete ? 'selected' : (old('is_rfa_complete') ? 'selected': '')}}>Yes</option>
                                            </select>
                                            @error('is_rfa_complete')
                                            <span id="is_rfa_complete" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="pre_epr_result">Pre EPR Result</label>
                                            <input value="{{ old('pre_epr_result', isset($row) ? $row->pre_epr_result : '') }}" type="text" class="form-control @error('pre_epr_result') is-invalid @enderror" name="pre_epr_result" id="pre_epr_result" placeholder="Enter Pre EPR Result">
                                            @error('pre_epr_result')
                                            <span id="pre_epr_result" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="post_epr_result">Post EPR Result</label>
                                            <input value="{{ old('post_epr_result', isset($row) ? $row->post_epr_result : '') }}" type="text" class="form-control @error('post_epr_result') is-invalid @enderror" name="post_epr_result" id="post_epr_result" placeholder="Enter Post EPR Result">
                                            @error('post_epr_result')
                                            <span id="post_epr_result" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="floor_area">Floor Area</label>
                                            <input value="{{ old('floor_area', isset($row) ? $row->floor_area : '') }}" type="text" class="form-control @error('floor_area') is-invalid @enderror" name="floor_area" id="floor_area" placeholder="Enter Floor Area">
                                            @error('floor_area')
                                            <span id="floor_area" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="abs_score">ABS Score</label>
                                            <input value="{{ old('abs_score', isset($row) ? $row->abs_score : 0) }}" oninput="fundingCal()" type="number" min="0" class="form-control @error('abs_score') is-invalid @enderror" name="abs_score" id="abs_score" placeholder="Enter ABS Score">
                                            @error('abs_score')
                                            <span id="abs_score" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="rate">Rate</label>
                                            <input value="{{ old('rate', isset($row) ? $row->rate : 0) }}" type="number" min="0" oninput="fundingCal()" class="form-control @error('rate') is-invalid @enderror" name="rate" id="rate" placeholder="Enter Rate">
                                            @error('rate')
                                            <span id="rate" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="funding">Funding</label>
                                            <input value="{{ old('funding', isset($row) ? $row->funding : 0) }}" type="number" disabled class="form-control @error('funding') is-invalid @enderror" name="funding" id="funding" placeholder="Enter Funding">
                                            @error('funding')
                                            <span id="funding" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="rc_name">RC Full Name</label>
                                        <input value="{{ old('rc_name', isset($row) ? $row->rc_name : '') }}" type="text" class="form-control @error('rc_name') is-invalid @enderror" name="rc_name" id="rc_name" placeholder="Enter RC Full Name">
                                        @error('rc_name')
                                        <span id="rc_name" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="wall_type">Wall Type</label>
                                        <select class="form-control @error('wall_type') is-invalid @enderror" id="wall_type" name="wall_type" style="width: 100%;">
                                            <option value="solid_wall" {{ isset($row) && $row->wall_type == 'solid_wall' ? 'selected' : (old('wall_type') == 'solid_wall' ? 'selected': '') }}>Solid Wall</option>
                                            <option value="non_solid_wall" {{ isset($row) && $row->wall_type == 'non_solid_wall' ? 'selected' : (old('wall_type') == 'non_solid_wall' ? 'selected': '')}}>Non Solid Wall</option>
                                        </select>
                                        @error('wall_type')
                                        <span id="wall_type" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                            <button type="button" class="btn btn-primary next_btn_3" onclick="stepper.next()" style="">Next</button>
                            <button type="submit" class="btn btn-primary submit_btn_3" style="display: none">Submit</button>
                        </div>
                        <!-- PART 4 -->
                        <div id="part-4" class="content" role="tabpanel" aria-labelledby="part-4-trigger">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="is_boiler_replacement" type="checkbox" id="is_boiler_replacement" value="" {{ old('is_boiler_replacement') == 'true' ? 'checked' : (isset($row) && count($row->other_pictures) ? 'checked' : '') }}>
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
                                            <input class="custom-control-input" name="is_external_wall_insulation" type="checkbox" id="is_external_wall_insulation" value="" {{ old('is_external_wall_insulation') == 'true' ? 'checked' : (isset($row) && count($row->other_pictures) ? 'checked' : '') }}>
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
                                            <input class="custom-control-input" name="is_first_time_central_heating" type="checkbox" id="is_first_time_central_heating" value="" {{ old('is_first_time_central_heating') == 'true' ? 'checked' : (isset($row) && count($row->other_pictures) ? 'checked' : '') }}>
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
                                            <input class="custom-control-input" name="is_internal_wall_insulation" type="checkbox" id="is_internal_wall_insulation" value="" {{ old('is_internal_wall_insulation') == 'true' ? 'checked' : (isset($row) && count($row->other_pictures) ? 'checked' : '') }}>
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
                                            <input class="custom-control-input" name="is_cavity_wall_insulation" type="checkbox" id="is_cavity_wall_insulation" value="" {{ old('is_cavity_wall_insulation') == 'true' ? 'checked' : (isset($row) && count($row->other_pictures) ? 'checked' : '') }}>
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
                                            <input class="custom-control-input" name="is_under_floor_insulation" type="checkbox" id="is_under_floor_insulation" value="" {{ old('is_under_floor_insulation') == 'true' ? 'checked' : (isset($row) && count($row->other_pictures) ? 'checked' : '') }}>
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
                                            <input class="custom-control-input" name="is_loft_insulation" type="checkbox" id="is_loft_insulation" value="" {{ old('is_loft_insulation') == 'true' ? 'checked' : (isset($row) && count($row->other_pictures) ? 'checked' : '') }}>
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
                                            <input class="custom-control-input" name="is_heating_controls" type="checkbox" id="is_heating_controls" value="" {{ old('is_heating_controls') == 'true' ? 'checked' : (isset($row) && count($row->other_pictures) ? 'checked' : '') }}>
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
                                            <input class="custom-control-input" name="is_solar_pv" type="checkbox" id="is_solar_pv" value="" {{ old('is_solar_pv') == 'true' ? 'checked' : (isset($row) && count($row->other_pictures) ? 'checked' : '') }}>
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
                                            <input class="custom-control-input" name="is_air_source" type="checkbox" id="is_air_source" value="" {{ old('is_air_source') == 'true' ? 'checked' : (isset($row) && count($row->other_pictures) ? 'checked' : '') }}>
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
                                            <input class="custom-control-input" name="is_storage_heater" type="checkbox" id="is_storage_heater" value="" {{ old('is_storage_heater') == 'true' ? 'checked' : (isset($row) && count($row->other_pictures) ? 'checked' : '') }}>
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
                                            <input class="custom-control-input" name="is_rir" type="checkbox" id="is_rir" value="" {{ old('is_rir') == 'true' ? 'checked' : (isset($row) && count($row->other_pictures) ? 'checked' : '') }}>
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
                                                    <input value="{{ old('ibg_cost', $measure_type->ibg_cost) }}" type="number" min="0" class="form-control @error('ibg_cost') is-invalid @enderror" name="ibg_cost" id="ibg_cost" placeholder="Enter IBG Cost">
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
                                <div class="measure-type">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="m2">M2</label>
                                                <input value="{{ old('m2') }}" type="text" class="form-control @error('m2') is-invalid @enderror" name="m2" id="m2" placeholder="Enter M2">
                                                @error('m2')
                                                <span id="m2" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="installer_id">Select Installer</label>
                                                <select class="form-control select2 @error('installer_id') is-invalid @enderror" name="types[0][installer_id]" style="width: 100%;">
                                                    <option disabled selected value> -- select installer -- </option>
                                                    @foreach($installers as $installer)
                                                        <option value="{{ $installer->id }}" {{ old('installer_id') == $installer->id ? 'selected': '' }}>
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
                                                <label for="start_date">Install Start Date</label>
                                                <input value="{{ old('start_date') }}" type="date" class="form-control @error('start_date') is-invalid @enderror" name="types[0][start_date]" id="start_date" placeholder="Enter Install Start Date">
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
                                                <input value="{{ old('completion_date') }}" type="date" class="form-control @error('completion_date') is-invalid @enderror" name="types[0][completion_date]" id="completion_date" placeholder="Enter Install Completion Date">
                                                @error('completion_date')
                                                <span id="completion_date" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="is_warranty_applied">Warranties Applied</label>
                                                <select class="form-control @error('is_warranty_applied') is-invalid @enderror" id="is_warranty_applied" name="types[0][is_warranty_applied]" style="width: 100%;">
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
                                                <input value="{{ old('ibg_cost', 0) }}" type="number" min="0" class="form-control @error('ibg_cost') is-invalid @enderror" name="types[0][ibg_cost]" id="ibg_cost" placeholder="Enter IBG Cost">
                                                @error('ibg_cost')
                                                <span id="ibg_cost" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row materials">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label for="material_name">Material</label>
                                                <input value="{{ old('material_name') }}" type="text" class="form-control @error('material_name') is-invalid @enderror" name="types[0][materials][0][material_name]" id="material_name" placeholder="Enter Material Name">
                                                @error('material_name')
                                                <span id="material_name" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label for="material_cost">Material Cost</label>
                                                <input value="{{ old('material_cost', 0) }}" type="number" min="0" class="form-control @error('material_cost') is-invalid @enderror" name="types[0][materials][0][material_cost]" id="material_cost" placeholder="Enter Material Cost">
                                                @error('material_cost')
                                                <span id="material_cost" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-2 d-flex justify-content-center align-items-center mt-2">
                                            <button type="button" class="btn btn-primary mx-2" onclick="addMaterial()"><i class="fas fa-plus-square"></i></button>
                                            <button type="button" class="btn btn-danger mx-2 remove_material"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="cost">Installer Cost</label>
                                                <input value="{{ old('cost', 0) }}" type="number" min="0" class="form-control @error('cost') is-invalid @enderror" name="types[0][cost]" id="cost" placeholder="Enter Installer Cost">
                                                @error('cost')
                                                <span id="cost" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
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
                                        <label for="is_completed_submission">All docs completed for submission</label>
                                        <select class="form-control @error('is_completed_submission') is-invalid @enderror" id="is_completed_submission" name="is_completed_submission" style="width: 100%;">
                                            <option value="true" {{ isset($row) && $row->is_completed_submission ? 'selected' : (old('is_completed_submission') == 'true' ? 'selected': '')}}>Yes</option>
                                            <option value="false" {{ isset($row) && !$row->is_completed_submission ? 'selected' : (old('is_completed_submission') == 'false' ? 'selected': '') }}>No</option>
                                        </select>
                                        @error('is_completed_submission')
                                        <span id="is_completed_submission" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
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
        }
        let form_index = 1;
        let material_index = 1;
        function addMaterial() {
            $(".materials:last").after(`<div class="row materials">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label for="material_name">Material</label>
                                                <input value="{{ old('material_name') }}" type="text" class="form-control @error('material_name') is-invalid @enderror" name="types[${form_index}][materials][${material_index}][material_name]" id="material_name" placeholder="Enter Material Name">
                                                @error('material_name')
            <span id="material_name" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
            </div>
        </div>
        <div class="col-5">
            <div class="form-group">
                <label for="material_cost">Material Cost</label>
                <input value="{{ old('material_cost', 0) }}" type="number" min="0" class="form-control @error('material_cost') is-invalid @enderror" name="types[${form_index}][materials][${material_index}][material_cost]" id="material_cost" placeholder="Enter Material Cost">
                                                @error('material_cost')
            <span id="material_cost" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
            </div>
        </div>
        <div class="col-2 d-flex justify-content-center align-items-center mt-2">
            <button type="button" class="btn btn-danger mx-2 remove_material"><i class="fas fa-trash"></i></button>
        </div>
    </div>`);
            material_index++
        }

        $(document).ready(function ($) {
            $("#is_flexible").on('change', function () {
                const flex_check = $(this).val()
                if (flex_check == 'false') {
                    $(".next_btn").hide()
                    $(".submit_btn").show()
                } else {
                    $(".next_btn").show()
                    $(".submit_btn").hide()
                }
            }).change();
            $("#regs_check_result").on('change', function () {
                if ($(this).val() == 'un_verified') {
                    $(".regs_details").hide()
                    $(".submit_btn_3").show()
                    $(".next_btn_3").hide()
                } else {
                    $(".regs_details").show()
                    $(".next_btn_3").show()
                    $(".submit_btn_3").hide()
                }
            }).change();

            $(".remove_material").on('click', function () {
                $(this).closest('div.materials').remove();
            })
        });
    </script>
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}">
@endpush
