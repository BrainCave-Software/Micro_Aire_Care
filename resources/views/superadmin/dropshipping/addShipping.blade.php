<div class="modal fade" id="addShipping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lgs" role="document">
        <div class="modal-content bg-white p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Shipping</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" id="addShippingForm1" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-body">

                    <!-- info & alert section -->
                    <div class="alert alert-success" id="addShippingAlert" style="display:none"></div>
                    <div class="alert alert-danger" style="display:none">
                        <ul></ul>
                    </div>
                    <!-- end -->

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="order_no">Order No. <span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="ShippingOrder_no" class="form-control" onchange="fetchOrdersDetailsShipping()" id="selectShippingOrder_no">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="customer_name">Customer Name <span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="shippingCustomerId" name="customer" placeholder="Customer Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mobile_no">Mobile No. <span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="shippingMobile" name="ShippingMobile_no" placeholder="mobile_no" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="due_date">Due Date <span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="shippingDateId" name="shippingDateName" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pickup">Pickup Address <span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="pickupId" name="pickupAddress" placeholder="Pickup Address" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="delivery">Delivery Address <span style="color:red;">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="deliveryId" name="DeliveryName" placeholder="Delivery Address" />
                                    </div>
                                </div>
                            </div>
                            <!-- product details -->
                            <div class="form-group row" style="display: none;">

                                <div class="col-sm-9">
                                    <textarea name="product" class="form-control" id="shippingProductId">

                                    </textarea>
                                </div>
                            </div>
                            <!-- SKU Code -->
                            <div class="form-group row">
                                <label for="getmerchant" class="col-sm-3 col-form-label">Vendor</label>
                                <div class="col-sm-9">
                                    <select name="merchant" class="form-control" id="getmerchant">

                                    </select>
                                </div>
                            </div>
                            <!-- Status -->
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" class="form-control">
                                        <option value="Packing">Packing</option>
                                        <option value="To be delivered">To be delivered</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Payment Status -->
                            <div class="form-group row">
                                <label for="payment_status" class="col-sm-3 col-form-label">Payment Status</label>
                                <div class="col-sm-9">
                                    <select name="payment_status" id="payment_status" class="form-control">
                                        <option value="Pending">Pending</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <fieldset class="border border-secondary p-2">
                                <legend class="float-none w-auto p-2">Product Details</legend>
                                <span style="color:red; font-size:small;" id="createdeliverytableEmptyError"></span>

                                <div class="table-responsive-sm border border-secondary" style="overflow-x:scroll;">
                                    <table class="table text-center border" id="productTableShipping">
                                        <thead>
                                            <tr>
                                                <th>Sl.No</th>
                                                <th>Product Name</th>
                                                <th>Category</th>
                                                <th>Varient</th>
                                                <th>Description</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Gross Amount</th>
                                                <th>Net Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id="productTableBodyShipping"></tbody>
                                    </table>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="addShippingClearBtn">Clear</button>
                    <button type="submit" id="addShippingForm" class="btn btn-primary">Add Shipping</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<!-- backend js file -->

