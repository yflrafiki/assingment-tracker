<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityUpdate;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DailyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $date = $request->query('date', Carbon::now()->toDateString());
        $selectedDate = Carbon::createFromFormat('Y-m-d', $date);

        // Get all activity updates for the selected date
        $updates = ActivityUpdate::whereDate('created_at', $selectedDate)
            ->with('activity', 'user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('activity_id');

        // Get all activities with their latest updates for this date
        $activities = Activity::with(['updates' => function ($query) use ($selectedDate) {
            $query->whereDate('created_at', $selectedDate)
                ->orderBy('created_at', 'desc');
        }, 'creator'])->get();

        $previousDate = $selectedDate->copy()->subDay()->toDateString();
        $nextDate = $selectedDate->copy()->addDay()->toDateString();

        return view('daily.index', compact(
            'activities',
            'updates',
            'date',
            'selectedDate',
            'previousDate',
            'nextDate'
        ));
    }

    public function handover(Request $request)
    {
        $date = $request->query('date', Carbon::now()->toDateString());
        $selectedDate = Carbon::createFromFormat('Y-m-d', $date);

        // Get pending activities for handover
        $pendingActivities = Activity::with(['updates' => function ($query) use ($selectedDate) {
            $query->whereDate('created_at', $selectedDate)
                ->where('status', 'pending')
                ->orderBy('created_at', 'desc');
        }, 'creator'])->get()->filter(function ($activity) {
            return $activity->updates->count() > 0;
        });

        return view('daily.handover', compact('pendingActivities', 'date', 'selectedDate'));
    }
}
