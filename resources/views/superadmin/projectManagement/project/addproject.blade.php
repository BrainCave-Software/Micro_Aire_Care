<header>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</header>
<!-- Modal -->
<div class="modal fade" id="addProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Project </h5>
                <button type="button" id="addProjectClose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" enctype="multipart/form-data" id="createProjectFileFormPage">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row ">
                            <label for="formFileMultiple" class="col-sm-2 col-form-label">Files Upload: </label>
                            <div class="col-sm-8">
                                <input class="form-control" name="projectFile" type="file" id="projectFile" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" multiple>
                                <label> <span style="color:red;">* allow only .xlsx file upload</span></label>

                            </div>
                            <div class="col-sm-2 ">
                                <button type="submit" name='excelViewproject' data-id='value["customer_id"]' class="btn btn-primary">Upload</button>
                                <!-- <a href="download" class="btn btn-success">Download</a> -->

                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form class="forms-sample" id="addProjectForm45" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- info & alert section -->
                    <div class="alert alert-success" id="addProjectAlert" style="display:none"></div>
                    <div class="alert alert-danger" style="display:none">
                        <ul></ul>
                    </div>
                    <!-- end -->

                    <div class="card">
                        <div class="card-body">
                            <!-- project id -->
                            <input type="hidden" id="projectId" name="projectIdName">
                            <!-- Project Title  -->
                            <div class="form-group row">
                                <label for="project_title" class="col-sm-3 col-form-label">Job Sheet No. <span style="color:red; font-size:medium">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="projectTitle" name="projecttitle" placeholder="Project Title" />
                                </div>
                            </div>

                            <!-- client Name -->
                            <div class="form-group row">
                                <label for="client_name" class="col-sm-3 col-form-label">Client Name </label>
                                <div class="col-sm-9">
                                    <!-- <select class="form-control" name="clientname" id="clientName">
                                    </select> -->
                                    <input type="text" class="form-control" name="clientExcelName" id="clientNameExcel" placeholder="Client Name">
                                </div>
                            </div>

                            <!-- Address Name -->
                            <div class="form-group row">
                                <label for="client_name" class="col-sm-3 col-form-label">Address </label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="clientAddress" id="clientNam123e" placeholder="Address">
                                </div>
                            </div>

                            <!-- Postal code -->
                            <div class="form-group row">
                                <label for="postalCode" class="col-sm-3 col-form-label">Postal Code </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="postal_Code" id="postalCode" placeholder="Postal Code">
                                </div>
                            </div>

                            <!-- Start Date -->
                            <div class="form-group row">
                                <label for="start_date" class="col-sm-3 col-form-label">Start Date <span style="color:red; font-size:medium">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="startDate" name="startdate" placeholder="Start Date" />
                                </div>
                            </div>

                            <!-- Deadline -->
                            <div class="form-group row">
                                <label for="deadline" class="col-sm-3 col-form-label">Deadline <span style="color:red; font-size:medium">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="deadline" name="deadline" placeholder="Deadline" />
                                </div>
                            </div>

                            <!-- Mobile number-->
                            <div class="form-group row">
                                <label for="mobilr_no" class="col-sm-3 col-form-label">Mobile Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="mobileNo" id="mobileNo"  placeholder="Mobile Number">
                                </div>
                            </div>

                            <!-- Assign to-->
                            <div class="form-group row">
                                <label for="sale_person" class="col-sm-3 col-form-label">Sales Person<span style="color:red; font-size:medium">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="assignto" id="assignTo" placeholder="Sale Person">
                                </div>
                            </div>

                            <!-- Sale Contact-->
                            <div class="form-group row">
                                <label for="saleContact" class="col-sm-3 col-form-label">Sale Contact <span style="color:red; font-size:medium">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="saleContact" id="saleContact" maxlength="8" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Sale Contact">
                                </div>
                            </div>

                            <div>
                                <input type="hidden" name="taskName" id="taskId">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-clear" id="addProjectFormClearBtn">Clear</button>
                    <button type="submit" id="addForm" class="btn btn-save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery CDN -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
