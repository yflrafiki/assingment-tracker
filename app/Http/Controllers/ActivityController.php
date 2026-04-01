<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $activities = Activity::with('latestUpdate', 'updates')->get();
        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Activity::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'created_by' => Auth::id(),
        ]);

        return redirect('activities')->with('success', 'Activity created successfully');
    }

    public function show(Activity $activity)
    {
        $activity->load('updates.user', 'creator');
        $updates = $activity->updates()->paginate(15);
        
        return view('activities.show', compact('activity', 'updates'));
    }

    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,done',
            'remark' => 'nullable|string',
        ]);

        ActivityUpdate::create([
            'activity_id' => $activity->id,
            'user_id' => Auth::id(),
            'status' => $validated['status'],
            'remark' => $validated['remark'] ?? null,
        ]);

        return redirect("activities/{$activity->id}")->with('success', 'Activity updated successfully');
    }

    public function getActivityModal(Activity $activity)
    {
        return view('activities.update-modal', compact('activity'));
    }
}
