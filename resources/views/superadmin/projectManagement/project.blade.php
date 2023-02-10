@extends('superadmin.layouts.master')
@section('title','Projects | Micro Aire-Care')
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
                <h3 class="mb-0">
                    Projects
                </h3>
                <div class="add-items d-flex">
                    <button class="add btn btn-primary font-weight-bold todo-list-add-btn" for="projectIdName" id="searchLabel">Search</button>
                    <input type="text" class="form-control todo-list-input" onkeyup="projectFilterName()" name="" id="projectIdName" placeholder="Search by client">
                    <button class="add btn btn-primary font-weight-bold todo-list-add-btn" id="resetEmployeeFilter">Reset</button>
                </div>

                <div class="d-flex">
                    <a href="#" onclick="jQuery('delProjectAlert').hide()" id="newbutton" class="btn btn-sm ml-3" data-toggle="modal" data-target="#addProject">Add</a>

                </div>

            </div>
            <div class="text-right">
                <label>For Demo File <a href="download">Click to download </a></label>
            </div>


            <!-- table start -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive-sm" style="overflow-x:scroll;">
                                <table class="table text-center table-hover">
                                    <caption class="project-main-table"></caption>
                                    <thead class="fw-bold text-dark">
                                        <tr class="col">
                                            <th>S/N</th>
                                            <th>Job Sheet No</th>
                                            <th>Client</th>
                                            <th>Date</th>
                                            <th>TEL</th>
                                            <th>Status</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody productlistItem">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="project-pagination-refs pagination-referece-css pagination justify-content-center"></ul>
            <!-- table end here -->
        </div>

        <!-- Create  Model -->
        @include('superadmin.projectManagement.project.addproject')
        @include('superadmin.projectManagement.project.editproject')




    </div>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- backend js file -->



    <script>
        // file uploading
        jQuery(document).ready(function() {
            ListProjectFile();
        });

        function ListProjectFile() {

            $.ajax({
                type: "GET",
                url: "{{ route('SA-GetProjectListFile') }}",
                success: function(response) {
                    let i = 0;
                    jQuery('.productlistFile').html('');
                    $('.project-table').html('Total Project : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.productlistFile').append(`<tr>
                    <td class=" border border-secondary">${++i} </td>
                    <td class=" border border-secondary">${value["job_sheet"]} </td>
                    <td class=" border border-secondary">${value["client_name"]} </td>
                    <td class=" border border-secondary">${value["date"]} </td>
                    <td class=" border border-secondary">${value["mobile"]} </td>
                    <td class=" border border-secondary"> ${value["address"]} </td>
                    <td class=" border border-secondary"><a name="viewprojectId"  href="/admin/projectId-edit/${value['customer_id']}"> <i class="mdi mdi-eye"></i> </a></td>\
                </tr>`);
                    });

                    $('.project-pagination123').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.project-pagination123').append(
                            '<li id="project" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });


                }
            });
        }
        // End file uploading function here

        jQuery(document).ready(function() {
            ListProject();
        });
        // All project list
        function ListProject() {

            $.ajax({
                type: "GET",
                url: "{{ route('SA-GetProjectList') }}",
                success: function(response) {
                    let i = 0;
                    jQuery('.productlistItem').html('');
                    $('.project-main-table').html('Total no. of Project : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.productlistItem').append(`<tr>
                    <td class=" border border-secondary">${++i} </td>
                    <td class=" border border-secondary">${value["project_title"]} </td>
                    <td class=" border border-secondary">${value["clientExcel_name"]} </td>
                    <td class=" border border-secondary">${value["deadline"]} </td>
                    <td class=" border border-secondary">${value["mobile"]} </td>
                    <td class=" border border-secondary"> ${value["status"]} </td>
                    <td class=" border border-secondary"><a name="viewproject" href="/admin/project-edit/${value['project_id']}"> <i class="mdi mdi-eye"></i> </a></td>\
                    <td style="display: ${value["display"]}" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalProject" name="deleteproject" data-id="${value["id"]}" > <i class="mdi mdi-delete"></i> </a></td>
                    </tr>`);
                    });

                    $('.project-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.project-pagination-refs').append(
                            '<li id="project_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });


                }
            });
        }
        // End function here
        // pagination links css and access page
        $(function() {
            $(document).on("click", "#project_pagination a", function() {
                //get url and make final url for ajax 
                var url = $(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append;

                $.get(finalURL, function(response) {
                    let i = response.from;
                    jQuery('.productlistItem').html('');
                    $('.project-main-table').html('Total no. of Project : ' + response.total);
                    jQuery.each(response.data, function(key, value) {

                        $('.productlistItem').append(`<tr>
                    <td class=" border border-secondary">${i++ }</td>
                    <td class=" border border-secondary">${ value["project_title"] }</td>
                    <td class=" border border-secondary">${value["clientExcel_name"] }</td>
                    <td class=" border border-secondary">${ value["deadline"] }</td>
                    <td class=" border border-secondary">${ value["mobile"] }</td>
                    <td class=" border border-secondary">${ value["status"] }</td>
                    <td class=" border border-secondary"><a name="viewproject"  href="/admin/project-edit/${value['project_id']}"> <i class="mdi mdi-eye"></i> </a></td>\
                    <td style="display: ${value["display"]}" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalProject" name="deleteproject" data-id="${value["id"]}" > <i class="mdi mdi-delete"></i> </a></td>
                </tr>`);
                    });

                    $('.project-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.project-pagination-refs').append(
                            '<li id="project_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });
                });
                return false;
            });
        });
        
        // Edit Project - start here
        $(document).on("click", "a[name = 'viewprojectId']", function(e) {
            let id = $(this).data("id");
            getProductEdit(id);

            function getProductEdit(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-FatchProjectEditTest')}}",
                    data: {
                        'customer_id': id,
                    },
                    success: function(response) {
                        jQuery.each(response, function(key, value) {
                            $('#projectId').val(value["id"]);
                            $('#editprojectTitle').val(value["project_title"]);

                        });
                    }
                });
            }
        });
        // end here
        // view individuals Exel Id
        $(document).on("click", "a[name = 'viewprojectId']", function(e) {
            console.log(234);
            let id = $(this).data("id");
            getprojectView(id);

            function getprojectView(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-FatchProject')}}",
                    data: {
                        'customer_id': id,
                    },
                    success: function(response) {
                        jQuery.each(response, function(key, value) {
                            $('#projectFileeId').val(value["customer_id"]);
                            $('#projectNoteId').val(value["customer_id"]);
                            $('#viewprojectTitleHead').val(value["project_title"]);
                            $('#viewprojectTitle').val(value["project_title"]);
                            $('#viewclientName').val(value["client_name"]);
                            $('#viewstartDate').val(value["start_date"]);
                            $('#viewdeadline').val(value["deadline"]);
                            $('#viewassignTo').val(value["assign_to"]);
                            $('#viewmanager').val(value["manager"]);

                            jQuery("#delProjectAlert").hide();
                            jQuery(".alert-danger").hide();
                            jQuery("#addOrdersAlert").hide();
                            jQuery("#editOrdersAlert").hide();


                        });
                    }
                });
            }
        });
        // end here 
        // view individuals orders
        $(document).on("click", "a[name = 'viewproject']", function(e) {
            let id = $(this).data("id");
            getprojectView(id);

            function getprojectView(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-FatchProject')}}",
                    data: {
                        'customer_id': id,
                    },
                    success: function(response) {
                        jQuery.each(response, function(key, value) {
                            $('#projectFileeId').val(value["customer_id"]);
                            $('#projectNoteId').val(value["customer_id"]);
                            $('#viewprojectTitle').val(value["project_title"]);
                            $('#viewclientName').val(value["client_name"]);
                            $('#viewstartDate').val(value["start_date"]);
                            $('#viewdeadline').val(value["deadline"]);
                            $('#viewassignTo').val(value["assign_to"]);
                            $('#viewmanager').val(value["manager"]);

                            jQuery("#delProjectAlert").hide();
                            jQuery(".alert-danger").hide();
                            jQuery("#addOrdersAlert").hide();
                            jQuery("#editOrdersAlert").hide();


                        });
                    }
                });
            }
        });
        // end here 

        // delete a single orders using id
        $(document).on("click", "a[name = 'deleteproject']", function(e) {
            let id = $(this).data("id");
            delOrders(id);

            function delOrders(id) {
                bootbox.confirm(" DO YOU WANT TO DELETE?", function(result) {
                    if (result) {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('SA-RemoveProject')}}",
                            data: {
                                'id': id,
                            },
                            success: function(result) {
                                successMsg(result.success);
                                ListProject();
                                ListProjectFile();
                                $("#removeModalProject .close").click();

                            }
                        });
                    }
                })
            }
        });
        // filter orders number
        // function projectFilterName() {
        //     $status = $('#projectIdName').val();
        //     $.ajax({
        //         type: "GET",
        //         url: "",
        //         data: {
        //             "status": $status,
        //         },
        //         success: function(response) {
        //             let i = 0;
        //             jQuery('.productlist').html('');
        //             jQuery.each(response, function(key, value) {
        //                 $('.productlist').append('<tr>\
        //             <td class=" border border-secondary">' + ++i + '</td>\
        //             <td class=" border border-secondary">' + value["customer_id"] + '</td>\
        //             <td class=" border border-secondary">' + value["customer_name"] + '</td>\
        //             <td class=" border border-secondary">' + value["customer_mobile"] + '</td>\
        //             <td class=" border border-secondary">' + value["customer_email"] + '</td>\
        //             <td class=" border border-secondary">' + value["project_ongoing"] + '</td>\
        //             <td class=" border border-secondary">' + value["project_completed"] + '</td>\
        //             <td class=" border border-secondary">' + value["customer_status"] + '</td>\
        //             <td class=" border border-secondary"><a name="viewManagement" data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewCustomer"> <i class="mdi mdi-eye"></i> </a></td>\
        //             <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editCustomer" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editCustomer"> <i class="mdi mdi-pencil"></i> </a></td>\
        //             <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalProject" name="deleteproject" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
        //         </tr>');
        //             });
        //         }
        //     });
        // }
        // filter
        function projectFilterName() {
            $user = $('#projectIdName').val();
            $.ajax({
                type: "GET",
                url: "{{route('SA-FilterProjectName')}}",
                data: {
                    "user": $user,
                },
                success: function(response) {

                    let i = 0;
                    jQuery('.productlistItem').html('');
                    $('.project-main-table').html('Total No : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.productlistItem').append(`<tr>
                    <td class=" border border-secondary">${++i} </td>
                    <td class=" border border-secondary">${value["project_title"]} </td>
                    <td class=" border border-secondary">${value["clientExcel_name"]} </td>
                    <td class=" border border-secondary">${value["deadline"]} </td>
                    <td class=" border border-secondary">${value["mobile"]} </td>
                    <td class=" border border-secondary">${value["status"]} </td>
                    <td class=" border border-secondary"><a name="viewproject" href="/admin/project-edit/${value['project_id']}"> <i class="mdi mdi-eye"></i> </a></td>\
                    <td style="display: ${value["display"]}" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalProject" name="deleteproject" data-id="${value["id"]}" > <i class="mdi mdi-delete"></i> </a></td>
                </tr>`);
                    });

                    $('.project-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.project-pagination-refs').append(
                            '<li id="project_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });


                }
            });

            // pagination links css and access page
            $(function() {
                $(document).on("click", "#project_pagination a", function() {
                    //get url and make final url for ajax 
                    var url = $(this).attr("href");
                    var append = url.indexOf("?") == -1 ? "?" : "&";
                    var finalURL = url + append;

                    $.get(finalURL, function(response) {
                        let i = 0;


                        jQuery('.productlist').html('');
                        $('.').html('Total No : ' + response.total);
                        jQuery.each(response.data, function(key, value) {

                            $('.productlist').append(`<tr>
                        <td class=" border border-secondary">' + ++i + '</td>
                    <td class=" border border-secondary">${value["project_title"]} </td>
                    <td class=" border border-secondary">${value["clientExcel_name"]} </td>
                    <td class=" border border-secondary">${value["deadline"]} </td>
                    <td class=" border border-secondary">${value["mobile"]} </td>
                    <td class=" border border-secondary"> ${value["status"]} </td>
                    <td class=" border border-secondary"><a name="viewproject" href="/admin/project-edit/${value['project_id']}"> <i class="mdi mdi-eye"></i> </a></td>\
                    <td style="display: ${value["display"]}" class=" border border-secondary"><a data-toggle="modal" data-target="#removeModalProject" name="deleteproject" data-id="${value["id"]}" > <i class="mdi mdi-delete"></i> </a></td>
                    </tr>`);
                        });

                        $('.project-pagination-refs').html('');
                        jQuery.each(response.links, function(key, value) {
                            $('.project-pagination-refs').append(
                                '<li id="project_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                            );
                        });
                    });
                    return false;
                });
            });
            // end here  

        }
        $(document).ready(function() {
            $('#resetProjectFilter').click(function() {
                $('#selectProjectStatus').prop('selectedIndex', 0);
                ListProject();
            });
        });

        $(document).on("click", "a[name = 'deleteproject']", function(e) {
            let id = $(this).data("id");
            $('#confirmRemoveSelectedProject').data('id', id);
        });

        // validation with add data
        $(document).ready(function() {
            jQuery('#createProjectFileForm').submit(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                });
            }).validate({
                rules: {

                },
                message: {

                },
                submitHandler: function() {
                    const formData = new FormData($('#createProjectFileForm')["0"]);
                    jQuery.ajax({
                        url: "{{ route('SA-CreateProjectFile') }}",
                        enctype: "multipart/form-data",
                        type: "post",
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(result) {
                            console.log('ch', result);
                            if (result.error != null) {
                                jQuery(".salesQuantityError").hide();
                            } else if (result.barerror != null) {
                                errorMsg(result.barerror);
                                jQuery(".salesQuantityError").hide();
                            } else if (result.success != null) {
                                successMsg(result.success);
                                jQuery("#createProjectFileForm")["0"].reset();
                                ListProjectFile();
                                getfiles($('#clientFileeId').val());
                            } else if (result.salesQuantityError != null) {} else {}

                        },
                    });
                }
            })
        });

        $(document).ready(function() {
            $('#resetEmployeeFilter').click(function() {
                ListProject();
            });
        });
    </script>



    @endsection