@extends('superadmin.layouts.master')
@section('title','Reports  | Micro Aire-Care')
@section('body')



<!-- customer css file -->
<link rel="stylesheet" href="{{ asset('inventorybackend/css/style.css')}}" />
<!-- coustomer js file -->
<script src="{{ asset('inventorybackend/js/action.js')}}"></script>

<div class="main-panel">
    <div class="content-wrapper pb-0">
        <div class="p-3">
            <!-- Reports Tab -->
            <div class="page-header flex-wrap">
                <h4 class="mb-0">Reports</h4>
                <div class="add-items d-flex">
                </div>
            </div>
            <!-- table start -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive-sm" style="overflow-x:scroll;">
                                <table class="table text-center table-hover">
                                    <caption class="sales-orders-main-table1"></caption>
                                    <thead class="fw-bold text-dark">
                                        <tr class="col">
                                            <th>AREA</th>
                                            <th>DESCRIPTION/REMARKS</th>
                                            <th>PLAN</th>
                                            <th>COMP</th>
                                            <th>STATUS</th>
                                            <th>PHOTOS/NOTES</th>
                                            <th>CONTRACTOR</th>
                                            <th>MANPOWER</th>
                                            <th>TIME START</th>
                                            <th>TIME END</th>
                                            <th>VEHICLE</th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody reports">

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
    </div>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- backend js file -->

    @endsection