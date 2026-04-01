

<?php $__env->startSection('title', 'Welcome to nPunto'); ?>

<?php $__env->startSection('content'); ?>
<div class="welcome-page bg-light min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow border-0">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <i class="fas fa-tasks fa-4x text-primary mb-3"></i>
                            <h1 class="h2 fw-bold text-dark mb-3">nPunto Activity Tracker</h1>
                            <p class="text-muted lead">
                                Efficiently track and manage your team's daily activities
                            </p>
                        </div>

                        <div class="d-grid gap-3 mt-4">
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-lg py-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </a>
                            <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-primary btn-lg py-3">
                                <i class="fas fa-user-plus me-2"></i>Register
                            </a>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <small class="text-muted">
                                Join your team in streamlining support workflows
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\npunto\resources\views/welcome.blade.php ENDPATH**/ ?>