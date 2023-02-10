<div class="modal fade" id="editRolePreviledges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-2">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit New Role</h5>
                <button type="button" class="close" id="editRoleoleclose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" id="editPreviledges">
                <div class="modal-body bg-white px-3">
                    <input type="hidden" class="form-control" name="oldrole" id="oldRole" />

                    <!-- info & alert section -->
                    <!-- <div class="alert alert-success alert-dismissible fade show" id="editUserAlert" style="display:none" role="alert">
                        <strong>Info ! </strong> <span id="editUserSuccessAlert"></span>
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->

                    <!-- <div class="alert alert-danger alert-dismissible fade show" id="editUserErrorAlert" style="display:none" role="alert">
                        <strong>Info ! </strong> <span id="editUserDangerAlert"></span>
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->
                    <!-- end -->

                    <div class=" form-group row">
                        <div class="col-md-2 col-form-label">Role Name</div>
                        <div class="col-md-4"><input type="text" class="form-control" name="rolename" id="editrolenameId" placeholder="Role Name"></div>
                        <!-- <div class="col-md-2 col-form-label">Select Access </div>
                        <div class="col-md-4">
                            <select class="form-control" name="access" id="editacessId">
                                <option value="">Select Access </option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div> -->

                    </div>

                    <div class="form-group row">
                        <div class="col-md-2 col-form-label">Resources</div>
                        <div class="col-md-10 ml-3">
                            <div class="" style="font-size: smaller; color:red;" id="editresources"></div>
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
                                            <input type="checkbox" class="form-check-input require-one cb_child" value="staff" name="list[]" id="editStaff" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> Staff
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-check-primary">
                                        <label class="">
                                            <input type="checkbox" class="form-check-input require-one cb_child" value="timesheet" name="list[]" id="editTimesheet" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> Time sheet
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-check-primary">
                                        <label class="">
                                            <input type="checkbox" class="form-check-input require-one cb_child" value="projects" name="list[]" id="editProjects" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> Projects
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check form-check-primary">
                                        <label class="">
                                            <input type="checkbox" class="form-check-input require-one cb_child" value="filemanage" name="list[]" id="editFilemanage" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> File manage
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-check-primary">
                                        <label class="">
                                            <input type="checkbox" class="form-check-input require-one cb_child" value="crm" name="list[]" id="editCrm" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> CRM
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-clear" id="clearFormEditBtn">Clear</button>
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
    // store data in db
    $("#editPreviledges").submit(function(e) {

        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        });
        bootbox.confirm(" DO YOU WANT TO SAVE?", function(result) {
            if (result) {
                jQuery.ajax({
                    url: "{{ route('SA-GetUpdateRole') }}",
                    data: jQuery("#editPreviledges").serialize(),
                    enctype: "multipart/form-data",
                    type: "post",

                    success: function(result) {
                        if (result.error != null) {

                        } else if (result.barerror != null) {
                            errorMsg(result.barerror);

                            // jQuery("#editUserAlert").hide();
                            // jQuery("#editUserErrorAlert").show();
                            // jQuery("#editUserDangerAlert").html(result.barerror);
                        } else if (result.success != null) {
                            successMsg(result.success);

                            // jQuery("#editUserAlert").hide();
                            // jQuery("#editUserSuccessAlert").html(result.success);
                            // $('#editUserAlert').show();
                            jQuery("#editPreviledges")["0"].reset();
                            // $('#editUserErrorAlert').hide();
                            $('#editRoleoleclose').click();
                            employeeList();
                            // } else {
                            //     jQuery("#editUserAlert").hide();
                            //     jQuery("#editUserAlert").hide();
                        }
                    },
                });
            }
        })
    });

    $('input[type="checkbox"]').click(function() {
        var allChecked = $('#accessToAllEdit').prop('checked');
        var staff = $('#editStaff').prop('checked');
        var timesheet = $('#editTimesheet').prop('checked');
        var projects = $('#editProjects').prop('checked');
        var filemanage = $('#editFilemanage').prop('checked');
        var crm = $('#editCrm').prop('checked');
        if (allChecked || staff || timesheet || projects || filemanage || crm) {
            $('#editresources').hide();
        } else {
            $('#editresources').show();
        }

    });

    // remove Access to all
    $('#accessToAllEdit').change(function() {
        $('.cb_child').prop('checked', this.checked)
    })
    $('.cb_child').change(function() {
        if ($('.cb_child:checked').length == $('.cb_child').length) {
            $('#accessToAllEdit').prop('checked', true)

        } else {
            $('#accessToAllEdit').prop('checked', false)


        }
    })
    jQuery('#clearFormEditBtn').on('click', function() {
        jQuery("#editPreviledges")["0"].reset();
    });
</script>