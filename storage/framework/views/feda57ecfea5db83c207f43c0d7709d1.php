

<?php $__env->startSection('title', 'Activity Reports'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-8">
        <h2>Activity Reports</h2>
        <p class="text-muted">Query and analyze activity histories</p>
    </div>
    <div class="col-md-4 text-end">
        <a href="/reports/summary" class="btn btn-info me-2">Summary View</a>
        <a href="/reports/export?start_date=<?php echo e($startDate); ?>&end_date=<?php echo e($endDate); ?>" class="btn btn-success">
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
                <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo e($startDate); ?>">
            </div>

            <div class="col-md-2">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo e($endDate); ?>">
            </div>

            <div class="col-md-2">
                <label for="activity_id" class="form-label">Activity</label>
                <select name="activity_id" id="activity_id" class="form-select">
                    <option value="">All Activities</option>
                    <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($activity->id); ?>" <?php if($activityId == $activity->id): ?> selected <?php endif; ?>>
                            <?php echo e($activity->title); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-md-2">
                <label for="user_id" class="form-label">Person</label>
                <select name="user_id" id="user_id" class="form-select">
                    <option value="">All Staff</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>" <?php if($userId == $user->id): ?> selected <?php endif; ?>>
                            <?php echo e($user->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-md-2">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="pending" <?php if($status === 'pending'): ?> selected <?php endif; ?>>Pending</option>
                    <option value="done" <?php if($status === 'done'): ?> selected <?php endif; ?>>Done</option>
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
                <h2><?php echo e($totalUpdates); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title text-muted">Completed</h6>
                <h2 class="text-success"><?php echo e($completedCount); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title text-muted">Pending</h6>
                <h2 class="text-warning"><?php echo e($pendingCount); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title text-muted">Completion Rate</h6>
                <h2 class="text-primary">
                    <?php if($totalUpdates > 0): ?>
                        <?php echo e(round(($completedCount / $totalUpdates) * 100)); ?>%
                    <?php else: ?>
                        0%
                    <?php endif; ?>
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
                <?php $__empty_1 = true; $__currentLoopData = $updates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $update): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <strong><?php echo e($update->created_at->format('M d, Y')); ?></strong><br>
                            <small class="text-muted"><?php echo e($update->created_at->format('H:i:s')); ?></small>
                        </td>
                        <td>
                            <a href="/activities/<?php echo e($update->activity->id); ?>">
                                <?php echo e($update->activity->title); ?>

                            </a>
                        </td>
                        <td>
                            <?php echo e($update->user->name); ?><br>
                            <small class="text-muted"><?php echo e($update->user->department ?? 'N/A'); ?></small>
                        </td>
                        <td>
                            <span class="badge <?php if($update->status === 'done'): ?> badge-done <?php else: ?> badge-pending <?php endif; ?>">
                                <?php echo e($update->status); ?>

                            </span>
                        </td>
                        <td>
                            <small>
                                <?php if($update->remark): ?>
                                    <?php echo e(Str::limit($update->remark, 100)); ?>

                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </small>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            No updates found for the selected criteria.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <?php echo e($updates->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\npunto\resources\views/reports/index.blade.php ENDPATH**/ ?>