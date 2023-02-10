<div class="modal fade" id="addRolePreviledges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-2">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Role</h5>
                <button type="button" class="close" id="closeAddRole" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" id="addPreviledges">
                <div class="modal-body bg-white px-3">
                    <!-- info & alert section -->
                    <!-- <div class="alert alert-success alert-dismissible fade show" id="addUserAlert" style="display:none" role="alert">
                        <strong>Info ! </strong> <span id="addUserSuccessAlert"></span>
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->

                    <!-- <div class="alert alert-danger alert-dismissible fade show" id="addUserErrorAlert" style="display:none" role="alert">
                        <strong>Info ! </strong> <span id="addUserDangerAlert"></span>
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->
                    <!-- end -->

                    <div class=" form-group row">
                        <div class="col-md-2 col-form-label">Role Name</div>
                        <div class="col-md-4"><input type="text" class="form-control" name="rolename" id="rolenameId" placeholder="Role Name"></div>
                        <!-- <div class="col-md-2 col-form-label">Select Access </div>
                        <div class="col-md-4">
                            <select class="form-control" name="access" id="acessId">
                                <option value="">Select Access </option>
                                <option value="access to all">Access to All</option>
                                <option value="manual">Manual</option>
                            </select>
                        </div> -->

                    </div>

                    <div class="form-group row">
                        <div class="col-md-2 col-form-label">Resources</div>
                        <div class="col-md-10 ml-3">
                            <div class="" style="font-size: smaller; color:red;" id="addresources"></div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check form-check-primary">
                                        <label class="">
                                            <input type="checkbox" class="form-check-input require-one" value="all" name="list[]" id="accessToAll" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> Access To All
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-check-primary">
                                        <label class="">
                                            <input type="checkbox" class="form-check-input require-one cb_child" value="staff" name="list[]" id="staff" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> Staff
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-check-primary">
                                        <label class="">
                                            <input type="checkbox" class="form-check-input require-one cb_child" value="timesheet" name="list[]" id="timeSheet" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> Time sheet
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-check-primary">
                                        <label class="">
                                            <input type="checkbox" class="form-check-input require-one cb_child" value="projects" name="list[]" id="projects" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> Projects
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-3">

                                    <div class="form-check form-check-primary">
                                        <label class="">
                                            <input type="checkbox" class="form-check-input require-one cb_child" value="filemanage" name="list[]" id="fileManage" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> File manage
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <div class="form-check form-check-primary">
                                        <label class="">
                                            <input type="checkbox" class="form-check-input require-one cb_child" value="crm" name="list[]" id="crm" style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> CRM
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-clear" id="clearFormRoleBtn">Clear</button>
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
    jQuery('#clearFormRoleBtn').on('click', function() {
        jQuery("#addPreviledges")["0"].reset();
    });
    // store data in db
    $("#addPreviledges").submit(function(e) {

        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        });
        bootbox.confirm(" DO YOU WANT TO SAVE?", function(result) {
            if (result) {
                jQuery.ajax({
                    url: "{{ route('SA-AddPreviledgesDB') }}",
                    data: jQuery("#addPreviledges").serialize(),
                    enctype: "multipart/form-data",
                    type: "post",
                    success: function(result) {
                        if (result.error != null) {
                        } else if (result.barerror != null) {
                            errorMsg(result.barerror);
                            // jQuery("#addUserAlert").hide();
                            // jQuery("#addUserErrorAlert").show();
                            // jQuery("#addUserDangerAlert").html(result.barerror);
                        } else if (result.success != null) {
                            successMsg(result.success);
                            // jQuery("#addUserAlert").hide();
                            // jQuery("#addUserSuccessAlert").html(result.success);
                            // $('#addUserAlert').show();
                            jQuery("#addPreviledges")["0"].reset();
                            // $('#addUserErrorAlert').hide();
                            $('#closeAddRole').click();
                            updateRoles();
                            employeeList();
                        } else {
                            // jQuery("#addUserAlert").hide();
                            // jQuery("#addUserAlert").hide();
                        }
                    },
                });
            }
        })
    });


    $('input[type="checkbox"]').click(function() {
        var allChecked = $('#accessToAll').prop('checked');
        var staff = $('#staff').prop('checked');
        var timeSheet = $('#timeSheet').prop('checked');
        var projects = $('#projects').prop('checked');
        var fileManage = $('#fileManage').prop('checked');
        var crm = $('#crm').prop('checked');
        if (allChecked || staff || timeSheet || projects || fileManage || crm) {
            $('#addresources').hide();
        } else {
            $('#addresources').show();
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
</script>