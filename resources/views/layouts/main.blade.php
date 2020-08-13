<!DOCTYPE html>
<html lang="en" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Convex admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Convex admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title')| APLIKASI TRAVEL</title>
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('app-assets/img/ico/apple-icon-60.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('app-assets/img/ico/apple-icon-76.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('app-assets/img/ico/apple-icon-120.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('app-assets/img/ico/apple-icon-152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/img/ico/favicon.ico')}}">
    <link rel="shortcut icon" type="image/png" href="{{asset('app-assets/img/ico/favicon-32.png')}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/perfect-scrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/prism.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/chartist.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/app.css')}}">
  </head>
  <body data-col="2-columns" class=" 2-columns ">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">
      <div data-active-color="white" data-background-color="crystal-clear" data-image="{{asset('app-assets/img/sidebar-bg/08.jpg')}}" class="app-sidebar">
        <div class="sidebar-header">
          <div class="logo clearfix"><a href="index.html" class="logo-text float-left">
              <div class="logo-img"><img src="{{asset('app-assets/img/logo.png')}}" alt="Convex Logo"/></div><span class="text align-middle">DTRAVEL</span></a><a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block"><i data-toggle="expanded" class="ft-disc toggle-icon"></i></a><a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i class="ft-circle"></i></a></div>
        </div>
        <div class="sidebar-content">
          <div class="nav-container">
            <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
              <li class="nav-item {{ ($request->is('dashboard')||$request->is('dashboard/*')?'open':'') }}"><a href="{{ url('dashboard') }}"><i class="icon-home"></i><span data-i18n="" class="menu-title">Dashboard</span></a></li>
              <li class="nav-item {{ ($request->is('transaksi')||$request->is('transaksi/*')?'open':'') }}"><a href="{{url('transaksi')}}"><i class="ft-shopping-cart"></i><span data-i18n="" class="menu-title">Transaksi</span></a></li>
              <li class="nav-item {{ ($request->is('jadwal')||$request->is('jadwal/*')?'open':'') }}"><a href="{{url('jadwal')}}"><i class="icon-calendar"></i><span data-i18n="" class="menu-title">Jadwal</span></a></li>
              <li class="nav-item {{ ($request->is('rute')||$request->is('rute/*')?'open':'') }}"><a href="{{url('rute')}}"><i class="ft-navigation"></i><span data-i18n="" class="menu-title">Rute</span></a></li>
              <li class="nav-item {{ ($request->is('kendaraan')||$request->is('kendaraan/*')?'open':'') }}"><a href="{{url('kendaraan')}}"><i class="fa fa-car"></i><span data-i18n="" class="menu-title">Kendaraan</span></a></li>
              <li class="nav-item {{ ($request->is('karyawan')||$request->is('karyawan/*')?'open':'') }}"><a href="{{url('karyawan')}}"><i class="icon-users"></i><span data-i18n="" class="menu-title">Karyawan</span></a></li>
            </ul>
          </div>
        </div>
        <div class="sidebar-background"></div>
      </div>

      <nav class="navbar navbar-expand-lg navbar-light bg-faded">
        <div class="container-fluid">
          <div class="navbar-header">
            
          </div>
          <div class="navbar-container">
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
              <ul class="navbar-nav">
                <li class="dropdown nav-item mr-0"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-user-link dropdown-toggle"><span class="avatar avatar-online"><img id="navbar-avatar" src="{{ url('app-assets/img/portrait/small/avatar-s-3.jpg') }}" alt="avatar"/></span>
                    <p class="d-none">User Settings</p></a>
                  <div aria-labelledby="dropdownBasic3" class="dropdown-menu dropdown-menu-right">
                    <div class="arrow_box_right">
                        {{-- <a href="user-profile-page.html" class="dropdown-item py-1"><i class="ft-edit mr-2"></i><span>My Profile</span></a> --}}
                      {{-- <div class="dropdown-divider"></div> --}}
                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a href="javascript:void(0);" onclick="parentNode.submit();" class="dropdown-item"><i class="ft-power mr-2"></i><span>Logout</span></a>
                        {{-- <button type="submit" class="dropdown-item"><i class="ft-power mr-2"></i><span>Logout</span></button> --}}
                      </form>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>
          </div>
        </div>

        <footer class="footer footer-static footer-light">
          <p class="clearfix text-muted text-center px-2"><span>Copyright  &copy; 2020 Travel Webapp, All rights reserved. </span></p>
        </footer>

      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="{{asset('app-assets/vendors/js/core/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/core/popper.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/prism.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/jquery.matchHeight-min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/screenfull.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/pace/pace.min.js')}}"></script>
    <!-- BEGIN VENDOR JS-->
    @yield('scriptpage')
    <!-- BEGIN CONVEX JS-->
    <script src="{{asset('app-assets/js/app-sidebar.js')}}"></script>
    <script src="{{asset('app-assets/js/notification-sidebar.js')}}"></script>
    <!-- END CONVEX JS-->
    <!-- CUSTOM SCRIPT -->
    @yield('script')
  </body>
</html>