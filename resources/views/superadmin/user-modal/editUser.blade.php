<style>
  .modal-content {
    overflow: auto;
  }
</style>
<!-- Modal -->
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
        <button type="button" id="editUpdateUser" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form method="post" id="editUserForm">
        <div class="modal-body bg-white px-3">

          <!-- info & alert section -->
          <!-- <div class="alert alert-success alert-dismissible fade show" id="editUserAlert" style="display:none;" role="alert">
            <strong>Info ! </strong> <span id="editUserSuccessAlert"></span>
            <button type="button" class="close" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->

          <!-- <div class="alert alert-danger alert-dismissible fade show" id="editUserErrorAlert" style="display:none;" role="alert">
            <strong>Info ! </strong> <span id="editUserDangerAlert"></span>
            <button type="button" class="close" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->
          <!-- end -->

          <div class="">
            <div class="">

              <input type="text" name="id" id="editUserFormId" style="display: none;">

              <!-- username -->
              <div class="form-group row">
                <label for="username" class="col-sm-3 col-form-label">Name<span style="color:red;">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="username" id="usernameEdit" placeholder="Name" />
                </div>
              </div>
              <!-- Email ID -->
              <div class="form-group row">
                <label for="emailid" class="col-sm-3 col-form-label">Email ID<span style="color:red;">*</span></label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" name="emailid" id="emailidEdit" placeholder="Email ID" />
                </div>
              </div>
              <!-- mobile number -->
              <div class="form-group row">
                <label for="mobilenumber" class="col-sm-3 col-form-label">Mobile Number<span style="color:red;">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="mobilenumber" id="mobilenumberEdit" maxlength="8" placeholder="Mobile Number" />
                </div>
              </div>

              <!-- phone number -->
              <div class="form-group row">
                <label for="phonnumber" class="col-sm-3 col-form-label">Home Number</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="phonenumber" id="phonnumberEdit" maxlength="8" placeholder="Home Number" />
                </div>
              </div>

              <!-- checkbox -->
              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">User Rights<span style="color:red;">*</span></label>
                <div class="col-sm-9 ml-3">
                  <div class="form-group">
                    <div class="" style="font-size: smaller; color:red;" id="userRightsErrorEdit"></div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-check form-check-primary">
                          <label class="">
                            <input type="checkbox" class="form-check-input require-one" value="all" name="list[]" id="accessToAllEdit" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> Access To All
                          </label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-check form-check-primary">
                          <label class="">
                            <input type="checkbox" class="form-check-input require-one cb_childE" name="list[]" value="staffmanagement" id="staffManagementEdit" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> Staff Management
                          </label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-check form-check-primary">
                          <label class="">
                            <input type="checkbox" class="form-check-input require-one cb_childE" value="timesheet" name="list[]" id="timesheetEdit" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> Timesheet
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-check form-check-primary">
                          <label class="">
                            <input type="checkbox" class="form-check-input require-one cb_childE" value="projectmanagement" name="list[]" id="projectManagementEdit" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> Project Management
                          </label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-check form-check-primary">
                          <label class="">
                            <input type="checkbox" class="form-check-input require-one cb_childE" value="crm" name="list[]" id="crmEdit" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> CRM
                          </label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-check form-check-primary">
                          <label class="">
                            <input type="checkbox" class="form-check-input require-one cb_childE" value="reports" name="list[]" id="reportsEdit" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> Reports
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-clear" id="clearEditFormBtn">Clear</button>
          <button type="submit" id="editUserForm1" class="btn btn-save">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- // backend js file -->

