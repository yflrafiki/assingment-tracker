@extends('layouts.app')

@section('title', 'Activity Handover')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>Activity Handover</h2>
        <p class="text-muted">Date: <strong>{{ $selectedDate->format('F d, Y') }}</strong></p>
        <p class="text-muted small">Pending items that need to be handed over for the next shift</p>
    </div>
    <div class="col-md-4 text-end">
        <a href="/daily?date={{ $date }}" class="btn btn-secondary">← Back to Daily View</a>
    </div>
</div>

<div class="alert alert-warning">
    <i class="bi bi-exclamation-triangle"></i>
    <strong>Pending Activities:</strong> These activities are still pending and need to be completed by the next shift. 
    Please review and hand over appropriately.
</div>

@if($pendingActivities->count() > 0)
    <div class="row">
        @foreach($pendingActivities as $activity)
            <div class="col-md-6 mb-3">
                <div class="card border-warning">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="mb-0">{{ $activity->title }}</h6>
                    </div>
                    <div class="card-body">
                        <p><small>{{ $activity->description }}</small></p>
                        
                        <hr>

                        <div class="mb-2">
                            <small><strong>Last Update:</strong></small>
                            @if($activity->updates->first())
                                <div class="alert alert-light mb-0 py-2 px-2">
                                    <div class="mb-1">
                                        <strong>{{ $activity->updates->first()->user->name }}</strong>
                                        <span class="badge badge-pending">{{ $activity->updates->first()->status }}</span>
                                    </div>
                                    <div class="mb-1">
                                        <small class="text-muted">{{ $activity->updates->first()->created_at->format('H:i:s') }}</small>
                                    </div>
                                    @if($activity->updates->first()->remark)
                                        <div>
                                            <small><strong>Remark:</strong><br>{{ $activity->updates->first()->remark }}</small>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-success text-center py-4">
        <h5>✓ All activities completed!</h5>
        <p class="mb-0">No pending activities for handover on {{ $selectedDate->format('F d, Y') }}</p>
    </div>
@endif
@endsection
