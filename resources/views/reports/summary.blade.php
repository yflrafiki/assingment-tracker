@extends('layouts.app')

@section('title', 'Reports Summary')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>Activity Summary Report</h2>
        <p class="text-muted">Overview and statistics for the period</p>
    </div>
    <div class="col-md-4 text-end">
        <a href="/reports" class="btn btn-secondary">← Back to Reports</a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Date Range</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="/reports/summary" class="row g-3">
            <div class="col-md-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate }}">
            </div>

            <div class="col-md-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}">
            </div>

            <div class="col-md-6 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Update Report</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Daily Updates Trend</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Total Updates</th>
                                <th>Completed</th>
                                <th>Pending</th>
                                <th>Completion %</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dailyUpdates as $dayUpdate)
                                <tr>
                                    <td>
                                        <strong>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $dayUpdate->date)->format('M d, Y') }}</strong>
                                    </td>
                                    <td>{{ $dayUpdate->total }}</td>
                                    <td class="text-success"><strong>{{ $dayUpdate->done_count }}</strong></td>
                                    <td class="text-warning"><strong>{{ $dayUpdate->total - $dayUpdate->done_count }}</strong></td>
                                    <td>
                                        @php
                                            $percentage = round(($dayUpdate->done_count / $dayUpdate->total) * 100);
                                        @endphp
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-success" style="width: {{ $percentage }}%;">
                                                {{ $percentage }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">
                                        No data for the selected period.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Overall Statistics</h5>
            </div>
            <div class="card-body">
                @php
                    $totalAll = $dailyUpdates->sum('total');
                    $doneAll = $dailyUpdates->sum('done_count');
                    $percent = $totalAll > 0 ? round(($doneAll / $totalAll) * 100) : 0;
                @endphp
                <div class="mb-3">
                    <small class="text-muted">Total Updates</small>
                    <h3>{{ $totalAll }}</h3>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Completed</small>
                    <h3 class="text-success">{{ $doneAll }}</h3>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Pending</small>
                    <h3 class="text-warning">{{ $totalAll - $doneAll }}</h3>
                </div>
                <div>
                    <small class="text-muted">Overall Completion</small>
                    <div class="progress" style="height: 25px;">
                        <div class="progress-bar bg-success" style="width: {{ $percent }}%;">
                            <strong>{{ $percent }}%</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Top Activities</h5>
            </div>
            <div class="list-group list-group-flush">
                @forelse($topActivities as $activity)
                    <div class="list-group-item d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1">{{ $activity->title }}</h6>
                            <small class="text-muted">{{ Str::limit($activity->description, 50) }}</small>
                        </div>
                        <span class="badge bg-primary rounded-pill">{{ $activity->total_updates }}</span>
                    </div>
                @empty
                    <div class="list-group-item text-center text-muted py-3">
                        No activities found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Staff Performance</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Person</th>
                            <th>Total</th>
                            <th>Done</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($staffPerformance as $staff)
                            <tr>
                                <td><strong>{{ $staff->name }}</strong></td>
                                <td>{{ $staff->total_updates }}</td>
                                <td class="text-success">{{ $staff->completed_updates }}</td>
                                <td>
                                    @php
                                        $perf = $staff->total_updates > 0 ? round(($staff->completed_updates / $staff->total_updates) * 100) : 0;
                                    @endphp
                                    <small><strong>{{ $perf }}%</strong></small>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">
                                    No staff activity found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
