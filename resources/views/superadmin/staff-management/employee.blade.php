@extends('superadmin.layouts.master')
@section('title','Employee | Micro Aire-Care')
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
                    Employee
                </h4>
                <div class="add-items d-flex">
                    <button class="add btn btn-primary font-weight-bold todo-list-add-btn" for="employeeFilter" id="searchLabel">Search</button>
                    <input type="text" class="form-control todo-list-input" onkeyup="employeeFilterName()" name="" id="employeeFilter" placeholder="Search by Username">
                    <button class="add btn btn-primary font-weight-bold todo-list-add-btn" id="resetEmployeeFilter">Reset</button>
                </div>
                <!-- <div class="d-flex">
                    <label for="employeeFilter" id="searchLabel" class="text-white bg-primary fw-bold">Search </label>
                    <input type="search" onkeypress="employeeFilterName()" name="" id="employeeFilter" placeholder="Search by Username">
                    <a href="#" id="resetEmployeeFilter" class="text-white" style="margin-left: 3px !important; margin-right:3px !important; border:2px solid #ccc !important;">reset</a>
                </div> -->
                <div class="d-flex">

                    <a href="#" id="newbutton" class="btn btn-sm ml-3" data-toggle="modal" data-target="#addNewEmployee"> Add new Employee </a>
                </div>
            </div>



            <!-- table start -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive-sm" style="overflow-x:scroll;">
                                <table class="table text-center table-hover">
                                    <caption class="employee-detail-main-table"></caption>
                                    <thead class="fw-bold text-dark">
                                        <tr>
                                            <th class=" border border-secondary">S/N</th>
                                            <th class=" border border-secondary">Username</th>
                                            <th class=" border border-secondary">Mobile No</th>
                                            <!-- <th class=" border border-secondary">Report to</th> -->
                                            <th class=" border border-secondary">Role</th>
                                            <th class=" border border-secondary" colspan="3">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody class="tbody employeedetail">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="employee-details-pagination-refs pagination-referece-css pagination justify-content-center"></ul>
            <!-- table end here -->
        </div>

        <!-- Create Employee Model -->
        @include('superadmin.staff-management.employee.addemployee')
        @include('superadmin.staff-management.employee.editemployee')
        @include('superadmin.staff-management.employee.viewemployee')


    </div>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- backend js file -->

    <SCRipt>
        jQuery(document).ready(function() {
            employeeList();


        });

        // All Empoloyee Details
        function employeeList() {
            $.ajax({
                type: "GET",
                url: "{{ route('SA-getEmployeeDetail') }}",
                success: function(response) {
                    let i = 0;
                    jQuery('.employeedetail').html('');
                    $('.employee-detail-main-table').html('Total no. of  Employee : ' + response.total);
                    jQuery.each(response.data, function(key, value) {

                        $('.employeedetail').append('<tr>\
                        <td class=" border border-secondary">' + ++i + '</td>\
                        <td class=" border border-secondary">' + value["user_name"] + '</td>\
                        <td class=" border border-secondary">' + value["contact_no"] + '</td>\
                        <td class=" border border-secondary">' + value["role"] + '</td>\
                        <td class=" border border-secondary"><a name="viewEmployee" data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewEmployee"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editEmployee" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editEmployee"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalEmployee" name="deleteEmployee" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                    });

                    $('.employee-details-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.employee-details-pagination-refs').append(
                            '<li id="employee_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });


                }
            });
        }
        // End function here

        // pagination links css and access page
        $(function() {
            $(document).on("click", "#employee_pagination a", function() {
                //get url and make final url for ajax 
                var url = $(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append;

                $.get(finalURL, function(response) {
                    let i = response.from;
                    jQuery('.employeedetail').html('');
                    $('.employee-detail-main-table').html('Total no. of  Employee : ' + response.total);
                    jQuery.each(response.data, function(key, value) {

                        $('.employeedetail').append('<tr>\
                            <td class=" border border-secondary">' + i++ + '</td>\
                            <td class=" border border-secondary">' + value["user_name"] + '</td>\
                            <td class=" border border-secondary">' + value["contact_no"] + '</td>\
                            <td class=" border border-secondary">' + value["role"] + '</td>\
                            <td class=" border border-secondary"><a name="viewEmployee" data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewEmployee"> <i class="mdi mdi-eye"></i> </a></td>\
                            <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editEmployee" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editEmployee"> <i class="mdi mdi-pencil"></i> </a></td>\
                            <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalEmployee" name="deleteEmployee" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                        </tr>');
                    });

                    $('.employee-details-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.employee-details-pagination-refs').append(
                            '<li id="employee_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });
                });
                return false;
            });
        });
        // end here  
        // view individuals Employee
        $(document).on("click", "a[name = 'viewEmployee']", function(e) {
            let id = $(this).data("id");
            getEmployeesInfo(id);

            function getEmployeesInfo(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-GetSingleEmployeeDetails')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        jQuery.each(response, function(key, value) {
                            $('#viewfirstname').val(value["name"]);
                            $('#viewemployeid').val(value["employe_id"]);
                            $('#viewmaindepartment').val(value["main_department"]);
                            $('#viewdesignation').val(value["designation"]);
                            $('#viewusername').val(value["user_name"]);
                            $('#viewemailid').val(value["email_id"]);
                            $('#viewgender').val(value["gender"]);
                            $('#viewPassword').val(value["view_password"]);
                            $('#viewcontactno').val(value["contact_no"]);
                            $('#viewrole').val(value["role"]);

                            jQuery("#delEmployeeAlert").hide();
                            jQuery(".alert-danger").hide();
                            jQuery("#addEmployeeAlert").hide();
                            jQuery("#editEmployeeAlert").hide();

                        });
                    }
                });
            }
        });
        // end here  
        // Edit employee details
        $(document).on("click", "a[name = 'editEmployee']", function(e) {
            let id = $(this).data("id");
            getDelivery(id);

            function getDelivery(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-GetSingleEmployeeDetails')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        console.log(response);
                        jQuery.each(response, function(key, value) {
                            $('#oldeditemployee').val(value["id"]);
                            $('#editFirstnameId').val(value["name"]);
                            $('#editEmployeeidId').val(value["employe_id"]);
                            $('#editUsersId').val(value["users_id"]);
                            $('#editMainDepartmentEmployee').val(value["main_department"]);
                            $('#editDesignation').val(value["designation"]);
                            $('#editUsernameId').val(value["user_name"]);
                            $('#editEmailidId').val(value["email_id"]);
                            $('#editGenderId').val(value["gender"]);
                            $('#editPassword').val(value["view_password"]);
                            $('#editContactId').val(value["contact_no"]);
                            $('#editConformPassword').val(value["view_password"]);
                            $('#editRole').val(value["role"]);

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
        function employeeFilterName() {
            $user = $('#employeeFilter').val();
            $.ajax({
                type: "GET",
                url: "{{ route('SA-FilterEmployeeName') }}",
                data: {
                    "user": $user,
                },
                success: function(response) {

                    let i = 0;
                    jQuery('.employeedetail').html('');
                    $('.employee-detail-main-table').html('Total no. of  Employee  : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.employeedetail').append('<tr>\
                        <td class=" border border-secondary">' + ++i + '</td>\
                        <td class=" border border-secondary">' + value["user_name"] + '</td>\
                        <td class=" border border-secondary">' + value["contact_no"] + '</td>\
                        <td class=" border border-secondary">' + value["role"] + '</td>\
                        <td class=" border border-secondary"><a name="viewEmployee" data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewEmployee"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editEmployee" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editEmployee"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalEmployee" name="deleteEmployee" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                    });

                    $('.employee-details-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.employee-details-pagination-refs').append(
                            '<li id="employee_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });


                }
            });

            // pagination links css and access page
            $(function() {
                $(document).on("click", "#employee_pagination a", function() {
                    //get url and make final url for ajax 
                    var url = $(this).attr("href");
                    var append = url.indexOf("?") == -1 ? "?" : "&";
                    var finalURL = url + append;

                    $.get(finalURL, function(response) {
                        let i = 0;


                        jQuery('.employeedetail').html('');
                        $('.employee-detail-main-table').html('Total no. of  Employee : ' + response.total);
                        jQuery.each(response.data, function(key, value) {

                            $('.employeedetail').append('<tr>\
                            <td class=" border border-secondary">' + ++i + '</td>\
                        <td class=" border border-secondary">' + value["user_name"] + '</td>\
                        <td class=" border border-secondary">' + value["contact_no"] + '</td>\
                        <td class=" border border-secondary">' + value["role"] + '</td>\
                        <td class=" border border-secondary"><a name="viewEmployee" data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewEmployee"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editEmployee" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editEmployee"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalEmployee" name="deleteEmployee" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                        </tr>');
                        });

                        $('.employee-details-pagination-refs').html('');
                        jQuery.each(response.links, function(key, value) {
                            $('.employee-details-pagination-refs').append(
                                '<li id="employee_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                            );
                        });
                    });
                    return false;
                });
            });


        }
        // end here  

        // delete a single Employee using id
        $(document).on("click", "a[name = 'deleteEmployee']", function(e) {
            let id = $(this).data("id");
            delEmployeeId(id);

            function delEmployeeId(id) {
                bootbox.confirm(" DO YOU WANT TO DELETE?", function(result) {
                    if (result) {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('SA-RemoveEmployee')}}",
                            data: {
                                'id': id,
                            },
                            success: function(result) {
                                successMsg(result.success);
                                employeeList();
                                jQuery("#deleteEmployeeIdAlert").show();
                                jQuery("#delEmployeeIdAlertMSG").html(response.success);
                                $("#removeModalEmployee .close").click();

                            }
                        });
                    }
                })
            }
        });
        $(document).ready(function() {
            $('#resetEmployeeFilter').click(function() {
                employeeList();
            });
        });
        // $(document).on("click", "a[name = 'deleteEmployee']", function(e) {
        //     let id = $(this).data("id");
        //     $('#confirmRemoveSelectedEmployee').data('id', id);
        // });
    </SCRipt>
    <!-- <div class="modal fade" id="removeModalEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a name="removeConfirmEmployee" class="btn btn-primary" id="confirmRemoveSelectedEmployee">
                        YES
                    </a>
                </div>
            </div>
        </div>
    </div> -->
    @endsection