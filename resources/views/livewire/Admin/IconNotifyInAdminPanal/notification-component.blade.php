<li class="nav-item dropdown">
    @include('notify::components.notify')
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">{{ $admin->unreadNotifications->count() }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">{{ $admin->notifications->count()}} Notifications</span>
        <div class="dropdown-divider"></div>
        @forelse ($admin->notifications as $notify)
        <a href="{{ route('order.show',Order::get_order($notify->data['order_number'])) }}" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> The Order #{{ $notify->data['order_number'] }} Is Sold By
            {{ User::find($notify->data['user_id'])->name}}
            <span class="float-right text-muted text-sm">{{ $notify->created_at }}</span>
        </a>
        <div class="dropdown-divider"></div>
        @empty
        <div style="text-align: center;padding:15px">
            No Notifications !!
        </div>
        @endforelse
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>