@extends('master')
@section('title', isset($row) ? 'Edit Installer': 'Create Installer')
@section('main-content')
    <div class="card card-primary">
        <!-- form start -->
        @if(isset($row))
            <form method="POST" action="{{ route('installers.update', $row->id) }}">
                @method('PUT')
        @else
            <form method="POST" action="{{ route('installers.store') }}">
        @endif
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input value="{{ old('first_name', isset($row) ? $row->first_name : '') }}" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="Enter First name">
                            @error('first_name')
                                <span id="first_name" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input value="{{ old('last_name', isset($row) ? $row->last_name : '') }}" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Enter Last name">
                            @error('last_name')
                            <span id="last_name" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="type">Select Type</label>
                            <select class="form-control select2 @error('type') is-invalid @enderror" multiple="multiple" name="type[]" style="width: 100%;">
                                <option value="EWI" {{ isset($row) ? $row->type == 'EWI' ? 'selected': null : old('type') }}>EWI</option>
                                <option value="IWI" {{ isset($row) ? $row->type == 'IWI' ? 'selected': null : old('type') }}>IWI</option>
                                <option value="RIR" {{ isset($row) ? $row->type == 'RIR' ? 'selected': null : old('type') }}>RIR</option>
                                <option value="Cavity" {{ isset($row) ? $row->type == 'Cavity' ? 'selected': null : old('type') }}>Cavity</option>
                                <option value="Boiler" {{ isset($row) ? $row->type == 'Boiler' ? 'selected': null : old('type') }}>Boiler</option>
                                <option value="Loft" {{ isset($row) ? $row->type == 'Loft' ? 'selected': null : old('type') }}>Loft</option>
                                <option value="Plumber" {{ isset($row) ? $row->type == 'Plumber' ? 'selected': null : old('type') }}>Plumber</option>
                                <option value="Electrician" {{ isset($row) ? $row->type == 'Electrician' ? 'selected': null : old('type') }}>Electrician</option>
                                <option value="Handy man" {{ isset($row) ? $row->type == 'Handy man' ? 'selected': null : old('type') }}>Handy man</option>
                                <option value="Cleaner" {{ isset($row) ? $row->type == 'Cleaner' ? 'selected': null : old('type') }}>Cleaner</option>
                                <option value="Driver" {{ isset($row) ? $row->type == 'Driver' ? 'selected': null : old('type') }}>Driver</option>
                                <option value="Renewables" {{ isset($row) ? $row->type == 'Renewables' ? 'selected': null : old('type') }}>Renewables</option>
                            </select>
                            @error('type')
                                <span id="type" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input value="{{ old('phone_number', isset($row) ? $row->phone_number : '') }}" type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" placeholder="Enter Phone Number">
                            @error('phone_number')
                                <span id="phone_number" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="education">Education</label>
                            <input value="{{ old('education', isset($row) ? $row->education : '') }}" type="text" class="form-control @error('education') is-invalid @enderror" name="education" id="education" placeholder="Enter Education">
                            @error('education')
                            <span id="education" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Comments</label>
                            <textarea class="form-control @error('comment') is-invalid @enderror" id="is_flexible" rows="4" placeholder="Enter Comments" name="comment">{{ isset($row) ? $row->comment : old('comment') }}</textarea>
                            @error('comment')
                            <span id="comment" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('installers.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection
