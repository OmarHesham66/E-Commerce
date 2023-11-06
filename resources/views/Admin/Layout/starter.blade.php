<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Online Store</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  @yield('notifycss')
  @notifyCss
  @livewireStyles
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    {{-- @includeFirst() --}}
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      @include('notify::components.notify')
      @yield('massege-notification')
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li> --}}
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        @livewire('notification-component')
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('get_logout') }}" role="button">
            {{-- <i class="fas fa-th-large"></i> --}}
            Logout
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Online Store</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            @if(Auth::user()->can('viewAny','App\\Models\Category')||Auth::user()->can('viewAny','App\\Models\SuperCategory'))
            <li class="nav-item">
              <a class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Categories
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('viewAny', 'App\\Models\SuperCategory')
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Main-Category</p>
                  </a>
                </li>
                @endcan
                @can('viewAny','App\\Models\Category')
                <li class="nav-item">
                  <a href="{{ route('category.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Category</p>
                  </a>
                </li>
                @endcan
              </ul>
            </li>
            @endif
            @can('viewAny', 'App\\Models\Product')
            <li class="nav-item">
              <a href="{{ route('product.index') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Products
                </p>
              </a>
            </li>
            @endcan
            @can('viewAny','App\\Models\UserOrder')
            <li class="nav-item">
              <a href="{{ route('order.index') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Orders
                </p>
              </a>
            </li>
            @endcan
            @can('viewAny','App\\Models\Payment')
            <li class="nav-item">
              <a href="{{ route('invoice.index') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Invoices
                </p>
              </a>
            </li>
            @endcan
            @can('viewAny','App\\Models\Role')
            <li class="nav-item">
              <a href="{{ route('permission.index') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Roles
                </p>
              </a>
            </li>
            @endcan
            @can('viewAny', 'App\\Models\Coupone')
            <li class="nav-item">
              <a href="{{ route('coupone.index') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Coupones
                </p>
              </a>
            </li>
            @endcan
            @can('viewAny', 'App\\Models\Admin')
            <li class="nav-item">
              <a href="{{ route('admin.index') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Admin
                </p>
              </a>
            </li>
            @endcan
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">@yield('title')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">@yield('page')</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Content Wrapper. Contains page content -->
      @yield('content')
      <!-- /.content-wrapper -->
    </div>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/jquery-3.7.1.js') }}"></script> --}}
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
  <script type="text/javascript" src="http://chir.ag/projects/ntc/ntc.js"></script>
  {{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> --}}
  <script>
    const User_id="{{ Auth::id() }}";
  </script>
  <script src="{{ asset('js/app.js') }}"></script>
  @stack('js')
  @yield('notifyjs')
  @notifyJs
  @livewireScripts
</body>

</html>