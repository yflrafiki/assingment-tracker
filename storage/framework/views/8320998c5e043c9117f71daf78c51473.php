

<?php $__env->startSection('title', 'Activity Handover'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-8">
        <h2>Activity Handover</h2>
        <p class="text-muted">Date: <strong><?php echo e($selectedDate->format('F d, Y')); ?></strong></p>
        <p class="text-muted small">Pending items that need to be handed over for the next shift</p>
    </div>
    <div class="col-md-4 text-end">
        <a href="/daily?date=<?php echo e($date); ?>" class="btn btn-secondary">← Back to Daily View</a>
    </div>
</div>

<div class="alert alert-warning">
    <i class="bi bi-exclamation-triangle"></i>
    <strong>Pending Activities:</strong> These activities are still pending and need to be completed by the next shift. 
    Please review and hand over appropriately.
</div>

<?php if($pendingActivities->count() > 0): ?>
    <div class="row">
        <?php $__currentLoopData = $pendingActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 mb-3">
                <div class="card border-warning">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="mb-0"><?php echo e($activity->title); ?></h6>
                    </div>
                    <div class="card-body">
                        <p><small><?php echo e($activity->description); ?></small></p>
                        
                        <hr>

                        <div class="mb-2">
                            <small><strong>Last Update:</strong></small>
                            <?php if($activity->updates->first()): ?>
                                <div class="alert alert-light mb-0 py-2 px-2">
                                    <div class="mb-1">
                                        <strong><?php echo e($activity->updates->first()->user->name); ?></strong>
                                        <span class="badge badge-pending"><?php echo e($activity->updates->first()->status); ?></span>
                                    </div>
                                    <div class="mb-1">
                                        <small class="text-muted"><?php echo e($activity->updates->first()->created_at->format('H:i:s')); ?></small>
                                    </div>
                                    <?php if($activity->updates->first()->remark): ?>
                                        <div>
                                            <small><strong>Remark:</strong><br><?php echo e($activity->updates->first()->remark); ?></small>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <div class="alert alert-success text-center py-4">
        <h5>✓ All activities completed!</h5>
        <p class="mb-0">No pending activities for handover on <?php echo e($selectedDate->format('F d, Y')); ?></p>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\npunto\resources\views/daily/handover.blade.php ENDPATH**/ ?>