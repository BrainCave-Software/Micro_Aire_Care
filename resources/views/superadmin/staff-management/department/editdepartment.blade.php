<!-- Modal -->
<div class="modal fade" id="editDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Department</h5>
                <button type="button" id="employeeSaveClose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" id="editDepartmentForm">
                <div class="modal-body bg-white px-3">
                    <!-- invoice body start here -->
                    <!-- info & alert section -->
                    <!-- <div class="alert alert-success" id="editEmployeeAlert" style="display:none"></div>
                    <div class="alert alert-danger" style="display:none">
                    </div> -->
                    <!-- end -->
                    <!-- quotation id -->
                    <input type="hidden" name="oldeditdepartment" id="oldeditdepartment">
                    <!--  Name -->
                    <div class=" form-group row">
                        <div class="col-md-3 col-form-label">Name <span style="color:red;">*</span></div>
                        <div class="col-md-9"><input type="text" class="form-control" name="editdepartmentname" id="editDepartmentName" placeholder="User Name"></div>
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
        jQuery('#editDepartmentForm').submit(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
        }).validate({
            rules: {


                editdepartmentname: {
                    required: true,
                },
                editdepartmentlocation: {
                    required: true,
                },
                editdepartmenthead: {
                    required: true,
                },
            },
            messages: {

                editdepartmentname: {
                    required: "Please Enter Name."
                },
                editdepartmentlocation: {
                    required: "Please Enter Location."
                },
                editdepartmenthead: {
                    required: "Please Enter Department Head.",
                },
            },
            submitHandler: function() {
                bootbox.confirm(" DO YOU WANT TO SAVE?", function(result) {
                    if (result) {
                        jQuery.ajax({
                            url: "{{ route('SA-UpdateDepartmentDetail') }}",
                            data: jQuery("#editDepartmentForm").serialize(),
                            enctype: "multipart/form-data",
                            type: "post",
                            success: function(result) {
                                if (result.error != null) {

                                } else if (result.barerror != null) {
                                    errorMsg(result.barerror);
                                } else if (result.success != null) {
                                    successMsg(result.success);
                                    jQuery("#editDepartmentForm")["0"].reset();
                                    $('#employeeSaveClose').click();
                                    departmentList();
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
        jQuery("#editDepartmentForm")["0"].reset();
    });
</script>