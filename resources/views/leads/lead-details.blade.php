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
                    </div>
                    <div class="bs-stepper-content">
                        <!-- PART 1 -->
                        <div id="part-1" class="content" role="tabpanel" aria-labelledby="part-1-trigger">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="is_regs_check">Building Regs check Result</label>
                                        <select class="form-control @error('is_regs_check') is-invalid @enderror" id="is_regs_check" name="is_regs_check" style="width: 100%;">
                                            <option value="false" {{ isset($row) && !$row->is_regs_check ? 'selected' : (old('is_regs_check') == false ? 'selected': '') }}>No</option>
                                            <option value="true" {{ isset($row) && $row->is_regs_check ? 'selected' : (old('is_regs_check') ? 'selected': '')}}>Yes</option>
                                        </select>
                                        @error('is_regs_check')
                                        <span id="is_regs_check" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 flex-details" style="display: none">
                                    <div class="form-group">
                                        <label for="is_flexible">Flexible check</label>
                                        <select class="form-control @error('is_flexible') is-invalid @enderror" id="is_flexible" name="is_flexible" style="width: 100%;">
                                            <option value="true" {{ isset($row) && $row->is_flexible ? 'selected' : (old('is_flexible') ? 'selected': '')}}>Yes</option>
                                            <option value="false" {{ isset($row) && !$row->is_flexible ? 'selected' : (old('is_flexible') == 'false' ? 'selected': '') }}>No</option>
                                        </select>
                                        @error('is_flexible')
                                        <span id="is_flexible" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row flex-details" style="display:none;">
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
                            <button type="button" class="btn btn-primary next_btn_2" onclick="stepper.next()" style="">Next</button>
                            <button type="submit" class="btn btn-primary submit_btn_2" style="display: none">Submit</button>
                        </div>
                        <div id="part-3" class="content" role="tabpanel" aria-labelledby="part-3-trigger">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="is_flexible">Building Regs check Result</label>
                                        <select class="form-control @error('is_flexible') is-invalid @enderror" id="is_flexible" name="is_flexible" style="width: 100%;">
                                            <option value="false" {{ isset($row) && !$row->is_flexible ? 'selected' : (old('is_flexible') == false ? 'selected': '') }}>No</option>
                                            <option value="true" {{ isset($row) && $row->is_flexible ? 'selected' : (old('is_flexible') ? 'selected': '')}}>Yes</option>
                                        </select>
                                        @error('is_flexible')
                                        <span id="is_flexible" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="ra_name">RA Name</label>
                                        <input value="{{ old('ra_name', isset($row) ? $row->ra_name : '') }}" type="text" class="form-control @error('ra_name') is-invalid @enderror" name="ra_name" id="ra_name" placeholder="Enter RA Name">
                                        @error('ra_name')
                                        <span id="ra_name" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
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
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="measure_install">Measures to install</label>
                                        <input value="{{ old('measure_install', isset($row) ? $row->measure_install : 1) }}" type="number" min="1" class="form-control @error('measure_install') is-invalid @enderror" name="measure_install" id="measure_install" placeholder="Enter Measures to install">
                                        @error('measure_install')
                                        <span id="measure_install" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <h3>Measure Types:</h3>
                            @if(isset($row))
                                @foreach($row->measure_types as $measure_type)
                                    <div class="measure-type">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="m2">M2</label>
                                                    <select class="form-control @error('m2') is-invalid @enderror" id="m2" name="m2" style="width: 100%;">
                                                        <option value="internal" {{ $measure_type->m2 == 'internal' ? 'selected' : (old('m2') == 'internal' ? 'selected': '') }}>Internal</option>
                                                        <option value="external" {{ $measure_type->m2 == 'external' ? 'selected' : (old('m2') == 'external' ? 'selected': '')}}>External</option>
                                                    </select>
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
                                                    <select class="form-control @error('m2') is-invalid @enderror" id="m2" name="types[0][m2]" style="width: 100%;">
                                                        <option value="internal" {{ old('m2') == 'internal' ? 'selected': '' }}>Internal</option>
                                                        <option value="external" {{ old('m2') == 'external' ? 'selected': '' }}>External</option>
                                                    </select>
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
                                                    <label for="cost">Installer Cost</label>
                                                    <input value="{{ old('cost', 0) }}" type="number" min="0" class="form-control @error('cost') is-invalid @enderror" name="types[0][cost]" id="cost" placeholder="Enter Installer Cost">
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
                                                <input value="{{ old('material_cost', 0) }}" type="number" min="0" class="form-control @error('material_cost') is-invalid @enderror" name="types[0][material_cost]" id="material_cost" placeholder="Enter Material Cost">
                                                @error('material_cost')
                                                <span id="material_cost" class="error invalid-feedback">{{ $message }}</span>
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
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="completion_date">Install Completion Date</label>
                                                <input value="{{ old('completion_date') }}" type="date" class="form-control @error('completion_date') is-invalid @enderror" name="types[0][completion_date]" id="completion_date" placeholder="Enter Install Completion Date">
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
                                        <div class="col-4 d-flex justify-content-center align-items-center mt-2">
                                            <button type="button" class="btn btn-primary mx-2" onclick="addType()"><i class="fas fa-plus-square"></i></button>
                                            <button type="button" class="btn btn-danger mx-2 remove_type"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
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
        function addType() {
            $(".measure-type:last").before(`<div class="measure-type">
                                    <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="m2">M2</label>
                                                    <select class="form-control @error('m2') is-invalid @enderror" id="m2" name="types[${form_index}][m2]" style="width: 100%;">
                                                        <option value="internal" {{ old('m2') == 'internal' ? 'selected': '' }}>Internal</option>
                                                        <option value="external" {{ old('m2') == 'external' ? 'selected': '' }}>External</option>
                                                    </select>
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
                <input value="{{ old('cost', 0) }}" type="number" min="0" class="form-control @error('cost') is-invalid @enderror" name="types[${form_index}][cost]" id="cost" placeholder="Enter Installer Cost">
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
            <input value="{{ old('material_cost', 0) }}" type="number" min="0" class="form-control @error('material_cost') is-invalid @enderror" name="types[${form_index}][material_cost]" id="material_cost" placeholder="Enter Material Cost">
                                                @error('material_cost')
            <span id="material_cost" class="error invalid-feedback">{{ $message }}</span>
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
        <div class="col-4">
            <div class="form-group">
                <label for="completion_date">Install Completion Date</label>
                <input value="{{ old('completion_date') }}" type="date" class="form-control @error('completion_date') is-invalid @enderror" name="types[${form_index}][completion_date]" id="completion_date" placeholder="Enter Install Completion Date">
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
                <input value="{{ old('ibg_cost', 0) }}" type="number" min="0" class="form-control @error('ibg_cost') is-invalid @enderror" name="types[${form_index}][ibg_cost]" id="ibg_cost" placeholder="Enter IBG Cost">
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
</div>`);
            form_index++
        }

        $(document).ready(function ($) {
            $("#is_regs_check").on('change', function () {
                const building_check = $(this).val();
                const flex_check = $("#is_flexible").val();
                if (building_check == 'true') {
                    $(".flex-details").show()
                } else {
                    $(".flex-details").hide();
                }
            });

            $("#is_flexible").on('change', function () {
                const building_check = $("#is_regs_check").val();
                const flex_check = $(this).val()
                if (flex_check == 'false') {
                    $(".next_btn").hide()
                    $(".submit_btn").show()
                } else {
                    $(".next_btn").show()
                    $(".submit_btn").hide()
                }
            })

            $("#is_match_sent").on('change', function () {
                const match_sent = $(this).val()
                if (match_sent == 'false') {
                    $(".next_btn_2").hide()
                    $(".submit_btn_2").show()
                } else {
                    $(".next_btn_2").show()
                    $(".submit_btn_2").hide()
                }
            })

            $(".remove_type").on('click', function () {
                $(this).closest('div.measure-type').remove();
            })
        });
    </script>
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}">
@endpush
