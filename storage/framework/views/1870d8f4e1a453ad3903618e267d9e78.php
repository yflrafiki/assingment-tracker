

<?php $__env->startSection('title', $activity->title); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-8">
        <h2><?php echo e($activity->title); ?></h2>
    </div>
    <div class="col-md-4 text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateActivityModal">
            + Update Activity Status
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Activity Description</h5>
            </div>
            <div class="card-body">
                <p><?php echo e($activity->description); ?></p>
                <hr>
                <small class="text-muted">
                    Created by: <strong><?php echo e($activity->creator->name); ?></strong><br>
                    Created on: <strong><?php echo e($activity->created_at->format('M d, Y H:i A')); ?></strong>
                </small>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Update History</h5>
            </div>
            <?php $__empty_1 = true; $__currentLoopData = $updates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $update): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between mb-2">
                            <h6 class="mb-1">
                                <strong><?php echo e($update->user->name); ?></strong>
                                <span class="badge <?php if($update->status === 'done'): ?> badge-done <?php else: ?> badge-pending <?php endif; ?>">
                                    <?php echo e($update->status); ?>

                                </span>
                            </h6>
                            <small class="text-muted"><?php echo e($update->created_at->format('M d, Y H:i A')); ?></small>
                        </div>
                        <?php if($update->remark): ?>
                            <p class="mb-0">
                                <small><strong>Remark:</strong> <?php echo e($update->remark); ?></small>
                            </p>
                        <?php else: ?>
                            <small class="text-muted">No remark provided</small>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="card-body text-center text-muted py-4">
                    No updates yet. Start by updating the activity status above.
                </div>
            <?php endif; ?>
        </div>

        <?php echo e($updates->links()); ?>

    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Stats</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Total Updates</small>
                    <h4><?php echo e($activity->updates->count()); ?></h4>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Completed</small>
                    <h4 class="text-success"><?php echo e($activity->updates()->where('status', 'done')->count()); ?></h4>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Pending</small>
                    <h4 class="text-warning"><?php echo e($activity->updates()->where('status', 'pending')->count()); ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateActivityModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Activity Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/activities/<?php echo e($activity->id); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="">Select Status</option>
                            <option value="pending">Pending</option>
                            <option value="done">Done</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="remark" class="form-label">Remark (Optional)</label>
                        <textarea name="remark" id="remark" rows="4" class="form-control" 
                                  placeholder="Add any comments or notes about this update"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\npunto\resources\views/activities/show.blade.php ENDPATH**/ ?>