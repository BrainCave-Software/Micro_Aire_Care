<!-- Modal -->
<div class="modal fade" id="editEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Employee</h5>
                <button type="button" id="employeeSaveClose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" id="editEmployeeForm">
                <div class="modal-body bg-white px-3">
                    <!-- invoice body start here -->

                    <!-- info & alert section -->
                    <!-- <div class="alert alert-success" id="editEmployeeAlert" style="display:none"></div>
                    <div class="alert alert-danger" style="display:none">
                    </div> -->
                    <!-- end -->

                    <!-- quotation id -->
                    <input type="hidden" name="oldeditemployee" id="oldeditemployee">
                    <input type="hidden" name="editUsersId" id="editUsersId">


                    <div class=" form-group row">
                        <!-- Employee Id -->
                        <!-- <div class="col-md-2 col-form-label">Employee ID <span style="color:red;">*</span></div>
                        <div class="col-md-4"><input type="text" class="form-control" name="editemployeid" id="editEmployeeidId" placeholder="Employee ID"></div> -->
                        <!-- user name -->
                        <div class="col-md-2 col-form-label">User Name <span style="color:red;">*</span></div>
                        <div class="col-md-4"><input type="text" class="form-control" name="editusername" id="editUsernameId" placeholder="User Name"></div>
                        <!-- first name -->
                        <div class="col-md-2 col-form-label"> Name <span style="color:red;">*</span></div>
                        <div class="col-md-4"><input type="text" class="form-control" name="editname" id="editFirstnameId" placeholder="First Name"></div>

                    </div>
        
                    <div class=" form-group row">
                        <!-- email id -->
                        <div class="col-md-2 col-form-label">Email ID <span style="color:red;">*</span></div>
                        <div class="col-md-4"><input type="email" class="form-control" name="editemailid" id="editEmailidId" placeholder="Email ID" require></div>
                        <!-- mobile number -->
                        <div class="col-md-2 col-form-label">Mobile No.</div>
                        <div class="col-md-4"><input type="text" class="form-control" name="editcontactno" id="editContactId" placeholder="Mobile Number"></div>

                    </div>
                    <div class=" form-group row">
                        <!-- gender -->
                        <div class="col-md-2 col-form-label">Gender</div>
                        <div class="col-md-4">
                            <select class="form-control" name="editgender" id="editGenderId">
                                <option value="">Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                
                        <!-- role -->
                        <div class="col-md-2 col-form-label">Role <span style="color:red;">*</span></div>
                        <div class="col-md-4">
                            <select class="form-control" name="editRole" id="editRole">
                            </select>
                        </div>
                    </div>
        
                    <div class=" form-group row">
                        <!-- main dipartment -->
                        <div class="col-md-2 col-form-label">Main Department <span style="color:red;">*</span></div>
                        <div class="col-md-4">
                            <select class="form-control" name="editMainDepartmentEmployee" id="editMainDepartmentEmployee">
                            </select>
                        </div>
                        <!-- designation -->
                        <div class="col-md-2 col-form-label">Designation <span style="color:red;">*</span></div>
                        <div class="col-md-4">
                            <select class="form-control" name="editDesignation" id="editDesignation">
                            </select>
                        </div>
                    </div>
                    <div class=" form-group row">
                        <!-- password -->
                        <div class="col-md-2 col-form-label">Password <span style="color:red;">*</span></div>
                        <div class="col-md-4"><input type="password" class="form-control" name="editPassword" id="editPassword" placeholder="Password"></div>
                        <!-- conform password -->
                        <div class="col-md-2 col-form-label">Confirm Password <span style="color:red;">*</span></div>
                        <div class="col-md-4"><input type="password" class="form-control" name="editConformPassword" id="editConformPassword" placeholder="confirm Password"></div>
                    </div>
                    <!-- end here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-clear" id="editEmployeeFormClearBtn">Clear</button>
                    <button type="submit" id="editEmployeeSave" class="btn btn-save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // validation with data store
    $(document).ready(function() {
        jQuery('#editEmployeeForm').submit(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
        }).validate({
            rules: {


                editname: {
                    required: true,
                },
                editusername: {
                    required: true,
                },
                editemailid: {
                    isValidEmailAddress: true,
                    email: true,
                    required: true,
                },
                editcontactno: {
                    required: true,
                    number: true,
                    minlength: 7,
                    maxlength: 15,
                },
                editPassword: {
                    required: true,
                    minlength: 8,
                },
                editConformPassword: {
                    required: true,
                    minlength: 8,
                    equalTo: "#editPassword"
                },
            },
            messages: {

                editname: {
                    required: "Please enter name"
                },
                editusername: {
                    required: "Please enter user name"
                },
                editemployeid: {
                    required: "employee ID required",
                },
                editaddress: {
                    required: "Customer address required",
                },
                editemailid: {
                    email: "The email should be in the format: abc@domain.tld",
                    isValidEmailAddress: "Please enter valid email address",
                    required: "Please enter your Valid email ID",
                },
                editcontactno: {
                    required: "Please enter your mobile number",
                    number: "Please enter your mobile number as a numerical value",
                    minlength: "Your mobile number should be 7 digits",
                    maxlength: "Your mobile number can be 15 digits"
                },
                editPassword: {
                    required: "Please enter your password",
                    minlength: "Your password should be 8 digits",
                },
                editConformPassword: {
                    required: "Please enter your conform password",
                    minlength: "Your password should be 8 digits",
                    equalTo: "Those passwords didn’t match. Try again."

                },
            },
            submitHandler: function() {
                bootbox.confirm(" DO YOU WANT TO SAVE?", function(result) {
                    if (result) {
                        jQuery.ajax({
                            url: "{{ route('SA-UpdateEmployeeDetail') }}",
                            data: jQuery("#editEmployeeForm").serialize(),
                            enctype: "multipart/form-data",
                            type: "post",
                            success: function(result) {
                                if (result.error != null) {

                                } else if (result.barerror != null) {
                                    errorMsg(result.barerror);
                                } else if (result.success != null) {
                                    successMsg(result.success);
                                    jQuery("#editEmployeeForm")["0"].reset();
                                    $('#employeeSaveClose').click();
                                    employeeList();
                                } else {}
                            }
                        });
                    }
                })
            }
        })
    });
    // end
    // clear form
    jQuery('#editEmployeeFormClearBtn').on('click', function() {
        jQuery("#editEmployeeForm")["0"].reset();
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
    // Postal Code
    $(document).on('change', '#editEmployeePostalCode', function() {

        jQuery.ajax({
            url: "https://developers.onemap.sg/commonapi/search",
            type: "get",
            data: {
                "searchVal": $(this).val(),
                "returnGeom": 'N',
                "getAddrDetails": 'Y',
            },
            success: function(response) {
                console.log(response);
                $('#editEmployeeAddressId').html('');
                $('#editEmployeeAddressId').append('<option value="">Select Address</option>');
                $.each(response.results, function(key, value) {
                    $('#editEmployeeAddressId').append(`
                   <option value="${value["ADDRESS"]}">${value["ADDRESS"]}</option>
               `);
                });
            }
        });
    });
</script>