<script>
  $(document).ready(function() {
    jQuery('#editUserForm').submit(function(e) {
      e.preventDefault();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
      });
    }).validate({
      rules: {

        username: {
          required: true,
          minlength: 3
        },
        phonenumber: {
          number: true,
          minlength: 8,
          maxlength: 8,
        },
        mobilenumber: {
          required: true,
          number: true,
          minlength: 8,
          maxlength: 8,
        },
        emailid: {
          required: true,
          isValidEmailAddress: true,
          email: true,
        },
        "list[]": {
          required: true,
          minlength: 1,
        }

      },
      messages: {

        username: {
          minlength: "Username should be at least 3 characters",
          required: "Please enter Your name"
        },
        mobilenumber: {
          required: "Please enter your mobile number",
          checkUsername: "Please enter username first",
          number: "Please enter your mobile number as a numerical value",
          min: "Your mobile number should be 8 digits",
          max: "Your mobile number can be 8 digits"
        },
        phonenumber: {
          number: "Please enter your home number as a numerical value",
          min: "Your home number should be 8 digits",
          max: "Your home number can be 8 digits"
        },
        emailid: {
          email: "The email should be in the format: abc@domain.tld",
          isValidEmailAddress: "Please enter valid email address",
          required: "Please enter your valid email ID",
        },
        "list[]": {
          required: "This field is required"
        }
      },
      submitHandler: function() {
        bootbox.confirm(" DO YOU WANT TO SAVE?", function(result) {
          if (result) {
            jQuery.ajax({
              url: "{{ route('SA-UpdateUser') }}",
              data: jQuery("#editUserForm").serialize(),
              enctype: "multipart/form-data",
              type: "post",
              success: function(result) {
                if (result.error != null) {

                } else if (result.barerror != null) {
                  errorMsg(result.barerror);
                  // jQuery("#editUserErrorAlert").show();
                  // jQuery("#editUserDangerAlert").html(result.barerror);
                  // jQuery("#editUserAlert").hide();
                } else if (result.success != null) {
                  successMsg(result.success);
                  // jQuery("#editUserAlert").show();
                  jQuery("#editUserForm")["0"].reset();
                  // jQuery("#editUserSuccessAlert").html(result.success);
                  // jQuery("#editUserErrorAlert").hide();
                  getUserDetails();
                  $('#editUpdateUser').click();
                } else {
                  // jQuery("#editUserErrorAlert").hide();
                  // jQuery("#editUserAlert").hide();
                }
              }
            });
          }
        })
      }
    })
  });
  var edit_status;

  // validation script start here
  $(document).ready(function() {

    $.validator.addMethod("checkUsername", function(value) {
      return $("#username").val() != null;
    });

    $.validator.addMethod("isValidEmailAddress", function(value) {
      var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
      return pattern.test(value);
    });

    $("#").validate({
      rules: {},
      messages: {}
    });
  });
  // end here

  // remove Access to all
  $('#accessToAllEdit').change(function() {
    $('.cb_childE').prop('checked', this.checked)
  })
  $('.cb_childE').change(function() {
    if ($('.cb_childE:checked').length == $('.cb_childE').length) {
      $('#accessToAllEdit').prop('checked', true)

    } else {
      $('#accessToAllEdit').prop('checked', false)


    }
  })


  $('input[type="checkbox"]').click(function() {
    var allChecked = $('#accessToAllEdit').prop('checked');
    var inventory = $('#inventoryEdit').prop('checked');
    var sales = $('#salesEdit').prop('checked');
    var purchase = $('#purchaseEdit').prop('checked');
    var reports = $('#reportsEdit').prop('checked');
    var deliveryManagement = $('#deliveryManagementEdit').prop('checked');
    var dropShipping = $('#dropShippingEdit').prop('checked');
    var taskManagement = $('#taskManagementEdit').prop('checked');
    var offerpackage = $('#offerpackageEdit').prop('checked');
    var loyalitysystem = $('#loyalitysystemEdit').prop('checked');
    var customerManagement = $('#customerManagementEdit').prop('checked');
    if (allChecked || inventory || sales || purchase || reports || customerManagement || deliveryManagement || dropShipping || taskManagement || offerpackage || loyalitysystem) {
      $('#userRightsErrorEdit').hide();
    } else {
      $('#userRightsErrorEdit').show();
    }
  });

  // end

  jQuery('#clearEditFormBtn').on('click', function() {
    jQuery("#editUserForm")["0"].reset();
  });
</script>