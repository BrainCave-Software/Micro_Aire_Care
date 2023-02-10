@extends('superadmin.layouts.master')
@section('title','Designation | Micro Aire-Care')
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
                    Designation
                </h4>
                <div class="add-items d-flex">
                    <button class="add btn btn-primary font-weight-bold todo-list-add-btn" for="designationFilter" id="searchLabel">Search</button>
                    <input type="text" class="form-control todo-list-input" onkeyup="designationFilterName()" name="" id="designationFilter" placeholder="Search by Designation Name">
                    <button class="add btn btn-primary font-weight-bold todo-list-add-btn" id="resetEmployeeFilter">Reset</button>
                </div>
             
                <div class="d-flex">
                    <!-- <a href="#"  class="btn btn-sm ml-3 btn-primary" data-toggle="modal" data-target="#addNewEmployee"> Add new Employee </a> -->
                    <a href="#" id="newbutton" onclick="jQuery('delEmployeeAlert').hide()" class="btn btn-sm ml-3" data-toggle="modal" data-target="#addNewEmployee"> Add </a>
                </div>
            </div>


            <!-- table start -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive-sm" style="overflow-x:scroll;">
                                <table class="table text-center table-hover">
                                    <caption class="designation-detail-main-table"></caption>
                                    <thead class="fw-bold text-dark">
                                        <tr>
                                            <th class=" border border-secondary">S/N</th>
                                            <th class=" border border-secondary">Designation Name</th>
                                            <th class=" border border-secondary">Main Department</th>
                                            <th class=" border border-secondary" colspan="3">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody designationdetail">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="designation-details-pagination-refs pagination-referece-css pagination justify-content-center"></ul>
            <!-- table end here -->
        </div>

        <!-- Create designation Model -->
        @include('superadmin.staff-management.designation.adddesignation')
        @include('superadmin.staff-management.designation.editdesignation')


    </div>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- backend js file -->

    <SCRipt>
        jQuery(document).ready(function() {
            designationList();


        });

        // All designation Details
        function designationList() {
            $.ajax({
                type: "GET",
                url: "{{ route('SA-getDesignationDetail') }}",
                success: function(response) {
                    let i = 0;
                    jQuery('.designationdetail').html('');
                    $('.designation-detail-main-table').html('Total no. of  Designation : ' + response.total);
                    jQuery.each(response.data, function(key, value) {

                        $('.designationdetail').append('<tr>\
                        <td class=" border border-secondary">' + ++i + '</td>\
                        <td class=" border border-secondary">' + value["designation_name"] + '</td>\
                        <td class=" border border-secondary">' + value["main_department"] + '</td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editEmployee" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editEmployee"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalDesignation" name="removeConfirmDesignation" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                    });

                    $('.designation-details-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.designation-details-pagination-refs').append(
                            '<li id="designation_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });


                }
            });
        }
        // End function here

        // pagination links css and access page
        $(function() {
            $(document).on("click", "#designation_pagination a", function() {
                //get url and make final url for ajax 
                var url = $(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append;

                $.get(finalURL, function(response) {
                    let i = response.from;
                    jQuery('.designationdetail').html('');
                    $('.designation-detail-main-table').html('Total no. of  Designation : ' + response.total);
                    jQuery.each(response.data, function(key, value) {

                        $('.designationdetail').append('<tr>\
                            <td class=" border border-secondary">' + i++ + '</td>\
                            <td class=" border border-secondary">' + value["designation_name"] + '</td>\
                            <td class=" border border-secondary">' + value["main_department"] + '</td>\
                            <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editEmployee" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editEmployee"> <i class="mdi mdi-pencil"></i> </a></td>\
                            <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalDesignation" name="deleteDesignation" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                        </tr>');
                    });

                    $('.designation-details-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.designation-details-pagination-refs').append(
                            '<li id="designation_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });
                });
                return false;
            });
        });
        // end here  

        // Edit employee details
        $(document).on("click", "a[name = 'editEmployee']", function(e) {
            let id = $(this).data("id");
            getDelivery(id);

            function getDelivery(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-GetSingleDesignationDetails')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {

                        jQuery.each(response, function(key, value) {
                            $('#oldEditDegination').val(value["id"]);
                            $('#editDesignationName').val(value["designation_name"]);
                            $('#editMainDepartment').val(value["main_department"]);


                            jQuery("#delQuotationAlert").hide();
                            jQuery(".alert-danger").hide();
                            jQuery("#addEmployeeAlert").hide();
                            jQuery("#editEmployeeAlert").hide();
                        });
                    }
                });
            }
        });
        // filter
        function designationFilterName() {
            $user = $('#designationFilter').val();
            $.ajax({
                type: "GET",
                url: "{{ route('SA-FilterDesignationName') }}",
                data: {
                    "designation": $user,
                },
                success: function(response) {

                    let i = 0;
                    jQuery('.designationdetail').html('');
                    $('.designation-detail-main-table').html('Total no. of  Designation  : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.designationdetail').append('<tr>\
                        <td class=" border border-secondary">' + ++i + '</td>\
                        <td class=" border border-secondary">' + value["designation_name"] + '</td>\
                        <td class=" border border-secondary">' + value["main_department"] + '</td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editEmployee" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editEmployee"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalDesignation" name="deleteDesignation" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                    });

                    $('.designation-details-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.designation-details-pagination-refs').append(
                            '<li id="designation_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });


                }
            });

            // pagination links css and access page
            $(function() {
                $(document).on("click", "#designation_pagination a", function() {
                    //get url and make final url for ajax 
                    var url = $(this).attr("href");
                    var append = url.indexOf("?") == -1 ? "?" : "&";
                    var finalURL = url + append;

                    $.get(finalURL, function(response) {
                        let i = 0;


                        jQuery('.designationdetail').html('');
                        $('.designation-detail-main-table').html('Total no. of  Designation : ' + response.total);
                        jQuery.each(response.data, function(key, value) {

                            $('.designationdetail').append('<tr>\
                            <td class=" border border-secondary">' + ++i + '</td>\
                        <td class=" border border-secondary">' + value["designation_name"] + '</td>\
                        <td class=" border border-secondary">' + value["main_department"] + '</td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editEmployee" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editEmployee"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalDesignation" name="deleteDesignation" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                        </tr>');
                        });

                        $('.designation-details-pagination-refs').html('');
                        jQuery.each(response.links, function(key, value) {
                            $('.designation-details-pagination-refs').append(
                                '<li id="designation_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                            );
                        });
                    });
                    return false;
                });
            });


        }
        // end here  

        // delete a single Designation using id
        $(document).on("click", "a[name = 'removeConfirmDesignation']", function(e) {
            let id = $(this).data("id");
            delDesignationId(id);

            function delDesignationId(id) {
                bootbox.confirm(" DO YOU WANT TO DELETE?", function(result) {
                    if (result) {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('SA-RemoveDesignation')}}",
                            data: {
                                'id': id,
                            },
                            success: function(result) {
                                successMsg(result.success);
                                designationList();
                                jQuery("#deleteEmployeeIdAlert").show();
                                jQuery("#delEmployeeIdAlertMSG").html(response.success);
                                $("#removeModalDesignation .close").click();
                            }
                        });
                    }
                })
            }
        });
        $(document).ready(function() {
            $('#resetEmployeeFilter').click(function() {
                $('#selectEmployeeStatus').prop('selectedIndex', 0);
                designationList();
            });
        });
        // $(document).on("click", "a[name = 'deleteDesignation']", function(e) {
        //     let id = $(this).data("id");
        //     $('#confirmRemoveSelectedDesignation').data('id', id);
        // });
    </SCRipt>
    <!-- <div class="modal fade" id="removeModalDesignation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a name="removeConfirmDesignation" class="btn btn-primary" id="confirmRemoveSelectedDesignation">
                        YES
                    </a>
                </div>
            </div>
        </div>
    </div> -->
    @endsection