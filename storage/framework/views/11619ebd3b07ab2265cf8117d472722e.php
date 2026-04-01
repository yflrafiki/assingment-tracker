

<?php $__env->startSection('title', 'Daily Activities View'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-6">
        <h2>Daily Activities</h2>
        <p class="text-muted">View all activities and updates for: <strong><?php echo e($selectedDate->format('F d, Y')); ?></strong></p>
    </div>
    <div class="col-md-6 text-end">
        <div class="btn-group" role="group">
            <a href="/daily?date=<?php echo e($previousDate); ?>" class="btn btn-outline-primary">← Previous Day</a>
            <a href="/daily?date=<?php echo e(now()->toDateString()); ?>" class="btn btn-outline-primary">Today</a>
            <a href="/daily?date=<?php echo e($nextDate); ?>" class="btn btn-outline-primary">Next Day →</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <input type="date" id="dateInput" class="form-control" value="<?php echo e($selectedDate->toDateString()); ?>">
        <small class="form-text text-muted">Jump to specific date</small>
    </div>
    <div class="col-md-9 text-end mb-3">
        <a href="/daily/handover?date=<?php echo e($selectedDate->toDateString()); ?>" class="btn btn-warning">
            View Handover (Pending Items)
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header bg-light">
        <h5 class="mb-0">Activity Updates for <?php echo e($selectedDate->format('F d, Y')); ?></h5>
    </div>
    
    <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php if($activity->updates->count() > 0): ?>
            <div class="card-body border-bottom">
                <h6 class="mb-3">
                    <strong><?php echo e($activity->title); ?></strong>
                    <small class="text-muted">(<?php echo e($activity->description); ?>)</small>
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
                            <?php $__currentLoopData = $activity->updates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $update): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <strong><?php echo e($update->user->name); ?></strong><br>
                                        <small class="text-muted"><?php echo e($update->user->department ?? 'N/A'); ?></small>
                                    </td>
                                    <td>
                                        <span class="badge <?php if($update->status === 'done'): ?> badge-done <?php else: ?> badge-pending <?php endif; ?>">
                                            <?php echo e($update->status); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <strong><?php echo e($update->created_at->format('H:i:s')); ?></strong><br>
                                        <small><?php echo e($update->created_at->format('M d')); ?></small>
                                    </td>
                                    <td>
                                        <?php if($update->remark): ?>
                                            <small><?php echo e(Str::limit($update->remark, 50)); ?></small>
                                        <?php else: ?>
                                            <small class="text-muted">-</small>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="card-body text-center text-muted py-4">
            <p>No activities or updates for this date.</p>
        </div>
    <?php endif; ?>
</div>

<script>
document.getElementById('dateInput').addEventListener('change', function() {
    window.location.href = '/daily?date=' + this.value;
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\npunto\resources\views/daily/index.blade.php ENDPATH**/ ?>