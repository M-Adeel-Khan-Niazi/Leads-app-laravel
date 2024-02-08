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
                    <div class="col-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input value="{{ old('first_name', isset($row) ? $row->first_name : '') }}" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="Enter First name">
                            @error('first_name')
                                <span id="first_name" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
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
                    <div class="col-6">
                        <div class="form-group">
                            <label for="type">Select Type</label>
                            <select class="form-control @error('type') is-invalid @enderror" name="type">
                                <option value="major" {{ isset($row) ? $row->type == 'major' ? 'selected': null : old('type') }}>Major</option>
                                <option value="boiler" {{ isset($row) ? $row->type == 'boiler' ? 'selected': null : old('type') }}>Boiler</option>
                            </select>
                            @error('type')
                                <span id="type" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
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
                    <div class="col-6">
                        <div class="form-group">
                            <label for="education">Education</label>
                            <input value="{{ old('education', isset($row) ? $row->education : '') }}" type="text" class="form-control @error('education') is-invalid @enderror" name="education" id="education" placeholder="Enter Education">
                            @error('education')
                            <span id="education" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
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
