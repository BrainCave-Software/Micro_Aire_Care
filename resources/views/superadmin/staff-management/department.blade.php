@extends('superadmin.layouts.master')
@section('title','Department | Micro Aire-Care')
@section('body')



<!-- customer css file -->
<link rel="stylesheet" href="{{ asset('inventorybackend/css/style.css')}}" />
<!-- coustomer js file -->
<script src="{{ asset('inventorybackend/js/action.js')}}"></script>

<div class="main-panel">
    <div class="content-wrapper pb-0">


        <div class="p-3">
            <!-- Employee Tab -->
            <div class="page-header flex-wrap">
                <h4 class="mb-0">
                    Department
                </h4>
                <div class="add-items d-flex">
                    <button class="add btn btn-primary font-weight-bold todo-list-add-btn" for="departmentFilter" id="searchLabel">Search</button>
                    <input type="text" class="form-control todo-list-input" onkeyup="departmentFilterName()" name="" id="departmentFilter" placeholder="Search by Name">
                    <button class="add btn btn-primary font-weight-bold todo-list-add-btn" id="resetEmployeeFilter">Reset</button>
                </div>

                
                <div class="d-flex">
                    <a href="#" id="newbutton" onclick="jQuery('delEmployeeAlert').hide()" class="btn btn-sm ml-3" data-toggle="modal" data-target="#addNewDepartment"> Add </a>
                </div>
            </div>

            <!-- table start -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive-sm" style="overflow-x:scroll;">
                                <table class="table text-center table-hover">
                                    <caption class="department-detail-main-table"></caption>
                                    <thead class="fw-bold text-dark">
                                        <tr>
                                            <th class=" border border-secondary">S/N</th>
                                            <th class=" border border-secondary">Name</th>
                                            <!-- <th class=" border border-secondary">Location</th>
                            <th class=" border border-secondary">Department Head</th> -->
                                            <th class=" border border-secondary" colspan="3">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody departmentdetail">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="department-details-pagination-refs pagination-referece-css pagination justify-content-center"></ul>
            <!-- table end here -->
        </div>

        <!-- Create Employee Model -->
        @include('superadmin.staff-management.department.adddepartment')
        @include('superadmin.staff-management.department.editdepartment')


    </div>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- backend js file -->

    <SCRipt>
        jQuery(document).ready(function() {
            departmentList();


        });

        // All Empoloyee Details
        function departmentList() {
            $.ajax({
                type: "GET",
                url: "{{ route('SA-getDepartmentDetail') }}",
                success: function(response) {
                    let i = 0;
                    jQuery('.departmentdetail').html('');
                    $('.department-detail-main-table').html('Total no. of  Department : ' + response.total);
                    jQuery.each(response.data, function(key, value) {

                        $('.departmentdetail').append('<tr>\
                        <td class=" border border-secondary">' + ++i + '</td>\
                        <td class=" border border-secondary">' + value["department_name"] + '</td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editDepartment" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editDepartment"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name= "removeConfirmDepartment" data-toggle="modal" data-target="#removeEmployeeModal"  data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                    });

                    $('.department-details-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.department-details-pagination-refs').append(
                            '<li id="department_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });


                }
            });
        }
        // End function here

        // pagination links css and access page
        $(function() {
            $(document).on("click", "#department_pagination a", function() {
                //get url and make final url for ajax 
                var url = $(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append;

                $.get(finalURL, function(response) {
                    let i = response.from;
                    jQuery('.departmentdetail').html('');
                    $('.department-detail-main-table').html('Total no. of  Department : ' + response.total);
                    jQuery.each(response.data, function(key, value) {

                        $('.departmentdetail').append('<tr>\
                            <td class=" border border-secondary">' + i++ + '</td>\
                        <td class=" border border-secondary">' + value["department_name"] + '</td>\
                        <td class=" border border-secondary">' + value["department_location"] + '</td>\
                        <td class=" border border-secondary">' + value["department_head"] + '</td>\
                            <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editDepartment" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editDepartment"> <i class="mdi mdi-pencil"></i> </a></td>\
                            <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeEmployeeModal" name="deleteDepartment" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                        </tr>');
                    });

                    $('.department-details-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.department-details-pagination-refs').append(
                            '<li id="department_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });
                });
                return false;
            });
        });
        // end here  

        // Edit Department details
        $(document).on("click", "a[name = 'editDepartment']", function(e) {
            let id = $(this).data("id");
            getDelivery(id);

            function getDelivery(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-GetSingleDepartmentDetails')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {

                        jQuery.each(response, function(key, value) {
                            $('#oldeditdepartment').val(value["id"]);
                            $('#editDepartmentName').val(value["department_name"]);
                            $('#editDepartmentLocation').val(value["department_location"]);
                            $('#editDepartmentHead').val(value["department_head"]);
                        });
                    }
                });
            }
        });
        // filter
        function departmentFilterName() {
            $user = $('#departmentFilter').val();
            $.ajax({
                type: "GET",
                url: "{{ route('SA-FilterDepartmentName') }}",
                data: {
                    "department": $user,
                },
                success: function(response) {

                    let i = 0;
                    jQuery('.departmentdetail').html('');
                    $('.department-detail-main-table').html('Total no. of  Department  : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.departmentdetail').append('<tr>\
                        <td class=" border border-secondary">' + ++i + '</td>\
                        <td class=" border border-secondary">' + value["department_name"] + '</td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editDepartment" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editDepartment"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeEmployeeModal" name="deleteDepartment" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                    });

                    $('.department-details-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.department-details-pagination-refs').append(
                            '<li id="department_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });
                }
            });

            // pagination links css and access page
            $(function() {
                $(document).on("click", "#department_pagination a", function() {
                    //get url and make final url for ajax 
                    var url = $(this).attr("href");
                    var append = url.indexOf("?") == -1 ? "?" : "&";
                    var finalURL = url + append;
                    $.get(finalURL, function(response) {
                        let i = 0;
                        jQuery('.departmentdetail').html('');
                        $('.department-detail-main-table').html('Total no. of  Department : ' + response.total);
                        jQuery.each(response.data, function(key, value) {

                            $('.departmentdetail').append('<tr>\
                            <td class=" border border-secondary">' + ++i + '</td>\
                        <td class=" border border-secondary">' + value["department_name"] + '</td>\
                        <td class=" border border-secondary">' + value["department_location"] + '</td>\
                        <td class=" border border-secondary">' + value["department_head"] + '</td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editDepartment" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editDepartment"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeEmployeeModal" name="deleteDepartment" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                        </tr>');
                        });

                        $('.department-details-pagination-refs').html('');
                        jQuery.each(response.links, function(key, value) {
                            $('.department-details-pagination-refs').append(
                                '<li id="department_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                            );
                        });
                    });
                    return false;
                });
            });


        }
        // end here  

        // delete a single department using id
        $(document).on("click", "a[name = 'removeConfirmDepartment']", function(e) {
            let id = $(this).data("id");
            delDepartmentId(id);

            function delDepartmentId(id) {
                bootbox.confirm(" DO YOU WANT TO DELETE?", function(result) {
                    if (result) {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('SA-RemoveDepartment')}}",
                            data: {
                                'id': id,
                            },
                            success: function(result) {
                                successMsg(result.success);
                                $("#removeEmployeeModal .close").click();
                                departmentList();
                            }
                        });
                    }
                })
            }
        });
        $(document).ready(function() {
            $('#resetEmployeeFilter').click(function() {
                $('#selectEmployeeStatus').prop('selectedIndex', 0);
                departmentList();
            });
        });
        // $(document).on("click", "a[name = 'deleteDepartment']", function(e) {
        //     let id = $(this).data("id");
        //     $('#confirmRemoveSelectedDepartment').data('id', id);
        // });
    </SCRipt>
    <!-- <div class="modal fade" id="removeEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Alert</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">DO YOU WANT TO DELETE?<span id="removeElementId"></span> </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">NO</button>
                    <a name="removeConfirmDepartment" class="btn btn-primary" id="confirmRemoveSelectedDepartment">
                        YES
                    </a>
                </div>
            </div>
        </div>
    </div> -->
    @endsection