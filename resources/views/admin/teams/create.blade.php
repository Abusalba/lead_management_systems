@extends('admin.layouts.app')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="container mt-5">
                    <h1>Create New Team</h1>
                    <form action="{{ route('teams.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Team Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Save Team</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
