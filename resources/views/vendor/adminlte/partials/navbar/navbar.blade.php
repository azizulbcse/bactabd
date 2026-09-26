@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

<style>
    .bacta-node-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%);
        color: #fff; font-size: 11px; font-weight: 700; letter-spacing: 0.3px;
        padding: 6px 12px; border-radius: 6px; margin-left: 10px;
    }
    .bacta-datetime {
        display: flex; align-items: center; gap: 14px; font-size: 12px; font-weight: 600; color: #475569;
    }
    .bacta-datetime span { display: inline-flex; align-items: center; gap: 5px; }
    .bacta-datetime i { color: #0284C7; }
    .bacta-secure-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: #DC2626; color: #fff; font-size: 11px; font-weight: 700;
        letter-spacing: 0.3px; padding: 6px 12px; border-radius: 20px;
    }
    .bacta-secure-dot {
        width: 7px; height: 7px; border-radius: 50%; background: #ffffff;
        animation: bactaSecurePulse 1.4s ease-in-out infinite;
    }
    @keyframes bactaSecurePulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(1.3); }
    }
    @media (max-width: 991px) {
        .bacta-node-badge, .bacta-datetime { display: none !important; }
    }
</style>

<nav class="main-header navbar
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    {{-- Navbar left links --}}
    <ul class="navbar-nav align-items-center">
        {{-- Left sidebar toggler link --}}
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

        {{-- BACTA organization node badge --}}
        <li class="nav-item">
            <span class="bacta-node-badge">
                <i class="fas fa-building-columns"></i> BACTA CENTRAL NODE
            </span>
        </li>

        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

        {{-- Custom left links --}}
        @yield('content_top_nav_left')
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto align-items-center">

        {{-- Live date & time --}}
        <li class="nav-item d-none d-lg-flex align-items-center mr-3">
            <span class="bacta-datetime">
                <span><i class="far fa-calendar-alt"></i> <span id="bactaNavDate"></span></span>
                <span><i class="far fa-clock"></i> <span id="bactaNavTime"></span></span>
            </span>
        </li>

        {{-- Secure online status --}}
        <li class="nav-item d-none d-md-flex align-items-center mr-3">
            <span class="bacta-secure-badge">
                <span class="bacta-secure-dot"></span> SECURE ONLINE
            </span>
        </li>

        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        {{-- Configured right links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

        {{-- User menu link --}}
        @if(Auth::user())
            @if(config('adminlte.usermenu_enabled'))
                @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
            @else
                @include('adminlte::partials.navbar.menu-item-logout-link')
            @endif
        @endif

        {{-- Right sidebar toggler link --}}
        @if($layoutHelper->isRightSidebarEnabled())
            @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>

</nav>

<script>
    (function () {
        function bactaUpdateClock() {
            var now = new Date();
            var dateEl = document.getElementById('bactaNavDate');
            var timeEl = document.getElementById('bactaNavTime');
            if (dateEl) {
                dateEl.textContent = now.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
            }
            if (timeEl) {
                timeEl.textContent = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
            }
        }
        bactaUpdateClock();
        setInterval(bactaUpdateClock, 1000);
    })();
</script>
