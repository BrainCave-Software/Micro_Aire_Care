@extends('superadmin.layouts.master')
@section('title','Today Attendance | Micro Aire-Care')
@section('body')



<!-- customer css file -->
<link rel="stylesheet" href="{{ asset('inventorybackend/css/style.css')}}" />
<!-- coustomer js file -->
<script src="{{ asset('inventorybackend/js/action.js')}}"></script>

<div class="main-panel">
    <div class="content-wrapper pb-0">


        <div class="p-3">
            <!-- orders Tab -->
            <div class="page-header flex-wrap">
                <h4 class="mb-0">
                    Today Attendance
                </h4>
                <div class="add-items d-flex">
     <button class="add btn btn-primary font-weight-bold todo-list-add-btn" for="salesOrdersName" id="searchLabel">Search</button>
     <input type="text" class="form-control todo-list-input" onkeypress="salesOrdersFilterName()" name="" id="salesOrdersName" placeholder="Search by Employee">
     <button class="add btn btn-primary font-weight-bold todo-list-add-btn" id="resetSalesOrdersFilter">Reset</button>
</div>
                <!-- <div class="d-flex">
                    <label for="salesOrdersName" id="searchLabel" class="text-white bg-primary fw-bold">Search </label>
                    <input type="search" onkeypress="salesOrdersFilterName()" name="" id="salesOrdersName" placeholder="Search by Employee"> -->

                    <!-- Category -->
                    <!-- <select name="" id="selectOrdersStatus" onchange="salesOrdersFilter()" class="form-control m-2 ">
                        <option value="" class="bg-info text-white" style="font-size: small;">Select status</option>
                        <option value="cash on delivery">Cash on delivery</option>
                        <option value="30 days">30 days</option>
                    </select> -->
                    <!-- Reset Filter -->
                    <!-- <a href="#" id="resetSalesOrdersFilter" class="text-white" style="margin-left: 3px !important; margin-right:3px !important; border:2px solid #ccc !important;">reset</a>
                </div> -->
                <div class="d-flex">
                    <!-- <a href="#" id="newbutton" onclick="jQuery('delOrdersAlert').hide()" class="btn btn-sm ml-3" data-toggle="modal" data-target="#createCustomerPage"> Get </a> -->
                    <!-- Default checked -->

                    <div class="custom-control custom-switch">
                        
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                        <label class="custom-control-label" for="customSwitch1">Active</label>
                    </div>
                </div>
            </div>
            <!-- alert section -->
            <div class="alert alert-success" id="delOrdersAlert" style="display:none"></div>
            <div class="alert alert-success alert-dismissible fade show" id="delOrdersAlert" style="display:none" role="alert">
                <strong>Info ! </strong> <span id="delOrdersAlertMSG"></span>
                <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- alert section end-->

            <!-- table start -->
            <div class="row">
     <div class="col-lg-12">
          <div class="card">
               <div class="card-body">
            <div class="table-responsive-sm" style="overflow-x:scroll;">
                <table class="table text-center table-hover">
                    <caption class="sales-orders-main-table1"></caption>
                    <thead class="fw-bold text-dark">
                        <tr class="col" >
                            <th >S/N</th>
                            <th >Employee</th>
                            <th >E-ID</th>
                            <!-- <th >Date</th> -->
                            <th >Clock in</th>
                            <th >Clock Out</th>
                            <!-- <th  colspan="3">Action</th> -->
                        </tr>
                    </thead>
                    <tbody class="tbody orders-list1">

                    </tbody>
                </table>
            </div>
            </div>
           </div>
     </div>
</div>
            <ul class="sales-orders-pagination-refs pagination-referece-css pagination justify-content-center"></ul>
            <!-- table end here -->
        </div>

        <!-- Create Orders Model -->



    </div>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- backend js file -->





    @endsection