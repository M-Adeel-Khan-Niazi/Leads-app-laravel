@extends('master')
@section('title', 'Data Match & Land Registry')
@section('address', $lead->house_number .', '. $lead->street .', '. $lead->town .', '. $lead->postal_code ?? 'N/A'))
@section('main-content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="POST" action="{{ route('leads.data_matched', request('lead')->id) }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
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
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="is_land_reg_matched">Land Registry Matched</label>
                            <select class="form-control @error('is_land_reg_matched') is-invalid @enderror" id="is_land_reg_matched" name="is_land_reg_matched" style="width: 100%;">
                                <option value="" {{ isset($row) && $row->is_land_reg_matched == null ? 'selected' : (old('is_land_reg_matched') ? 'selected': '')}}>N/A</option>
                                <option value="true" {{ isset($row) && $row->is_land_reg_matched ? 'selected' : (old('is_land_reg_matched') ? 'selected': '')}}>Yes</option>
                                <option value="false" {{ isset($row) && !$row->is_land_reg_matched ? 'selected' : (old('is_land_reg_matched') == 'false' ? 'selected': '') }}>No</option>
                            </select>
                            @error('is_land_reg_matched')
                            <span id="is_land_reg_matched" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="is_match_sent">Data Match Request Sent</label>
                            <select class="form-control @error('is_match_sent') is-invalid @enderror" id="is_match_sent" name="is_match_sent" style="width: 100%;">
                                <option value="" {{ isset($row) && $row->is_match_sent == null ? 'selected' : (old('land_reg_matched') ? 'selected': '')}}>N/A</option>
                                <option value="true" {{ isset($row) && $row->is_match_sent ? 'selected' : (old('is_match_sent') ? 'selected': '')}}>Yes</option>
                                <option value="false" {{ isset($row) && !$row->is_match_sent ? 'selected' : (old('is_match_sent') == 'false' ? 'selected': '') }}>No</option>
                            </select>
                            @error('is_match_sent')
                            <span id="is_match_sent" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
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
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="status">Lead Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" style="width: 100%;">
                                <option value="approved" {{ isset($lead) && $lead->status == 'approved' ? 'selected' : (old('status') == 'approved' ? 'selected': '')}}>Approved</option>
                                <option value="rejected" {{ isset($lead) && $lead->status == 'rejected' ? 'selected' : (old('status') == 'rejected' ? 'selected': '') }}>Rejected</option>
                                <option value="onHold" {{ isset($lead) && $lead->status == 'onHold' ? 'selected' : (old('status') == 'onHold' ? 'selected': '') }}>On Hold</option>
                            </select>
                            @error('status')
                            <span id="status" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Comments</label>
                            <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" rows="4" placeholder="Enter Comments" name="comment">{{ isset($row) ? $row->comment : old('comment') }}</textarea>
                            @error('comment')
                            <span id="comment" class="error invalid-feedback">{{ $message }}</span>
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
