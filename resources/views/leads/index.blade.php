@extends('master')
@section('title', 'Leads')
@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{route('leads.index')}}">
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <h3 class="card-title py-2">Leads List</h3>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <select class="form-control" name="status" id="featured">
                                        <option {{is_null(request()->input('status')) ? 'selected' : ''}} value=""> All</option>
                                        <option {{request()->input('status') == 'pending' ? 'selected' : ''}} value="pending">Lead Submitted</option>
                                        <option {{request()->input('status') == 'rejected' ? 'selected' : ''}} value="rejected">Lead Rejected</option>
                                        <option {{request()->input('status') == 'onHold' ? 'selected' : ''}} value="onHold">Lead On Hold</option>
                                        <option {{request()->input('status') == 'approved' ? 'selected' : ''}} value="approved">Lead Approved</option>
                                        <option {{request()->input('status') == 'Awaiting' ? 'selected' : ''}} value="Awaiting">Awaiting Data Matched</option>
                                        <option {{request()->input('status') == 'Matched' ? 'selected' : ''}} value="Matched">Data Matched Sent</option>
                                        <option {{request()->input('status') == 'Unverified' ? 'selected' : ''}} value="Unverified">Data Matched Un-Verified</option>
                                        <option {{request()->input('status') == 'Unmatched' ? 'selected' : ''}} value="Unmatched">Data Un-Matched</option>
                                        <option {{request()->input('status') == 'raBooked' ? 'selected' : ''}} value="raBooked">RA Booked</option>
                                        <option {{request()->input('status') == 'raCompleted' ? 'selected' : ''}} value="raCompleted">RA Completed</option>
                                        <option {{request()->input('status') == 'raLodged' ? 'selected' : ''}} value="raLodged">RA Lodged</option>
                                        <option {{request()->input('status') == 'installationBooked' ? 'selected' : ''}} value="installationBooked">Installation Booked</option>
                                        <option {{request()->input('status') == 'installationStarted' ? 'selected' : ''}} value="installationStarted">Installation Started</option>
                                        <option {{request()->input('status') == 'installationCompleted' ? 'selected' : ''}} value="installationCompleted">Installation Completed</option>
                                        <option {{request()->input('status') == 'installationCompleted' ? 'selected' : ''}} value="installationCompleted">Hanover Pending</option>
                                        <option {{request()->input('status') == 'handoverCompleted' ? 'selected' : ''}} value="handoverCompleted">Hanover Completed</option>
                                        <option {{request()->input('status') == 'paperworkSubmitted' ? 'selected' : ''}} value="paperworkSubmitted">Funder Paperwork Submitted</option>
                                        <option {{request()->input('status') == 'paperworkError' ? 'selected' : ''}} value="paperworkError">Funder Paperwork Error</option>
                                        <option {{request()->input('status') == 'paperworkAccepted' ? 'selected' : ''}} value="paperworkAccepted">Funder Paperwork Accepted</option>
                                        <option {{request()->input('status') == 'invoicePaid' ? 'selected' : ''}} value="invoicePaid">Invoice Paid</option>
                                        @if(request()->user()->role == 'admin')
                                            <option {{request()->input('status') == 'invoicePaid' ? 'selected' : ''}} value="invoicePaid">Agent Awaiting Invoice</option>
                                            <option {{request()->input('status') == 'agentPaid' ? 'selected' : ''}} value="agentPaid">Agent Paid</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <input value="{{ request()->search ?? old('search') }}" type="text" class="form-control" name="search" placeholder="Enter Search">
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="col-md-2 col-12">
                                <a href="{{ route('leads.create') }}" class="btn btn-block btn-outline-primary">Create</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table class="table table-bordered text-nowrap">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Agent Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($leads as $lead)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $lead->agent_details ? $lead->agent_details->name : $lead->created_by_user->name }}</td>
                            <td>{{ $lead->house_number .', '. $lead->street .', '. $lead->town .', '. $lead->postal_code ?? 'N/A' }}</td>
                            <td>{{ $lead->resident_contact ?? 'N/A' }}</td>
                            <td>
                                @switch($lead->status)
                                    @case('draft')<button type="button" class="btn btn-block btn-dark btn-sm">Draft</button>@break
                                    @case('pending')<button type="button" class="btn btn-block btn-secondary btn-sm">Lead Submitted</button>@break

                                    @case('raBooked')<button type="button" class="btn btn-block btn-primary btn-sm">RA Booked</button>@break
                                    @case('installationBooked')<button type="button" class="btn btn-block btn-primary btn-sm">Installation Booked</button>@break

                                    @case('installationStarted')<button type="button" class="btn btn-block btn-info btn-sm">Installation Started</button>@break
                                    @case('paperworkSubmitted')<button type="button" class="btn btn-block btn-info btn-sm">Funder Paperwork Submitted</button>@break

                                    @case('paperworkAccepted')<button type="button" class="btn btn-block btn-warning btn-sm">Awaiting Invoice Payment</button>@break
                                    @case('invoicePaid')<button type="button" class="btn btn-block btn-warning btn-sm">Agent Awaiting Invoice</button>@break
                                    @case('installationCompleted')<button type="button" class="btn btn-block btn-warning btn-sm">Handover Pending</button>@break
                                    @case('handoverCompleted')<button type="button" class="btn btn-block btn-warning btn-sm">Funder Paperwork Pending</button>@break
                                    @case('raLodged')<button type="button" class="btn btn-block btn-warning btn-sm">Awaiting Installation</button>@break
                                    @case('raCompleted')<button type="button" class="btn btn-block btn-warning btn-sm">RA Lodgement Pending</button>@break
                                    @case('approved')<button type="button" class="btn btn-block btn-warning btn-sm">RA Pending</button>@break
                                    @case('onHold')<button type="button" class="btn btn-block btn-warning btn-sm">OnHold</button>@break

                                    @case('paperworkError')<button type="button" class="btn btn-block btn-danger btn-sm">Funder Paperwork Error</button>@break
                                    @case('rejected')<button type="button" class="btn btn-block btn-danger btn-sm">Rejected</button>@break
                                    @case('invoicePaid')<button type="button" class="btn btn-block btn-success btn-sm">Invoice Paid</button>@break
                                    @case('agentPaid')<button type="button" class="btn btn-block btn-success btn-sm">Agent Paid</button>@break
                                @endswitch
                            </td>
                            <td>{{ $lead->created_at->format('Y-m-d H:i') }}</td>
                            <td class="text-center">
                                <form method="post" id="delete-form" action="{{ route('leads.destroy', $lead->id) }}">
                                    @if (auth()->user()->role == 'admin' || $lead->status == 'draft')
                                        <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-pen"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="SingleDelete btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                    @endif
                                    @if (!in_array($lead->status,['draft']) && auth()->user()->role == 'admin')
                                        <a href="{{ route('leads.details', ['data-matched',$lead->id]) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-book-open"></i></a>
                                        <a href="{{ route('leads.details', ['retrofit',$lead->id]) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-user-cog"></i></a>
                                        <a href="{{ route('leads.details', ['measure-install',$lead->id]) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-ruler-combined"></i></a>
                                        <a href="{{ route('leads.details', ['handover',$lead->id]) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-hand-holding"></i></a>
                                        <a href="{{ route('leads.details', ['summary',$lead->id]) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-calculator"></i></a>
                                    @endif
                                    @if($lead->status == 'completed')
                                        <a href="{{ route('survey.pdf', $lead->id) }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-file-pdf"></i></a>
                                    @endif
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
