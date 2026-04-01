<a href="/dashboard" class="<?php if(request()->is('dashboard')): ?> active <?php endif; ?>">Dashboard</a>
<a href="/daily" class="<?php if(request()->is('daily*')): ?> active <?php endif; ?>">Daily View</a>
<a href="/activities" class="<?php if(request()->is('activities*')): ?> active <?php endif; ?>">Activities</a>
<a href="/reports" class="<?php if(request()->is('reports*')): ?> active <?php endif; ?>">Reports</a>
<?php /**PATH C:\laragon\www\npunto\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>