<script>
    // clear form
    jQuery('#addProjectFormClearBtn').on('click', function() {
        jQuery("#addProjectForm45")["0"].reset();
    });
    // Get client Name
    // getClient();

    // function getClient() {
    //     $.ajax({
    //         type: "GET",
    //         url: "{{ route('SA-clientName')}}",
    //         success: function(response) {
    //             $('#clientName').html('');
    //             $('#clientName').append('<option value="">Select client name</option>');
    //             $('#editclientName').html('');
    //             $('#editclientName').append('<option value="">Select client name</option>');
    //             jQuery.each(response, function(key, value) {
    //                 $('#clientName').append(
    //                     '<option value="' + value["customer_name"] + '">\
    //                     ' + value["customer_name"] + '\
    //                     </option>'
    //                 );
    //                 $('#editclientName').append(
    //                     '<option value="' + value["customer_name"] + '">\
    //                     ' + value["customer_name"] + '\
    //                     </option>'
    //                 );
    //             });
    //         }
    //     });
    // }
    // Get client Name(End)
    // file upload and fatch excel
    $(document).ready(function() {
        jQuery('#createProjectFileFormPage').submit(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
        }).validate({
            rules: {

            },
            message: {

            },
            submitHandler: function() {
                const formData = new FormData($('#createProjectFileFormPage')["0"]);
                jQuery.ajax({
                    url: "{{ route('SA-CreateProjectFile') }}",
                    enctype: "multipart/form-data",
                    type: "post",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        console.log(result.return_data);
                        if (result.error != null) {
                            jQuery(".salesQuantityError").hide();
                        } else if (result.barerror != null) {
                            errorMsg(result.barerror);
                            jQuery(".salesQuantityError").hide();
                        } else if (result.success != null) {
                            successMsg(result.success);
                            jQuery("#createProjectFileFormPage")["0"].reset();
                            getProductEdit();
                            ListProjectFile();
                            $('#projectId').val(result.return_data.project_id);
                            $('#projectTitle').val(result.return_data.job_sheet);
                            $('#clientNameExcel').val(result.return_data.client_name);
                            $('#clientNam123e').val(result.return_data.address);
                            $('#startDate').val(result.return_data.date);
                            $('#deadline').val(result.return_data.delivery_date);
                            $('#mobileNo').val(result.return_data.mobile);
                            $('#assignTo').val(result.return_data.sale_person);
                            $('#taskId').val(result.return_data.task);
                            $('#postalCode').val(result.return_data.postalCode);
                            // $('#saleContact').val(result.return_data.sale_person);
                        } else if (result.salesQuantityError != null) {} else {}
                    },
                });
            }
        })
    });
    // End
    // After upload show excel data


    function getProductEdit() {
        $.ajax({
            type: "GET",
            url: "{{ route('SA-autoFillForm')}}",
            success: function(response) {
                console.log('hello5', ($('#clientNam123e').val()));
                jQuery.each(response, function(key, value) {

                });
            }
        });
    }


    // validation with data store
    $(document).ready(function() {
        jQuery('#addProjectForm45').submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
        }).validate({
            rules: {
                projecttitle: {
                    required: true,
                },
                clientname: {
                    required: true,
                },
                startdate: {
                    required: true,
                },
                deadline: {
                    required: true,
                },
                assignto: {
                    required: true,
                },
                assignto: {
                    required: true,
                }
            },
            messages: {
                projecttitle: {
                    required: "Please enter valid  name .",
                },
                clientname: {
                    required: "This field is required.",
                },
                startdate: {
                    required: "This field is required.",
                },
                deadline: {
                    required: "This field is required",
                },
                assignto: {
                    required: "This field is require",
                },
                assignto: {
                    required: "This field is require "
                }
            },
            submitHandler: function() {
                bootbox.confirm(" DO YOU WANT TO SAVE?", function(result) {
                    if (result) {
                        jQuery.ajax({
                            url: "{{route('SA-addProject')}}",
                            data: jQuery("#addProjectForm45").serialize(),
                            type: "post",

                            success: function(result) {
                                if (result.error != null) {
                                    jQuery(".alert-danger>ul").html(
                                        "<li> Info ! Please complete below mentioned fields : </li>"
                                    );
                                    jQuery.each(result.error, function(key, value) {

                                        jQuery(".alert-danger").show();
                                        jQuery(".alert-danger>ul").append(
                                            // "<li>" + key + " : " + value + "</li>"
                                        );
                                    });
                                } else if (result.barerror != null) {
                                    errorMsg(result.barerror);
                                } else if (result.success != null) {
                                    successMsg(result.success);
                                    $("#addProjectClose").click();
                                    jQuery("#addProjectForm45")["0"].reset();
                                    ListProject();

                                } else {}
                            },
                        });
                    }
                })
            }
        })
    });
</script>
<script>
$('#startDate').datepicker({ dateFormat: 'dd-mm-yy' }).val();
$('#deadline').datepicker({ dateFormat: 'dd-mm-yy' }).val();
</script>
