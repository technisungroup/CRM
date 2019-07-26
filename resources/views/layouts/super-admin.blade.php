<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{ config('app.name', 'APG CRM') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link href="{{ asset('theme/css/datatables.bundle.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/css/vendors.bundle.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/css/style.bundle.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('theme/css/style.css') }}" rel="stylesheet" type="text/css"/>
</head>

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed" data-gr-c-s-loaded="true">
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="">
            <img alt="Logo" src="{{ asset('theme/images/logo-admin2.png') }}" class="apg crm">
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
    </div>
</div>
<!-- end:: Header Mobile -->
<!--header-->
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside" style="opacity: 1;">
    <div class="kt-aside__brand kt-grid__item  " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="">
                <img alt="Logo" src="{{ asset('theme/images/logo-admin.png') }}" class="img-fluid">
            </a>
        </div>
    </div>
    <!-- end:: Aside -->
    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item {{ (!empty($modulesLink)  && $modulesLink == true) ? 'active-menu' : '' }}" aria-haspopup="true">
                    <a href="{{ route('modules.index') }}" class="kt-menu__link "><span class="kt-menu__link-text ">Modules</span></a>
                </li>
                <li class="kt-menu__item {{ (!empty($roleTypeLink)  && $roleTypeLink == true) ? 'active-menu' : '' }}" aria-haspopup="true">
                    <a href="{{ route('user-role.index') }}" class="kt-menu__link ">
                        <span class="kt-menu__link-text">Role Type</span>
                    </a>
                </li>
                <li class="kt-menu__item {{ (!empty($locationLink)  && $locationLink == true) ? 'active-menu' : '' }}" aria-haspopup="true">
                    <a href="{{ route('locations.index') }}" class="kt-menu__link">
                        <span class="kt-menu__link-text">Locations</span>
                    </a>
                </li>
                <li class="kt-menu__item {{ (!empty($usersLink)  && $usersLink == true) ? 'active-menu' : '' }}" aria-haspopup="true">
                    <a href="{{ route('users.index') }}" class="kt-menu__link "><span class="kt-menu__link-text">Users</span></a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="" class="kt-menu__link "><span class="kt-menu__link-text">Extra menu</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- end:: Aside Menu -->
</div>
<!-- begin:: Header -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
    <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper" style="opacity: 1;">
            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-tab ">
                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item " aria-haspopup="true">
                        <a href="" class="kt-menu__link "><span class="kt-menu__link-text">Dashboard</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end: Header Menu -->
        <!-- begin:: Header Topbar -->
        <div class="kt-header__topbar">
            <!--begin: User Bar -->
            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                    <div class="kt-header__topbar-user">
                        {{--<span class="kt-hidden kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                        <span class="kt-hidden kt-header__topbar-username kt-hidden-mobile">Sean</span>
                        <img class="kt-hidden" alt="Pic" src="./Metronic _ Scrollable Examples_files/300_25.jpg">--}}
                        <a href="javascript:void(0)" class="btn btn-label btn-label-success btn-sm btn-bold">{{ Auth::user()->name }}</a>
                    </div>
                </div>
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
                    <div class="kt-notification">
                        <a href="" class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    My Profile
                                </div>
                            </div>
                        </a>
                        <a href="" class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    Settings
                                </div>
                            </div>
                        </a>
                        <div class="kt-notification__custom kt-space-between">
                            <a href="{{ route('logout') }}" target="_blank" class="btn btn-label btn-label-brand btn-sm btn-bold"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <!--end: Navigation -->
                </div>
            </div>
            <!--end: User Bar -->
        </div>
    </div>
    <!-- end:: Header -->
    @yield('contents')
    <!-- begin:: Footer -->
    <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-footer__copyright">
                2019&nbsp;©&nbsp;
                <a href="" target="_blank" class="kt-link">Technisun</a>
            </div>
            <div class="kt-footer__menu">
            </div>
        </div>
    </div>
    <!-- end:: Footer -->
</div>
<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {"colors":{"state":{"brand":"#2c77f4","light":"#ffffff","dark":"#282a3c","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
</script>
<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('theme/Metronic _ Scrollable Examples_files/vendors.bundle.js.download') }}" type="text/javascript"></script>
<script src="{{ asset('theme/Metronic _ Scrollable Examples_files/scripts.bundle.js.download') }}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->
<!--begin::Page Vendors(used by this page) -->
<script src="{{ asset('Metronic _ Scrollable Examples_files/datatables.bundle.js.download') }}" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('theme/js/ajax-client-side.js.download') }}" type="text/javascript"></script>
<!--end::Page Scripts -->
@yield('scripts')
</body>
</html>