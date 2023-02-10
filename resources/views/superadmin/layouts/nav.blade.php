<div class="container-fluid page-body-wrapper">
  <div id="theme-settings" class="settings-panel">
    <i class="settings-close mdi mdi-close"></i>
    <p class="settings-heading">SIDEBAR SKINS</p>
    <div class="sidebar-bg-options selected" id="sidebar-default-theme">
      <div class="img-ss rounded-circle bg-light border mr-3"></div> Default
    </div>
    <div class="sidebar-bg-options" id="sidebar-dark-theme">
      <div class="img-ss rounded-circle bg-dark border mr-3"></div> Dark
    </div>
    <p class="settings-heading mt-2">HEADER SKINS</p>
    <div class="color-tiles mx-0 px-4">
      <div class="tiles light"></div>
      <div class="tiles dark"></div>
    </div>
  </div>
  <nav class="navbar col-lg-12 col-12 p-lg-0 fixed-top d-flex flex-row">
    <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
      <a class="navbar-brand brand-logo-mini align-self-center d-lg-none fw-bold h2" style="color: #6e0000;" href="">Micro-Air</a>
      <!-- <img src="{{ asset('backend/images/micro air logo-1.png')}}" alt="logo" /> -->
      <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
        <i class="mdi mdi-menu" style="color: #fff;"></i>
      </button>
     
      <ul class="navbar-nav navbar-nav-right ml-lg-auto">
      @if( Session::has("error") )
      <div class="alert alert-danger alert-block" role="alert">
        <button class="close" data-dismiss="alert"></button>
        {{ Session::get("error") }}
      </div>
      @endif
        <li class="nav-item nav-profile dropdown border-0">
          @if(Auth::user()->role_id == 0)
          <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown">
            <img class="nav-profile-img mr-2" alt="" src="{{ asset('backend/images/superadmin.png')}}" />
            <span class="profile-name fw-bold h6" style="color: #fff;">Super Admin</span>
          </a>
          @else
          <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown">
            <img class="nav-profile-img mr-2" alt="" src="{{ asset('backend/images/admin.png')}}" />
            <span class="profile-name fw-bold h6" style="color: #fff;">Admin</span>
          </a>
          @endif

          <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="{{route('SA-Profile')}}">
              <i class="mdi mdi-account mr-2 text-success"></i> Profile </a>
            <!-- <a class="dropdown-item" href="#"><i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a> -->
            <form action="{{route('logout')}}" method="POST" style="margin:0;">
              @csrf
              <button type="submit" class="dropdown-item"><i class="mdi mdi-logout mr-2 text-primary"></i> Log Out</button>
            </form>
          </div>
        </li>
      </ul>
   
    </div>
  </nav>