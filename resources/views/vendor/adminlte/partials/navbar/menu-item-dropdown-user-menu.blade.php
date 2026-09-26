@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
@php( $profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout') )

@if (config('adminlte.usermenu_profile_url', false))
    @php( $profile_url = Auth::user()->adminlte_profile_url() )
@endif

@if (config('adminlte.use_route_url', false))
    @php( $profile_url = $profile_url ? route($profile_url) : '' )
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
@else
    @php( $profile_url = $profile_url ? url($profile_url) : '' )
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
@endif

<style>
    .bacta-usermenu.dropdown-menu {
        padding: 0; border: none; border-radius: 10px; overflow: hidden;
        box-shadow: 0 20px 45px -10px rgba(15, 23, 42, 0.35); min-width: 250px;
    }
    .bacta-usermenu-header {
        background: #0F172A; padding: 22px 20px 18px; text-align: center;
    }
    .bacta-usermenu-avatar {
        width: 82px; height: 82px; border-radius: 50%; object-fit: cover;
        border: 3px solid rgba(255,255,255,0.85); box-shadow: 0 4px 14px rgba(0,0,0,0.3);
    }
    .bacta-usermenu-name { color: #fff; font-weight: 700; font-size: 15px; margin-top: 12px; }
    .bacta-usermenu-desc { color: #93C5FD; font-size: 11.5px; font-weight: 600; margin-top: 2px; }
    .bacta-usermenu-footer { display: flex; gap: 8px; padding: 12px; background: #fff; }
    .bacta-usermenu-footer a {
        flex: 1; display: inline-flex; align-items: center; justify-content: center; gap: 6px;
        font-size: 12.5px; font-weight: 700; padding: 8px 10px; border-radius: 6px;
        border: 1px solid #E2E8F0; text-decoration: none; transition: all 0.15s ease;
    }
    .bacta-usermenu-footer a.bacta-profile-btn { color: #0284C7; }
    .bacta-usermenu-footer a.bacta-profile-btn:hover { background: #EFF6FF; }
    .bacta-usermenu-footer a.bacta-logout-btn { color: #DC2626; }
    .bacta-usermenu-footer a.bacta-logout-btn:hover { background: #FEF2F2; }
</style>

<li class="nav-item dropdown user-menu">

    {{-- User menu toggler --}}
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        @if(config('adminlte.usermenu_image'))
            <img src="{{ Auth::user()->adminlte_image() }}"
                 class="user-image img-circle elevation-2"
                 alt="{{ Auth::user()->name }}">
        @endif
        <span @if(config('adminlte.usermenu_image')) class="d-none d-md-inline" @endif>
            {{ Auth::user()->name }}
        </span>
    </a>

    {{-- User menu dropdown --}}
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right bacta-usermenu">

        <li class="bacta-usermenu-header">
            <img src="{{ Auth::user()->adminlte_image() }}" class="bacta-usermenu-avatar" alt="{{ Auth::user()->name }}">
            <div class="bacta-usermenu-name">{{ Auth::user()->name }}</div>
            @if(config('adminlte.usermenu_desc'))
                <div class="bacta-usermenu-desc">{{ Auth::user()->adminlte_desc() }}</div>
            @endif
        </li>

        {{-- Configured user menu links --}}
        @each('adminlte::partials.navbar.dropdown-item', $adminlte->menu("navbar-user"), 'item')

        {{-- User menu body --}}
        @hasSection('usermenu_body')
            <li class="user-body">
                @yield('usermenu_body')
            </li>
        @endif

        {{-- User menu footer --}}
        <li class="bacta-usermenu-footer">
            @if($profile_url)
                <a href="{{ $profile_url }}" class="bacta-profile-btn">
                    <i class="fas fa-user"></i> Profile
                </a>
            @endif
            <a href="#" class="bacta-logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-power-off"></i> Log Out
            </a>
            <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                @if(config('adminlte.logout_method'))
                    {{ method_field(config('adminlte.logout_method')) }}
                @endif
                {{ csrf_field() }}
            </form>
        </li>

    </ul>

</li>
