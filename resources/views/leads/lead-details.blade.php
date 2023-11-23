@extends('master')
@section('title', 'Lead Details')
@section('main-content')
    <div class="card card-primary">
        <!-- form start -->
{{--        {{ route('leads.update',$row->id) }}--}}
        <form method="POST" action="">
            @csrf
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
                                        <textarea class="form-control @error('comment') is-invalid @enderror" id="is_flexible" rows="4" placeholder="Enter Comments" name="comment">{{ isset($row) ? $row->comment : old('comment') }}</textarea>
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
        });
    </script>
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}">
@endpush
