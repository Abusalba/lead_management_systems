@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="container mb-4">
                <form method="GET" action="{{ route('leads.index') }}" class="row g-3">
                    
                    <!-- Search by Name, Email, Status, Service -->
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Search leads..."
                            value="{{ request('search') }}">
                    </div>
            
                    <!--Filter by Date Range -->
                    <div class="col-md-2">
                        <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                    </div>
            
                    <!--Filter by Country -->
                    <div class="col-md-2">
                        <select name="country" class="form-control">
                            <option value="">Select Country</option>
                            <option value="USA" {{ request('country') == 'USA' ? 'selected' : '' }}>USA</option>
                            <option value="UK" {{ request('country') == 'UK' ? 'selected' : '' }}>UK</option>
                            <option value="India" {{ request('country') == 'India' ? 'selected' : '' }}>India</option>
                        </select>
                    </div>
            
                    <!-- Filter by Lead Source -->
                    <div class="col-md-2">
                        <select name="lead_source" class="form-control">
                            <option value="">Lead Source</option>
                            <option value="Website" {{ request('lead_source') == 'Website' ? 'selected' : '' }}>Website</option>
                            <option value="Referral" {{ request('lead_source') == 'Referral' ? 'selected' : '' }}>Referral</option>
                            <option value="Social Media" {{ request('lead_source') == 'Social Media' ? 'selected' : '' }}>Social Media</option>
                            <option value="Event" {{ request('lead_source') == 'Event' ? 'selected' : '' }}>Event</option>
                        </select>
                    </div>
            
                    <!-- Filter by Status -->
                    <div class="col-md-2">
                        <select name="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="New" {{ request('status') == 'New' ? 'selected' : '' }}>New</option>
                            <option value="Contacted" {{ request('status') == 'Contacted' ? 'selected' : '' }}>Contacted</option>
                            <option value="Qualified" {{ request('status') == 'Qualified' ? 'selected' : '' }}>Qualified</option>
                            <option value="Lost" {{ request('status') == 'Lost' ? 'selected' : '' }}>Lost</option>
                        </select>
                    </div>
            
                    <!--Sorting -->
                    <div class="col-md-2">
                        <select name="sort_by" class="form-control">
                            <option value="received_date" {{ request('sort_by') == 'received_date' ? 'selected' : '' }}>Received Date</option>
                            <option value="follow_up_date" {{ request('sort_by') == 'follow_up_date' ? 'selected' : '' }}>Follow Up Date</option>
                            <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>Status</option>
                        </select>
                    </div>
            
                    <div class="col-md-2">
                        <select name="sort_order" class="form-control">
                            <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                    </div>
            
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('leads.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
            
                </form>
            </div>
            
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Leads Management</h2>
                    <a href="{{ route('leads.create') }}" class="btn btn-primary">Add Lead</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Contact Number</th>
                            <th>Lead Source</th>
                            <th>Service Required</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leads as $lead)
                            <tr>
                                <td>{{ $lead->lead_id }}</td>
                                <td>{{ $lead->customer_name }}</td>
                                <td>{{ $lead->email }}</td>
                                <td>{{ $lead->country }}</td>
                                <td>{{ $lead->contact_number }}</td>
                                <td>{{ $lead->lead_source }}</td>
                                <td>{{ $lead->service_required }}</td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'New' => 'primary',
                                            'Contacted' => 'success',
                                            'Qualified' => 'info',
                                            'Lost' => 'danger',
                                            'Converted' => 'warning' // Add more statuses if needed
                                        ];
                                    @endphp
                                
                                    <span class="badge bg-{{ $statusColors[$lead->status] ?? 'secondary' }}">
                                        {{ $lead->status }}
                                    </span>
                                </td>
                                
                                <td>{{ $lead->assigned_to }}</td>
                                <td>
                                    <a href="{{ route('leads.edit', $lead->lead_id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('leads.destroy', $lead->lead_id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">No leads found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection