<!-- Modal -->
<div class="modal fade" id="editProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Project </h5>
                <button type="button" id="editProjectClose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="forms-sample" id="editProjectForm" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="projectid" id="projectId">
                    <!-- info & alert section -->
                    <div class="alert alert-success" id="editProjectAlert" style="display:none"></div>
                    <div class="alert alert-danger" style="display:none">
                        <ul></ul>
                    </div>
                    <!-- end -->

                    <div class="card">
                        <div class="card-body">

                            <!-- Project Title  -->
                            <div class="form-group row">
                                <label for="project_title" class="col-sm-3 col-form-label">Project Title <span style="color:red; font-size:medium">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editprojectTitle" name="editprojecttitle" placeholder="Project Title" />
                                </div>
                            </div>

                            <!-- client Name -->
                            <div class="form-group row">
                                <label for="client_name" class="col-sm-3 col-form-label">client Name <span style="color:red; font-size:medium">*</span> </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="editclientname" id="editclientName">
                                    </select>
                                </div>
                            </div>

                            <!-- Start Date -->
                            <div class="form-group row">
                                <label for="start_date" class="col-sm-3 col-form-label">Start Date <span style="color:red; font-size:medium">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="editstartDate" name="editstartdate" placeholder="Start Date" />
                                </div>
                            </div>

                            <!-- Deadline -->
                            <div class="form-group row">
                                <label for="deadline" class="col-sm-3 col-form-label">Deadline <span style="color:red; font-size:medium">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="editdeadline" name="editdeadline" placeholder="Deadline" />
                                </div>
                            </div>

                            <!-- Assign to-->
                            <div class="form-group row">
                                <label for="assign_to" class="col-sm-3 col-form-label">Assign to</label>
                                <div class="col-sm-9">
                                    <!-- <select class="form-control" name="assignto" id="assignTo">
                                    </select> -->
                                    <input type="text" class="form-control" name="editassignto" id="editassignTo">
                                </div>
                            </div>
                             <!-- manager-->
                             <div class="form-group row">
                                <label for="assign_to" class="col-sm-3 col-form-label">Manager</label>
                                <div class="col-sm-9">
                                    <!-- <select class="form-control" name="assignto" id="assignTo">
                                    </select> -->
                                    <input type="text" class="form-control" name="editmanager" id="editmanager">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-clear" id="editProjectFormClearBtn">Clear</button>
                    <button type="submit" id="addForm" class="btn btn-save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('#editProjectFormClearBtn').on('click', function() {
        $('#editProjectForm')["0"].reset();
    });
    // ==================================================================================
    // store data to database and validation
    // ==================================================================================
    $(document).ready(function() {
        jQuery('#editProjectForm').submit(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
        }).validate({
            rules: {
                editprojecttitle: {
                    required: true,

                },

                editclientname: {
                    required: true,
                },

                editstartdate: {
                    required: true,
                },

                editdeadline: {
                    required: true,

                },
                editassignto: {
                    required: true,
                }

            },
            messages: {
                editprojecttitle: {
                    required: "Please enter valid  name .",
                },
                editclientname: {
                    required: "This field is required.",
                },
                editstartdate: {
                    required: "This field is required.",
                },

                editdeadline: {
                    required: "This field is required",

                },
                editassignto: {
                    required: "This field is require",
                }
            },
            submitHandler: function() {
                bootbox.confirm(" DO YOU WANT TO SAVE?", function(result) {
                    if (result) {
                jQuery.ajax({
                    url: "{{route('SA-UpdateProject')}}",
                    data: jQuery("#editProjectForm").serialize(),
                    enctype: "multipart/form-data",
                    type: "post",

                    success: function(result) {
                        if (result.error != null) {} else if (result.barerror != null) {
                            errorMsg(result.barerror);

                            // jQuery("#addProjectAlert").hide();
                            // jQuery(".alert-danger").show();
                            // jQuery(".alert-danger").html(result.barerror);
                        } else if (result.success != null) {
                            successMsg(result.success);
                            $("#editProjectClose").click();
                            // jQuery(".alert-danger").hide();
                            // jQuery("#addProjectAlert").html(result.success);
                            // jQuery("#addProjectAlert").show();
                            jQuery("#editProjectForm")["0"].reset();

                        } else {
                            // jQuery(".alert-danger").hide();
                            // jQuery("#addProjectAlert").hide();
                        }
                    },
                });
            }
                })
            }
        })
    });
</script>