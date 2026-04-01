

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12">
        <h2>Welcome, <?php echo e(auth()->user()->name); ?>!</h2>
        <p class="text-muted"><?php echo e(auth()->user()->department ?? 'Support Team'); ?> - <?php echo e(auth()->user()->role); ?></p>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title text-muted">Total Activities</h6>
                <h2><?php echo e(\App\Models\Activity::count()); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title text-muted">Today's Updates</h6>
                <h2><?php echo e(\App\Models\ActivityUpdate::whereDate('created_at', today())->count()); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title text-muted">Completed Today</h6>
                <h2 class="text-success"><?php echo e(\App\Models\ActivityUpdate::whereDate('created_at', today())->where('status', 'done')->count()); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title text-muted">Pending Today</h6>
                <h2 class="text-warning"><?php echo e(\App\Models\ActivityUpdate::whereDate('created_at', today())->where('status', 'pending')->count()); ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Today's Activities</h5>
            </div>
            <div class="card-body">
                <?php
                    $todayUpdates = \App\Models\ActivityUpdate::with('activity', 'user')
                        ->whereDate('created_at', today())
                        ->orderBy('created_at', 'desc')
                        ->get();
                ?>
                <?php $__empty_1 = true; $__currentLoopData = $todayUpdates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $update): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="mb-2 pb-2 border-bottom">
                        <small>
                            <strong><?php echo e($update->activity->title); ?></strong><br>
                            <?php echo e($update->user->name); ?> - 
                            <span class="badge <?php if($update->status === 'done'): ?> badge-done <?php else: ?> badge-pending <?php endif; ?>">
                                <?php echo e($update->status); ?>

                            </span><br>
                            <span class="text-muted"><?php echo e($update->created_at->format('H:i')); ?></span>
                        </small>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-muted">No activities updated today.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <a href="/daily" class="btn btn-info btn-block mb-2 d-block">View Daily Activities</a>
                <a href="/activities/create" class="btn btn-success btn-block mb-2 d-block">Create New Activity</a>
                <a href="/activities" class="btn btn-primary btn-block mb-2 d-block">Manage Activities</a>
                <a href="/reports" class="btn btn-warning btn-block d-block">View Reports</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Recent Activity Updates</h5>
            </div>
            <div class="card-body">
                <?php
                    $recentUpdates = \App\Models\ActivityUpdate::with('activity', 'user')
                        ->orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get();
                ?>
                <?php $__empty_1 = true; $__currentLoopData = $recentUpdates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $update): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="mb-2 pb-2 border-bottom">
                        <small>
                            <strong><?php echo e($update->activity->title); ?></strong><br>
                            <?php echo e($update->user->name); ?> - 
                            <span class="badge <?php if($update->status === 'done'): ?> badge-done <?php else: ?> badge-pending <?php endif; ?>">
                                <?php echo e($update->status); ?>

                            </span><br>
                            <span class="text-muted"><?php echo e($update->created_at->diffForHumans()); ?></span>
                        </small>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-muted">No activity updates yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\npunto\resources\views/dashboard.blade.php ENDPATH**/ ?>