@extends('superadmin.layouts.master')
@section('title','Task Management | Micro-Air')
@section('body')
<!-- sales css file -->
<link rel="stylesheet" href="{{ asset('inventorybackend/css/style.css')}}" />
<!-- sales js file -->
<script src="{{ asset('inventorybackend/js/action.js')}}"></script>

<div class="main-panel">
    <div class="content-wrapper pb-0">

        <div class="p-3">
            <div class="page-header flex-wrap">
                <h4 class="mb-0">
                    Task Management
                </h4>
                <div class="d-flex">
                    <a href="#" class="btn btn-sm ml-3 btn-primary" data-toggle="modal" data-target="#addTask"> Add Task </a>
                </div>
            </div>

            <!-- alert section -->
            <div class="alert alert-success" id="delTaskAlert" style="display:none"></div>
            <!-- alert section end-->

            <!-- table start -->
            <div class="table-responsive-sm border border-secondary" style="overflow-x:scroll;">
                <table class="table text-center border">
                    <caption class="task-management-main-table text-primary fw-bold"></caption>
                    <thead>
                        <tr class="col" style="border: 2px ridge blue;">
                            <th class="p-2 border border-secondary">Sr. No.</th>
                            <th class="p-2 border border-secondary">Task Name</th>
                            <th class="p-2 border border-secondary">Assigned To</th>
                            <th class="p-2 border border-secondary">Start Time</th>
                            <th class="p-2 border border-secondary">End Time</th>
                            <th class="p-2 border border-secondary">Status</th>
                            <th class="p-2 border border-secondary" colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="taskbody">

                    </tbody>
                </table>
            </div>
            <ul class="task-management-pagination-refs pagination pagination-referece-css justify-content-center"></ul>
            <!-- table end here -->
        </div>

        <!-- Add taskmanagement Model -->
        @include('superadmin.taskmanagement.addTask')
        <!-- end model here -->

        <!-- Edit taskmanagement Model -->
        @include('superadmin.taskmanagement.editTask')
        <!-- end model here -->

        <!-- View taskmanagement Model -->
        @include('superadmin.taskmanagement.viewTask')
        <!-- end model here -->

    </div>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- backend js file -->

    <script>
        jQuery(document).ready(function() {
            getTasks();
        });

        // All Product Details
        function getTasks() {
            $.ajax({
                type: "GET",
                url: "{{ route('SA-GetTasks') }}",
                success: function(response) {
                    let i = 0;
                    $('.taskbody').html('');
                    $('.task-management-main-table').html('Total no. of Tasks : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.taskbody').append('<tr>\
                        <td class="p-2 border border-secondary">' + ++i + '</td>\
                        <td class="p-2 border border-secondary">' + value["task_name"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["assigned_to"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["start_time"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["end_time"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["status"] + '</td>\
                        <td class="p-2 border border-secondary"><a name="viewtask"  data-toggle="modal" data-id="' + value["id"] + '"  data-target=".viewTask"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td class="p-2 border border-secondary"><a name="edittask" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editTask"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td  class="p-2 border border-secondary"><a name="deletetask" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                    });
                    $('.task-management-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.task-management-pagination-refs').append(
                            '<li id="task_management_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '" ><a href="' + value['url'] + '" class="page-link" >' + value["label"] + '</a></li>'
                        );
                    });
                }
            });
        }
        // End function here

        // pagination links css and access page
        $(function() {
            $(document).on("click", "#task_management_pagination a", function() {
                //get url and make final url for ajax
                var url = $(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append;


                $.get(finalURL, function(response) {
                    let i = response.from;

                    $('.taskbody').html('');
                    $('.task-management-main-table').html('Total no. of products : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.taskbody').append('<tr>\
                        <td class="border border-primary">' + i++ + '</td>\
                        <td class="p-2 border border-secondary">' + value["task_name"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["assigned_to"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["start_time"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["end_time"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["status"] + '</td>\
                        <td class="border border-primary"><a name="viewUser"  data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewUser"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td class="border border-primary"><a name="editUser" onclick="myvalidation()" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editUser"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td class="border border-primary"><a name="delUser" data-toggle="modal" data-target="#removeModal" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                    });
                    $('.task-management-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.task-management-pagination-refs').append(
                            '<li id="task_management_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '" ><a href="' + value['url'] + '" class="page-link" >' + value["label"] + '</a></li>'
                        );
                    });
                });
                return false;
            });
        });
        // end here

        // get a single product
        $(document).on("click", "a[name = 'edittask']", function(e) {
            let id = $(this).data("id");
            getTask(id);

            function getTask(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-GetTask')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        jQuery.each(response, function(key, value) {
                            $('#editTaskId').val(value["id"]);
                            $('#edittask_name').val(value["task_name"]);
                            $('#editassigned_to').val(value["assigned_to"]);
                            $('#editstart_time').val(value["start_time"]);
                            $('#editend_time').val(value["end_time"]);
                            $('#editstatus').val(value["status"]);
                        });
                    }
                });
            }
        });

        // delete a single product using id
        $(document).on("click", "a[name = 'deletetask']", function(e) {
            let id = $(this).data("id");
            getTask(id);

            function getTask(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-RemoveTask')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        jQuery("#delTaskAlert").show();
                        jQuery("#delTaskAlert").html(response.success);
                        getTasks();
                    }
                });
            }
        });

        // view a single product using id
        $(document).on("click", "a[name = 'viewtask']", function(e) {
            let id = $(this).data("id");
            getTask(id);

            function getTask(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-ViewTask')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        jQuery.each(response, function(key, value) {
                            $('#viewtask_name').val(value["task_name"]);
                            $('#viewassigned_to').val(value["assigned_to"]);
                            $('#viewstart_time').val(value["start_time"]);
                            $('#viewend_time').val(value["end_time"]);
                            $('#viewstatus').val(value["status"]);
                        });
                    }
                });
            }
        });
    </script>
    @endsection