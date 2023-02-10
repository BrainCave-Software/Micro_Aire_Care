@extends('superadmin.layouts.master')
@section('title','Customer Management | Micro Aire-Care')
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
                    Clients
                </h3>
                <div class="add-items d-flex">
                      <button class="add btn btn-primary font-weight-bold todo-list-add-btn" for="customerManagementFilter" id="searchLabel">Search</button>
                      <input type="text" class="form-control todo-list-input" onkeypress="salesOrdersFilterName()" name="" id="customerManagementFilter" placeholder="Search by  Name">
                      <button class="add btn btn-primary font-weight-bold todo-list-add-btn" id="resetSalesOrdersFilter">Reset</button>
                    </div>
                <!-- <div class="d-flex">
                    <label for="customerManagementFilter" id="searchLabel" class="text-white bg-primary fw-bold">Search </label>
                    <input type="search" onkeypress="salesOrdersFilterName()" name="" id="customerManagementFilter" placeholder="Search by  Name"> -->

                    <!-- Category -->
                    <!-- <select name="" id="selectOrdersStatus" onchange="salesOrdersFilter()" class="form-control m-2 ">
                        <option value="" class="bg-info text-white" style="font-size: small;">Select status</option>
                        <option value="cash on delivery">Cash on delivery</option>
                        <option value="30 days">30 days</option>
                    </select> -->
                    <!-- Reset Filter -->
                    <!-- <a href="#" id="resetSalesOrdersFilter" class="text-white">Reset</a>
                </div> -->
                <div class="d-flex">
                    <a href="#" id="newbutton" data-toggle="modal" data-target="#createCustomerPage"> Create </a>
                    <!-- <a href="#" id="newbutton" onclick="jQuery('delCustomerAlert').hide()" data-toggle="modal" data-target="#createCustomerPage"> Create </a> -->
                </div>
            </div>
            <!-- alert section -->
            <!-- <div class="alert alert-success" id="delCustomerAlert" style="display:none"></div> -->
            <div class="alert alert-success alert-dismissible fade show" id="delCustomerAlert" style="display:none" role="alert">
                <strong>User Detials Removed Succesfully </strong><span id="delCustomerAlertMSG"></span>
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
                        <tr>
                            <th class=" border border-secondary">S/N</th>
                            <th class=" border border-secondary">ID</th>
                            <th class=" border border-secondary">Name</th>
                            <th class=" border border-secondary">Email ID</th>
                            <th class=" border border-secondary">Mobile No.</th>
                            <th class=" border border-secondary">Projects Ongoing</th>
                            <th class=" border border-secondary">Project Completed</th>
                            <th class=" border border-secondary">Status</th>
                            <th class=" border border-secondary" colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody customerlist">

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
        @include('superadmin.customer-modal.createcustomer')
        @include('superadmin.customer-modal.editcustomer')
        @include('superadmin.customer-modal.viewcustomer')



    </div>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- backend js file -->
    <script>
        jQuery(document).ready(function() {
            updateCustomer();


        });
        // All Product Details
        function updateCustomer() {

            $.ajax({
                type: "GET",
                url: "{{ route('SA-ClientsList') }}",
                success: function(response) {
                    let i = 0;
                    jQuery('.customerlist').html('');
                    $('.sales-orders-main-table1').html('Total no. of  Customer : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.customerlist').append(`<tr>
                        <td class=" border border-secondary">${++i} </td>
                        <td class=" border border-secondary">${value["customer_id"]} </td>
                        <td class=" border border-secondary">${value["customer_name"]} </td>
                        <td class=" border border-secondary">${value["customer_email"]} </td>
                        <td class=" border border-secondary">${value["customer_mobile"]} </td>
                        <td class=" border border-secondary">${value["project_ongoing"]} </td>
                        <td class=" border border-secondary"> ${value["project_completed"]}</td>
                        <td class=" border border-secondary"> ${value["customer_status"]} </td>
                        <td class=" border border-secondary"><a name="viewManagement" data-toggle="modal" data-id="${ value["customer_id"]} "  data-target=".viewclient"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td style="display:${value["display"]}" class=" border border-secondary"><a name="editCustomer" data-toggle="modal" data-id="${value["customer_id"]}" data-target="#editCustomer"> <i class="mdi mdi-pencil"></i> </a></td>
                        <td style="display: ${value["display"]}" class=" border border-secondary"><a data-toggle="modal" data-target="#removeCustomer" name="deleteCustomer" data-id="${value["id"]}" > <i class="mdi mdi-delete"></i> </a></td>
                    </tr>`);
                    });

                    $('.sales-orders-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.sales-orders-pagination-refs').append(
                            '<li id="sales_orders_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });


                }
            });
        }
        // End function here
        // pagination links css and access page
        $(function() {
            $(document).on("click", "#sales_orders_pagination a", function() {
                //get url and make final url for ajax 
                var url = $(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append;

                $.get(finalURL, function(response) {
                    let i = response.from;
                    jQuery('.customerlist').html('');
                    $('.sales-orders-main-table1').html('Total no. of Customer : ' + response.total);
                    jQuery.each(response.data, function(key, value) {

                        $('.customerlist').append('<tr>\
                        <td class=" border border-secondary">' + i++ + '</td>\
                        <td class=" border border-secondary">' + value["customer_id"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_name"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_email"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_mobile"] + '</td>\
                        <td class=" border border-secondary">' + value["project_ongoing"] + '</td>\
                        <td class=" border border-secondary">' + value["project_completed"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_status"] + '</td>\
                        <td class=" border border-secondary"><a name="viewManagement" data-toggle="modal" data-id="' + value["customer_id"] + '"  data-target=".viewclient"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editCustomer" data-toggle="modal" data-id="' + value["customer_id"] + '" data-target="#editCustomer"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeCustomer" name="deleteCustomer" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                    });

                    $('.sales-orders-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.sales-orders-pagination-refs').append(
                            '<li id="sales_orders_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });
                });
                return false;
            });
        });
        // end here  
        // Edit customer management - start here
        $(document).on("click", "a[name = 'editCustomer']", function(e) {
            let id = $(this).data("id");
            jQuery("#productTableEditOrdersBody").html('');
            getClientEditInfo(id);

            function getClientEditInfo(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-FatchClients')}}",
                    data: {
                        'customer_id': id,
                    },
                    success: function(response) {
                        jQuery.each(response, function(key, value) {
                            $('#oid').val(value["id"]);
                            $('#nameIdEdit').val(value["customer_name"]);
                            $('#statusIdEdit').val(value["customer_status"]);
                            $('#emailIdEdit').val(value["customer_email"]);
                            $('#mobileIdEdit').val(value["customer_mobile"]);
                            $('#addressIdEdit').val(value["customer_address"]);
                            $('#customerPostalCodeEdit').val(value["customer_postal"]);
                            $('#unitNumberEdit').val(value["unit_number"]);
                            if (value["shipping_type"] == "delivery") {
                                $('#deliveryEdit').prop('checked', true)

                            } else {
                                $('#dropshippingEdit').prop('checked', true)
                            }



                            if (value["tax_inclusive"] === 1) {
                                $('#taxIncludeEditOrders').prop('checked', true);
                            } else {
                                $('#taxIncludeEditOrders').prop('checked', false);
                                $('#gstEOrders').val('');
                            }

                            jQuery("#delCustomerAlert").hide();
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
        $(document).on("click", "a[name = 'viewManagement']", function(e) {
            let id = $(this).data("id");
            getClientViewInfo(id);

            function getClientViewInfo(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-FatchClients')}}",
                    data: {
                        'customer_id': id,
                    },
                    success: function(response) {
                        jQuery.each(response, function(key, value) {
                            $('#clientFileeId').val(value["customer_id"])
                            $('#clientNoteId').val(value["customer_id"])
                            $('#nameView').val(value["customer_name"]);
                            $('#emailIdView').val(value["customer_email"]);
                            $('#phoneNumberView').val(value["customer_mobile"]);
                            $('#addressView').val(value["customer_address"]);
                            $('#customerPostalCodeView').val(value["customer_postal"]);
                            $('#statusIdView').val(value["customer_status"]);




                            jQuery("#delCustomerAlert").hide();
                            jQuery(".alert-danger").hide();
                            jQuery("#addOrdersAlert").hide();
                            jQuery("#editOrdersAlert").hide();

                            //pdf data
                            //$('#orders_pdf_no').html(value["id"]);

                        });
                    }
                });
            }

        });
        // end here 

        // delete a single customer using id
        $(document).on("click", "a[name = 'deleteCustomer']", function(e) {
            let id = $(this).data("id");
            delCustomer(id);

            function delCustomer(id) {
                bootbox.confirm(" DO YOU WANT TO DELETE?", function(result) {
                    if (result) {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('SA-RemoveCustumer')}}",
                            data: {
                                'id': id,
                            },
                            success: function(result) {
                                successMsg(result.success);
                                $("#removeCustomer .close").click();
                                updateCustomer();
                                // jQuery("#delCustomerAlert").show();
                                // jQuery("#delCustomerAlertMSG").html(response.success);
                                // setTimeout(() => {
                                //     jQuery("#delCustomerAlert").hide();

                                // }, 2000);

                            }
                        });
                    }
                })
            }
        });
        // filter orders number
        function salesOrdersFilter() {
            $status = $('#selectOrdersStatus').val();

            $.ajax({
                type: "GET",
                url: "",
                data: {
                    "status": $status,
                },

                success: function(response) {
                    let i = 0;
                    jQuery('.customerlist').html('');
                    jQuery.each(response, function(key, value) {
                        $('.customerlist').append('<tr>\
                        <td class=" border border-secondary">' + ++i + '</td>\
                        <td class=" border border-secondary">' + value["customer_id"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_name"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_email"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_mobile"] + '</td>\
                        <td class=" border border-secondary">' + value["project_ongoing"] + '</td>\
                        <td class=" border border-secondary">' + value["project_completed"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_status"] + '</td>\
                        <td class=" border border-secondary"><a name="viewManagement" data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewCustomer"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editCustomer" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editCustomer"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeCustomer" name="deleteCustomer" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                    });

                }
            });
        }
        // filter
        function salesOrdersFilterName() {
            $user = $('#customerManagementFilter').val();
            $.ajax({
                type: "GET",
                url: "{{ route('SA-FilterCustomerName') }}",
                data: {
                    "user": $user,
                },
                success: function(response) {

                    let i = 0;
                    jQuery('.customerlist').html('');
                    $('.sales-orders-main-table1').html('Total no. of  Customer : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.customerlist').append('<tr>\
                        <td class=" border border-secondary">' + ++i + '</td>\
                        <td class=" border border-secondary">' + value["customer_id"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_name"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_email"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_mobile"] + '</td>\
                        <td class=" border border-secondary">' + value["project_ongoing"] + '</td>\
                        <td class=" border border-secondary">' + value["project_completed"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_status"] + '</td>\
                        <td class=" border border-secondary"><a name="viewManagement" data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewCustomer"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editCustomer" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editCustomer"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeCustomer" name="deleteCustomer" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                    });

                    $('.sales-orders-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.sales-orders-pagination-refs').append(
                            '<li id="search_sales_orders_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });


                }
            });

            // pagination links css and access page
            $(function() {
                $(document).on("click", "#search_sales_orders_pagination a", function() {
                    //get url and make final url for ajax 
                    var url = $(this).attr("href");
                    var append = url.indexOf("?") == -1 ? "?" : "&";
                    var finalURL = url + append;

                    $.get(finalURL, function(response) {
                        let i = 0;


                        jQuery('.customerlist').html('');
                        $('.sales-orders-main-table1').html('TTotal no. of  Customer : ' + response.total);
                        jQuery.each(response.data, function(key, value) {

                            $('.customerlist').append('<tr>\
                            <td class=" border border-secondary">' + ++i + '</td>\
                        <td class=" border border-secondary">' + value["customer_id"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_name"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_email"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_mobile"] + '</td>\
                        <td class=" border border-secondary">' + value["project_ongoing"] + '</td>\
                        <td class=" border border-secondary">' + value["project_completed"] + '</td>\
                        <td class=" border border-secondary">' + value["customer_status"] + '</td>\
                        <td class=" border border-secondary"><a name="viewManagement" data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewCustomer"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a name="editOrders" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editCustomer"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td style="display:' + value["display"] + '" class=" border border-secondary"><a data-toggle="modal" data-target="#removeCustomer" name="deleteCustomer" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                        </tr>');
                        });

                        $('.sales-orders-pagination-refs').html('');
                        jQuery.each(response.links, function(key, value) {
                            $('.sales-orders-pagination-refs').append(
                                '<li id="search_sales_orders_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                            );
                        });
                    });
                    return false;
                });
            });


        }
        // end here  
        $(document).ready(function() {
            $('#resetSalesOrdersFilter').click(function() {
                $('#selectOrdersStatus').prop('selectedIndex', 0);
                updateCustomer();
            });
        });

        // $(document).on("click", "a[name = 'deleteCustomer']", function(e) {
        //     let id = $(this).data("id");
        //     $('#confirmRemoveSelectedCustomer').data('id', id);
        // });
    </script>
    <!-- <div class="modal fade" id="removeCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a name="removeConfirmCustomer" class="btn btn-primary" id="confirmRemoveSelectedCustomer">
                        YES
                    </a>
                </div>
            </div>
        </div>
    </div> -->
    @endsection