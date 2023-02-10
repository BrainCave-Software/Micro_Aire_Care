<div class="modal fade" id="addNewEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-2">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                <button type="button" id="addEmployeeClose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" id="addEmployee">
                <div class="modal-body bg-white px-3">

                    <div class=" form-group row">
                        <!-- user name -->
                        <div class="col-md-2 col-form-label">User Name <span style="color:red;">*</span></div>
                        <div class="col-md-4"><input type="text" class="form-control" name="username" id="userName" placeholder="User Name"></div>
                        <!-- first name -->
                        <div class="col-md-2 col-form-label"> Name <span style="color:red;">*</span></div>
                        <div class="col-md-4"><input type="text" class="form-control" name="name" id="name" placeholder="Name"></div>
                    </div>
                    <!-- <div class=" form-group row"> -->
                        <!-- last name -->
                        <!-- <div class="col-md-2 col-form-label">Last Name <span style="color:red;">*</span></div>
                        <div class="col-md-4"><input type="text" class="form-control" name="lastname" id="lastName" placeholder="Last Name"></div> -->
                    <!-- </div> -->
                    <div class=" form-group row">
                        <!-- email id -->
                        <div class="col-md-2 col-form-label">Email ID <span style="color:red;">*</span></div>
                        <div class="col-md-4"><input type="email" class="form-control" name="emailid" id="emailId" placeholder="Email ID" require></div>
                        <!-- mobile number -->
                        <div class="col-md-2 col-form-label">Mobile No. <span style="color:red;">*</span></div>
                        <div class="col-md-4"><input type="text" class="form-control" name="contactno" id="contactNo" maxlength="15" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Mobile Number"></div>
                    </div>
                    <div class="form-group row">
                        <!-- gender -->
                        <div class="col-md-2 col-form-label">Gender<span style="color:red;">*</span></div>
                        <div class="col-md-4">
                            <select class="form-control" name="gender" id="gender">
                                <option value="">Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <!-- role -->
                        <div class="col-md-2 col-form-label">Role <span style="color:red;">*</span></div>
                        <div class="col-md-4">
                            <select class="form-control" name="role" id="role"> </select>
                        </div>
                        <!-- date of birth -->
                        <!-- <div class="col-md-2 col-form-label">Date of Birth<span style="color:red;">*</span> </div>
                        <div class="col-md-4"><input type="date" class="form-control" name="birth" id="birth"></div> -->
                    </div>
                    <!-- <div class=" form-group row"> -->
                        <!-- postal code -->
                        <!-- <div class="col-md-2 col-form-label">Postal Code<span style="color:red;">*</span></div>
                        <div class="col-md-4">
                            <input type="text" id="addEmployeePostalCode" name="addEmployeePostalCode" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Postal Code">
                        </div> -->
                        <!-- address -->
                        <!-- <div class="col-sm-2 col-form-label">Address </div> -->
                        <!-- <div class="col-sm-4">
                            <textarea type="text" class="form-control" name="address" id="address" placeholder="Address" readonly></textarea>
                            <select name="address" class="form-control" id="address">
                                <option value="">Select Address</option>
                            </select>
                        </div> -->
                    <!-- </div> -->

                    <div class=" form-group row">
                        <!-- Unit Number -->
                        <!-- <div class="col-md-2 col-form-label">Unit Number<span style="color:red;">*</span> </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="employeeUnitname" id="employeeUnitId" placeholder="Unit Number">
                        </div> -->
                        
                    </div>
                    <div class=" form-group row">
                        <!-- main department -->
                        <div class="col-md-2 col-form-label">Main Department <span style="color:red;">*</span></div>
                        <div class="col-md-4">
                            <select class="form-control" name="mainDepartmentEmployee" id="mainDepartmentEmployee"> </select>
                        </div>
                        <!-- designation -->
                        <div class="col-md-2 col-form-label">Designation <span style="color:red;">*</span></div>
                        <div class="col-md-4">
                            <select class="form-control" name="designation" id="designation"></select>
                        </div>
                    </div>
                    <div class=" form-group row">
                        <!-- password -->
                        <div class="col-md-2 col-form-label">Password <span style="color:red;">*</span></div>
                        <div class="col-md-4"><input type="password" class="form-control" name="password" id="password" placeholder="Password"></div>
                        <!-- conform password -->
                        <div class="col-md-2 col-form-label">Confirm Password <span style="color:red;">*</span></div>
                        <div class="col-md-4"><input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="confirm Password"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-clear" id="clearFormBtn">Clear</button>
                    <button type="submit" id="" class="btn btn-save" >Save</button>
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
    // clear form
    jQuery('#clearFormBtn').on('click', function() {
        jQuery("#addEmployee")["0"].reset();
    });
    // Get Role Name

    getRole();

    function getRole() {
        $.ajax({
            type: "GET",
            url: "{{ route('SA-selectRoletName')}}",
            success: function(response) {
                $('#role').html('');
                $('#role').append('<option value="">Select Role Name</option>');
                $('#editRole').html('');
                $('#editRole').append('<option value="">Select Role Name</option>');
                jQuery.each(response, function(key, value) {
                    $('#role').append(
                        '<option value="' + value["role_name"] + '">\
                    ' + value["role_name"] + '\
                    </option>'
                    );
                    $('#editRole').append(
                        '<option value="' + value["role_name"] + '">\
                    ' + value["role_name"] + '\
                    </option>'
                    );
                });
            }
        });
    }

    // Get department Name

    getMainDepartmentName();

    function getMainDepartmentName() {
        $.ajax({
            type: "GET",
            url: "{{route('SA-selectDepartmentName')}}",
            success: function(response) {
                $('#mainDepartmentEmployee').html('');
                $('#mainDepartmentEmployee').append('<option value="">Select Department name</option>');
                $('#editMainDepartmentEmployee').html('');
                $('#editMainDepartmentEmployee').append('<option value="">Select Department name</option>');
                jQuery.each(response, function(key, value) {
                    $('#mainDepartmentEmployee').append(
                        '<option value="' + value["department_name"] + '">\
            ' + value["department_name"] + '\
            </option>'
                    );
                    $('#editMainDepartmentEmployee').append(
                        '<option value="' + value["department_name"] + '">\
            ' + value["department_name"] + '\
            </option>'
                    );
                });
            }
        });
    }

    // Get designation Name
    getDesignation();

    function getDesignation() {
        $.ajax({
            type: "GET",
            url: "{{ route('SA-selectdesignationName')}}",
            success: function(response) {
                $('#designation').html('');
                $('#designation').append('<option value="">Select Designation name</option>');
                $('#editDesignation').html('');
                $('#editDesignation').append('<option value="">Select Designation name</option>');
                jQuery.each(response, function(key, value) {
                    $('#designation').append(
                        '<option value="' + value["designation_name"] + '">\
                    ' + value["designation_name"] + '\
                    </option>'
                    );
                    $('#editDesignation').append(
                        '<option value="' + value["designation_name"] + '">\
                    ' + value["designation_name"] + '\
                    </option>'
                    );
                });
            }
        });
    }
    // Get designation Name(End)



    // validation with data
    $(document).ready(function() {
        jQuery('#addEmployee').submit(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
        }).validate({
            rules: {

                name: {
                    required: true,
                },
                username: {
                    required: true,
                },
                maindepartment: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                role: {
                    required: true,
                },
                contactno: {
                    required: true,
                    number: true,
                    minlength: 7,
                    maxlength: 15,
                },
                password: {
                    required: true,
                    minlength: 8,
                },
                emailid: {
                    required: true,
                    isValidEmailAddress: true,
                    email: true,
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                },
                // birth: {
                //     required: true,
                // },
                designation: {
                    required: true,
                },
                // lastname: {
                //     required: true,
                // },
                // addEmployeePostalCode: {
                //     required: true,
                // },
                // employeeUnitname: {
                //     required: true,
                // },
                mainDepartmentEmployee: {
                    required: true,
                },


            },
            messages: {

                name: {
                    required: "Please enter your name",
                },
                username: {
                    required: "Please enter user name"
                },
                maindepartment: {
                    required: "Please select department",
                },
                gender: {
                    required: "Please select gender",
                },
                role: {
                    required: "Please select role",
                },
                contactno: {
                    required: "Please enter your mobile number",
                    number: "Please enter your mobile number as a numerical value",
                    minlength: "Your mobile number should be 7 digits",
                    maxlength: "Your mobile number can be 15 digits"
                },
                password: {
                    required: "Please enter your password",
                    minlength: "Your password should be 8 digits",
                },
                emailid: {
                    email: "The email should be in the format: abc@domain.tld",
                    isValidEmailAddress: "Please enter valid email address.",
                    required: "Please enter your Valid email ID",
                },

                password_confirmation: {
                    required: "Please enter your conform password",
                    minlength: "Your password should be 8 digits",
                    equalTo: "Those passwords didn’t match. Try again."
                },
                // birth: {
                //     required: "Please select your DOB"
                // },
                designation: {
                    required: "please select designation"
                },
                // addEmployeePostalCode: {
                //     required: "please enter your postal code"
                // },
                // employeeUnitname: {
                //     required: "please enter your unit number"
                // },
                mainDepartmentEmployee: {
                    required: "please select department"
                }


            },
            submitHandler: function() {
                bootbox.confirm(" DO YOU WANT TO SAVE?", function(result) {
                    if (result) {
                        jQuery.ajax({
                            url: "{{ route('SA-AddEmployeeDB') }}",
                            data: jQuery("#addEmployee").serialize(),
                            enctype: "multipart/form-data",
                            type: "post",
                            success: function(result) {
                                if (result.error != null) {} else if (result.barerror != null) {
                                    errorMsg(result.barerror);
                                } else if (result.success != null) {
                                    successMsg(result.success);
                                    jQuery("#addEmployeeClose").click();
                                    jQuery("#addEmployee")["0"].reset();
                                    employeeList();
                                } else {}

                            }
                        });
                    }
                })
            }
        })
    });


    // API for Address
    $(document).on('change', '#addEmployeePostalCode', function() {

        let fullAddress = $(this).val();

        if (fullAddress.toString().length == 6) {



            jQuery.ajax({


                url: "{{route('SA-postaladdresses')}}",
                type: "get",
                data: {
                    postalcode: $(this).val()
                },

                beforeSend: function() {
                    $('#address').val('Lodding...');
                },
                success: function(response) {
                    if (JSON.parse(response).found == 0) {
                        $('#address').val('');
                        $('#addEmployeePostalCode').val('');
                        toastr.error('Please Enter Valid Postal Code');
                    } else {
                        $('#address').val(JSON.parse(response).results[0].ADDRESS);
                    }
                }
            });
        } else {
            toastr.error('Please Enter 6 digits  Postal Code');

        }

    });
</script>