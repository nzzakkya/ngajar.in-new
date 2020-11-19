<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Ngajar.in</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        @auth
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span></a>
        @endauth
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Menu</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">All Menu:</h6>
                @auth
                @if(Auth::user()->role == 'client')
                <a class="collapse-item" href="{{ route('dashboard.mentor-list') }}">Mentor List</a>
                <a class="collapse-item" href="{{ route('dashboard.order-request', ['user' => auth()->user()]) }}">Order Request</a>
                <a class="collapse-item" href="{{ route('dashboard.chat') }}">Chat</a>
                @endif
                @if(Auth::user()->role == 'mentor')
                <a class="collapse-item" href="{{ route('dashboard.schedule') }}">Schedule</a>
                <a class="collapse-item" href="{{ route('dashboard.skill') }}">Skill</a>
                <a class="collapse-item" href="{{ route('dashboard.mentor-order-request', ['user' => auth()->user()]) }}">Order Request</a>
                <a class="collapse-item" href="{{ route('dashboard.chat') }}">Chat</a>
                <a class="collapse-item" href="{{ route('dashboard.user-payment') }}">User payment</a>
                @endif
                @if(Auth::user()->role == 'admin')
                <a class="collapse-item" href="{{ route('dashboard.user-unverified') }}">User Unverified</a>
                <a class="collapse-item" href="{{ route('dashboard.user-verified') }}">User Verified</a>
                <a class="collapse-item" href="{{ route('dashboard.user-skill') }}">User Skill</a>
                <a class="collapse-item" href="{{ route('dashboard.chat') }}">Chat</a>
                <a class="collapse-item" href="{{ route('dashboard.payment-request') }}">Payment Request</a>
                @endif
                @endauth
                @guest
                <a class="collapse-item" href="{{ route('login') }}">Login</a>
                <a class="collapse-item" href="{{ route('register') }}">Register</a>
                <a class="collapse-item" href="{{ route('our-profile') }}">Our Profile</a>
                <a class="collapse-item" href="{{ route('our-contact') }}">Our Contact</a>
                @endguest
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->