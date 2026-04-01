<?php

namespace App\Http\Controllers;

use App\Models\ActivityUpdate;
use App\Models\Activity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $startDate = $request->query('start_date', Carbon::now()->subDays(7)->toDateString());
        $endDate = $request->query('end_date', Carbon::now()->toDateString());
        $activityId = $request->query('activity_id', null);
        $userId = $request->query('user_id', null);
        $status = $request->query('status', null);

        $query = ActivityUpdate::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->with('activity', 'user')
            ->orderBy('created_at', 'desc');

        if ($activityId) {
            $query->where('activity_id', $activityId);
        }

        if ($userId) {
            $query->where('user_id', $userId);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $updates = $query->paginate(25);

        // Get all activities and users for filter dropdowns
        $activities = Activity::orderBy('title')->get();
        $users = \App\Models\User::where('role', 'staff')->orderBy('name')->get();

        // Calculate statistics
        $totalUpdates = count($updates->items());
        $completedCount = collect($updates->items())->where('status', 'done')->count();
        $pendingCount = collect($updates->items())->where('status', 'pending')->count();

        return view('reports.index', compact(
            'updates',
            'activities',
            'users',
            'startDate',
            'endDate',
            'activityId',
            'userId',
            'status',
            'totalUpdates',
            'completedCount',
            'pendingCount'
        ));
    }

    public function summary(Request $request)
    {
        $startDate = $request->query('start_date', Carbon::now()->subDays(30)->toDateString());
        $endDate = $request->query('end_date', Carbon::now()->toDateString());

        // Get updates grouped by date
        $dailyUpdates = ActivityUpdate::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total, 
                        SUM(CASE WHEN status = "done" THEN 1 ELSE 0 END) as done_count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Get top activities
        $topActivities = Activity::with('updates')
            ->withCount(['updates as total_updates' => function ($query) use ($startDate, $endDate) {
                $query->whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate);
            }])
            ->orderByDesc('total_updates')
            ->limit(10)
            ->get();

        // Get staff performance
        $staffPerformance = \App\Models\User::where('role', 'staff')
            ->withCount(['activityUpdates as total_updates' => function ($query) use ($startDate, $endDate) {
                $query->whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate);
            }])
            ->withCount(['activityUpdates as completed_updates' => function ($query) use ($startDate, $endDate) {
                $query->whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate)
                    ->where('status', 'done');
            }])
            ->orderByDesc('total_updates')
            ->get();

        return view('reports.summary', compact(
            'dailyUpdates',
            'topActivities',
            'staffPerformance',
            'startDate',
            'endDate'
        ));
    }

    public function export(Request $request)
    {
        $startDate = $request->query('start_date', Carbon::now()->subDays(7)->toDateString());
        $endDate = $request->query('end_date', Carbon::now()->toDateString());

        $query = ActivityUpdate::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->with('activity', 'user')
            ->orderBy('created_at', 'desc');

        if ($request->query('activity_id')) {
            $query->where('activity_id', $request->query('activity_id'));
        }

        $updates = $query->get();

        $csvData = "Date,Time,Activity,Person,Status,Remark\n";

        foreach ($updates as $update) {
            $date = $update->created_at->toDateString();
            $time = $update->created_at->toTimeString();
            $activity = $update->activity->title;
            $person = $update->user->name;
            $status = $update->status;
            $remark = '"' . str_replace('"', '""', $update->remark ?? '') . '"';

            $csvData .= "$date,$time,$activity,$person,$status,$remark\n";
        }

        return response($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="activity_report_' . date('Y-m-d_H-i-s') . '.csv"',
        ]);
    }
}
