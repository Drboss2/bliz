<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('page-title')</title>
  <link href="{{('assets/img/app5.png')}}" rel="icon">

  <link href="{{('assets/img/app5.png')}}" rel="icon">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">

  <link rel="stylesheet" href="{{asset('assets/css/load.css')}}">


  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <p class="animation__shake"  height="60" width="60">Blizexchange</p>
  </div>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Dashboard</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">My account</span>
          <div class="dropdown-divider"></div>
          <a href="/kyc" class="dropdown-item">
            <i class="fas fa-church mr-2"></i>KYC
          </a>
           <div class="dropdown-divider"></div>
          <a href="/settings" class="dropdown-item">
            <i class="fas fa-circle  mr-2"></i>Settings
          </a>
          <div class="dropdown-divider"></div>
          <a href="/logout" class="dropdown-item">
            <i class="fas fa-power-off   mr-2"></i>Logout
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{asset('assets/img/app5.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 bg-light" style="opacity: .8">
      <span class="brand-text font-weight-light" style="font-family:Sofia Pro">Blizexchange</span>
    </a>
    @if(auth()->user()->isadmin == 0)
    <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('dist/img/person.png')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                   <a href="/logout"><span style="color:rgb(157, 230, 157)">logout</span></a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('user.dashboard')}}" class="nav-link @yield('active-mode')">
                                <i class="far fa-circle nav-icon"></i>
                                  <p>Dashboard </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">Rates</li>
                        <li class="nav-item">
                            <a href="{{route('rates')}}" class="nav-link @yield('active-rates')"> 
                                <i class="nav-icon fas fa-sort-numeric-up-alt"></i>
                                <p>
                                    Our Rates
                                </p>
                            </a>
                        </li> 
                    </li>
                    <li class="nav-header">Wallet Area</li>
                        <li class="nav-item">
                            <a href="{{route('wallet')}}" class="nav-link @yield('active-wallet')">
                            <i class="nav-icon fas fa-wallet"></i>
                            <p>
                                My Wallet
                            </p>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="{{route('trans')}}" class="nav-link  @yield('active-trans')">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Transactions
                            </p>
                            </a>
                        </li> 
                    </li>
                    <li class="nav-header">Trades</li>
                        <li class="nav-item">
                            <a href="{{route('giftcard')}}" class="nav-link  @yield('active-gift')">
                            <i class="nav-icon fas fa-gift"></i>
                            <p>Giftcards Assets</p>
                            </a>
                        </li>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('crypto.index')}}" class="nav-link  @yield('active-crypto')">
                        <i class="nav-icon fab fa-bitcoin"></i></i>
                        <p>Crypto Assets</p>
                        </a>
                    </li>
                    <li class="nav-header">User Area</li>
                        <li class="nav-item">
                            <a href="{{route('index')}}" class="nav-link @yield('active-setting')">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Settings</p>
                            </a>
                        </li>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('logout')}}" class="nav-link">
                            <i class="fas fa-power-off nav-icon nav-icon"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    @elseif(auth()->user()->isadmin == 2)
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('dist/img/person.png')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <span><a style="color:lightgreen" href="{{route('logout')}}">logout</a></span>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item menu-open">
                        <ul class="nav nav-treeview">
                            <li class="nav-item user-panel">
                                <a href="/admin" class="nav-link @yield('active-mode')">
                                <i class="far fa-circle nav-icon"></i>
                                   <p>Dashboard </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header user-panel mb-2">Transaction Area
                        <li class="nav-item" >
                            <a href="{{route('admin.trade')}}" class="nav-link @yield('active-admin_trade')">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>
                                  Trade Request
                                </p>
                            </a>
                        </li> 
                         <li class="nav-item">
                            <a href="/admin/trade/failed" class="nav-link @yield('rejected-admin_trade')">
                                <i class="nav-icon fas fa-trash"></i>
                                <p>
                                  Rejected Trade
                                </p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="/admin/trade/paid" class="nav-link @yield('paid-admin_trade')">
                                <i class="nav-icon far fa-thumbs-up"></i>
                                <p>
                                  Paid Trade
                                </p>
                            </a>
                        </li>
                    </li>
                    <li class="nav-header user-panel mb-2">Withdrawal Area</li>
                        <li class="nav-item">
                            <a href="/admin/withdraw" class="nav-link @yield('with-admin_trade')">
                                <i class="nav-icon fab fa-slack-hash"></i>
                                <p>
                                  Withdrawal Request
                                </p>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="/admin/withdraw/paid" class="nav-link  @yield('with-admin_trade_paid')">
                            <i class="nav-icon fas fa-fill"></i>
                               <p>Paid Withdrawal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/withdraw/fail" class="nav-link  @yield('with-admin_trade_fails')">
                            <i class="nav-icon fas fa-brush"></i>
                               <p>Declined Withdrawal</p>
                            </a>
                        </li>
                    </li>
                    <li class="nav-header user-panel mb-2">Admin Area</li>
                         <li class="nav-item">
                            <a href="/admin/add" class="nav-link  @yield('active-admin_admin')">
                            <i class="nav-icon fas fa-gift"></i>
                            <p> Manage Admin</p>
                            </a>
                        </li>
                    </li>
                    <li class="nav-header user-panel mb-2">Trades Area</li>
                         <li class="nav-item">
                            <a href="/admin/gift" class="nav-link  @yield('active-admin_gift')">
                            <i class="nav-icon fas fa-gift"></i>
                            <p> Add Giftcards Assets</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/crypto" class="nav-link  @yield('active-admin_crypto')">
                            <i class="nav-icon fab fa-bitcoin"></i></i>
                              <p> Add Crypto Assets</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="/admin/bank" class="nav-link  @yield('active-admin_bank')">
                            <i class="nav-icon fas fa-university"></i>
                              <p> Add Bank</p>
                            </a>
                        </li>
                        <li class="nav-header user-panel">User Area</li>
                          <li class="nav-item">
                                <a href="/admin/user" class="nav-link @yield('active-admin_users')">
                                <i class="fas fa-user nav-icon"></i>
                                <p>All Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/pin" class="nav-link @yield('active-admin_pin')">
                                <i class="fas fa-lock nav-icon"></i>
                                <p>Change Pin</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('index')}}" class="nav-link @yield('active-setting')">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('logout')}}" class="nav-link">
                                    <i class="fas fa-power-off nav-icon nav-icon"></i>
                                    <p>Logout</p>
                                </a>
                            </li>
                        </li>
                    </li>
                </ul>
            </nav>
        </div>
    @else
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('dist/img/person.png')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <span><a style="color:lightgreen" href="{{route('logout')}}">logout</a></span>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item menu-open">
                        <ul class="nav nav-treeview">
                            <li class="nav-item user-panel">
                                <a href="/admin" class="nav-link @yield('active-mode')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header user-panel mb-2">Transaction Area
                        <li class="nav-item" >
                            <a href="{{route('admin.trade')}}" class="nav-link @yield('active-admin_trade')">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>
                                Trade Request
                                </p>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="/admin/trade/failed" class="nav-link @yield('rejected-admin_trade')">
                                <i class="nav-icon fas fa-trash"></i>
                                <p>
                                Rejected Trade
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/trade/paid" class="nav-link @yield('paid-admin_trade')">
                                <i class="nav-icon far fa-thumbs-up"></i>
                                <p>
                                Paid Trade
                                </p>
                            </a>
                        </li>
                    </li>
                    <li class="nav-header user-panel mb-2">Withdrawal Area</li>
                        <li class="nav-item">
                            <a href="/admin/withdraw" class="nav-link @yield('with-admin_trade')">
                                <i class="nav-icon fab fa-slack-hash"></i>
                                <p>
                                Withdrawal Request
                                </p>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="/admin/withdraw/paid" class="nav-link  @yield('with-admin_trade_paid')">
                            <i class="nav-icon fas fa-fill"></i>
                            <p>Paid Withdrawal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/withdraw/fail" class="nav-link  @yield('with-admin_trade_fails')">
                            <i class="nav-icon fas fa-brush"></i>
                            <p>Declined Withdrawal</p>
                            </a>
                        </li>
                    </li>
                    <li class="nav-header user-panel mb-2">Trades Area</li>
                        <!-- <li class="nav-item">
                            <a href="/admin/gift" class="nav-link  @yield('active-admin_gift')">
                            <i class="nav-icon fas fa-gift"></i>
                            <p> Add Giftcards Assets</p>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a href="/admin/crypto" class="nav-link  @yield('active-admin_crypto')">
                            <i class="nav-icon fab fa-bitcoin"></i></i>
                            <p> Add Crypto Assets</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="/admin/bank" class="nav-link  @yield('active-admin_bank')">
                            <i class="nav-icon fas fa-university"></i>
                            <p> Add Bank</p>
                            </a>
                        </li>
                        <li class="nav-header user-panel">User Area</li>
                           <!-- <li class="nav-item">
                                <a href="/admin/user" class="nav-link @yield('active-admin_users')">
                                <i class="fas fa-user nav-icon"></i>
                                <p>All Users</p>
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a href="/admin/pin" class="nav-link @yield('active-admin_pin')">
                                <i class="fas fa-lock nav-icon"></i>
                                <p>Change Pin</p>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="{{route('index')}}" class="nav-link @yield('active-setting')">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Settings</p>
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a href="{{route('logout')}}" class="nav-link">
                                    <i class="fas fa-power-off nav-icon nav-icon"></i>
                                    <p>Logout</p>
                                </a>
                            </li>
                        </li>
                    </li>
                </ul>
            </nav>
        </div>
    @endif
            <!-- /.sidebar -->
        </aside>
        @yield('content')

        <footer class="main-footer">
            <small>Copyright &copy; 2021 <a href="/">Blizexchange</a>. All rights reserved.</small>
        
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        </div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>

</body>
</html>
