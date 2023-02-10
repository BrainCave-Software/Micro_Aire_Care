<div class="modal fade" id="addNewEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-2">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Designation</h5>
                <button type="button" id="addEmployeeClose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" id="addDesignation">
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
                    <!-- Designation Name-->
                    <div class=" form-group row">
                        <div class="col-md-3 col-form-label">Designation Name <span style="color:red;">*</span></div>
                        <div class="col-md-9"><input type="text" class="form-control" name="designationName" id="designationName" placeholder="Designation Name"></div>
                    </div>


                    <!-- Main Department -->
                    <div class="form-group row">
                        <div class="col-md-3 col-form-label">Main Department <span style="color:red;">*</span> </div>
                        <div class="col-md-9">
                            <select class="form-control" name="mainDepartment" id="mainDepartment">
                            </select>
                        </div>
                    </div>





                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-clear" id="clearFormBtn">Clear</button>
                    <button type="submit" id="" class="btn btn-save">Save</button>
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
        jQuery("#addDesignation")["0"].reset();
    });

    // Get department Name

    getdepartment();

    function getdepartment() {
        $.ajax({
            type: "GET",
            url: "{{route('SA-selectDepartmentName')}}",
            success: function(response) {
                $('#mainDepartment').html('');
                $('#mainDepartment').append('<option value="">Select Department name</option>');
                $('#editMainDepartment').html('');
                $('#editMainDepartment').append('<option value="">Select Department name</option>');
                jQuery.each(response, function(key, value) {
                    $('#mainDepartment').append(
                        '<option value="' + value["department_name"] + '">\
            ' + value["department_name"] + '\
            </option>'
                    );
                    $('#editMainDepartment').append(
                        '<option value="' + value["department_name"] + '">\
            ' + value["department_name"] + '\
            </option>'
                    );
                });
            }
        });
    }
    // Get Department Name(End)


    // validation with data
    $(document).ready(function() {
        jQuery('#addDesignation').submit(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
        }).validate({
            rules: {

                designationName: {
                    required: true,
                },
                mainDepartment: {
                    required: true,
                },

            },
            messages: {

                designationName: {
                    required: "Please Enter Your Designation Name",
                },

                mainDepartment: {
                    required: "Please Select Department ",
                },

            },
            submitHandler: function() {
                bootbox.confirm(" DO YOU WANT TO SAVE?", function(result) {
                    if (result) {
                        jQuery.ajax({
                            url: "{{ route('SA-AddDesignationDB') }}",
                            data: jQuery("#addDesignation").serialize(),
                            enctype: "multipart/form-data",
                            type: "post",
                            success: function(result) {
                                if (result.error != null) {} else if (result.barerror != null) {
                                    errorMsg(result.barerror);

                                    // jQuery("#addUserAlert").hide();
                                    // jQuery("#addUserErrorAlert").show();
                                    // jQuery("#addUserDangerAlert").html(result.barerror);
                                } else if (result.success != null) {
                                    successMsg(result.success);
                                    // jQuery("#addUserSuccessAlert").html(result.success);
                                    // $('#addUserAlert').show();
                                    jQuery("#addEmployeeClose").click();
                                    designationList();
                                    jQuery("#addDesignation")["0"].reset();

                                    // $('#addUserErrorAlert').hide();
                                    employeeList();
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
</script>