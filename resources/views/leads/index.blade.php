@extends('master')
@section('title', 'Leads')
@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <h3 class="card-title py-2">Leads List</h3>
                        </div>
                        <div class="col-md-2 offset-7">
                            <a href="{{ route('leads.create') }}" class="btn btn-block btn-outline-primary">Create</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Agent Name</th>
                            <th>Source</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($leads as $lead)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $lead->agent_details ? $lead->agent_details->name : 'N/A' }}</td>
                            <td>{{ $lead->source ?? 'N/A' }}</td>
                            <td>{{ $lead->status }}</td>
                            <td>{{ $lead->created_by_user ? $lead->created_by_user->name : 'N/A' }}</td>
                            <td>{{ $lead->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <form method="post" id="delete-form" action="{{ route('leads.destroy', $lead->id) }}">
                                    <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-pen"></i></a>
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
                    {{ $leads->links('pagination.links') }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
