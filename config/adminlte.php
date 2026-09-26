<?php
return [
    'title' => 'BACTA | Admin Panel',
    'title_prefix' => '',
    'title_postfix' => '',
    'use_ico_only' => false,
    'use_full_favicon' => false,
    'google_fonts' => [
        'allowed' => true,
    ],

    'logo' => '<b>BACTA</b> Admin',
    'logo_img' => 'images/logo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    'auth_logo' => [
        'enabled' => true,
        'img' => [
            'path' => 'images/logo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'images/logo.png',
            'alt' => 'BACTA Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => false,

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => true,
    'layout_dark_mode' => null,

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    'classes_body' => '',
    'classes_brand' => 'bg-[#0F172A] border-bottom border-slate-800/60',
    'classes_brand_text' => 'font-weight-bold text-white tracking-tight',
    'classes_content_wrapper' => 'bg-[#F8FAFC]', 
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary bg-[#0F172A] elevation-2 border-right border-slate-800/60',
    'classes_sidebar_nav' => 'nav-flat nav-child-indent', 
    'classes_topnav' => 'navbar-light bg-white border-bottom border-slate-200/80',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => 'profile',
    'disable_darkmode_routes' => false,

    'laravel_asset_bundling' => false,

'menu' => [
    [
        'type'         => 'navbar-search',
        'text'         => 'Search Member...',
        'topnav_right' => true,
    ],
    [
        'type'         => 'fullscreen-widget',
        'topnav_right' => true,
    ],
    [
        'type' => 'sidebar-menu-search',
        'text' => 'Quick Find...',
    ],
    [
        'text' => 'Main Dashboard',
        'route' => 'admin.dashboard',
        'icon' => 'fas fa-fw fa-tachometer-alt',
    ],
    [
        'text' => 'Admin & Staff Directory',
        'route' => 'admin.staff.list',
        'icon' => 'fas fa-fw fa-users-cog',
    ],
    [
        'text'    => 'Master Control Hub',
        'icon'    => 'fas fa-fw fa-cogs',
        'submenu' => [
            [
                'text'  => 'Hospitals Registry',
                'route' => 'admin.hospitals.index',
                'icon'  => 'fas fa-fw fa-hospital',
            ],
            [
                'text'  => 'Medical Designations',
                'route' => 'admin.med_desig.index',
                'icon'  => 'fas fa-fw fa-user-md',
            ],
            [
                'text'  => 'BACTA Designations',
                'route' => 'admin.bacta_desig.index',
                'icon'  => 'fas fa-fw fa-award',
            ],
            [
                'text'  => 'Surgery Type Settings',
                'route' => 'admin.surgery_types.index',
                'icon'  => 'fas fa-fw fa-sliders-h',
            ],
        ],
    ],
    [
        'text'    => 'Governance & Membership',
        'icon'    => 'fas fa-fw fa-shield-alt',
        'submenu' => [
            [
                'text'  => 'Executive Committee',
                'route' => 'admin.members.index',
                'icon'  => 'fas fa-fw fa-users',
            ],
            [
                'text'  => 'Lifetime Fellows',
                'route' => 'admin.members.index',
                'icon'  => 'fas fa-fw fa-award',
            ],
            [
                'text'  => 'Active Members',
                'route' => 'admin.members.index',
                'icon'  => 'fas fa-fw fa-user-md',
            ],
        ],
    ],
        [
        'text'    => 'News & Publications',
        'icon'    => 'fas fa-fw fa-newspaper',
        'submenu' => [
            [
                'text'  => 'Announcements',
                'route' => 'admin.notices.index',
                'icon'  => 'fas fa-fw fa-bullhorn',
            ],
            [
                'text'  => 'Executive Minutes',
                'route' => 'admin.minutes.index',
                'icon'  => 'fas fa-fw fa-history',
            ],
            [
                'text'  => 'Events & Seminars',
                'route' => 'admin.events.index', 
                'icon'  => 'fas fa-fw fa-calendar-check',
            ],
            [
                'text'  => 'Media Gallery Hub',
                'route' => 'admin.gallery.index', 
                'icon'  => 'fas fa-fw fa-images',
            ],
            [
                'text'  => 'Journals (BACTA)',
                'route' => 'admin.journals.index', 
                'icon'  => 'fas fa-fw fa-book-medical',
            ],
            [
                'text'  => 'Secretariat Inbox',
                'route' => 'admin.contacts.index',
                'icon'  => 'fas fa-fw fa-envelope-open-text',
            ],
            [
                'text'  => 'Membership Applications',
                'route' => 'admin.membership_applications.index',
                'icon'  => 'fas fa-fw fa-user-plus',
            ],
            [
                'text'  => 'Homepage Popup',
                'route' => 'admin.popups.index',
                'icon'  => 'fas fa-fw fa-window-restore',
            ],
            [
                'text'  => 'Clinical Guidelines',
                'route' => 'admin.guidelines.index',
                'icon'  => 'fas fa-fw fa-file-medical',
            ],
        ],
    ],
    [
        'text'    => 'National Surgical Hub',
        'icon'    => 'fas fa-fw fa-database text-info',
        'submenu' => [
            [
                'text'  => 'Overall Cardiac Grid',
                'route' => 'admin.surgeries.index',
                'icon'  => 'fas fa-fw fa-chart-line text-cyan',
            ],
            [
                'text'  => 'Congenital Surgery Grid',
                'route' => 'admin.congenital.index',
                'icon'  => 'fas fa-fw fa-baby-carriage text-pink',
            ],
            [
                'text'  => 'Valvular Surgery Grid',
                'route' => 'admin.valvular.index',
                'icon'  => 'fas fa-fw fa-heart-pulse text-danger',
            ],
        ],
    ],

    ['header' => 'ACCOUNT SECURITY'],
    [
        'text'  => 'Change Password',
        'route' => 'profile.edit',
        'icon'  => 'fas fa-fw fa-key',
    ],
    [
        'text'        => 'Sign Out Application',
        'url'         => 'logout',
        'icon'        => 'fas fa-fw fa-sign-out-alt',
        'icon_color'  => 'red',
        'attributes'  => [
            'onclick' => "event.preventDefault(); var f = document.createElement('form'); f.method = 'POST'; f.action = '/logout'; var s = document.createElement('input'); s.type = 'hidden'; s.name = '_token'; s.value = document.querySelector('meta[name=\"csrf-token\"]') ? document.querySelector('meta[name=\"csrf-token\"]').content : ''; f.appendChild(s); document.body.appendChild(f); f.submit();"
        ],
    ],
],

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
