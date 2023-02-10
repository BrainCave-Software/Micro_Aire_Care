<!-- customer css file -->
<link rel="stylesheet" href="{{ asset('inventorybackend/css/style.css')}}" />

<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <!-- <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
    <a class="sidebar-brand brand-logo fw-bold h1"  href="">Micro-Air</a>
    <a class="sidebar-brand brand-logo-mini pl-4 pt-3 fw-bold h2"  href="">YS</a>
  </div> -->
  <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
      <a class="sidebar-brand brand-logo" href="" style="width: 100%;"><img src="{{asset('backend/images/micro air logo-1.png')}}"  alt="logo" /></a>
    <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href=""></a> 
  
    <!-- <h2 style="color:#fff; margin-left:25%;" class="text-center">Micro-Air</h2> -->
  </div>
  
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        @if(Auth::user()->role_id == 0)
        <div class="nav-profile-image">
          <img src="{{ asset('backend/images/superadmin.png')}}" alt="profile" />
          <span class="login-status online"></span>
        </div>
        <div class="nav-profile-text d-flex flex-column pr-3">
          <span class="font-weight-medium mb-2 text-dark fw-bold h5 mx-auto" style="color:#455a64 !important;">Super Admin</span>
        </div>
        @else
        <div class="nav-profile-image">
          <img src="{{ asset('backend/images/admin.png')}}" alt="profile" />
          <span class="login-status online"></span>
        </div>
        <div class="nav-profile-text d-flex flex-column pr-3">
          <span class="font-weight-medium mb-2 text-dark fw-bold h5 mx-auto">Admin</span>
        </div>
        @endif
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="{{route('SA-Dashboard')}}">
        <i class="mdi mdi-home menu-icon" ></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    @if(Auth::user()->role_id == 0)
    <li class="nav-item">
      <a class="nav-link " href="{{route('SA-ListUser')}}">
        <i class="mdi mdi-account menu-icon" ></i>
        <span class="menu-title">Admin</span>
      </a>
    </li>
    @endif
    <?php

    use Illuminate\Support\Facades\Auth;

    $assigned = explode(",", Auth::user()->assigned_modules)
    ?>
    
    @if (in_array("customerManagement", $assigned) || Auth::user()->role_id==0)
    <!-- <li class="nav-item">
      <a class="nav-link" href="{{route('SA-CustomerManagement')}}">
        <i class="mdi mdi-account-multiple menu-icon" ></i>
        <span class="menu-title">Customer Management</span>
      </a>
    </li> -->
    @endif
    @if (in_array("inventory", $assigned) || Auth::user()->role_id==0)

    <li class="nav-item ">

      <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class=" nav-link dropdown-toggle">
        <i class="mdi mdi-sitemap menu-icon" ></i>
        <span class="menu-title">Staff Management</span> </a>

      <ul class="collapse list-unstyled" id="homeSubmenu">
        <li class="nav-item">
          <a class="nav-link" href="{{route('SA-Employee')}}">
            <span class="menu-title">Employee</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('SA-RoleAndPrivileges')}}">
            <span class="menu-title">Role And Privilege</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('SA-Department')}}">
            <span class="menu-title">Department</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('SA-designation')}}">
            <span class="menu-title">Designation</span></a>
        </li>
      </ul>
    </li>






    <!-- <div class="dropdown">
      <button class="dropbtn">
      <i class="mdi mdi-sitemap menu-icon" ></i>
      Staff Management
      </button>
      <div class="dropdown-content">
        <a href="{{route('SA-Employee')}}">Employee</a>
        <a href="{{route('SA-RoleAndPrivileges')}}">Role And Privileges</a>
        
      </div>
    </div> -->
    <!-- <li class="nav-item">
      <a class="nav-link" href="{{route('SA-Inventory')}}">
        <i class="mdi mdi-sitemap menu-icon" ></i>
        <span class="menu-title">Staff management </span>
      </a>
    </li> -->
    @endif
    @if (in_array("timesheet", $assigned) || Auth::user()->role_id==0)
    <li class="nav-item">
      <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">
        <i class="mdi mdi-briefcase-upload menu-icon " ></i>
        <span class="menu-title">Timesheet</span></a>
      <ul class="collapse list-unstyled" id="pageSubmenu">
        <li class="nav-item">
          <a class="nav-link" href="{{route('SA-Attendance')}}">
            <span class="menu-title"> Today Attendance</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('SA-MonthlyTimesheet')}}">
            <span class="menu-title">Monthly Timesheet</span></a>
        </li>

      </ul>
    </li>
    <!-- <style>
      .active i {
        transform: rotate(-180deg);
      }
    </style> -->
    <!-- <script>
      $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
          $('#sidebar').toggleClass('active');
        });
      });
    </script> -->
    @endif
    @if (in_array("projectmanagement", $assigned) || Auth::user()->role_id==0)
    <li class="nav-item">
      <a href="#staffmanagmentSubmenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">
        <i class="mdi mdi-briefcase-upload menu-icon" ></i>
        <span class="menu-title">Project Management</span></a>
      <ul class="collapse list-unstyled" id="staffmanagmentSubmenu">
        <li class="nav-item" >
          <a class="nav-link" href="{{route('SA-Projectdashboard')}}">
            <span class="menu-title">Dashboard</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('SA-project')}}">
            <span class="menu-title">Projects</span></a>
        </li>
        
      </ul>
    </li>
    @endif
    @if (in_array("customerManagement", $assigned) || Auth::user()->role_id==0)
    <!-- <li class="nav-item">
      <a class="nav-link" href="{{route('SA-CustomerManagement')}}">
        <i class="mdi mdi-account-multiple menu-icon" ></i>
        <span class="menu-title">Customer Management</span>
      </a>
    </li> -->
    @endif

    

    @if (in_array("dropShipping", $assigned) || Auth::user()->role_id==0)
    <!-- <li class="nav-item">
      <a class="nav-link" href="{{route('SA-DropShipping')}}">
        <i class="mdi mdi-truck-delivery menu-icon" ></i>
        <span class="menu-title">Drop Shipping</span>
      </a>
    </li> -->
    @endif
    @if (in_array("taskManagement", $assigned) || Auth::user()->role_id==0)
    <!-- <li class="nav-item">
      <a class="nav-link" href="{{route('SA-TaskManagement')}}">
        <i class="mdi mdi-worker menu-icon" ></i>
        <span class="menu-title">Task Management</span>
      </a>
    </li> -->
    @endif
    
    @if (in_array("loyalitysystem", $assigned) || Auth::user()->role_id==0)
    <!-- <li class="nav-item">
      <a class="nav-link" href="">
        <i class="mdi mdi-star menu-icon" ></i>
        <span class="menu-title">Loyalty System</span>
      </a>
    </li> -->
    @endif

    @if (in_array("reports", $assigned) || Auth::user()->role_id==0)
    <li class="nav-item">
      <a class="nav-link" href="{{route('SA-Reports')}}">
        <i class="mdi mdi-chart-line menu-icon" ></i>
        <span class="menu-title">Reports</span>
      </a>
    </li>
    @endif
  </ul>
</nav>

