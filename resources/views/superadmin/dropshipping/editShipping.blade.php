<div class="modal fade" id="editShipping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lgs" role="document">
        <div class="modal-content bg-white p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" id="editShippingForm1" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-body">

                    <!-- info & alert section -->
                    <div class="alert alert-success" id="editShippingAlert" style="display:none"></div>
                    <div class="alert alert-danger" style="display:none">
                        <ul></ul>
                    </div>
                    <!-- end -->

                    <input type="text" name="id" id="editShippingId" style="display: none;">

                    <div class="card">
                        <div class="card-body">
                            <!-- Choose Customer  -->
                            <div class="form-group row">
                                <label for="order_no" class="col-sm-3 col-form-label">Order No.</label>
                                <div class="col-sm-9">
                                    <select name="editShippingOrderName" class="form-control" id="editShippingOrderId" onchange="fetchOrdersDetailsShipping()">

                                    </select>
                                </div>
                            </div>
                            <!-- name  -->
                            <div class="form-group row">
                                <label for="edit_mobile" class="col-sm-3 col-form-label">Mobile No.</label>
                                <div class="col-sm-9">
                                    <input name="EditMobileName" id="editMobileId"  class="form-control form-control-lg">
                                </div>
                            </div>

                            <!-- Product Varient -->
                            <div class="form-group row">
                                <label for="editShippingContact" class="col-sm-3 col-form-label">Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editShippingContactId" name="editShippingContactName" />
                                </div>
                            </div>

                            

                            <!-- SKU Code -->
                            <div class="form-group row">
                                <label for="getmerchant" class="col-sm-3 col-form-label">Vendor</label>
                                <div class="col-sm-9">
                                    <select name="merchant" class="form-control" id="getmerchantShip">

                                    </select>
                                </div>
                            </div>

                            <!-- Minimum Scale Price -->
                            <div class="form-group row">
                                <label for="initial_address" class="col-sm-3 col-form-label">Initial Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="initial_addressShip" name="initial_address" />
                                </div>
                            </div>

                            <!-- Tax -->
                            <div class="form-group row">
                                <label for="final_address" class="col-sm-3 col-form-label">Final Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="final_addressShip" name="final_address" />
                                </div>
                            </div>

                            <div class="form-group row" style="display: none;">
                                <label for="product" class="col-sm-3 col-form-label">product</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editShippingProductId" name="editShippingProductname" />
                                </div>
                            </div>

                            <!-- Supplier Code -->
                            <div class="form-group row">
                                <label for="date" class="col-sm-3 col-form-label">date</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="dateShip" name="date" />
                                </div>
                            </div>
                            <!-- Status -->
                            <div class="form-group row">
                                <label for="statusShip" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="status" id="statusShip" class="form-control">
                                        <option value="Packing">Packing</option>
                                        <option value="To be delivered">To be delivered</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Payment Status -->
                            <div class="form-group row">
                                <label for="payment_statusShip" class="col-sm-3 col-form-label">Payment Status</label>
                                <div class="col-sm-9">
                                    <select name="payment_status" id="payment_statusShip" class="form-control">
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
                  <tbody id="editproductTableBodyShipping"></tbody>
                </table>
              </div>
            </fieldset>
          </div>
        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="editShippingForm" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- backend js file -->

<script>
    jQuery(document).ready(function() {
        jQuery("#editShippingForm1").submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
            $.ajax({
                url: "{{ route('SA-EditShipping') }}",
                data: jQuery("#editShippingForm1").serialize(),
                type: "post",
                success: function(result) {
                    jQuery(".alert-danger>ul").html(
                        "<li> Info ! Please complete below mentioned fields : </li>"
                    );
                    if (result.error != null) {
                        jQuery.each(result.error, function(key, value) {
                            jQuery(".alert-danger").show();
                            jQuery(".alert-danger>ul").append(
                                "<li>" + key + " : " + value + "</li>"
                            );
                        });
                    } else if (result.barerror != null) {
                        jQuery("#editShippingAlert").hide();
                        jQuery(".alert-danger").show();
                        jQuery(".alert-danger").html(result.barerror);
                    } else if (result.success != null) {
                        jQuery(".alert-danger").hide();
                        jQuery("#editShippingAlert").html(result.success);
                        jQuery("#editShippingAlert").show();
                        jQuery("#editShippingForm1")["0"].reset();
                        getShippings();
                    } else {
                        jQuery(".alert-danger").hide();
                        jQuery("#editShippingAlert").hide();
                    }
                }
            });
        });
    });

    // get customer list
    getCustomerShip();

    function getCustomerShip() {
        $.ajax({
            type: "GET",
            url: "{{ route('SA-CustomerList')}}",
            success: function(response) {
                $('#editShippingOrderId').append('<option value="">Select Customer</option>');
                jQuery.each(response, function(key, value) {
                    $('#editShippingOrderId').append(
                        '<option value="' + value["order_id"] + '">\
                ' + value["order_id"] + '\
                </option>'
                    );
                });
            }
        });
    }
    // get all products
    getProductsInvoice();

    function getProductsInvoice() {
        $.ajax({
            type: "GET",
            url: "{{ route('SA-GetProducts')}}",
            success: function(response) {
                $('#productNameShip').append('<option>Select Product</option>');
                jQuery.each(response, function(key, value) {
                    $('#productNameShip').append(
                        '<option value="' + value["product_name"] + '">\
                ' + value["product_name"] + '\
                </option>'
                    );
                });
            }
        });
    }
    // select products
    function selectFunctionInvoice() {
        let id = this.event.target.id;
        let pro = $('#' + id).val();
        getProductInvoice(pro, id);

        //     get single product details
        function getProductInvoice(pro, id) {
            $.ajax({
                type: "GET",
                url: "{{ route('SA-GetProduct')}}",
                data: {
                    "pro": pro
                },
                success: function(response) {
                    jQuery.each(response, function(key, value) {
                        // variend
                        $('#varientShip').val(value["product_varient"]);
                        $('#categoryShip').val(value["product_category"]);
                    });
                }
            });
        }
    };
    
    
</script>