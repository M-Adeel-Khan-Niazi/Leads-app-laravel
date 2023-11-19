@extends('master')
@section('title', 'Funders')
@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <h3 class="card-title py-2">Funders List</h3>
                        </div>
                        <div class="col-md-2 offset-7">
                            <a href="{{ route('funders.create') }}" class="btn btn-block btn-outline-primary">Create</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($funders as $funder)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $funder->first_name }}</td>
                            <td>{{ $funder->last_name ?? 'N/A' }}</td>
                            <td>{{ $funder->email }}</td>
                            <td>{{ $funder->address }}</td>
                            <td>{{ $funder->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <form method="post" id="delete-form" action="{{ route('funders.destroy', $funder->id) }}">
                                    <a href="{{ route('funders.edit', $funder->id) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-pen"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="SingleDelete btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr style="width: 100%">No Records Found!</tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix ">
                    {{ $funders->links('pagination.links') }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
