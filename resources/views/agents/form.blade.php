@extends('master')
@section('title', isset($row) ? 'Edit Agent': 'Create Agent')
@section('main-content')
    <div class="card card-primary">
        <!-- form start -->
        @if(isset($row))
            <form method="POST" action="{{ route('agents.update',$row->id) }}">
                @method('PUT')
        @else
            <form method="POST" action="{{ route('agents.store') }}">
        @endif
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input value="{{ old('name', isset($row) ? $row->name : '') }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="full_name" placeholder="Enter Full name">
                            @error('name')
                                <span id="name" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input value="{{ old('email', isset($row) ? $row->email : '') }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter Email">
                            @error('email')
                                <span id="email" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input value="{{ old('phone', isset($row) ? $row->phone : '') }}" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Enter Phone">
                            @error('phone')
                            <span id="phone" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                            @error('password')
                                <span id="password" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Confirm Password">
                            @error('password_confirmation')
                                <span id="password_confirmation" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="share">Shares</label>
                            <input type="number" name="share" class="form-control @error('share') is-invalid @enderror" id="share" placeholder="Enter Share" value="{{ old('share', isset($row) && $row->share ?? 0) }}">
                            @error('share')
                            <span id="share" class="error invalid-feedback">{{ $message }}</span>
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
                <a href="{{ route('agents.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection
