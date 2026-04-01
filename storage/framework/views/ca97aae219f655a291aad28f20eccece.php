

<?php $__env->startSection('title', 'Welcome'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="card-title mb-4">nPunto Activity Tracker</h1>
                    <p class="card-text text-muted mb-4">
                        Track and manage daily activities for your application support team
                    </p>
                    <div class="d-grid gap-2">
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-lg">Login</a>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-primary btn-lg">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\npunto\resources\views/welcome.blade.php ENDPATH**/ ?>