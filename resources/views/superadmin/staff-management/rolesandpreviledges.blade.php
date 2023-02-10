@extends('superadmin.layouts.master')
@section('title','Role and Privileges | Micro Aire-Care')
@section('body')
<!-- customer css file -->
<link rel="stylesheet" href="{{ asset('inventorybackend/css/style.css')}}" />
<!-- coustomer js file -->
<script src="{{ asset('inventorybackend/js/action.js')}}"></script>

<div class="main-panel">
    <div class="content-wrapper pb-0">
        <div class="p-3">
            <!-- Previledges Tab -->
            <div class="page-header flex-wrap">
                <h4 class="mb-0">
                Role and Privileges
                </h4>
                <div class="add-items d-flex">
                      <button class="add btn btn-primary font-weight-bold todo-list-add-btn" for="roleAndPreviledgesName" id="searchLabel">Search</button>
                      <input type="text" class="form-control todo-list-input" onkeyup="rolePreviledgesFilterName()" name="" id="roleAndPreviledgesName" placeholder="Search by Role Name">
                      <button class="add btn btn-primary font-weight-bold todo-list-add-btn" id="resetRoleFilter">Reset</button>
                    </div>
                <!-- <div class="d-flex">
                    <label for="roleAndPreviledgesName" id="searchLabel" class="text-white bg-primary fw-bold">Search </label>
                    <input type="search" onkeypress="rolePreviledgesFilterName()" name="" id="roleAndPreviledgesName" placeholder="Search by Role Name"> -->

                    <!-- Category -->
                    <!-- <select name="" id="selectRoleStatus" onchange="salesOrdersFilter()" class="form-control m-2 ">
                        <option value="" class="bg-info text-white" style="font-size: small;">Select status</option>
                        <option value="cash on delivery">Cash on delivery</option>
                        <option value="30 days">30 days</option>
                    </select> -->
                    <!-- Reset Filter -->
                    <!-- <a href="#" id="resetRoleFilter" class="text-white" style="margin-left: 3px !important; margin-right:3px !important; border:2px solid #ccc !important;">reset</a>
                </div> -->
                <div class="d-flex">
                    <a href="#" onclick="jQuery('delRoleAlert').hide()" class="btn btn-sm ml-3" id="newbutton" data-toggle="modal" data-target="#addRolePreviledges"> Add new role </a>
                </div>
            </div>
            <!-- alert section -->
            <!-- <div class="alert alert-success" id="delRoleAlert" style="display:none"></div>
            <div class="alert alert-success alert-dismissible fade show" id="delRoleAlert" style="display:none" role="alert">
                <strong>Info ! </strong> <span id="delRoleAlertMSG"></span>
                <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <!-- alert section end-->

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
                            <th class=" border border-secondary">Role Id</th>
                            <th class=" border border-secondary">Role Name</th>
                            <th class=" border border-secondary">Menu Permission</th>
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



    </div>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- backend js file -->
    <!-- Create Employee Model -->
    @include('superadmin.staff-management.rolesandpreviledges.addrolespreviledges')
    @include('superadmin.staff-management.rolesandpreviledges.editrolespreviledges')
    @include('superadmin.staff-management.rolesandpreviledges.viewrolespreviledges')

    <SCRipt>
        jQuery(document).ready(function() {
            updateRoles();
        });

        // All Empoloyee Details
        function updateRoles() {
            $.ajax({
                type: "GET",
                url: "{{ route('SA-GetRoleList') }}",
                success: function(response) {
                    let i = 0;
                    jQuery('.employeedetail').html('');
                    $('.employee-detail-main-table').html('Total Role & Privileges : ' + response.total);
                    jQuery.each(response.data, function(key, value) {

                        $('.employeedetail').append('<tr>\
                        <td class=" border border-secondary">' + ++i + '</td>\
                        <td class=" border border-secondary">' + value["role_id"] + '</td>\
                        <td class=" border border-secondary">' + value["role_name"] + '</td>\
                        <td class=" border border-secondary">' + value["report_to"] + '</td>\
                        <td class=" border border-secondary"><a name="viewrolepreviledges" data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewrolepreviledges"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editRolePreviledges" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editRolePreviledges"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalRole" name="deleteRole" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
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
                    $('.employee-detail-main-table').html('Total Role & Privileges : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.employeedetail').append('<tr>\
                            <td class=" border border-secondary">' + i++ + '</td>\
                            <td class=" border border-secondary">' + value["role_id"] + '</td>\
                            <td class=" border border-secondary">' + value["role_name"] + '</td>\
                            <td class=" border border-secondary">' + value["report_to"] + '</td>\
                            <td class=" border border-secondary"><a name="viewrolepreviledges" data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewrolepreviledges"> <i class="mdi mdi-eye"></i> </a></td>\
                            <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editRolePreviledges" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editRolePreviledges"> <i class="mdi mdi-pencil"></i> </a></td>\
                            <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalRole" name="deleteRole" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
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
        // view individuals 
        $(document).on("click", "a[name = 'viewrolepreviledges']", function(e) {
            let id = $(this).data("id");
            getRolesInfo(id);

            function getRolesInfo(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-GetSingleRoleDetails')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        jQuery.each(response, function(key, value) {
                            $('#viewfirstname').val(value["id"]);
                            $('#viewrolenameId').val(value["role_name"]);
                            $('#viewacessId').val(value["access"]);


                            const rights = value["role_modules"];
                            const rightsArr = rights.split(/\s*,\s*/);

                            (jQuery.inArray('staff', rightsArr) != -1) ? $('#viewStaff').prop('checked', true): $('#viewStaff').prop('checked', false);
                            (jQuery.inArray('timesheet', rightsArr) != -1) ? $('#viewTimesheet').prop('checked', true): $('#viewTimesheet').prop('checked', false);
                            (jQuery.inArray('projects', rightsArr) != -1) ? $('#viewProjects').prop('checked', true): $('#viewProjects').prop('checked', false);
                            (jQuery.inArray('filemanage', rightsArr) != -1) ? $('#viewFilemanage').prop('checked', true): $('#viewFilemanage').prop('checked', false);
                            (jQuery.inArray('crm', rightsArr) != -1) ? $('#viewCrm').prop('checked', true): $('#viewCrm').prop('checked', false);





                            jQuery("#delRoleAlert").hide();
                            jQuery(".alert-danger").hide();
                            jQuery("#addRoleAlert").hide();
                            jQuery("#editRoleAlert").hide();



                        });
                    }
                });
            }
        });
        // end here  
        // Edit employee details
        $(document).on("click", "a[name = 'editRolePreviledges']", function(e) {
            let id = $(this).data("id");
            getDelivery(id);

            function getDelivery(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-GetSingleRoleDetails')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {

                        jQuery.each(response, function(key, value) {
                            $('#oldRole').val(value["id"]);
                            $('#editrolenameId').val(value["role_name"]);
                            $('#editacessId').val(value["access"]);

                            const rights = value["role_modules"];
                            const rightsArr = rights.split(/\s*,\s*/);
                            (jQuery.inArray('all', rightsArr) != -1) ? $('#accessToAllEdit').prop('checked', true): $('#accessToAllEdit').prop('checked', false);
                            (jQuery.inArray('staff', rightsArr) != -1) ? $('#editStaff').prop('checked', true): $('#editStaff').prop('checked', false);
                            (jQuery.inArray('timesheet', rightsArr) != -1) ? $('#editTimesheet').prop('checked', true): $('#editTimesheet').prop('checked', false);
                            (jQuery.inArray('projects', rightsArr) != -1) ? $('#editProjects').prop('checked', true): $('#editProjects').prop('checked', false);
                            (jQuery.inArray('filemanage', rightsArr) != -1) ? $('#editFilemanage').prop('checked', true): $('#editFilemanage').prop('checked', false);
                            (jQuery.inArray('crm', rightsArr) != -1) ? $('#editCrm').prop('checked', true): $('#editCrm').prop('checked', false);



                            jQuery("#delRoleAlert").hide();
                            jQuery(".alert-danger").hide();
                            jQuery("#addRoleAlert").hide();
                            jQuery("#editRoleAlert").hide();
                        });
                    }
                });
            }
        });
        // delete a single Previledges using id
        $(document).on("click", "a[name = 'deleteRole']", function(e) {
            let id = $(this).data("id");
            delPreviledges(id);
            function delPreviledges(id) {
                bootbox.confirm(" DO YOU WANT TO DELETE?", function(result) {
                    if (result) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-RemoveRolePreviledges')}}",
                    data: {
                        'id': id,
                    },
                    success: function(result) {
                        successMsg(result.success);
                        updateRoles();
                        jQuery("#delRoleAlert").show();
                        jQuery("#delRoleAlertMSG").html(response.success);
                        $("#removeModalRole .close").click();

                    }
                });
            }
                })
            }
        });
        // filter
        function rolePreviledgesFilterName() {
            $user = $('#roleAndPreviledgesName').val();
            $.ajax({
                type: "GET",
                url: "{{ route('SA-Filterroleandpriviledges') }}",
                data: {
                    "user": $user,
                },
                success: function(response) {
                    let i = 0;
                    jQuery('.employeedetail').html('');
                    $('.employee-detail-main-table').html('Total Role & Privileges : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.employeedetail').append('<tr>\
                        <td class=" border border-secondary">' + ++i + '</td>\
                        <td class=" border border-secondary">' + value["role_id"] + '</td>\
                        <td class=" border border-secondary">' + value["role_name"] + '</td>\
                        <td class=" border border-secondary">' + value["report_to"] + '</td>\
                        <td class=" border border-secondary"><a name="viewrolepreviledges" data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewrolepreviledges"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editRolePreviledges" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editRolePreviledges"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalRole" name="deleteRole" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                    });
                    $('.employee-details-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.employee-details-pagination-refs').append(
                            '<li id="search_employee_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });
                }
            });
            // pagination links css and access page
            $(function() {
                $(document).on("click", "#search_employee_pagination a", function() {
                    //get url and make final url for ajax 
                    var url = $(this).attr("href");
                    var append = url.indexOf("?") == -1 ? "?" : "&";
                    var finalURL = url + append;
                    $.get(finalURL, function(response) {
                        let i = 0;
                        jQuery('.employeedetail').html('');
                        $('.employee-detail-main-table').html('Total Role & Privileges : ' + response.total);
                        jQuery.each(response.data, function(key, value) {
                            $('.employeedetail').append('<tr>\
                            <td class=" border border-secondary">' + ++i + '</td>\
                            <td class=" border border-secondary">' + value["role_id"] + '</td>\
                        <td class=" border border-secondary">' + value["role_name"] + '</td>\
                        <td class=" border border-secondary">' + value["report_to"] + '</td>\
                        <td class=" border border-secondary"><a name="viewrolepreviledges" data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewrolepreviledges"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editRolePreviledges" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editRolePreviledges"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalRole" name="deleteRole" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                        </tr>');
                        });

                        $('.employee-details-pagination-refs').html('');
                        jQuery.each(response.links, function(key, value) {
                            $('.employee-details-pagination-refs').append(
                                '<li id="search_employee_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                            );
                        });
                    });
                    return false;
                });
            });
        }
        $(document).ready(function() {
            $('#resetRoleFilter').click(function() {
                $('#selectRoleStatus').prop('selectedIndex', 0);
                updateRoles();
            });
        });

        // $(document).on("click", "a[name = 'deleteRole']", function(e) {
        //     let id = $(this).data("id");
        //     $('#confirmRemoveSelectedRole').data('id', id);
        // });
    </SCRipt>
    <!-- <div class="modal fade" id="removeModalRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a name="removeConfirmRoles" class="btn btn-primary" id="confirmRemoveSelectedRole">
                        YES
                    </a>
                </div>
            </div>
        </div>
    </div> -->
    @endsection