@extends('superadmin.layouts.master')
@section('title','Admin | Micro Aire-Care ')
@section('body')
<div class="main-panel">
    <div class="content-wrapper pb-0">
        <!-- user management header -->
        <div class="page-header flex-wrap">
            <h3 class="mb-0">
                Admin
            </h3>
            <div class="d-flex">
                <a href="#" id="newbutton" data-toggle="modal" data-target="#addUser"> Add User </a>
            </div>
        </div>
        <!-- main section -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-body">
                    
              <div class="table-responsive">
              <table class="table table-bordered">
                <caption class="user-management-main-table text-primary fw-bold"></caption>
                <thead>
                    <tr class="col">
                        <th>S/N</th>
                        <th>Username</th>
                        <th>Email ID</th>
                        <th>Mobile Number</th>
                        <th colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody class="user-management-detials">

                </tbody>
            </table>
              </div>
                    </div>
                </div>
            </div>
        </div>
      
        <ul class="user-management-pagination-refs pagination pagination-referece-css justify-content-center"></ul>
        <!-- </div> -->
    </div>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- // backend js file -->

    @include('superadmin.user-modal.addUser')
    @include('superadmin.user-modal.editUser')
    @include('superadmin.user-modal.viewUser')

    <script>
        $(document).ready(function() {
            getUserDetails();
        });
        // All Customer Details
        function getUserDetails() {
            $.ajax({
                type: "GET",
                url: "{{ route('SA-FetchUsersDetials') }}",
                success: function(response) {
                    let i = 0;
                    $('.user-management-detials').html('');
                    $('.user-management-main-table').html('Total no. of User : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.user-management-detials').append('<tr>\
                        <td>' + ++i + '</td>\
                        <td>' + value["name"] + '</td>\
                        <td>' + value["email"] + '</td>\
                        <td>' + value["mobile_number"] + '</td>\
                        <td><a name="viewUser"  data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewUser"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td><a name="editUser" data-toggle="modal" onclick="myvalidation()" data-id="' + value["id"] + '" data-target="#editUser"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td><a name="delUser" data-toggle="modal" data-target="#removeModal" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');

                    });
                    $('.user-management-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.user-management-pagination-refs').append(
                            '<li id="user_management_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '" ><a href="' + value['url'] + '" class="page-link" >' + value["label"] + '</a></li>'
                        );
                    });
                }
            });
        }
        // End function here


        // pagination links css and access page
        $(function() {
            $(document).on("click", "#user_management_pagination a", function() {
                //get url and make final url for ajax
                var url = $(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append;
                $.get(finalURL, function(response) {
                    let i = response.from;
                    $('.user-management-detials').html('');
                    $('.user-management-main-table').html('Total no. of User : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.user-management-detials').append('<tr>\
                        <td class="border border-primary">' + i++ + '</td>\
                        <td class="border border-primary">' + value["name"] + '</td>\
                        <td class="border border-primary">' + value["email"] + '</td>\
                        <td class="border border-primary">' + value["mobile_number"] + '</td>\
                        <td class="border border-primary"><a name="viewUser"  data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewUser"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td class="border border-primary"><a name="editUser" onclick="myvalidation()" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editUser"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td class="border border-primary"><a name="delUser" data-toggle="modal" data-target="#removeModal" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                    });
                    $('.user-management-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.user-management-pagination-refs').append(
                            '<li id="user_management_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '" ><a href="' + value['url'] + '" class="page-link" >' + value["label"] + '</a></li>'
                        );
                    });
                });
                return false;
            });
        });
        // end here    


        // edit user details
        $(document).on("click", "a[name = 'editUser']", function(e) {
            let id = $(this).data("id");
            viewUserDetials(id);

            function viewUserDetials(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-EditUser')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        jQuery.each(response, function(key, value) {
                            $('#editUserFormId').val(value["id"]);
                            $('#usernameEdit').val(value["name"]);
                            $('#phonnumberEdit').val(value["phone_number"]);
                            $('#mobilenumberEdit').val(value["mobile_number"]);
                            $('#emailidEdit').val(value["email"]);
                            const rights = value["assigned_modules"];
                            const rightsArr = rights.split(/\s*,\s*/);
                            (jQuery.inArray('all', rightsArr) != -1) ? $('#accessToAllEdit').prop('checked', true): $('#accessToAllEdit').prop('checked', false);
                            (jQuery.inArray('staffmanagement', rightsArr) != -1) ? $('#staffManagementEdit').prop('checked', true): $('#staffManagementEdit').prop('checked', false);
                            (jQuery.inArray('timesheet', rightsArr) != -1) ? $('#timesheetEdit').prop('checked', true): $('#timesheetEdit').prop('checked', false);
                            (jQuery.inArray('projectmanagement', rightsArr) != -1) ? $('#projectManagementEdit').prop('checked', true): $('#projectManagementEdit').prop('checked', false);
                            (jQuery.inArray('crm', rightsArr) != -1) ? $('#crmEdit').prop('checked', true): $('#crmEdit').prop('checked', false);
                            (jQuery.inArray('reports', rightsArr) != -1) ? $('#reportsEdit').prop('checked', true): $('#reportsEdit').prop('checked', false);

                        });
                    }
                });
            }
        });

        // view customer details
        $(document).on("click", "a[name = 'viewUser']", function(e) {
            let id = $(this).data("id");
            viewCustomerInfo(id);
            function viewCustomerInfo(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-ViewUser')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        jQuery.each(response, function(key, value) {
                            $('#usernameView').val(value["name"]);
                            $('#phonnumberView').val(value["phone_number"]);
                            $('#mobilenumberView').val(value["mobile_number"]);
                            $('#emailidView').val(value["email"]);
                            const rights = value["assigned_modules"];
                            const rightsArr = rights.split(/\s*,\s*/);
                            (jQuery.inArray('staffmanagement', rightsArr) != -1) ? $('#staffManagementView').prop('checked', true): $('#staffManagementView').prop('checked', false);
                            (jQuery.inArray('timesheet', rightsArr) != -1) ? $('#timesheetView').prop('checked', true): $('#timesheetView').prop('checked', false);
                            (jQuery.inArray('projectmanagement', rightsArr) != -1) ? $('#projectManagementView').prop('checked', true): $('#projectManagementView').prop('checked', false);
                            (jQuery.inArray('crm', rightsArr) != -1) ? $('#crmView').prop('checked', true): $('#crmView').prop('checked', false);
                            (jQuery.inArray('reports', rightsArr) != -1) ? $('#reportsView').prop('checked', true): $('#reportsView').prop('checked', false);

                        });
                    }
                });
            }
        });

        // delete a single user detials using id
        $(document).on("click", "a[name = 'delUser']", function(e) {
            let id = $(this).data("id");
            delUserId(id);

            function delUserId(id) {
                bootbox.confirm(" DO YOU WANT TO DELETE?", function(result) {
                    if (result) {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('SA-DeleteUser')}}",
                            data: {
                                'id': id,
                            },
                            success: function(result) {
                                successMsg(result.success);
                                $("#removeModal .close").click();
                                getUserDetails();
                            }
                        });
                    }
                })
            }
        });

        
    </script>
    
    @endsection