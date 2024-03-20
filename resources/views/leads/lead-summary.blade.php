@extends('master')
@section('title', 'Additional Costs & Summary')
@section('address', $lead->house_number .', '. $lead->street .', '. $lead->town .', '. $lead->postal_code ?? 'N/A'))
@section('main-content')
    <div class="card card-primary">
        <!-- form start -->
        <form method="POST" action="{{ route('leads.summary', request('lead')->id) }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="floor_area">Floor Area</label>
                            <input value="{{ old('floor_area', isset($lead) && $lead->retrofit ? $lead->retrofit->floor_area : '') }}" type="text" class="form-control @error('floor_area') is-invalid @enderror" name="floor_area" id="floor_area" placeholder="Enter Floor Area">
                            @error('floor_area')
                            <span id="floor_area" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="pre_epr_result">Pre EPR Result</label>
                            <input value="{{ old('pre_epr_result', isset($lead) && $lead->retrofit ? $lead->retrofit->pre_epr_result : '') }}" type="text" class="form-control @error('pre_epr_result') is-invalid @enderror" name="pre_epr_result" id="pre_epr_result" placeholder="Enter Pre EPR Result">
                            @error('pre_epr_result')
                            <span id="pre_epr_result" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="post_epr_result">Post EPR Result</label>
                            <input value="{{ old('post_epr_result', isset($lead) && $lead->retrofit ? $lead->retrofit->post_epr_result : '') }}" type="text" class="form-control @error('post_epr_result') is-invalid @enderror" name="post_epr_result" id="post_epr_result" placeholder="Enter Post EPR Result">
                            @error('post_epr_result')
                            <span id="post_epr_result" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="wall_type">Wall Type</label>
                            <select class="form-control @error('wall_type') is-invalid @enderror" id="wall_type" name="wall_type" style="width: 100%;">
                                <option value="solid_wall" {{ isset($lead->retrofit) && $lead->retrofit->wall_type == 'solid_wall' ? 'selected' : (old('wall_type') == 'solid_wall' ? 'selected': '') }}>Solid Wall</option>
                                <option value="non_solid_wall" {{ isset($lead->retrofit) && $lead->retrofit->wall_type == 'non_solid_wall' ? 'selected' : (old('wall_type') == 'non_solid_wall' ? 'selected': '')}}>Non Solid Wall</option>
                            </select>
                            @error('wall_type')
                            <span id="wall_type" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="trickle_vents">Trickle Vents</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ isset($lead) && $lead->details ? $lead->details->trickle_vents : old('trickle_vents', 0) }}" type="number" step=".01" min="0" class="form-control @error('trickle_vents') is-invalid @enderror" name="trickle_vents" id="trickle_vents" placeholder="Enter Trickle Vents">
                                @error('trickle_vents')
                                <span id="trickle_vents" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                 <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="air_brick">Air Brick</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ isset($lead) && $lead->details ? $lead->details->air_brick :old('air_brick', 0) }}" type="number" step=".01" min="0" class="form-control @error('air_brick') is-invalid @enderror" name="air_brick" id="air_brick" placeholder="Enter Air Brick">
                                @error('air_brick')
                                <span id="air_brick" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                 <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="fans">Extractor Fans</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ isset($lead) && $lead->details ? $lead->details->fans :old('fans', 0) }}" type="number" step=".01" min="0" class="form-control @error('fans') is-invalid @enderror" name="fans" id="fans" placeholder="Enter Fans">
                                @error('fans')
                                <span id="fans" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                 <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="minor_work_cert">Minor Works Cert</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ isset($lead) && $lead->details ? $lead->details->minor_work_cert :old('minor_work_cert', 0) }}" type="number" step=".01" min="0" class="form-control @error('minor_work_cert') is-invalid @enderror" name="minor_work_cert" id="minor_work_cert" placeholder="Enter Minor Works Cert">
                                @error('minor_work_cert')
                                <span id="minor_work_cert" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                 <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="roof_vents">Roof Vents</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ isset($lead) && $lead->details ? $lead->details->roof_vents :old('roof_vents', 0) }}" type="number" step=".01" min="0" class="form-control @error('roof_vents') is-invalid @enderror" name="roof_vents" id="roof_vents" placeholder="Enter Roof Vents">
                                @error('roof_vents')
                                <span id="roof_vents" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                 <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="door_undercut">Door Undercut</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ isset($lead) && $lead->details ? $lead->details->door_undercut :old('door_undercut', 0) }}" type="number" step=".01" min="0" class="form-control @error('door_undercut') is-invalid @enderror" name="door_undercut" id="door_undercut" placeholder="Enter Door Undercut">
                                @error('door_undercut')
                                <span id="door_undercut" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                 <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="other_ventilation">Other Ventilation</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ isset($lead) && $lead->details ? $lead->details->other_ventilation :old('other_ventilation', 0) }}" type="number" step=".01" min="0" class="form-control @error('other_ventilation') is-invalid @enderror" name="other_ventilation" id="other_ventilation" placeholder="Enter Other Ventilation">
                                @error('other_ventilation')
                                <span id="other_ventilation" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                 <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="retrofit_coordinator_cost">Retrofit Coordinator Cost</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ isset($lead) && $lead->details ? $lead->details->retrofit_coordinator_cost :old('retrofit_coordinator_cost', 0) }}" type="number" step=".01" min="0" class="form-control @error('retrofit_coordinator_cost') is-invalid @enderror" name="retrofit_coordinator_cost" id="retrofit_coordinator_cost" placeholder="Enter Retrofit Coordinator Cost">
                                @error('retrofit_coordinator_cost')
                                <span id="retrofit_coordinator_cost" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                 <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="retrofit_assessor_cost">Retrofit Assessor Cost</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ isset($lead) && $lead->details ? $lead->details->retrofit_assessor_cost :old('retrofit_assessor_cost', 0) }}" type="number" step=".01" min="0" class="form-control @error('retrofit_assessor_cost') is-invalid @enderror" name="retrofit_assessor_cost" id="retrofit_assessor_cost" placeholder="Enter Retrofit Assessor Cost">
                                @error('retrofit_assessor_cost')
                                <span id="retrofit_assessor_cost" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                 <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="gas_safe_reg">Gas Safe Cert</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ isset($lead) && $lead->details ? $lead->details->gas_safe_reg :old('gas_safe_reg', 0) }}" type="number" step=".01" min="0" class="form-control @error('gas_safe_reg') is-invalid @enderror" name="gas_safe_reg" id="gas_safe_reg" placeholder="Enter Gas Safe-CPS-land Reg">
                                @error('gas_safe_reg')
                                <span id="gas_safe_reg" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                 <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="ibg_cost">IBG Cost</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ $lead->details->ibg_cost ?? 0 }}" type="number" step=".01" min="0" class="form-control ibg_cost @error('ibg_cost') is-invalid @enderror" name="ibg_cost" id="ibg_cost" placeholder="Enter IBG Cost">
                                @error('ibg_cost')
                                <span id="ibg_cost" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="tech_survey">Tech Survey</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ $lead->details->tech_survey ?? 0 }}" type="number" step=".01" min="0" class="form-control tech_survey @error('tech_survey') is-invalid @enderror" name="tech_survey" id="tech_survey" placeholder="Enter Tech Survey">
                                @error('tech_survey')
                                <span id="tech_survey" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="retrofit_design_cost">Retrofit Design</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ $lead->details->retrofit_design_cost ?? 0 }}" type="number" step=".01" min="0" class="form-control retrofit_design_cost @error('retrofit_design_cost') is-invalid @enderror" name="retrofit_design_cost" id="retrofit_design_cost" placeholder="Enter Retrofit Design">
                                @error('retrofit_design_cost')
                                <span id="retrofit_design_cost" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="land_reg_cost">Land Registry</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ $lead->details->land_reg_cost ?? 0 }}" type="number" step=".01" min="0" class="form-control land_reg_cost @error('land_reg_cost') is-invalid @enderror" name="land_reg_cost" id="land_reg_cost" placeholder="Enter Land Registry">
                                @error('land_reg_cost')
                                <span id="land_reg_cost" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="trustmark_cost">Trustmark Lodgement</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ $lead->details->trustmark_cost ?? 0 }}" type="number" step=".01" min="0" class="form-control trustmark_cost @error('trustmark_cost') is-invalid @enderror" name="trustmark_cost" id="trustmark_cost" placeholder="Enter Trustmark Lodgement">
                                @error('trustmark_cost')
                                <span id="trustmark_cost" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="building_regs_fee">Building Regs Fee</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ $lead->details->building_regs_fee ?? 0 }}" type="number" step=".01" min="0" class="form-control building_regs_fee @error('building_regs_fee') is-invalid @enderror" name="building_regs_fee" id="building_regs_fee" placeholder="Enter Building Regs Fee">
                                @error('building_regs_fee')
                                <span id="building_regs_fee" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="data_match_cost">Data Match Cost</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ $lead->details->data_match_cost ?? 0 }}" type="number" step=".01" min="0" class="form-control data_match_cost @error('data_match_cost') is-invalid @enderror" name="data_match_cost" id="data_match_cost" placeholder="Enter Data Match Cost">
                                @error('data_match_cost')
                                <span id="data_match_cost" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="waste_manage">Waste Management</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ $lead->details->waste_manage ?? 0 }}" type="number" step=".01" min="0" class="form-control waste_manage @error('waste_manage') is-invalid @enderror" name="waste_manage" id="waste_manage" placeholder="Enter Waste Management">
                                @error('waste_manage')
                                <span id="waste_manage" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="plumbing_cost">Plumbing</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ $lead->details->plumbing_cost ?? 0 }}" type="number" step=".01" min="0" class="form-control plumbing_cost @error('plumbing_cost') is-invalid @enderror" name="plumbing_cost" id="plumbing_cost" placeholder="Enter Plumbing">
                                @error('plumbing_cost')
                                <span id="plumbing_cost" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="joinery_cost">Joinery</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ $lead->details->joinery_cost ?? 0 }}" type="number" step=".01" min="0" class="form-control joinery_cost @error('joinery_cost') is-invalid @enderror" name="joinery_cost" id="joinery_cost" placeholder="Enter Joinery">
                                @error('joinery_cost')
                                <span id="joinery_cost" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="travel_cost">Travel Cost</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ $lead->details->travel_cost ?? 0 }}" type="number" step=".01" min="0" class="form-control travel_cost @error('travel_cost') is-invalid @enderror" name="travel_cost" id="travel_cost" placeholder="Enter Travel Cost">
                                @error('travel_cost')
                                <span id="travel_cost" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="food_cost">Food Cost</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ $lead->details->food_cost ?? 0 }}" type="number" step=".01" min="0" class="form-control food_cost @error('food_cost') is-invalid @enderror" name="food_cost" id="food_cost" placeholder="Enter Food Cost">
                                @error('food_cost')
                                <span id="food_cost" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Add Other costs multiple --}}
                </div>
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="abs_score">ABS Score</label>
                            <input value="{{ old('abs_score', $lead->details->abs_score ?? 0) }}" oninput="fundingCal()" type="number" step=".01" min="0" class="form-control @error('abs_score') is-invalid @enderror" name="abs_score" id="abs_score" placeholder="Enter ABS Score">
                            @error('abs_score')
                            <span id="abs_score" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="rate">Rate</label>
                            <input value="{{ old('rate', $lead->details->rate ?? 0) }}" type="number" step=".01" min="0" oninput="fundingCal()" class="form-control @error('rate') is-invalid @enderror" name="rate" id="rate" placeholder="Enter Rate">
                            @error('rate')
                            <span id="rate" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="funding">Funding</label>
                            <input value="{{ old('funding', $lead->details->funding ?? 0) }}" type="number" step=".01" readonly class="form-control @error('funding') is-invalid @enderror" name="funding" id="funding" placeholder="Enter Funding">
                            @error('funding')
                            <span id="funding" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                @if(count($lead->types))
                    @foreach($lead->types as $type)
                        @if($type->type == 'material')
                        <div class="row materials">
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="measure">Measure</label>
                                    <select class="form-control select2 @error('measure') is-invalid @enderror" multiple="multiple" name="materials[0][measure][]" style="width: 100%;">
                                        <option value="Loft" {{ is_array($type->measure) && in_array('Loft', $type->measure) ? 'selected' : '' }}>Loft</option>
                                        <option value="IWI" {{ is_array($type->measure) && in_array('IWI', $type->measure) ? 'selected' : '' }}>IWI</option>
                                        <option value="EWI" {{ is_array($type->measure) && in_array('EWI', $type->measure) ? 'selected' : '' }}>EWI</option>
                                        <option value="ASHP" {{ is_array($type->measure) && in_array('ASHP', $type->measure) ? 'selected' : '' }}>ASHP</option>
                                        <option value="Solar PV" {{ is_array($type->measure) && in_array('Solar PV', $type->measure) ? 'selected' : '' }}>Solar PV</option>
                                        <option value="HC" {{ is_array($type->measure) && in_array('HC', $type->measure) ? 'selected' : '' }}>HC</option>
                                        <option value="Boiler" {{ is_array($type->measure) && in_array('Boiler', $type->measure) ? 'selected' : '' }}>Boiler</option>
                                        <option value="FTCH" {{ is_array($type->measure) && in_array('FTCH', $type->measure) ? 'selected' : '' }}>FTCH</option>
                                        <option value="RIR" {{ is_array($type->measure) && in_array('RIR', $type->measure) ? 'selected' : '' }}>RIR</option>
                                        <option value="Storage Heaters" {{ is_array($type->measure) && in_array('Storage Heaters', $type->measure) ? 'selected' : '' }}>Storage Heaters</option>
                                        <option value="Cavity Wall Insulation" {{ is_array($type->measure) && in_array('Cavity Wall Insulation', $type->measure) ? 'selected' : '' }}>Cavity Wall Insulation</option>
                                    </select>
                                    @error('measure')
                                    <span id="measure" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="title">Material</label>
                                    <input value="{{ $type->title ?? old('title') }}" type="text" class="form-control @error('title') is-invalid @enderror" name="materials[0][title]" id="material_title" placeholder="Enter Material Name">
                                    @error('title')
                                    <span id="title" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="cost">Material Cost</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">£</span>
                                        </div>
                                        <input value="{{ old('cost', $type->cost ?? 0) }}" type="number" step=".01" min="0" class="form-control m-cost @error('cost') is-invalid @enderror" name="materials[0][cost]" id="material_cost" placeholder="Enter Material Cost">
                                        @error('cost')
                                        <span id="cost" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-12 d-flex justify-content-center align-items-center mt-2">
                                <button type="button" class="btn btn-primary mx-2" onclick="addMaterial()"><i class="fas fa-plus-square"></i></button>
                            </div>
                        </div>
                        @else
                        <div class="row installers">
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="measure">Measure</label>
                                    <select class="form-control select2 @error('measure') is-invalid @enderror" multiple="multiple" name="installers[0][measure][]" style="width: 100%;">
                                        <option value="Loft" {{ is_array($type->measure) && in_array('Loft', $type->measure) ? 'selected' : '' }}>Loft</option>
                                        <option value="IWI" {{ is_array($type->measure) && in_array('IWI', $type->measure) ? 'selected' : '' }}>IWI</option>
                                        <option value="EWI" {{ is_array($type->measure) && in_array('EWI', $type->measure) ? 'selected' : '' }}>EWI</option>
                                        <option value="ASHP" {{ is_array($type->measure) && in_array('ASHP', $type->measure) ? 'selected' : '' }}>ASHP</option>
                                        <option value="Solar PV" {{ is_array($type->measure) && in_array('Solar PV', $type->measure) ? 'selected' : '' }}>Solar PV</option>
                                        <option value="HC" {{ is_array($type->measure) && in_array('HC', $type->measure) ? 'selected' : '' }}>HC</option>
                                        <option value="Boiler" {{ is_array($type->measure) && in_array('Boiler', $type->measure) ? 'selected' : '' }}>Boiler</option>
                                        <option value="FTCH" {{ is_array($type->measure) && in_array('FTCH', $type->measure) ? 'selected' : '' }}>FTCH</option>
                                        <option value="RIR" {{ is_array($type->measure) && in_array('RIR', $type->measure) ? 'selected' : '' }}>RIR</option>
                                        <option value="Storage Heaters" {{ is_array($type->measure) && in_array('Storage Heaters', $type->measure) ? 'selected' : '' }}>Storage Heaters</option>
                                        <option value="Cavity Wall Insulation" {{ is_array($type->measure) && in_array('Cavity Wall Insulation', $type->measure) ? 'selected' : '' }}>Cavity Wall Insulation</option>
                                    </select>
                                    @error('measure')
                                    <span id="measure" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="title">Installer</label>
                                    <input value="{{ $type->title ?? old('title') }}" type="text" class="form-control @error('title') is-invalid @enderror" name="installers[0][title]" id="installer_title" placeholder="Enter Installer">
                                    @error('title')
                                    <span id="title" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="cost">Installer Cost</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">£</span>
                                        </div>
                                        <input value="{{ old('cost', $type->cost ?? 0) }}" type="number" step=".01" min="0" class="form-control i-cost @error('cost') is-invalid @enderror" name="installers[0][cost]" id="installer_cost" placeholder="Enter Installer Cost">
                                        @error('cost')
                                        <span id="cost" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-12 d-flex justify-content-center align-items-center mt-2">
                                <button type="button" class="btn btn-primary mx-2" onclick="addInstaller()"><i class="fas fa-plus-square"></i></button>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @else
                <div class="row materials">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="measure">Measure</label>
                            <select class="form-control select2 @error('measure') is-invalid @enderror" multiple="multiple" name="materials[0][measure][]" style="width: 100%;">
                                <option value="Loft">Loft</option>
                                <option value="IWI">IWI</option>
                                <option value="EWI">EWI</option>
                                <option value="ASHP">ASHP</option>
                                <option value="Solar PV">Solar PV</option>
                                <option value="HC">HC</option>
                                <option value="Boiler">Boiler</option>
                                <option value="FTCH">FTCH</option>
                                <option value="RIR">RIR</option>
                                <option value="Storage Heaters">Storage Heaters</option>
                                <option value="Cavity Wall Insulation">Cavity Wall Insulation</option>
                            </select>
                            @error('measure')
                            <span id="measure" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="title">Material</label>
                            <input value="{{ old('title') }}" type="text" class="form-control @error('title') is-invalid @enderror" name="materials[0][title]" id="material_title" placeholder="Enter Material Name">
                            @error('title')
                            <span id="title" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="cost">Material Cost</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ old('cost', 0) }}" type="number" step=".01" min="0" class="form-control m-cost @error('cost') is-invalid @enderror" name="materials[0][cost]" id="material_cost" placeholder="Enter Material Cost">
                                @error('cost')
                                <span id="cost" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-12 d-flex justify-content-center align-items-center mt-2">
                        <button type="button" class="btn btn-primary mx-2" onclick="addMaterial()"><i class="fas fa-plus-square"></i></button>
                    </div>
                </div>
                <div class="row installers">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="measure">Measure</label>
                            <select class="form-control select2 @error('measure') is-invalid @enderror" multiple="multiple" name="installers[0][measure][]" style="width: 100%;">
                                <option value="Loft">Loft</option>
                                <option value="IWI">IWI</option>
                                <option value="EWI">EWI</option>
                                <option value="ASHP">ASHP</option>
                                <option value="Solar PV">Solar PV</option>
                                <option value="HC">HC</option>
                                <option value="Boiler">Boiler</option>
                                <option value="FTCH">FTCH</option>
                                <option value="RIR">RIR</option>
                                <option value="Storage Heaters">Storage Heaters</option>
                                <option value="Cavity Wall Insulation">Cavity Wall Insulation</option>
                            </select>
                            @error('measure')
                            <span id="measure" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="title">Installer</label>
                            <input value="{{ old('title') }}" type="text" class="form-control @error('title') is-invalid @enderror" name="installers[0][title]" id="installer_title" placeholder="Enter Installer">
                            @error('title')
                            <span id="title" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="cost">Installer Cost</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ old('cost', 0) }}" type="number" step=".01" min="0" class="form-control i-cost @error('cost') is-invalid @enderror" name="installers[0][cost]" id="installer_cost" placeholder="Enter Installer Cost">
                                @error('cost')
                                <span id="cost" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-12 d-flex justify-content-center align-items-center mt-2">
                        <button type="button" class="btn btn-primary mx-2" onclick="addInstaller()"><i class="fas fa-plus-square"></i></button>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="total_material">Total Material Cost</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ isset($lead) && $lead->details ? $lead->details->total_material : 0 }}" type="number" step=".01" min="0" readonly class="form-control" id="total_material" name="total_material">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="total_installer">Total Installer Cost</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ isset($lead) && $lead->details ? $lead->details->total_installer : 0 }}" type="number" step=".01" min="0" readonly class="form-control" id="total_installer" name="total_installer">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="sub_total">Sub Total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ isset($lead) && $lead->details ? $lead->details->sub_total : 0 }}" type="number" step=".01" min="0" readonly class="form-control" id="sub_total" name="sub_total">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="total_cost">Total Cost of Job</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ old('total_cost', $lead->details->total_cost ?? 0) }}" type="number" step=".01" name="total_cost" readonly class="form-control" id="total_cost">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="gross_profit">Gross Profit</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ old('gross_profit', $lead->details->gross_profit ?? 0) }}" type="number" step=".01" readonly class="form-control" name="gross_profit" id="gross_profit">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="share_type">Share Type</label>
                            <select class="form-control @error('share_type') is-invalid @enderror" id="share_type" name="share_type" style="width: 100%;">
                                <option value="percentage" {{ isset($lead->details) && $lead->details->share_type == 'percentage' ? 'selected' : (old('share_type') == 'percentage' ? 'selected': '')}}>Percentage</option>
                                <option value="fixed" {{ isset($lead->details) && $lead->details->share_type == 'fixed' ? 'selected' : (old('share_type') == 'fixed' ? 'selected': '') }}>Fixed</option>
                            </select>
                            @error('share_type')
                            <span id="share_type" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-12" id="fixed" style="display: none">
                        <div class="form-group">
                            <label for="introducer_share_f">Introducer Share</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ old('introducer_share', $lead->details->introducer_share ?? 0) }}" type="number" step=".01" name="introducer_share" class="form-control introducer_share" id="introducer_share_f">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12" id="percentage" style="">
                        <div class="form-group">
                            <label for="introducer_share_p">Introducer Share</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">%</span>
                                </div>
                                <input value="{{ old('introducer_share', $lead->details->introducer_share ?? 0) }}" type="number" step=".01" name="introducer_share" min="0" max="100" class="form-control introducer_share" id="introducer_share_p">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="introducer_fee">Introducer Fee Payable</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ old('introducer_fee', $lead->details->introducer_fee ?? 0) }}" type="number" step=".01" readonly class="form-control" name="introducer_fee" id="introducer_fee">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="net_profit">Net Profit</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">£</span>
                                </div>
                                <input value="{{ old('net_profit', $lead->details->net_profit ?? 0) }}" type="number" step=".01" readonly class="form-control" name="net_profit" id="net_profit">
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
            $('.select2').select2();
            summary_calculate()
        });
        $('body').on('input', function() {
            summary_calculate()
        })
        $("#share_type").on('change', function () {
            const value = $(this).val();
            if (value == 'fixed') {
                $("#fixed").show()
                $("#percentage").hide()
            } else {
                $("#fixed").hide()
                $("#percentage").show()
            }
        }).change();
        $(".introducer_share").on('change', function () {
            const value = $(this).val()
            const type = $('#share_type').val();
            const gross_profit = parseInt($("#gross_profit").val());
            let fee = 0;
            if (type == 'fixed')
                fee = gross_profit - value
            else
                fee = (((value / 100) * gross_profit)).toFixed(2);
            $('#introducer_fee').attr('value', fee);
            $('#net_profit').attr('value', (gross_profit - fee).toFixed(2));
        }).change();
        function summary_calculate(){
            const funding = parseInt($("#funding").val());
            const sub_total = parseInt($("#sub_total").val());
            const total_ibg_cost = parseInt($("#ibg_cost").val());
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
            const gross_profit = funding - total_cost;
            $('#total_cost').attr('value', total_cost);
            $('#gross_profit').attr('value', gross_profit);
            $('#net_profit').attr('value', gross_profit);
        }
        function fundingCal() {
            const score = $("#abs_score").val();
            const rate = $("#rate").val();
            const funding = score * rate;
            $('#funding').attr('value', funding);
            $('#funding_summary').attr('value', funding);
        }
        $(document).on('click', '.remove_material', function () {
            $(this).parents('div.materials').remove();
        });
        $(document).on('click', '.remove_installer', function () {
            $(this).parents('div.installers').remove();
        });
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
        let material_index = 0;
        let installer_index = 0;
        function addMaterial() {
            material_index++;
            $(".materials:last").after(`<div class="row materials">
            <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="measure">Measure</label>
                            <select class="form-control select2 @error('measure') is-invalid @enderror" multiple="multiple" name="materials[${material_index}][measure][]" style="width: 100%;">
                                <option value="Loft">Loft</option>
                                <option value="IWI">IWI</option>
                                <option value="EWI">EWI</option>
                                <option value="ASHP">ASHP</option>
                                <option value="Solar PV">Solar PV</option>
                                <option value="HC">HC</option>
                                <option value="Boiler">Boiler</option>
                                <option value="FTCH">FTCH</option>
                                <option value="RIR">RIR</option>
                                <option value="Storage Heaters">Storage Heaters</option>
                                <option value="Cavity Wall Insulation">Cavity Wall Insulation</option>
                            </select>
                            @error('measure')
            <span id="measure" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
            </div>
        </div>
<div class="col-md-4 col-12">
<div class="form-group">
<label for="material_name">Material</label>
<input value="{{ old('material_name') }}" type="text" class="form-control @error('material_name') is-invalid @enderror" name="materials[${material_index}][title]" id="material_name" placeholder="Enter Material Name">
            @error('material_name')
            <span id="material_name" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="form-group">
                <label for="material_cost">Material Cost</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">£</span>
                    </div>
                    <input value="{{ old('material_cost', 0) }}" type="number" step=".01" min="0" class="form-control m-cost @error('material_cost') is-invalid @enderror" name="materials[${material_index}][cost]" id="material_cost" placeholder="Enter Material Cost">
                @error('material_cost')
            <span id="material_cost" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            <div class="input-group-append">
                <span class="input-group-text">.00</span>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-2 col-12 d-flex justify-content-center align-items-center mt-2">
    <button type="button" class="btn btn-danger mx-2 remove_material"><i class="fas fa-trash"></i></button>
    </div>
    </div>`);
            $('.select2').select2();
        }
        function addInstaller() {
            installer_index++;
            $(".installers:last").after(`<div class="row installers">
            <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="measure">Measure</label>
                            <select class="form-control select2 @error('measure') is-invalid @enderror" multiple="multiple" name="installers[${installer_index}][measure][]" style="width: 100%;">
                                <option value="Loft">Loft</option>
                                <option value="IWI">IWI</option>
                                <option value="EWI">EWI</option>
                                <option value="ASHP">ASHP</option>
                                <option value="Solar PV">Solar PV</option>
                                <option value="HC">HC</option>
                                <option value="Boiler">Boiler</option>
                                <option value="FTCH">FTCH</option>
                                <option value="RIR">RIR</option>
                                <option value="Storage Heaters">Storage Heaters</option>
                                <option value="Cavity Wall Insulation">Cavity Wall Insulation</option>
                            </select>
                            @error('measure')
            <span id="measure" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
            </div>
        </div>
<div class="col-md-4 col-12">
<div class="form-group">
<label for="title">Installer</label>
<input value="{{ old('title') }}" type="text" class="form-control @error('title') is-invalid @enderror" name="installers[${installer_index}][title]" id="installer_title" placeholder="Enter Installer">
            @error('title')
            <span id="title" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="form-group">
                <label for="cost">Installer Cost</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">£</span>
                    </div>
                    <input value="{{ old('cost', 0) }}" type="number" step=".01" min="0" class="form-control i-cost @error('cost') is-invalid @enderror" name="installers[${installer_index}][cost]" id="installer_cost" placeholder="Enter Installer Cost">
                @error('cost')
            <span id="cost" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            <div class="input-group-append">
                <span class="input-group-text">.00</span>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-2 col-12 d-flex justify-content-center align-items-center mt-2">
    <button type="button" class="btn btn-danger mx-2 remove_installer"><i class="fas fa-trash"></i></button>
    </div>
    </div>`);
            $('.select2').select2();
        }
    </script>
@endpush
