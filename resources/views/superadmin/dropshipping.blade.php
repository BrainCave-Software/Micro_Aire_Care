@extends('superadmin.layouts.master')
@section('title','Drop Shipping | Micro-Air')
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
                    Drop Shipping
                </h4>
                <div class="d-flex">
                    <a href="#" class="btn btn-sm ml-3 btn-primary" data-toggle="modal" data-target="#addShipping"> Add Shipping </a>
                </div>
            </div>

            <!-- alert section -->
            <div class="alert alert-success" id="delDeliveryAlert" style="display:none"></div>
            <!-- alert section end-->

            <!-- table start -->
            <div class="table-responsive-sm border border-secondary" style="overflow-x:scroll;">
                <table class="table text-center border">
                    <caption class="drop-management-main-table text-primary fw-bold"></caption>
                    <thead>
                        <tr>
                            <th class="p-2 border border-secondary">Sr. No.</th>
                            <th class="p-2 border border-secondary">Customer</th>
                            <th class="p-2 border border-secondary">Vendor</th>
                            <th class="p-2 border border-secondary">Initial Address</th>
                            <th class="p-2 border border-secondary">Final Address</th>
                            <th class="p-2 border border-secondary">Date</th>
                            <th class="p-2 border border-secondary">Status</th>
                            <th class="p-2 border border-secondary">Payment Status</th>
                            <th class="p-2 border border-secondary" colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="shippingbody">

                    </tbody>
                </table>
            </div>
            <ul class="drop-management-pagination-refs pagination pagination-referece-css justify-content-center"></ul>
            <!-- table end here -->
        </div>

        <!-- Add dropshipping Model -->
        @include('superadmin.dropshipping.addShipping')
        <!-- end model here -->

        <!-- Edit dropshipping Model -->
        @include('superadmin.dropshipping.editShipping')
        <!-- end model here -->

        <!-- View dropshipping Model -->
        @include('superadmin.dropshipping.viewShipping')
        <!-- end model here -->

    </div>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- backend js file -->

    <script>
        jQuery(document).ready(function() {
            getShippings();
        });

        // All Product Details
        function getShippings() {
            $.ajax({
                type: "GET",
                url: "{{ route('SA-GetShippings') }}",
                success: function(response) {
                    let i = 0;
                    console.log(response);
                    jQuery('.shippingbody').html('');
                    $('.drop-management-main-table').html('Total no. of Dropshipping : ' + response.total);
                    jQuery.each(response.data, function(key, value) {

                        $('.shippingbody').append('<tr>\
                        <td class="p-2 border border-secondary">' + ++i + '</td>\
                        <td class="p-2 border border-secondary">' + value["customer"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["merchant"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["pickup_address"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["delivery_address"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["date"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["status"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["payment_status"] + '</td>\
                        <td class="p-2 border border-secondary"><a name="viewshipping"  data-toggle="modal" data-id="' + value["id"] + '"  data-target=".viewShipping"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td class="p-2 border border-secondary"><a name="editshipping" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editShipping"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td  class="p-2 border border-secondary"><a name="deleteshipping" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                    });
                    $('.drop-management-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.drop-management-pagination-refs').append(
                            '<li id="drop_management_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '" ><a href="' + value['url'] + '" class="page-link" >' + value["label"] + '</a></li>'
                        );
                    });
                }
            });
        }
        // End function here

        // pagination links css and access page
        $(function() {
            $(document).on("click", "#drop_management_pagination a", function() {
                //get url and make final url for ajax
                var url = $(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append;


                $.get(finalURL, function(response) {
                    let i = response.from;

                    $('.shippingbody').html('');
                    $('.drop-management-main-table').html('Total no. of Dropshipping : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.shippingbody').append('<tr>\
                        <td class="border border-primary">' + i++ + '</td>\
                        <td class="p-2 border border-secondary">' + value["customer"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["product"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["varient"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["category"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["merchant"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["initial_address"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["final_address"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["deliveryman"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["date"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["status"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["payment_status"] + '</td>\
                        <td class="border border-primary"><a name="viewUser"  data-toggle="modal" data-id="' + value["id"] + '"  data-target="#viewUser"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td class="border border-primary"><a name="editUser" onclick="myvalidation()" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editUser"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td class="border border-primary"><a name="delUser" data-toggle="modal" data-target="#removeModal" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                    });
                    $('.drop-management-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.drop-management-pagination-refs').append(
                            '<li id="drop_management_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '" ><a href="' + value['url'] + '" class="page-link" >' + value["label"] + '</a></li>'
                        );
                    });
                });
                return false;
            });
        });
        // end here

        // get a single product
        $(document).on("click", "a[name = 'editshipping']", function(e) {
            let id = $(this).data("id");
            getShipping(id);

            function getShipping(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-GetShipping')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        jQuery.each(response, function(key, value) {
                            $('#editShippingId').val(value["id"]);
                            $('#editShippingContactId').val(value["customer"]);
                            $('#editShippingOrderId').val(value["order_no"]);
                            $('#editMobileId').val(value["mobile"]);
                            $('#getmerchantShip').val(value["merchant"]);
                            $('#initial_addressShip').val(value["pickup_address"]);
                            $('#final_addressShip').val(value["delivery_address"]);
                            $('#dateShip').val(value["date"]);
                            $('#statusShip').val(value["status"]);
                            $('#payment_statusShip').val(value["payment_status"]);

                            let sno = 0;
                            let str = value["product"];

                            let obj = JSON.parse(str);

                            jQuery.each(obj, function(key, value) {


                                $('#productTableShipping').append('<tr class="child">\
                            <td>' + ++sno + '</td>\
                            <td class="product_idDelivery" style="display:none;" >' + value["product_Id"] + '</td>\
                            <td class="product_nameDelivery">' + value["product_name"] + '</td>\
                            <td class="product_categoryDelivery">' + value["category"] + '</td>\
                            <td class="product_varientDelivery">' + value["product_varient"] + '</td>\
                            <td class="product_descDelivery">' + value["description"] + '</td>\
                            <td class="product_quantityDelivery">' + value["quantity"] + '</td>\
                            <td class="unit_priceDelivery">' + value["unitPrice"] + '</td>\
                            <td class="taxesDelivery" style="display:none;" >' + value["taxes"] + '</td>\
                            <td class="subtotalDelivery">' + value["subTotal"] + '</td>\
                            <td class="netAmountDelivery">' + value["netAmount1"] + '</td>\
                            <td>\
                                 <a href="javascript:void(0);" class="remCF1deliveryQE">\
                                            <i class="mdi mdi-delete"></i>\
                            </a>\
                            </td>\
                            </tr>');



                            });
                            if ($('#taxIncludeQEdit').prop('checked')) {} else {
                                $('#gstQE').style('display', 'none');
                            }

                            jQuery("#delQuotationAlert").hide();
                            jQuery(".alert-danger").hide();
                            jQuery("#addQuotationAlert").hide();
                            jQuery("#editQuotationAlert").hide();
                        });
                    }
                });
            }
        });

        // delete a single product using id
        $(document).on("click", "a[name = 'deleteshipping']", function(e) {
            let id = $(this).data("id");
            getShipping(id);

            function getShipping(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-RemoveShipping')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        jQuery("#delShippingAlert").show();
                        jQuery("#delShippingAlert").html(response.success);
                        getShippings();
                        $("# .close").click();
                    }
                });
            }
        });

        // view a single product using id
        $(document).on("click", "a[name = 'viewshipping']", function(e) {
            let id = $(this).data("id");
            getShipping(id);

            function getShipping(id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('SA-ViewShipping')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        jQuery.each(response, function(key, value) {
                            $('#ViewDropshipping').val(value["customer"]);
                            $('#viewShippingOrder_no').val(value["order_no"]);
                            $('#viewMobile').val(value["mobile"]);
                            $('#viewgetmerchantShip').val(value["merchant"]);
                            $('#viewinitial_addressShip').val(value["pickup_address"]);
                            $('#viewfinal_addressShip').val(value["delivery_address"]);
                            $('#viewdateShip').val(value["date"]);
                            $('#viewstatusShip').val(value["status"]);
                            $('#viewpayment_statusShip').val(value["payment_status"]);

                            let sno = 0;
                            let str = value["product"];

                            let obj = JSON.parse(str);

                            jQuery.each(obj, function(key, value) {


                                $('#viewproductTableShipping').append('<tr class="child">\
                            <td>' + ++sno + '</td>\
                            <td class="product_idDelivery" style="display:none;" >' + value["product_Id"] + '</td>\
                            <td class="product_nameDelivery">' + value["product_name"] + '</td>\
                            <td class="product_categoryDelivery">' + value["category"] + '</td>\
                            <td class="product_varientDelivery">' + value["product_varient"] + '</td>\
                            <td class="product_descDelivery">' + value["description"] + '</td>\
                            <td class="product_quantityDelivery">' + value["quantity"] + '</td>\
                            <td class="unit_priceDelivery">' + value["unitPrice"] + '</td>\
                            <td class="taxesDelivery" style="display:none;" >' + value["taxes"] + '</td>\
                            <td class="subtotalDelivery">' + value["subTotal"] + '</td>\
                            <td class="netAmountDelivery">' + value["netAmount1"] + '</td>\
                            <td>\
                                 <a href="javascript:void(0);" class="remCF1deliveryQE">\
                                            <i class="mdi mdi-delete"></i>\
                            </a>\
                            </td>\
                            </tr>');



                            });
                            if ($('#taxIncludeQEdit').prop('checked')) {} else {
                                $('#gstQE').style('display', 'none');
                            }

                            jQuery("#delQuotationAlert").hide();
                            jQuery(".alert-danger").hide();
                            jQuery("#addQuotationAlert").hide();
                            jQuery("#editQuotationAlert").hide();
                        });
                    }
                });
            }


        });
        $(document).on('click', '.remCF1deliveryQE', function() {
        $(this).parent().parent().remove();
        calculate();
        $('#viewProductTable tr').each(function(i) {
            $($(this).find('td')[0]).html(i + 1);
        });
    });
    </script>
    <div class="modal fade" id="removeModalBusinessManagement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabe">Confirm Alert</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">DO YOU WANT TO DELETE?<span id="removeElementId"></span> </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">NO</button>
                <a name="removeConfirmDelivery" class="btn btn-primary" id="confirmRemoveSelectedDelivery">
                    YES
                </a>
            </div>
        </div>
    </div>
    
</div>
    @endsection