<script>
    // clear form
    jQuery('#addShippingClearBtn').on('click', function() {
        jQuery("#addShippingForm1")["0"].reset();
    });

    // validation script start here
    $(document).ready(function() {

        $.validator.addMethod("validate", function(value) {
            return /[A-Za-z]/.test(value);
        });



        $("#addShippingForm1").validate({
            rules: {

                customer: {
                    required: true,

                },

                ShippingOrder_no: {
                    required: true,
                },

                merchant: {
                    required: true,
                },
                pickupAddress: {
                    required: true,
                },

                DeliveryName: {
                    required: true,

                },

                shippingDateName: {
                    required: true,

                },

            },
            messages: {
                customer: {
                    required: "This field is required.",

                },
                ShippingOrder_no: {
                    required: "This field is required.",
                },
                merchant: {
                    required: "This field is required.",
                },
                pickupAddress: {
                    required: "Address field required.",
                },

                DeliveryName: {
                    required: "Address field required",

                },
                shippingDateName: {
                    required: "This field is required.",
                },
            }

        });
    });
    // end here

    jQuery(document).ready(function() {
        jQuery("#addShippingForm1").submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
            jQuery.ajax({
                url: "{{ route('SA-AddShipping') }}",
                data: jQuery("#addShippingForm1").serialize(),
                enctype: "multipart/form-data",
                type: "post",

                success: function(result) {
                    if (result.error != null) {
                        jQuery(".alert-danger>ul").html(
                            "<li> Info ! Please complete below mentioned fields : </li>"
                        );
                        jQuery.each(result.error, function(key, value) {
                            jQuery(".alert-danger").show();
                            jQuery(".alert-danger>ul").append(
                                // "<li>" + key + " : " + value + "</li>"
                            );
                        });
                    } else if (result.barerror != null) {
                        jQuery("#addShippingAlert").hide();
                        jQuery(".alert-danger").show();
                        jQuery(".alert-danger").html(result.barerror);
                    } else if (result.success != null) {
                        jQuery(".alert-danger").hide();
                        jQuery("#addShippingAlert").html(result.success);
                        jQuery("#addShippingAlert").show();
                        jQuery("#addShippingForm1")["0"].reset();
                        getShippings();
                    } else {
                        jQuery(".alert-danger").hide();
                        jQuery("#addShippingAlert").hide();
                    }
                },
            });
        });
    });
    // get  orders id list
    getCustomerInvoice();

    function getCustomerInvoice() {
        $.ajax({
            type: "GET",
            url: "{{ route('SA-CustomerList')}}",
            success: function(response) {
                console.log(response);
                $('#selectShippingOrder_no').append('<option value="">Select Customer</option>');
                jQuery.each(response, function(key, value) {
                    $('#selectShippingOrder_no').append(
                        '<option value="' + value["order_id"] + '">\
                    ' + value["order_id"] + '\
                    </option>'
                    );
                });
            }
        });
    }
    

    
    // Throw order id fatch all details
    function fetchOrdersDetailsShipping() {
        let id = this.event.target.value;

        jQuery("#productTableShipping tbody").html('');
        getProductDrop(id);

        //     Auto fill customer details
        function getProductDrop(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('SA-GetProduct')}}",
                data: {
                    "order_id": id
                },
                success: function(response) {
                    jQuery.each(response, function(key, value) {
                        $('#shippingCustomerId').val(value["customer_name"]);
                        $('#editShippingContactId').val(value["customer_name"]);
                        $('#deliveryId').val(value["customer_address"]);
                        $('#final_addressShip').val(value["customer_address"]);
                        $('#shippingProductId').val(value["products_details"]);
                        $('#editShippingProductId').val(value["products_details"]);
                        $('#shippingMobile').val(value["mobile_no"]);
                        $('#editMobileId').val(value["mobile_no"]);
                        $('#shippingDateId').val(value["date"]);
                        $('#dateShip').val(value["date"]);

                        // getFilteredProducts(value["customer_id"]);

                        let sno = 1;


                        
                        let str = value["products_details"];

                        let obj = JSON.parse(str);

                        jQuery.each(obj, function(key, value) {
                            
                            $('#productTableShipping tbody').append('<tr class="child">\
                            <td>' + sno++ + '</td>\
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
                            <td><a href="javascript:void(0);" class="remCF1AddInvoice">\
                                                <i class="mdi mdi-delete"></i>\
                                </a>\
                            </td>\
                        </tr>');



                        });
                    });
                }
            });
        }
    };
    // get all Merchants 
    getMerchant();

    function getMerchant() {
        $.ajax({
            type: "GET",
            url: "",
            success: function(response) {
                $('#getmerchant').append('<option>Select Vendor</option>');
                $('#getmerchantShip').append('<option>Select Vendor</option>');
                jQuery.each(response, function(key, value) {
                    $('#getmerchant').append(
                        '<option value="' + value["vendor_name"] + '">\
                    ' + value["vendor_name"] + '\
                    </option>'
                    );
                    $('#getmerchantShip').append(
                        '<option value="' + value["vendor_name"] + '">\
                    ' + value["vendor_name"] + '\
                    </option>'
                    );
                });
            }
        });
    }
    

    
</script>