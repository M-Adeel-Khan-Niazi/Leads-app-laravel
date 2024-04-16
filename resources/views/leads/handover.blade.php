@extends('master')
@section('title', 'Handover & Submission')
@section('address', $lead->house_number .', '. $lead->street .', '. $lead->town .', '. $lead->postal_code ?? 'N/A'))
@section('main-content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="POST" action="{{ route('leads.handover', request('lead')->id) }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="handover_on">Handover Date</label>
                            <input value="{{ isset($lead) && $lead->details ? $lead->details->handover_on :old('handover_on') }}" type="date" class="form-control @error('handover_on') is-invalid @enderror" name="handover_on" id="handover_on" placeholder="Enter Handover date">
                            @error('handover_on')
                            <span id="handover_on" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="is_handover_emailed">Handover Emailed</label>
                            <select class="form-control @error('is_handover_emailed') is-invalid @enderror" id="is_handover_emailed" name="is_handover_emailed" style="width: 100%;">
                                <option value="true" {{ isset($lead->details) && $lead->details->is_andover_emailed ? 'selected' : (old('is_handover_emailed') == 'true' ? 'selected': '')}}>Yes</option>
                                <option value="false" {{ isset($lead->details) && !$lead->details->is_handover_emailed ? 'selected' : (old('is_handover_emailed') == 'false' ? 'selected': '') }}>No</option>
                            </select>
                            @error('is_handover_emailed')
                            <span id="is_handover_emailed" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="is_warranty_applied">Warranties Applied</label>
                            <select class="form-control @error('is_warranty_applied') is-invalid @enderror" id="is_warranty_applied" name="is_warranty_applied" style="width: 100%;">
                                <option value="true" {{ isset($lead->details) && $lead->details->is_warranty_applied ? 'selected' : (old('is_warranty_applied') == 'true' ? 'selected': '') }}>Yes</option>
                                <option value="false" {{ isset($lead->details) && !$lead->details->is_warranty_applied ? 'selected' : (old('is_warranty_applied') == 'false' ? 'selected': '') }}>No</option>
                            </select>
                            @error('is_warranty_applied')
                            <span id="is_warranty_applied" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="status">Funder Paper Work</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" style="width: 100%;">
                                <option value="">Pending</option>
                                <option value="paperworkSubmitted" {{ isset($lead) && $lead->status == 'paperworkSubmitted' ? 'selected' : (old('status') == 'paperworkSubmitted' ? 'selected': '') }}>Submitted</option>
                                <option value="paperworkError" {{ isset($lead) && $lead->status == 'paperworkError' ? 'selected' : (old('status') == 'paperworkError' ? 'selected': '') }}>Error</option>
                                <option value="paperworkAccepted" {{ isset($lead) && $lead->status == 'paperworkAccepted' ? 'selected' : (old('status') == 'paperworkAccepted' ? 'selected': '') }}>Accepted</option>
                            </select>
                            @error('is_completed_submission')
                            <span id="is_completed_submission" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="is_invoice_paid">Invoice Paid</label>
                            <select class="form-control @error('is_invoice_paid') is-invalid @enderror" id="is_invoice_paid" name="is_invoice_paid" style="width: 100%;">
                                <option value="false" {{ isset($lead->details) && !$lead->details->is_invoice_paid ? 'selected' : (old('is_invoice_paid') == 'false' ? 'selected': '') }}>No</option>
                                <option value="true" {{ isset($lead->details) && $lead->details->is_invoice_paid ? 'selected' : (old('is_invoice_paid') ? 'selected': '')}}>Yes</option>
                            </select>
                            @error('is_invoice_paid')
                            <span id="is_invoice_paid" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="is_agent_paid">Agent Paid</label>
                            <select class="form-control @error('is_agent_paid') is-invalid @enderror" id="is_agent_paid" name="is_agent_paid" style="width: 100%;">
                                <option value="false" {{ isset($lead->details) && !$lead->details->is_agent_paid ? 'selected' : (old('is_agent_paid') == 'false' ? 'selected': '') }}>No</option>
                                <option value="true" {{ isset($lead->details) && $lead->details->is_agent_paid ? 'selected' : (old('is_agent_paid') ? 'selected': '')}}>Yes</option>
                            </select>
                            @error('is_agent_paid')
                            <span id="is_agent_paid" class="error invalid-feedback">{{ $message }}</span>
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
    </script>
@endpush
