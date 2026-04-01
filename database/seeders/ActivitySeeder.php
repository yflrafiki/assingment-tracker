<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::create([
            'title' => 'Daily SMS Count Comparison',
            'description' => 'Daily SMS count in comparison to SMS count from logs',
            'created_by' => 1,
        ]);

        Activity::create([
            'title' => 'System Uptime Check',
            'description' => 'Verify all systems are up and operational',
            'created_by' => 1,
        ]);

        Activity::create([
            'title' => 'Database Backup',
            'description' => 'Perform daily database backup',
            'created_by' => 1,
        ]);

        Activity::create([
            'title' => 'Log File Review',
            'description' => 'Review critical error logs',
            'created_by' => 1,
        ]);

        Activity::create([
            'title' => 'API Response Time Check',
            'description' => 'Monitor API response times and latency',
            'created_by' => 1,
        ]);
    }
}
