

<?php $__env->startSection('title', 'Activities'); ?>

<?php $__env->startSection('content'); ?>
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
                <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><strong><?php echo e($activity->title); ?></strong></td>
                        <td>
                            <small><?php echo e(Str::limit($activity->description, 60)); ?></small>
                        </td>
                        <td>
                            <small><?php echo e($activity->creator->name ?? 'N/A'); ?></small>
                        </td>
                        <td>
                            <?php if($activity->latestUpdate): ?>
                                <span class="badge <?php if($activity->latestUpdate->status === 'done'): ?> badge-done <?php else: ?> badge-pending <?php endif; ?>">
                                    <?php echo e($activity->latestUpdate->status); ?>

                                </span>
                            <?php else: ?>
                                <span class="badge bg-secondary">No updates</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/activities/<?php echo e($activity->id); ?>" class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            No activities found. <a href="/activities/create">Create one now</a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\npunto\resources\views/activities/index.blade.php ENDPATH**/ ?>