@extends('master')
@section('title', 'Additional Costs & Summary')
@section('main-content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="POST" action="{{ route('leads.summary', request('lead')->id) }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="trickle_vents">Trickle Vents</label>
                            <input value="{{ isset($lead) && $lead->details ? $lead->details->trickle_vents : old('trickle_vents', 0) }}" type="number" min="0" class="form-control @error('trickle_vents') is-invalid @enderror" name="trickle_vents" id="trickle_vents" placeholder="Enter Trickle Vents">
                            @error('trickle_vents')
                            <span id="trickle_vents" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="air_brick">Air Brick</label>
                            <input value="{{ isset($lead) && $lead->details ? $lead->details->air_brick :old('air_brick', 0) }}" type="number" min="0" class="form-control @error('air_brick') is-invalid @enderror" name="air_brick" id="air_brick" placeholder="Enter Air Brick">
                            @error('air_brick')
                            <span id="air_brick" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="fans">Fans</label>
                            <input value="{{ isset($lead) && $lead->details ? $lead->details->fans :old('fans', 0) }}" type="number" min="0" class="form-control @error('fans') is-invalid @enderror" name="fans" id="fans" placeholder="Enter Fans">
                            @error('fans')
                            <span id="fans" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="minor_work_cert">Minor Works Cert</label>
                            <input value="{{ isset($lead) && $lead->details ? $lead->details->minor_work_cert :old('minor_work_cert', 0) }}" type="number" min="0" class="form-control @error('minor_work_cert') is-invalid @enderror" name="minor_work_cert" id="minor_work_cert" placeholder="Enter Minor Works Cert">
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
                            <input value="{{ isset($lead) && $lead->details ? $lead->details->roof_vents :old('roof_vents', 0) }}" type="number" min="0" class="form-control @error('roof_vents') is-invalid @enderror" name="roof_vents" id="roof_vents" placeholder="Enter Roof Vents">
                            @error('roof_vents')
                            <span id="roof_vents" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="door_undercut">Door Undercut</label>
                            <input value="{{ isset($lead) && $lead->details ? $lead->details->door_undercut :old('door_undercut', 0) }}" type="number" min="0" class="form-control @error('door_undercut') is-invalid @enderror" name="door_undercut" id="door_undercut" placeholder="Enter Door Undercut">
                            @error('door_undercut')
                            <span id="door_undercut" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="other_ventilation">Other Ventilation</label>
                            <input value="{{ isset($lead) && $lead->details ? $lead->details->other_ventilation :old('other_ventilation', 0) }}" type="number" min="0" class="form-control @error('other_ventilation') is-invalid @enderror" name="other_ventilation" id="other_ventilation" placeholder="Enter Other Ventilation">
                            @error('other_ventilation')
                            <span id="other_ventilation" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="retrofit_coordinator_cost">Retrofit Coordinator Cost</label>
                            <input value="{{ isset($lead) && $lead->details ? $lead->details->retrofit_coordinator_cost :old('retrofit_coordinator_cost', 0) }}" type="number" min="0" class="form-control @error('retrofit_coordinator_cost') is-invalid @enderror" name="retrofit_coordinator_cost" id="retrofit_coordinator_cost" placeholder="Enter Retrofit Coordinator Cost">
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
                            <input value="{{ isset($lead) && $lead->details ? $lead->details->retrofit_assessor_cost :old('retrofit_assessor_cost', 0) }}" type="number" min="0" class="form-control @error('retrofit_assessor_cost') is-invalid @enderror" name="retrofit_assessor_cost" id="retrofit_assessor_cost" placeholder="Enter Retrofit Assessor Cost">
                            @error('retrofit_assessor_cost')
                            <span id="retrofit_assessor_cost" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="gas_safe_reg">Gas Safe-CPS-land Reg</label>
                            <input value="{{ isset($lead) && $lead->details ? $lead->details->gas_safe_reg :old('gas_safe_reg', 0) }}" type="number" min="0" class="form-control @error('gas_safe_reg') is-invalid @enderror" name="gas_safe_reg" id="gas_safe_reg" placeholder="Enter Gas Safe-CPS-land Reg">
                            @error('gas_safe_reg')
                            <span id="gas_safe_reg" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="handover_on">Handover Date</label>
                            <input value="{{ isset($lead) && $lead->details ? $lead->details->handover_on :old('handover_on') }}" type="date" class="form-control @error('handover_on') is-invalid @enderror" name="handover_on" id="handover_on" placeholder="Enter Handover date">
                            @error('handover_on')
                            <span id="handover_on" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
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
                    <div class="col-3">
                        <div class="form-group">
                            <label for="is_invoice_paid">Invoice Paid</label>
                            <select class="form-control @error('is_invoice_paid') is-invalid @enderror" id="is_invoice_paid" name="is_invoice_paid" style="width: 100%;">
                                <option value="false" {{ isset($row) && !$row->is_invoice_paid ? 'selected' : (old('is_invoice_paid') == 'false' ? 'selected': '') }}>No</option>
                                <option value="true" {{ isset($row) && $row->is_invoice_paid ? 'selected' : (old('is_invoice_paid') ? 'selected': '')}}>Yes</option>
                            </select>
                            @error('is_invoice_paid')
                            <span id="is_invoice_paid" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="is_agent_paid">Agent Paid</label>
                            <select class="form-control @error('is_agent_paid') is-invalid @enderror" id="is_agent_paid" name="is_agent_paid" style="width: 100%;">
                                <option value="false" {{ isset($row) && !$row->is_agent_paid ? 'selected' : (old('is_agent_paid') == 'false' ? 'selected': '') }}>No</option>
                                <option value="true" {{ isset($row) && $row->is_agent_paid ? 'selected' : (old('is_agent_paid') ? 'selected': '')}}>Yes</option>
                            </select>
                            @error('is_agent_paid')
                            <span id="is_agent_paid" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="funding">Funding</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{$lead->retrofit->funding}}" type="number" disabled class="form-control" id="funding_summary">
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
        $(document).ready(function ($) {
            summary_calculate()
        });
        $('body').on('input', function() {
            summary_calculate()
        })
        $("#introducer_share").on('change', function () {
            const value = $(this).val()
            const gross_profit = parseInt($("#gross_profit").val());
            const fee = (((value / 100) * gross_profit)).toFixed(2);
            $('#introducer_fee').attr('value', fee);
            $('#net_profit').attr('value', (gross_profit - fee).toFixed(2));
        }).change();
        function summary_calculate(){
            const funding = {{ $lead->retrofit->funding }};
            const sub_total = {{ $lead->details->sub_total }};
            const total_ibg_cost = {{ $total_ibg }};
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

            const total_cost = sub_total + trickle_vents + air_brick + fans + minor_work_cert + roof_vents + door_undercut + other_ventilation + gas_safe_reg + retrofit_assessor_cost + retrofit_coordinator_cost + total_ibg_cost;
            const gross_profit = total_cost - funding;
            $('#total_cost').attr('value', total_cost);
            $('#gross_profit').attr('value', gross_profit);
            $('#net_profit').attr('value', gross_profit);
        }
    </script>
@endpush
