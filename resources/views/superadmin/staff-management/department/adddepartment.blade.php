<div class="modal fade" id="addNewDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-2">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                <button type="button" id="addDepartmentClose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" id="addDepartment">
                <div class="modal-body bg-white px-3">
                    <div class=" form-group row">
                        <!-- Name -->
                        <div class="col-md-3 col-form-label">Name <span style="color:red;">*</span></div>
                        <div class="col-md-9"><input type="text" class="form-control" name="departmentname" id="departmentName" placeholder="Name"></div>
                        </div>
                    <div class=" form-group row">
                        <!-- Location -->
                        <!-- <div class="col-md-3 col-form-label">Location <span style="color:red;">*</span></div>
                        <div class="col-md-9"><input type="text" class="form-control" name="departmentlocation" id="departmentLocation" placeholder="Location"></div> -->
                         </div>
                    <div class=" form-group row">
                        <!-- department head -->
                        <!-- <div class="col-md-3 col-form-label">Department Head <span style="color:red;">*</span></div>
                        <div class="col-md-9"><input type="text" class="form-control" name="departmenthead" id="departmentHead" placeholder="Department Head" require></div> -->
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
        jQuery("#addDepartment")["0"].reset();
    });



    // validation with data
    $(document).ready(function() {
        jQuery('#addDepartment').submit(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
        }).validate({
            rules: {

                departmentname: {
                    required: true,
                },
                
               

            },
            messages: {

                departmentname: {
                    required: "Please Enter  Name",
                },

                

            },
            submitHandler: function() {
                bootbox.confirm(" DO YOU WANT TO SAVE?", function(result) {
                    if (result) {
                        jQuery.ajax({
                            url: "{{ route('SA-AddDepartmentDB') }}",
                            data: jQuery("#addDepartment").serialize(),
                            enctype: "multipart/form-data",
                            type: "post",
                            success: function(result) {
                                if (result.error != null) {
                                } else if (result.barerror != null) {
                                    errorMsg(result.barerror);
                                } else if (result.success != null) {
                                    successMsg(result.success);
                                    jQuery("#addDepartmentClose").click();
                                    $("#clearFormBtn").click();
                                    departmentList();
                                } else {
                                }

                            }
                        });
                    }
                })
            }
        })
    });
</script>