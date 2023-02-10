<!-- Modal -->
<div class="modal fade" id="editEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Designation</h5>
                <button type="button" id="designationSaveClose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="editDesignationForm">
                <!--  body start here -->
                <div class="modal-body bg-white px-3">
                    <!-- quotation id -->
                    <input type="hidden" name="oldEditDegination" id="oldEditDegination">
                    <!-- Designation Name  -->
                    <div class=" form-group row">
                        <div class="col-md-3 col-form-label">Designation Name <span style="color:red;">*</span></div>
                        <div class="col-md-9"><input type="text" class="form-control" name="editDesignationName" id="editDesignationName" placeholder="Designation Name"></div>
                    </div>
                    <!-- Main Department -->
                    <div class=" form-group row">
                        <div class="col-md-3 col-form-label">Main Department <span style="color:red;">*</span> </div>
                        <div class="col-md-9">
                            <select class="form-control" name="editMainDepartment" id="editMainDepartment">
                            </select>
                        </div>
                    </div>
                </div>
                <!-- end here -->
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
        jQuery('#editDesignationForm').submit(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
        }).validate({
            rules: {


                editfirstname: {
                    required: true,
                },
                editusername: {
                    required: true,
                },
            },
            messages: {

                editfirstname: {
                    required: "Please enter name."
                },
                editusername: {
                    required: "Please enter user name."
                },
            },
            submitHandler: function() {
                bootbox.confirm(" DO YOU WANT TO SAVE?", function(result) {
                    if (result) {
                        jQuery.ajax({
                            url: "{{ route('SA-UpdatedesignationDetail') }}",
                            data: jQuery("#editDesignationForm").serialize(),
                            enctype: "multipart/form-data",
                            type: "post",
                            success: function(result) {
                                if (result.error != null) {

                                } else if (result.barerror != null) {
                                    errorMsg(result.barerror);
                                    // jQuery("#editEmployeeAlert").hide();
                                    // jQuery(".alert-danger").show();
                                    // jQuery(".alert-danger").html(result.barerror);
                                } else if (result.success != null) {
                                    successMsg(result.success);
                                    // jQuery("#editEmployeeAlert").html(result.success);
                                    // jQuery("#editEmployeeAlert").show();
                                    jQuery("#editDesignationForm")["0"].reset();
                                    $('#designationSaveClose').click();
                                    designationList();
                                } else {
                                    // jQuery(".alert-danger").hide();
                                    // jQuery("#editEmployeeAlert").hide();
                                }
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
        jQuery("#editDesignationForm")["0"].reset();
    });

    
</script>