@extends('admin.layouts.app')
    @section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        
                            <div class="container">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h2>Add New Lead</h2>
                                    <a href="{{ route('leads.index') }}" class="btn btn-secondary">Back to Leads</a>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('leads.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Customer Name</label>
                                                <input type="text" name="customer_name" class="form-control" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Country</label>
                                                <input type="text" name="country" class="form-control">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Contact Number</label>
                                                <input type="text" name="contact_number" class="form-control">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Website</label>
                                                <input type="url" name="website" class="form-control">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Lead Source</label>
                                                <select name="lead_source" class="form-control">
                                                    <option value="Website">Website</option>
                                                    <option value="Referral">Referral</option>
                                                    <option value="Social Media">Social Media</option>
                                                    <option value="Event">Event</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Service Required</label>
                                                <select name="service_required" class="form-control">
                                                    <option value="Consulting">Consulting</option>
                                                    <option value="Development">Development</option>
                                                    <option value="Marketing">Marketing</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="New">New</option>
                                                    <option value="Contacted">Contacted</option>
                                                    <option value="Qualified">Qualified</option>
                                                    <option value="Converted">Converted</option>
                                                    <option value="Lost">Lost</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Follow Up Date</label>
                                                <input type="datetime-local" name="follow_up_date" class="form-control" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Received Date</label>
                                                <input type="date" name="received_date" class="form-control" required>
                                            </div>
                                            

                                            <div class="form-group mb-3">
                                                <label>LinkedIn Profile</label>
                                                <input type="url" name="linkedin_profile" class="form-control">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Assigned To</label>
                                                <select name="assigned_to" class="form-control">
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-success">Save Lead</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection