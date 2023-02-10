@extends('superadmin.layouts.master') @section('title','Dashboard | Micro Aire-Care ') @section('body') <div class="main-panel">
  <div class="content-wrapper pb-0">
    <!-- start row -->
    <div class="row">
      <div class="col-xl-6 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
        <!-- <div class="card bg-warning"><div class="card-body px-3 py-4">
            <div class="d-flex justify-content-between align-items-start">
                <div class="color-card"><h2 class="text-white">
                     21 </h2></div><i class="card-icon-indicator mdi mdi-basket bg-inverse-icon-warning"></i>
                    </div><h6 class="text-white">Employee Absent Today
                        </h6></div></div> -->

        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
            <i class="mdi mdi-basket"></i>
            </div>
            <p class="card-category">Employee Absent Today</p>
            <h3 class="card-title">{{$count2}}</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <a href="{{route('SA-Attendance')}}">Know More</a>
              <i class="mdi mdi-arrow-right-thick"></i>
             
            </div>
          </div>
        </div>
      </div>
    
      <div class="col-xl-6 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
      <div class="card card-stats">
        <div class="card-header card-header-rose card-header-icon">
            <div class="card-icon">
            <i class="mdi mdi-cube-outline"></i>
            </div>
            <p class="card-category">Employee Present Today</p>
            <h3 class="card-title">{{$count2}}</h3></div>
            <div class="card-footer">
                <div class="stats">
                <a href="{{route('SA-Attendance')}}">Know More</a>
              <i class="mdi mdi-arrow-right-thick"></i>
            </div>
        </div>
    </div>
      <!-- <div class="card bg-danger">
          <div class="card-body px-3 py-4">
            <div class="d-flex justify-content-between align-items-start">
              <div class="color-card">
                <p class="mb-0 color-card-head">Margin</p> 
                <h2 class="text-white"> 21</h2>
              </div>
              <i class="card-icon-indicator mdi mdi-cube-outline bg-inverse-icon-danger"></i>
            </div>
            <h6 class="text-white">Employee Present Today </h6>
          </div>
        </div> -->
      </div>
    </div>
    <!-- row end -->
    <!-- row start -->
    <div class="row">
      <div class="col-xl-6 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
      <div class="card card-stats">
        <div class="card-header card-header-success card-header-icon">
            <div class="card-icon"> 
                <i class="mdi mdi-cube-outline"></i>
        </div>
        <p class="card-category">Revenue</p>
        <h3 class="card-title">00</h3>
    </div>
    <div class="card-footer">
        <div class="stats">
        <a href="#">Know More</a>
              <i class="mdi mdi-arrow-right-thick"></i>
        </div>
    </div>
</div>
      <!-- <div class="card bg-primary">
          <div class="card-body px-3 py-4">
            <div class="d-flex justify-content-between align-items-start">
              <div class="color-card">
                 <p class="mb-0 color-card-head">Orders</p>    
                <h2 class="text-white"> 0 </h2>
              </div>
              <i class="card-icon-indicator mdi mdi-briefcase-outline bg-inverse-icon-primary"></i>
            </div>
            <h6 class="text-white">Total Project</h6>
          </div>
        </div> -->
        
      </div>
      <div class="col-xl-6 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
      <div class="card card-stats">
        <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
            <i class="mdi mdi-briefcase-outline"></i>
        </div><p class="card-category">Task</p>
        <h3 class="card-title">{{$count4}}</h3>
    </div>
    <div class="card-footer">
        <div class="stats">
        <a href="{{route('SA-project')}}">Know More</a>
              <i class="mdi mdi-arrow-right-thick"></i></div>
            </div>
        </div> 
      <!-- <div class="card bg-primary">
          <div class="card-body px-3 py-4">
            <div class="d-flex justify-content-between align-items-start">
              <div class="color-card">
                <p class="mb-0 color-card-head">Orders</p> 
                <h2 class="text-white"> 0 </h2>
              </div>
              <i class="card-icon-indicator mdi mdi-briefcase-outline bg-inverse-icon-primary"></i>
            </div>
            <h6 class="text-white">Task</h6>
          </div>
        </div> -->
      </div>
    </div>
    <!-- row end -->
    <!-- start row -->
    <!-- <div class="row"><div class="col-xl-3 col-md-3 stretch-card grid-margin grid-margin-sm-0 pb-sm-3"><div class="card bg-warning"><div class="card-body px-3 py-4"><div class="d-flex justify-content-between align-items-start"><div class="color-card"><p class="mb-0 color-card-head"> Employee Present Sales</p><h2 class="text-white" id="availableProducts"> 000 </h2></div><i class="card-icon-indicator mdi mdi-basket bg-inverse-icon-warning"></i></div><h6 class="text-white"> Employee Present Today</h6></div></div></div><div class="col-xl-3 col-md-3 stretch-card grid-margin grid-margin-sm-0 pb-sm-3"><div class="card bg-danger"><div class="card-body px-3 py-4"><div class="d-flex justify-content-between align-items-start"><div class="color-card"><p class="mb-0 color-card-head">Margin</p><h2 class="text-white" id="totalSale"> 000 </h2></div><i class="card-icon-indicator mdi mdi-cube-outline bg-inverse-icon-danger"></i></div><h6 class="text-white">Employee Present</h6></div></div></div><div class="col-xl-3 col-md-3 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3"><div class="card bg-primary"><div class="card-body px-3 py-4"><div class="d-flex justify-content-between align-items-start"><div class="color-card"><p class="mb-0 color-card-head">Orders</p><h2 class="text-white" id="totalPurchase"> 000 </h2></div><i class="card-icon-indicator mdi mdi-briefcase-outline bg-inverse-icon-primary"></i></div><h6 class="text-white">Total Project</h6></div></div></div><div class="col-xl-3 col-md-3 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3"><div class="card bg-primary"><div class="card-body px-3 py-4"><div class="d-flex justify-content-between align-items-start"><div class="color-card"><p class="mb-0 color-card-head">Orders</p><h2 class="text-white" id="totalOrder"> 000 </h2></div><i class="card-icon-indicator mdi mdi-briefcase-outline bg-inverse-icon-primary"></i></div><h6 class="text-white">Total Task</h6></div></div></div></div> -->
    <!-- End Row -->
    <!-- <div class="row"><div class="col-xl-6 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3"><div class="card bg-primary"><div class="card-body px-3 py-4"><div class="d-flex justify-content-between align-items-start"><div class="color-card"><p class="mb-0 color-card-head">Orders</p><h2 class="text-white"> 10,000 </h2></div><i class="card-icon-indicator mdi mdi-briefcase-outline bg-inverse-icon-primary"></i></div><h6 class="text-white">Total Goods for Sale</h6></div></div></div><div class="col-xl-6 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3"><div class="card bg-primary"><div class="card-body px-3 py-4"><div class="d-flex justify-content-between align-items-start"><div class="color-card"><p class="mb-0 color-card-head">Orders</p><h2 class="text-white"> 10,000 </h2></div><i class="card-icon-indicator mdi mdi-briefcase-outline bg-inverse-icon-primary"></i></div><h6 class="text-white">Goods in Warehouse</h6></div></div></div></div> -->
  </div> @endsection
  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- // backend js file -->
  <script>
    // Total No Of Products
    $.ajax({
      type: "GET",
      url: "{{ route('SA-GetNoOfProducts') }}",
      success: function(response) {
        $('#availableProducts').text(response);
      }
    });
    // Total Sale
    $.ajax({
      type: "GET",
      url: "{{ route('SA-TotalSale') }}",
      success: function(response) {
        $('#totalSale').text(response);
      }
    });
    // Total Purchase
    $.ajax({
      type: "GET",
      url: "{{ route('SA-TotalPurchase') }}",
      success: function(response) {
        $('#totalPurchase').text(response);
      }
    });
    // Total Order
    $.ajax({
      type: "GET",
      url: "{{ route('SA-TotalOrders') }}",
      success: function(response) {
        $('#totalOrder').text(response);
      }
    });
  </script>