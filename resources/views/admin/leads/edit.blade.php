@extends('admin.layouts.app')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="container">
                <h2>Edit Lead</h2>
                <a href="{{ route('leads.index') }}" class="btn btn-secondary mb-3">Back to Leads</a>

                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form to update lead -->
                <form action="{{ route('leads.update', ['lead' => $lead->lead_id]) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Use PUT method for updating -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Customer Name</label>
                                <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name', $lead->customer_name) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $lead->email) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control" value="{{ old('country', $lead->country) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Contact Number</label>
                                <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number', $lead->contact_number) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Website</label>
                                <input type="url" name="website" class="form-control" value="{{ old('website', $lead->website) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Lead Source</label>
                                <select name="lead_source" class="form-control">
                                    <option value="Website" {{ $lead->lead_source == 'Website' ? 'selected' : '' }}>Website</option>
                                    <option value="Referral" {{ $lead->lead_source == 'Referral' ? 'selected' : '' }}>Referral</option>
                                    <option value="Social Media" {{ $lead->lead_source == 'Social Media' ? 'selected' : '' }}>Social Media</option>
                                    <option value="Event" {{ $lead->lead_source == 'Event' ? 'selected' : '' }}>Event</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Service Required</label>
                                <select name="service_required" class="form-control">
                                    <option value="Consulting" {{ $lead->service_required == 'Consulting' ? 'selected' : '' }}>Consulting</option>
                                    <option value="Development" {{ $lead->service_required == 'Development' ? 'selected' : '' }}>Development</option>
                                    <option value="Marketing" {{ $lead->service_required == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="New" {{ $lead->status == 'New' ? 'selected' : '' }}>New</option>
                                    <option value="Contacted" {{ $lead->status == 'Contacted' ? 'selected' : '' }}>Contacted</option>
                                    <option value="Qualified" {{ $lead->status == 'Qualified' ? 'selected' : '' }}>Qualified</option>
                                    <option value="Converted" {{ $lead->status == 'Converted' ? 'selected' : '' }}>Converted</option>
                                    <option value="Lost" {{ $lead->status == 'Lost' ? 'selected' : '' }}>Lost</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label>Follow Up Date</label>
                                <input type="datetime-local" name="follow_up_date" class="form-control" value="{{ old('follow_up_date', date('Y-m-d\TH:i', strtotime($lead->follow_up_date))) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Received Date</label>
                                <input type="date" name="received_date" class="form-control" value="{{ old('received_date', $lead->received_date) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>LinkedIn Profile</label>
                                <input type="url" name="linkedin_profile" class="form-control" value="{{ old('linkedin_profile', $lead->linkedin_profile) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Assigned To</label>
                                <select name="assigned_to" class="form-control">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $lead->assigned_to == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Update Lead</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
