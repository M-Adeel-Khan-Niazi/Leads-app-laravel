@extends('master')
@section('title', 'Measures to install')
@section('main-content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="POST" action="{{ route('leads.measures', request('lead')->id) }}">
            @csrf
            <div class="card-body">
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
                <div id="measure-type">
                @if(count($categories))
                    @foreach($categories as $key => $measure_type)
                        @php
                            $slug = \Str::slug($measure_type->category);
                        @endphp
                        <div class="card-outline card-primary" id="{{ $slug }}">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6 m-auto">
                                        <h3 class="card-title">{{ $measure_type->category }}</h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-auto">
                                            <select class="form-control @error("types['{{$key}}'][measure_status]") is-invalid @enderror" name="types[{{$key}}][measure_status]" style="width: 100%;">
                                                <option value="Awaiting Installation" {{ $measure_type->measure_status == 'Awaiting Installation' ? 'selected': old('measure_status') }}>Awaiting Installation</option>
                                                <option value="Booked" {{ $measure_type->measure_status == 'Booked' ? 'selected': old('measure_status') }}>Booked</option>
                                                <option value="Started" {{ $measure_type->measure_status == 'Started' ? 'selected': old('measure_status') }}>Started</option>
                                                <option value="Completed" {{ $measure_type->measure_status == 'Completed' ? 'selected': old('measure_status') }}>Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3 m-auto">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" name="types[{{$key}}][is_pibi]" type="checkbox" id="is_pibi" {{ $measure_type->is_pibi ? 'checked' : '' }}>
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
                                                <input class="custom-control-input" name="types[{{$key}}][is_design]" type="checkbox" id="is_design" {{ $measure_type->is_design ? 'checked' : '' }}>
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
                                                <input class="custom-control-input" name="types[{{$key}}][is_tech_survey]" type="checkbox" id="is_tech_survey" {{ $measure_type->is_tech_survey ? 'checked' : '' }}>
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
                                            <select class="form-control @error('is_customer_informed') is-invalid @enderror" id="is_customer_informed" name="types[{{$key}}][is_customer_informed]" style="width: 100%;">
                                                <option value="true" {{ $measure_type->is_customer_informed ? 'selected': old('is_customer_informed') }}>Yes</option>
                                                <option value="false" {{ !$measure_type->is_customer_informed ? 'selected': old('is_customer_informed') }}>No</option>
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
                                            <input value="{{ $measure_type->m2 }}" type="text" class="form-control @error('m2') is-invalid @enderror" name="types[{{$key}}][m2]" id="m2" placeholder="Enter M2">
                                            @error('m2')
                                            <span id="m2" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="installer_id">Select Installer</label>
                                            <select class="form-control select2 @error('installer_id') is-invalid @enderror" name="types[{{$key}}][installer_id]" style="width: 100%;">
                                                <option disabled selected value> -- select installer -- </option>
                                                @foreach($installers as $installer)
                                                    <option value="{{ $installer->id }}" {{ $measure_type->installer_id == $installer->id ? 'selected': '' }}>
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
                                            <input value="{{ $measure_type->start_date }}" type="date" class="form-control @error('start_date') is-invalid @enderror" name="types[{{$key}}][start_date]" id="start_date" placeholder="Enter Install Start Date">
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
                                            <input value="{{ $measure_type->completion_date }}" type="date" class="form-control @error('completion_date') is-invalid @enderror" name="types[{{$key}}][completion_date]" id="completion_date" placeholder="Enter Install Completion Date">
                                            @error('completion_date')
                                            <span id="completion_date" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('leads.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection
@push('scripts')
<script>
    let form_index = {{ count($categories) ?? 0 }};
    function convertToSlug(Text) {
        return Text.toLowerCase()
            .replace(/ /g, "-")
            .replace(/[^\w-]+/g, "");
    }
    function addMeasureForm(type) {
        const slug = convertToSlug(type);
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
            <label for="is_customer_informed">Customer Informed of Start</label>
            <select class="form-control @error('is_customer_informed') is-invalid @enderror" id="is_customer_informed" name="types[${form_index}][is_customer_informed]" style="width: 100%;">
                        <option value="true">Yes</option>
                        <option value="false">No</option>
                    </select>
                    @error('is_customer_informed')
            <span id="is_customer_informed" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
            </div>
        </div>
    </div>
</div>
</div>
    </div>
</div>`)
        }
    }
</script>
@endpush
