<a href="/dashboard" class="@if(request()->is('dashboard')) active @endif">Dashboard</a>
<a href="/daily" class="@if(request()->is('daily*')) active @endif">Daily View</a>
<a href="/activities" class="@if(request()->is('activities*')) active @endif">Activities</a>
<a href="/reports" class="@if(request()->is('reports*')) active @endif">Reports</a>
