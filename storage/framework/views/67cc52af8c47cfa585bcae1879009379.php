

<?php $__env->startSection('title', 'Reports Summary'); ?>

<?php $__env->startSection('content'); ?>
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
                <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo e($startDate); ?>">
            </div>

            <div class="col-md-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo e($endDate); ?>">
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
                            <?php $__empty_1 = true; $__currentLoopData = $dailyUpdates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dayUpdate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <strong><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d', $dayUpdate->date)->format('M d, Y')); ?></strong>
                                    </td>
                                    <td><?php echo e($dayUpdate->total); ?></td>
                                    <td class="text-success"><strong><?php echo e($dayUpdate->done_count); ?></strong></td>
                                    <td class="text-warning"><strong><?php echo e($dayUpdate->total - $dayUpdate->done_count); ?></strong></td>
                                    <td>
                                        <?php
                                            $percentage = round(($dayUpdate->done_count / $dayUpdate->total) * 100);
                                        ?>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-success" style="width: <?php echo e($percentage); ?>%;">
                                                <?php echo e($percentage); ?>%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">
                                        No data for the selected period.
                                    </td>
                                </tr>
                            <?php endif; ?>
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
                <?php
                    $totalAll = $dailyUpdates->sum('total');
                    $doneAll = $dailyUpdates->sum('done_count');
                    $percent = $totalAll > 0 ? round(($doneAll / $totalAll) * 100) : 0;
                ?>
                <div class="mb-3">
                    <small class="text-muted">Total Updates</small>
                    <h3><?php echo e($totalAll); ?></h3>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Completed</small>
                    <h3 class="text-success"><?php echo e($doneAll); ?></h3>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Pending</small>
                    <h3 class="text-warning"><?php echo e($totalAll - $doneAll); ?></h3>
                </div>
                <div>
                    <small class="text-muted">Overall Completion</small>
                    <div class="progress" style="height: 25px;">
                        <div class="progress-bar bg-success" style="width: <?php echo e($percent); ?>%;">
                            <strong><?php echo e($percent); ?>%</strong>
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
                <?php $__empty_1 = true; $__currentLoopData = $topActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="list-group-item d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1"><?php echo e($activity->title); ?></h6>
                            <small class="text-muted"><?php echo e(Str::limit($activity->description, 50)); ?></small>
                        </div>
                        <span class="badge bg-primary rounded-pill"><?php echo e($activity->total_updates); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="list-group-item text-center text-muted py-3">
                        No activities found.
                    </div>
                <?php endif; ?>
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
                        <?php $__empty_1 = true; $__currentLoopData = $staffPerformance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><strong><?php echo e($staff->name); ?></strong></td>
                                <td><?php echo e($staff->total_updates); ?></td>
                                <td class="text-success"><?php echo e($staff->completed_updates); ?></td>
                                <td>
                                    <?php
                                        $perf = $staff->total_updates > 0 ? round(($staff->completed_updates / $staff->total_updates) * 100) : 0;
                                    ?>
                                    <small><strong><?php echo e($perf); ?>%</strong></small>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">
                                    No staff activity found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\npunto\resources\views/reports/summary.blade.php ENDPATH**/ ?>