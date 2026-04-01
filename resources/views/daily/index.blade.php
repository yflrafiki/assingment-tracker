@extends('layouts.app')

@section('title', 'Daily Activities View')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2>Daily Activities</h2>
        <p class="text-muted">View all activities and updates for: <strong>{{ $selectedDate->format('F d, Y') }}</strong></p>
    </div>
    <div class="col-md-6 text-end">
        <div class="btn-group" role="group">
            <a href="/daily?date={{ $previousDate }}" class="btn btn-outline-primary">← Previous Day</a>
            <a href="/daily?date={{ now()->toDateString() }}" class="btn btn-outline-primary">Today</a>
            <a href="/daily?date={{ $nextDate }}" class="btn btn-outline-primary">Next Day →</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <input type="date" id="dateInput" class="form-control" value="{{ $selectedDate->toDateString() }}">
        <small class="form-text text-muted">Jump to specific date</small>
    </div>
    <div class="col-md-9 text-end mb-3">
        <a href="/daily/handover?date={{ $selectedDate->toDateString() }}" class="btn btn-warning">
            View Handover (Pending Items)
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header bg-light">
        <h5 class="mb-0">Activity Updates for {{ $selectedDate->format('F d, Y') }}</h5>
    </div>
    
    @forelse($activities as $activity)
        @if($activity->updates->count() > 0)
            <div class="card-body border-bottom">
                <h6 class="mb-3">
                    <strong>{{ $activity->title }}</strong>
                    <small class="text-muted">({{ $activity->description }})</small>
                </h6>

                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Person</th>
                                <th>Status</th>
                                <th>Time</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activity->updates as $update)
                                <tr>
                                    <td>
                                        <strong>{{ $update->user->name }}</strong><br>
                                        <small class="text-muted">{{ $update->user->department ?? 'N/A' }}</small>
                                    </td>
                                    <td>
                                        <span class="badge @if($update->status === 'done') badge-done @else badge-pending @endif">
                                            {{ $update->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ $update->created_at->format('H:i:s') }}</strong><br>
                                        <small>{{ $update->created_at->format('M d') }}</small>
                                    </td>
                                    <td>
                                        @if($update->remark)
                                            <small>{{ Str::limit($update->remark, 50) }}</small>
                                        @else
                                            <small class="text-muted">-</small>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @empty
        <div class="card-body text-center text-muted py-4">
            <p>No activities or updates for this date.</p>
        </div>
    @endforelse
</div>

<script>
document.getElementById('dateInput').addEventListener('change', function() {
    window.location.href = '/daily?date=' + this.value;
});
</script>
@endsection
