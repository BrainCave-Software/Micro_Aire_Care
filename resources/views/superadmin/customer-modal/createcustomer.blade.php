<!-- Modal -->
<div class="modal fade" id="createCustomerPage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-2">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Client </h5>
                <button type="button" id="closeCustomerAdd" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" id="createCustomerForm">
                <div class="modal-body bg-white px-3">
                    <!-- customer management body start here -->

                    <!-- info & alert section -->
                    <!-- <div class="alert alert-success" id="addQuotationAlert" style="display:none"></div>
                    <div class="alert alert-danger" id="addCustomerAlertDangerMSG" style="display:none">

                    </div> -->
                    <!-- end -->

                    <!-- info & alert section -->
                    <!-- <div class="alert alert-success alert-dismissible fade show" id="addQuotationAlert" style="display:none" role="alert">
                        <span id="addQuotationAlertMSG"></span>
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->

                    <!-- <div class="alert alert-danger alert-dismissible fade show" id="addCustomerAlertDanger" style="display:none" role="alert">
                        <span id="addCustomerAlertDangerMSG"></span>
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->
                    <!-- end -->
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Name<span style="color:red;">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="customername" id="nameId" placeholder="Name" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email ID<span style="color:red;">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="customeremail" id="emailId" placeholder="Email ID">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile" class="col-sm-3 col-form-label">Mobile Number<span style="color:red;">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="customermobile" id="mobileId" maxlength="15" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Mobile Number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="postalcode" class="col-sm-3 col-form-label">Postal Code<span style="color:red;">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="customerPostalname"   id="customerPostalCode" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Postal Code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-3 col-form-label">Address<span style="color:red;">*</span></label>
                        <div class="col-md-9">
                            <!-- <input type="text" name="customeraddress" id="addressId" class="form-control" placeholder="Address"> -->
                            <select name="customeraddress" id="addressId" class="form-control" ><option value="">Select Address</option></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="postalcode" class="col-sm-3 col-form-label">Unit Number</label>
                        <div class="col-md-9">
                            <input type="text" name="unitNumber" id="unitNumber" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Unit Numner">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-md-9">
                            <select name="customerstatus" id="statusId" class="form-control text-dark">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-clear" id="createCustomerFromClearBtn">Clear</button>
                    <button type="submit" id="addCustomerSave" class="btn btn-save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // clear form
    jQuery('#createCustomerFromClearBtn').on('click', function() {
        jQuery("#createCustomerForm")["0"].reset();
    });
    // validation script start here
    $(document).ready(function() {
        $.validator.addMethod("isValidEmailAddress", function(value) {
            var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
            return pattern.test(value);
        });
    });
    // end here
    // validation with data store
    $(document).ready(function() {
        jQuery('#createCustomerForm').submit(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
        }).validate({
            rules: {


                customername: {
                    required: true,
                    minlength: 3,
                },
                customeraddress: {
                    required: true,
                },
                customermobile: {
                    required: true,
                    number: true,
                    minlength: 7,
                    maxlength: 15,
                },
                customeremail: {
                    required: true,
                    isValidEmailAddress: true,
                    email: true,
                },
            },
            messages: {
                customername: {
                    minlength: "Username should be at least 3 characters",
                    required: "Please enter customer name"
                },
                customeraddress: {
                    required: "please enter customer address "
                },
                customermobile: {
                    required: "Please enter your mobile number",
                    number: "Please enter your mobile number as a numerical value",
                    minlength: "Your mobile number should be 7 digits",
                    maxlength: "Your mobile number can be 15 digits"
                },
                customeremail: {
                    email: "The email should be in the format: abc@domain.tld",
                    isValidEmailAddress: "Please enter valid email address",
                    required: "Please enter your valid email ID",
                },
            },
            submitHandler: function() {
                bootbox.confirm(" DO YOU WANT TO SAVE?", function(result) {
                    if (result) {
                        // form data

                        jQuery.ajax({
                            url: "{{ route('SA-CreatCustomer') }}",
                            data: jQuery("#createCustomerForm").serialize(),
                            enctype: "multipart/form-data",
                            type: "post",
                            success: function(result) {
                                if (result.error != null) {
                                    // jQuery(".salesQuantityError").hide();
                                } else if (result.barerror != null) {
                                    errorMsg(result.barerror);
                                    // jQuery("#addQuotationAlert").hide();
                                    // jQuery("#addCustomerAlertDanger").show();
                                    // jQuery("#addCustomerAlertDangerMSG").html(result.barerror);
                                    // jQuery(".salesQuantityError").hide();
                                    // setTimeout(() => {
                                    //     jQuery("#addCustomerAlertDanger").hide();

                                    // }, 2000);
                                } else if (result.success != null) {
                                    successMsg(result.success);
                                    // jQuery("#addCustomerAlertDanger").hide();
                                    // jQuery("#addQuotationAlert").html(result.success);
                                    jQuery("#createCustomerForm")["0"].reset();
                                    // jQuery("#addQuotationAlert").show();
                                    // jQuery("#ordersTable1 tbody").html('');
                                    // jQuery("#productTableBody1").html('');
                                    $('#closeCustomerAdd').click();
                                    updateCustomer();
                                    // jQuery(".salesQuantityError").hide();
                                } else if (result.salesQuantityError != null) {
                                    // jQuery(".salesQuantityError").show();
                                    // jQuery(".salesQuantityError").html(result.salesQuantityError);
                                    // jQuery("#ordersTable1 tbody").html('');
                                    // jQuery("#productTableBody1").html('');
                                } else {
                                    // jQuery(".salesQuantityError").hide();
                                    // jQuery("#addCustomerAlertDanger").hide();
                                    // jQuery("#addQuotationAlert").hide();
                                }
                            }
                        });
                    }
                })
            }
        })
    });
    // API for Address
    $(document).on('change','#customerPostalCode', function(){
   
        jQuery.ajax({
            url: "https://developers.onemap.sg/commonapi/search",
            type: "get",
            data: {
                "searchVal": $(this).val(),
                "returnGeom": 'N',
                "getAddrDetails": 'Y',
            },
            success: function(response) {
                $('#addressId').html('');
                $('#addressId').append('<option value="">Select Address</option>');
                $.each(response.results, function(key, value) {
                    $('#addressId').append(`
                        <option value="${value["ADDRESS"]}">${value["ADDRESS"]}</option>
                    `);
                });
            }
        });
    });
</script>