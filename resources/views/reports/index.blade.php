@extends('layouts.app')

@section('title', 'Activity Reports')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>Activity Reports</h2>
        <p class="text-muted">Query and analyze activity histories</p>
    </div>
    <div class="col-md-4 text-end">
        <a href="/reports/summary" class="btn btn-info me-2">Summary View</a>
        <a href="/reports/export?start_date={{ $startDate }}&end_date={{ $endDate }}" class="btn btn-success">
            Export CSV
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Filters</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="/reports" class="row g-3">
            <div class="col-md-2">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate }}">
            </div>

            <div class="col-md-2">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}">
            </div>

            <div class="col-md-2">
                <label for="activity_id" class="form-label">Activity</label>
                <select name="activity_id" id="activity_id" class="form-select">
                    <option value="">All Activities</option>
                    @foreach($activities as $activity)
                        <option value="{{ $activity->id }}" @if($activityId == $activity->id) selected @endif>
                            {{ $activity->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="user_id" class="form-label">Person</label>
                <select name="user_id" id="user_id" class="form-select">
                    <option value="">All Staff</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @if($userId == $user->id) selected @endif>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="pending" @if($status === 'pending') selected @endif>Pending</option>
                    <option value="done" @if($status === 'done') selected @endif>Done</option>
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            </div>
        </form>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title text-muted">Total Updates</h6>
                <h2>{{ $totalUpdates }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title text-muted">Completed</h6>
                <h2 class="text-success">{{ $completedCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title text-muted">Pending</h6>
                <h2 class="text-warning">{{ $pendingCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title text-muted">Completion Rate</h6>
                <h2 class="text-primary">
                    @if($totalUpdates > 0)
                        {{ round(($completedCount / $totalUpdates) * 100) }}%
                    @else
                        0%
                    @endif
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Activity Update Details</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Date & Time</th>
                    <th>Activity</th>
                    <th>Person</th>
                    <th>Status</th>
                    <th>Remark</th>
                </tr>
            </thead>
            <tbody>
                @forelse($updates as $update)
                    <tr>
                        <td>
                            <strong>{{ $update->created_at->format('M d, Y') }}</strong><br>
                            <small class="text-muted">{{ $update->created_at->format('H:i:s') }}</small>
                        </td>
                        <td>
                            <a href="/activities/{{ $update->activity->id }}">
                                {{ $update->activity->title }}
                            </a>
                        </td>
                        <td>
                            {{ $update->user->name }}<br>
                            <small class="text-muted">{{ $update->user->department ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <span class="badge @if($update->status === 'done') badge-done @else badge-pending @endif">
                                {{ $update->status }}
                            </span>
                        </td>
                        <td>
                            <small>
                                @if($update->remark)
                                    {{ Str::limit($update->remark, 100) }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </small>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            No updates found for the selected criteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $updates->links() }}
    </div>
</div>
@endsection
