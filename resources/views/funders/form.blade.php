@extends('master')
@section('title', isset($row) ? 'Edit Funder': 'Create Funder')
@section('main-content')
    <div class="card card-primary">
        <!-- form start -->
        @if(isset($row))
            <form method="POST" action="{{ route('funders.update', $row->id) }}">
                @method('PUT')
        @else
            <form method="POST" action="{{ route('funders.store') }}">
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
                            <label for="email">Email</label>
                            <input value="{{ old('email', isset($row) ? $row->email : '') }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter Email">
                            @error('email')
                                <span id="email" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input value="{{ old('address', isset($row) ? $row->address : '') }}" type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Enter Address">
                            @error('address')
                            <span id="address" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input value="{{ old('phone', isset($row) ? $row->phone : '') }}" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Enter Phone">
                            @error('phone')
                            <span id="phone" class="error invalid-feedback">{{ $message }}</span>
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
                <a href="{{ route('funders.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection
