@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Dashboard Header with Stats -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="mb-0 fw-bold text-primary"><i class="fas fa-chart-line"></i> Performance Analytics</h1>
                        <div class="badge bg-success p-2">
                            <i class="fas fa-sync-alt"></i> Live Data
                        </div>
                    </div>
                    <p class="text-muted">Track and analyze your business performance metrics</p>
                </div>
            </div>

            <!-- Quick Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="card-subtitle text-muted">Total Leads</h6>
                                <i class="fas fa-users text-primary"></i>
                            </div>
                            <h2 class="mb-0 fw-bold" id="totalLeadsCount">{{ $totalLeads }}</h2>
                            <div class="mt-auto">
                                <span class="badge bg-soft-success text-success"><i class="fas fa-arrow-up"></i> 12%</span>
                                <small class="text-muted ms-1">vs last month</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="card-subtitle text-muted">Conversion Rate</h6>
                                <i class="fas fa-chart-pie text-success"></i>
                            </div>
                            <h2 class="mb-0 fw-bold" id="conversionRate">{{ $totalLeads > 0 ? round(($convertedLeads / $totalLeads) * 100, 1) : 0 }}%</h2>
                            <div class="mt-auto">
                                <span class="badge bg-soft-danger text-danger"><i class="fas fa-arrow-down"></i> 3.2%</span>
                                <small class="text-muted ms-1">vs last month</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="card-subtitle text-muted">Converted Leads</h6>
                                <i class="fas fa-user-check text-warning"></i>
                            </div>
                            <h2 class="mb-0 fw-bold" id="convertedLeadsCount">{{ $convertedLeads }}</h2>
                            <div class="mt-auto">
                                <span class="badge bg-soft-success text-success"><i class="fas fa-arrow-up"></i> 8.4%</span>
                                <small class="text-muted ms-1">vs last month</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="card-subtitle text-muted">Pending Follow-ups</h6>
                                <i class="fas fa-calendar-check text-info"></i>
                            </div>
                            <h2 class="mb-0 fw-bold" id="pendingFollowupsCount">{{ count($followUps) }}</h2>
                            <div class="mt-auto">
                                <span class="badge bg-soft-warning text-warning"><i class="fas fa-equals"></i> 0%</span>
                                <small class="text-muted ms-1">vs last month</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fas fa-filter"></i> Filter Dashboard</h5>
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label for="startDate" class="form-label small text-muted">Start Date</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="far fa-calendar-alt"></i></span>
                                <input type="date" id="startDate" class="form-control border-0 bg-light" placeholder="Start Date">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="endDate" class="form-label small text-muted">End Date</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="far fa-calendar-alt"></i></span>
                                <input type="date" id="endDate" class="form-control border-0 bg-light" placeholder="End Date">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="serviceFilter" class="form-label small text-muted">Service Type</label>
                            <select id="serviceFilter" class="form-select border-0 bg-light">
                                <option value="">All Services</option>
                                @foreach($leadServiceLabels as $service)
                                <option value="{{ $service }}">{{ $service }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button id="filterBtn" class="btn btn-primary w-100">
                                <i class="fas fa-search me-2"></i> Apply Filters
                            </button>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Filters</h5>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <input type="date" class="form-control" id="startDate" 
                                            value="{{ $filters['start_date'] ?? '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control" id="endDate" 
                                            value="{{ $filters['end_date'] ?? '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-select" id="serviceFilter">
                                            <option value="">All Services</option>
                                            @foreach($leadServiceLabels as $service)
                                                <option value="{{ $service }}" 
                                                    {{ ($filters['service_type'] ?? '') == $service ? 'selected' : '' }}>
                                                    {{ $service }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button id="filterBtn" class="btn btn-primary w-100">
                                            <i class="fas fa-filter me-2"></i>Apply Filters
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Leads by Status (Donut Chart) -->
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0"><i class="fas fa-chart-pie text-primary me-2"></i> Lead Status Distribution</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" type="button" id="statusChartOptions" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="statusChartOptions">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i> Export</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-sync-alt me-2"></i> Refresh</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chart-container" style="position: relative; height:280px;">
                                <canvas id="leadsStatusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Leads by Service Required (Bar Graph) -->
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0"><i class="fas fa-chart-bar text-success me-2"></i> Service Distribution</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" type="button" id="serviceChartOptions" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="serviceChartOptions">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i> Export</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-sync-alt me-2"></i> Refresh</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chart-container" style="position: relative; height:280px;">
                                <canvas id="leadsServiceRequiredChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Follow-Up Timeline -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0"><i class="far fa-calendar-alt text-info me-2"></i> Follow-Up Schedule</h5>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-primary active">Month</button>
                                    <button type="button" class="btn btn-sm btn-outline-primary">Week</button>
                                    <button type="button" class="btn btn-sm btn-outline-primary">Day</button>
                                </div>
                            </div>
                            <div id="followUpCalendar" style="min-height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Follow-ups List -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0"><i class="fas fa-tasks text-warning me-2"></i> Upcoming Follow-ups</h5>
                                <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Service</th>
                                            <th scope="col">Follow-up Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(array_slice($followUps, 0, 5) as $followUp)
                                        <tr>
                                            <td>{{ $followUp['title'] }}</td>
                                            <td><span class="badge bg-soft-info text-info">Service Type</span></td>
                                            <td>{{ date('M d, Y', strtotime($followUp['start'])) }}</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light" type="button" id="followupAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="followupAction1">
                                                        <li><a class="dropdown-item" href="#"><i class="fas fa-check me-2"></i> Mark Complete</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="fas fa-pencil-alt me-2"></i> Edit</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-alt me-2"></i> Reschedule</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- External Libraries -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
   document.addEventListener('DOMContentLoaded', function() {
    let statusChart, serviceChart, calendar;

    function initializeCharts(statusData, serviceData) {
        // Destroy existing charts if they exist
        if (statusChart) statusChart.destroy();
        if (serviceChart) serviceChart.destroy();

        // Status Chart
        statusChart = new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: statusData.labels,
                datasets: [{
                    data: statusData.values,
                    backgroundColor: ['#4f46e5', '#10b981', '#f59e0b', '#ef4444']
                }]
            }
        });

        // Service Chart
        serviceChart = new Chart(document.getElementById('serviceChart'), {
            type: 'bar',
            data: {
                labels: serviceData.labels,
                datasets: [{
                    label: 'Leads',
                    data: serviceData.values,
                    backgroundColor: '#3b82f6'
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }

    function initializeCalendar(events) {
        if (calendar) calendar.destroy();
        
        calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            initialView: 'dayGridMonth',
            headerToolbar: {
                start: 'title',
                center: '',
                end: 'today prev,next'
            },
            events: events
        });
        calendar.render();
    }

    // Initial load
    initializeCharts(
        { labels: @json($leadStatusLabels), values: @json($leadStatusCounts) },
        { labels: @json($leadServiceLabels), values: @json($leadServiceCounts) }
    );
    initializeCalendar(@json($followUps));

    // Filter button click handler
    document.getElementById('filterBtn').addEventListener('click', function() {
        const filters = {
            startDate: document.getElementById('startDate').value,
            endDate: document.getElementById('endDate').value,
            serviceFilter: document.getElementById('serviceFilter').value
        };

        fetch('/dashboard/filter', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(filters)
        })
        .then(response => response.json())
        .then(data => {
            // Update metrics
            document.getElementById('totalLeads').textContent = data.totalLeads;
            document.getElementById('convertedLeads').textContent = data.convertedLeads;
            document.getElementById('pendingFollowups').textContent = data.pendingFollowups;

            // Update charts
            initializeCharts(
                { labels: data.leadStatusLabels, values: data.leadStatusCounts },
                { labels: data.leadServiceLabels, values: data.leadServiceCounts }
            );

            // Update calendar
            initializeCalendar(data.followUps);
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>

@endsection