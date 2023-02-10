<!-- Modal -->
<div class="modal fade" id="editCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Client</h5>
                <button type="button" id="closeEditCustomer" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" id="editCustomerForm">
                <div class="modal-body bg-white px-3">
                    <!-- invoice body start here -->
                    <input type="hidden" class="form-control" name="oid" id="oid" />
                    <!-- info & alert section -->
                    <!-- <div class="alert alert-success" id="editCustomerAlert" style="display:none"></div>
                    <div class="alert alert-danger" style="display:none">

                    </div> -->
                    <!-- end -->
                    <!-- customer management edit form -->
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Name<span style="color:red;">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="customernameedit" id="nameIdEdit" placeholder="Name" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email ID<span style="color:red;">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="customeremailedit" id="emailIdEdit" placeholder="Email Id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile" class="col-sm-3 col-form-label">Mobile Number<span style="color:red;">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="customermobileedit" id="mobileIdEdit" maxlength="15" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" placeholder="Mobile Number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="postalcode" class="col-sm-3 col-form-label">Postal Code<span style="color:red;">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="customerpostalcodeedit" id="customerPostalCodeEdit" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Postal Code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-3 col-form-label">Address<span style="color:red;">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="customeraddressedit" id="addressIdEdit" class="form-control" placeholder="Address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="postalcode" class="col-sm-3 col-form-label">Unit Number</label>
                        <div class="col-md-9">
                            <input type="text" name="unitNumberEdit" id="unitNumberEdit" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Unit Numner">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-md-9">
                            <select name="customerstatusedit" id="statusIdEdit" class="form-control text-dark">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                
                            </select>
                        </div>
                    </div>
                    <!-- end here -->
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-clear" id="editQuotationFormClearBtn">Clear</button>
                    <button type="submit" id="editQuotationForm1" class="btn btn-save">Save</button>
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
    jQuery('#editQuotationFormClearBtn').on('click', function() {
        jQuery("#editCustomerForm")["0"].reset();
        $('#productTableBodyQE').html('');
    });
    // validation script start here
    $(document).ready(function() {
        $.validator.addMethod("isValidEmailAddress", function(value) {
            var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
            return pattern.test(value);
        });
    });
    // end here
    // validation with storage
    $(document).ready(function() {
        jQuery('#editCustomerForm').submit(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
        }).validate({
            rules: {


                customernameedit: {
                    required: true,
                },

                customeremailedit: {
                    required: true,
                    isValidEmailAddress: true,
                    email: true,
                },

                customermobileedit: {
                    required: true,
                    number: true,
                    minlength: 7,
                    maxlength: 15,
                },

                customeraddressedit: {
                    required: true,
                },



            },
            messages: {

                customernameedit: {
                    required: "Please enter customer name"
                },
                customeraddressedit: {
                    required: "Please enter address",
                },
                customeremailedit: {
                    email: "The email should be in the format: abc@domain.tld",
                    isValidEmailAddress: "Please enter valid email address",
                    required: "Please enter your valid email ID",
                },
                customermobileedit: {
                    required: "Please enter your mobile number",
                    number: "Please enter your mobile number as a numerical value",
                    minlength: "Your mobile number should be 7 digits",
                    maxlength: "Your mobile number can be 15 digits"
                },


            },
            submitHandler: function() {
                bootbox.confirm(" DO YOU WANT TO SAVE?", function(result) {
                    if (result) {
                        // form data

                        jQuery.ajax({
                            url: "{{ route('SA-EditClients') }}",
                            data: jQuery("#editCustomerForm").serialize(),
                            enctype: "multipart/form-data",
                            type: "post",
                            success: function(result) {
                                if (result.error != null) {
                                    jQuery(".salesQuantityErrorEdit").hide();
                                } else if (result.barerror != null) {
                                    errorMsg(result.barerror);
                                    // jQuery("#editCustomerAlert").hide();
                                    // jQuery(".alert-danger").show();
                                    // jQuery(".alert-danger").html(result.barerror);
                                    // jQuery(".salesQuantityErrorEdit").hide();
                                } else if (result.success != null) {
                                    successMsg(result.success);

                                    // jQuery(".alert-danger").hide();
                                    // jQuery("#editCustomerAlert").html(result.success);
                                    jQuery("#editCustomerForm")["0"].reset();
                                    $('#closeEditCustomer').click();
                                    // jQuery("#productsTableQE tbody").html('');
                                    // jQuery("#productTableBodyQE").html('');
                                    // jQuery(".salesQuantityErrorEdit").hide();
                                    updateCustomer();
                                } else if (result.salesQuantityErrorEdit != null) {
                                    // jQuery(".salesQuantityErrorEdit").show();
                                    // jQuery(".salesQuantityErrorEdit").html(result.salesQuantityErrorEdit);
                                    // jQuery("#productsTableQE tbody").html('');
                                    // jQuery("#productTableBodyQE").html('');
                                } else {
                                    // jQuery(".salesQuantityErrorEdit").hide();
                                    // jQuery(".alert-danger").hide();
                                    // jQuery("#editCustomerAlert").hide();
                                }

                            }
                        });
                    }
                })
            }
        })
    });
    // end
</script>