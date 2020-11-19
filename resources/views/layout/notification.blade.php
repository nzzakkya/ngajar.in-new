<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        @if (auth()->user()->unreadNotifications->count() > 0)
        <span class="badge badge-danger badge-counter">{{auth()->user()->unreadNotifications->count()}}</span>
        @endif
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Notification
        </h6>
        @forelse(auth()->user()->unreadNotifications->groupBy('data') as $notifications)
        @foreach($notifications->unique('data') as $notification)
        @if($notification->type == 'App\Notifications\newMessage')
        <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard.chat') }}">
            <div class="mr-3">
                <div class="icon-circle bg-primary">
                    <i class="fas fa-envelope text-white"></i>
                </div>
            </div>
            <div>
                <div class="small text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
                <span class="font-weight-bold">Ada {{auth()->user()->unreadNotifications->where('data', $notification->data)->count('id')}} pesan baru dari {{ $notification->data['from']}}</span>
            </div>
        </a>
        
        @endif
        @endforeach
        @empty
        <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
                <div class="icon-circle bg-primary">
                    <i class="fas fa-cog text-white"></i>
                </div>
            </div>
            <div>
                <div class="small text-gray-500">...</div>
                <span class="font-weight-bold">Tidak ada notifikasi baru</span>
            </div>
        </a>
        @endforelse
        <a class="dropdown-item text-center small text-gray-500" href="{{ route('dashboard.mark-as-read-all') }}">Mark all as read</a>
    </div>
</li>