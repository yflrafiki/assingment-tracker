@extends('layouts.app')

@section('title', 'Activities')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>All Activities</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="/activities/create" class="btn btn-success">+ New Activity</a>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Activity</th>
                    <th>Description</th>
                    <th>Created By</th>
                    <th>Latest Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                    <tr>
                        <td><strong>{{ $activity->title }}</strong></td>
                        <td>
                            <small>{{ Str::limit($activity->description, 60) }}</small>
                        </td>
                        <td>
                            <small>{{ $activity->creator->name ?? 'N/A' }}</small>
                        </td>
                        <td>
                            @if($activity->latestUpdate)
                                <span class="badge @if($activity->latestUpdate->status === 'done') badge-done @else badge-pending @endif">
                                    {{ $activity->latestUpdate->status }}
                                </span>
                            @else
                                <span class="badge bg-secondary">No updates</span>
                            @endif
                        </td>
                        <td>
                            <a href="/activities/{{ $activity->id }}" class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            No activities found. <a href="/activities/create">Create one now</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
