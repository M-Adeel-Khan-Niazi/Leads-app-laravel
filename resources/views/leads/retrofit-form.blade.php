@extends('master')
@section('title', 'Retrofit Assessment / Findings')
@section('main-content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="POST" action="{{ route('leads.retrofit', request('lead')->id) }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="ra_name">Retrofit Assessor Assigned</label>
                            <input value="{{ old('ra_name', isset($row) ? $row->ra_name : '') }}" type="text" class="form-control @error('ra_name') is-invalid @enderror" name="ra_name" id="ra_name" placeholder="Enter Retrofit Assessor Assigned">
                            @error('ra_name')
                            <span id="ra_name" class="error invalid-feedback">{{ $message }}</span>
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
                    <div class="col-4">
                        <div class="form-group">
                            <label for="is_rfa_lodged">RFA Lodgement</label>
                            <select class="form-control @error('is_rfa_lodged') is-invalid @enderror" id="is_rfa_lodged" name="is_rfa_lodged" style="width: 100%;">
                                <option value="false" {{ isset($row) && !$row->is_rfa_lodged ? 'selected' : (old('is_rfa_lodged') == 'false' ? 'selected': '') }}>No</option>
                                <option value="true" {{ isset($row) && $row->is_rfa_lodged ? 'selected' : (old('is_rfa_lodged') ? 'selected': '')}}>Yes</option>
                            </select>
                            @error('is_rfa_lodged')
                            <span id="is_rfa_lodged" class="error invalid-feedback">{{ $message }}</span>
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
                            <label for="pre_epr_result">Pre EPR Result</label>
                            <input value="{{ old('pre_epr_result', isset($row) ? $row->pre_epr_result : '') }}" type="text" class="form-control @error('pre_epr_result') is-invalid @enderror" name="pre_epr_result" id="pre_epr_result" placeholder="Enter Pre EPR Result">
                            @error('pre_epr_result')
                            <span id="pre_epr_result" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
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
                    <div class="col-4">
                        <div class="form-group">
                            <label for="is_floor_plan_created">Floor Plan Created</label>
                            <select class="form-control @error('is_floor_plan_created') is-invalid @enderror" id="is_floor_plan_created" name="is_floor_plan_created" style="width: 100%;">
                                <option value="false" {{ isset($row) && !$row->is_floor_plan_created ? 'selected' : (old('is_floor_plan_created') == 'false' ? 'selected': '') }}>No</option>
                                <option value="true" {{ isset($row) && $row->is_floor_plan_created ? 'selected' : (old('is_floor_plan_created') ? 'selected': '')}}>Yes</option>
                            </select>
                            @error('is_floor_plan_created')
                            <span id="is_floor_plan_created" class="error invalid-feedback">{{ $message }}</span>
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
                            <input value="{{ old('funding', isset($row) ? $row->funding : 0) }}" type="number" readonly class="form-control @error('funding') is-invalid @enderror" name="funding" id="funding" placeholder="Enter Funding">
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
    function fundingCal() {
        const score = $("#abs_score").val();
        const rate = $("#rate").val();
        const funding = score * rate;
        $('#funding').attr('value', funding);
        $('#funding_summary').attr('value', funding);
    }
</script>
@endpush
