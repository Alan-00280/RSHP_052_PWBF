<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>RSHP - @yield('title')</title>

  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
  <!-- endinject -->

  <!-- Plugin css for this page -->
  <!-- <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css"> -->
  {{-- <link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css"> --}}
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
  <!-- End plugin css for this page -->

  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <!-- endinject -->
  <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/6/65/Logo-Branding-UNAIR-biru.png" type="image/png">

  {{-- Vite additional --}}
  @yield('vite-additional')

  <!-- For Hot Reload -->
  @vite(['resources/css/app2.css'])

  {{-- Custom CSS --}}
  @yield('style')
  
</head>

<body>
  <div class="container-scroller">
    
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo me-5" href="{{ route('home') }}"><img src="{{ asset('images/UNIVERSITAS-AIRLANGGA-scaled.webp') }}" class="me-2"
            alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}"><img src="https://upload.wikimedia.org/wikipedia/commons/6/65/Logo-Branding-UNAIR-biru.png"
            alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now (not available yet)"
                aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
              data-bs-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
              aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">App notification goes here</h6>
                  <p class="font-weight-light small-text mb-0 text-muted"> Just now </p>
                </div>
              </a>
              {{-- <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted"> Private message </p>
                </div>
              </a> --}}
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="{{ asset('images/user/9e1b64a3a8797626e6a80b589c946e96.jpg') }}" alt="profile" />
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i> Settings </a>
              <a class="dropdown-item" href="{{ route('logout') }}">
                <i class="ti-power-off text-primary"></i> Logout </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->

    <div class="container-fluid page-body-wrapper">

      {{-- Side Bar --}}
      @php
        $role_id = Session::get('role_id')
      @endphp
      @switch($role_id)
          @case('1')
              <x-layout.navigations.adminnav />
              @break
          @case('2')
              <x-layout.navigations.dokternav />
              @break
          @case('3')
              <x-layout.navigations.perawatnav />
              @break
          @case('4')
              <x-layout.navigations.resepsionisnav />
              @break
          @case('5')
              {{-- @include('pages.dashboard.pemilik') --}}
              @break
          @default
              <h1>401 - Unauthorized</h1>
      @endswitch

      {{-- <x-layout.navbar/> --}}

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          {{-- Alert Message --}}
          <x-successAlert :message="session('success')" />

          @if(session('error'))
              <x-error-alert :errors="session('error')" type="global" />
          @endif

          <x-error-alert :errors="$errors" />


          @yield('content')
        </div>
      <!-- content-wrapper ends -->

      <!-- partial:partials/_footer.html -->
      <x-layout.footer />
      <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    
    {{-- Modal go is nto here --}}
    @yield('modal')
    <!-- page-body-wrapper ends -->
  </div>
  <!-- end-container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->

  <!-- Plugin js for this page -->
  {{-- <script src="assets/vendors/chart.js/chart.umd.js"></script> --}}
  {{-- <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script> --}}
  <!-- <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script> -->
  {{-- <script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script> --}}
  {{-- <script src="assets/js/dataTables.select.min.js"></script> --}}
  <!-- End plugin js for this page -->

  <!-- inject:js -->
  <script src="{{asset('assets/js/off-canvas.js')}}"></script>
  <script src="{{asset('assets/js/template.js')}}"></script>
  {{-- <script src="assets/js/settings.js"></script> --}}
  {{-- <script src="assets/js/todolist.js"></script> --}}
  <!-- endinject -->
  
  <!-- Custom js for this page-->
  @yield('page-script')
  {{-- <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="assets/js/dashboard.js"></script> --}}
  <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
  <!-- End custom js for this page-->

</body>

</html>