<!-- Modal -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" id="closeAddUser" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <style>
  #addUserForm input[type='checkbox']{
    margin-left: 1.5% !important;
    margin-top: -3px !important;
  }
</style>
      <form method="post" id="addUserForm">
        <div class="modal-body bg-white px-3">
          <!-- info & alert section -->
          <!-- <div class="alert alert-success alert-dismissible fade show" id="addUserAlert" style="display:none" role="alert">
            <span id="addUserSuccessAlert"></span>
            <button type="button" class="close" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->

          <!-- <div class="alert alert-danger alert-dismissible fade show" id="addUserErrorAlert" style="display:none" role="alert">
            <span id="addUserDangerAlert"></span>
            <button type="button" class="close" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->
          <!-- end -->

          <div class="">
            <div class="">

              <!-- username -->
              <div class="form-group row">
                <label for="username" class="col-sm-3 col-form-label">Name<span style="color:red;">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="username" id="username" placeholder="Name" />
                </div>
              </div>
              <!-- Email ID -->
              <div class="form-group row">
                <label for="emailid" class="col-sm-3 col-form-label">Email ID<span style="color:red;">*</span></label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" name="emailid" id="emailid" placeholder="Email ID" />
                </div>
              </div>
              <!-- mobile number -->
              <div class="form-group row">
                <label for="mobilenumber" class="col-sm-3 col-form-label">Mobile Number<span style="color:red;">*</span></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="mobilenumber" id="mobilenumber" maxlength="8" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Mobile Number" />
                </div>
              </div>
              <!-- phone number -->
              <div class="form-group row">
                <label for="phonnumber" class="col-sm-3 col-form-label">Home Number</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="phonenumber" id="phonnumber" maxlength="8" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Home Number" />
                </div>
              </div>
              <!-- Password -->
              <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password<span style="color:red;">*</span></label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                </div>
              </div>
              <!-- checkbox -->
              <div class="row">
                <div class="col-sm-3">
                <label for="exampleInputPassword2" class="form-label">User Rights<span style="color:red;">*</span></label>
                </div>
                
                <div class="col-sm-9">
                  <div class="form-group">
                    <div class="" style="font-size: smaller; color:red;" id="userRightsError"></div>
                    <div class="row">
                      <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="form-check form-check-primary">
                          <label class="">Access To All  <input type="checkbox" class="form-check-input require-one" value="all" name="list[]" id="accessToAll" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /></label>
                           
                         
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="form-check form-check-primary">
                          <label class="">Staff Management
                            <input type="checkbox" class="form-check-input require-one cb_child" name="list[]" value="staffmanagement" id="staffManagement" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" />

                          </label>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="form-check form-check-primary">
                          <label class="">Timesheet
                            <input type="checkbox" class="form-check-input require-one cb_child" value="timesheet" name="list[]" id="timesheet" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2  !important;border-width: 2px;margin-top: 0px;" /> 
                          </label>
                        </div>
                      </div>
                    
                      <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="form-check form-check-primary">
                          <label class="">Project Management
                            <input type="checkbox" class="form-check-input require-one cb_child" value="projectmanagement" name="list[]" id="projectManagement" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> 
                          </label>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="form-check form-check-primary">
                          <label class="">CRM
                            <input type="checkbox" class="form-check-input require-one cb_child" value="crm" name="list[]" id="crm" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> 
                          </label>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="form-check form-check-primary">
                          <label class="">Reports
                            <input type="checkbox" class="form-check-input require-one cb_child" value="reports" name="list[]" id="reports" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> 
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
          <button type="button" class="btn btn-clear" id="clearFormBtn">Clear</button>
          <button type="submit" id="addUserForm1" class="btn btn-save">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    jQuery('#addUserForm').submit(function(e) {
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
          minlength: 8,
          maxlength: 8,
        },
        mobilenumber: {
          required: true,
          minlength: 8,
          maxlength: 8,
        },
        emailid: {
          required: true,
          isValidEmailAddress: true,
          email: true,
        },
        password: {
          required: true,
          minlength: 8,
        },
        "list[]": {
          required: true,
          minlength: 1,
        }

      },
      messages: {
        username: {
          required: "Please enter your name",
          minlength: "Name should be at least 3 characters",
        },
        phonenumber: {
          minlength: "Home number should be at least 8 digits",
          maxlength: "Your home number can be 8 digits"
        },
        mobilenumber: {
          required: "Please enter your mobile number",
          minlength: "Your mobile number should be 8 digits",
          maxlength: "Your mobile number can be 8 digits"
        },
        emailid: {
          email: "The email should be in the format: abc@domain.tld",
          isValidEmailAddress: "Please enter valid email address",
          required: "Please enter your valid email ID",
        },
        password: {
          required: "Please enter your password",
          minlength: "Password should be at least 8 digits",
        },
        "list[]": {
          required: "This field is required"
        }

      },
      submitHandler: function() {
        bootbox.confirm(" DO YOU WANT TO SAVE?", function(result) {
          if (result) {
            jQuery.ajax({
              url: "{{ route('SA-AddNewUser') }}",
              data: jQuery("#addUserForm").serialize(),
              enctype: "multipart/form-data",
              type: "post",
              success: function(result) {
                if (result.error != null) {

                } else if (result.barerror != null) {
                  errorMsg(result.barerror);
                  // jQuery("#addUserAlert").hide();
                  // jQuery("#addUserErrorAlert").show();
                  // jQuery("#addUserDangerAlert").html(result.barerror);
                  // setTimeout(() => {
                  //   jQuery("#addUserErrorAlert").hide();
                  // }, 2000);
                } else if (result.success != null) {
                  successMsg(result.success);
                  // jQuery("#addUserAlert").hide();
                  // jQuery("#addUserSuccessAlert").html(result.success);
                  // $('#addUserAlert').show();
                  jQuery("#addUserForm")["0"].reset();
                  getUserDetails();
                  $('#closeAddUser').click();
                  // $('#addUserErrorAlert').hide();
                } else {
                  // jQuery("#addUserAlert").hide();
                  // jQuery("#addUserAlert").hide();
                }

              }
            });
          }
        })
      }
    })
  });

  // validation script start here
  $(document).ready(function() {

    var value = $("#password").val();

    $.validator.addMethod("checkUsername", function(value) {
      return $("#username").val() != null;
    });

    $.validator.addMethod("isValidEmailAddress", function(value) {
      var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
      return pattern.test(value);
    });


  });
  // end here

  //  submission alert
  // $('#addUserForm1').on('click',function(){
  //   bootbox.confirm({
  //     size: "medium",
  //     message: "<b>sure</b>entry?",
  //     callback: function(result){
  //       bootbox.alert('closed');
  //     }
  //   })
  // })
  //  (end)submission alert

  $('input[type="checkbox"]').click(function() {
    var allChecked = $('#accessToAll').prop('checked');
    var staffmanagement = $('#staffManagement').prop('checked');
    var timesheet = $('#timesheet').prop('checked');
    var projectmanagement = $('#projectManagement').prop('checked');
    var crm = $('#crm').prop('checked');
    if (allChecked || staffmanagement || timesheet || projectmanagement || crm) {
      $('#userRightsError').hide();
    } else {
      $('#userRightsError').show();
    }

  });

  // remove Access to all
  $('#accessToAll').change(function() {
    $('.cb_child').prop('checked', this.checked)
  })
  $('.cb_child').change(function() {
    if ($('.cb_child:checked').length == $('.cb_child').length) {
      $('#accessToAll').prop('checked', true)

    } else {
      $('#accessToAll').prop('checked', false)


    }
  })
  jQuery('#clearFormBtn').on('click', function() {
    jQuery("#addUserForm")["0"].reset();
  });
</script>