<header>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


</header>
<!-- Modal -->
<div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-2">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Task</h5>
                <button type="button" id="taskClose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" id="assignTask" enctype="multipart/form-data">
                <div class="modal-body bg-white px-3">


                    <div class="">
                        <div class="">
                            <input type="hidden" name="projectExcel_id" id="projectExcel_id">
                            <input type="hidden" name="projectName" id="projectId">
                            <input type="hidden" name="projName" id="projectNameId">
                            <input type="hidden" name="heading_all" id="heading_all">
                            <!-- sub task -->
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9 main">
                                    <textarea class="text-center" name="taskAll" id="task_all" cols="70" rows="7" readonly></textarea>
                                </div>
                            </div>
                            <!-- username -->
                            <!-- <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="username" id="username"> </select>
                                </div>
                            </div> -->

                            <div class="row">
                                <div class="col-md-12">
                                    <!-- image section -->
                                    <div class="form-group row">
                                        <label for="image" class="col-sm-3 col-form-label">Name <span style="color:red;">*</span> </label>
                                        <div class="col-sm-9">
                                            <button class="btn btn-success" id="addImageBtn" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add Employee</button>
                                            <div class="input-group hdtuto control-group lst increment">
                                                <!-- images -->
                                            </div>
                                            <div class="clone hide">
                                                <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                                    <select class="form-control" name="username[]" id="username"> </select>
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-danger" id="removeImage" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- <div class="row">
                                <div class="col-md-12"> -->
                            <!-- image section -->
                            <!-- <div class="form-group row">
                                        <label for="image" class="col-sm-3 col-form-label">Multiple Image</label>
                                        <div class="col-sm-9"> -->
                            <!-- <button class="btn btn-success" id="addImageBtn" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add Image</button>
                                            <div class="input-group hdtuto control-group lst increment">
                                                </div> -->
                            <!-- images -->
                            <!-- <div class="clone hide" style="display: none;">
                                                <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                                    <input type="file" name="filenames[]" class="myfrm form-control">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-danger" id="removeImage" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                                                    </div>
                                                </div>
                                            </div> -->
                            <!-- </div>
                                    </div>
                                </div>
                            </div> -->



                            <!-- Due Date -->
                            <div class="form-group row">
                                <label for="dueDate" class="col-sm-3 col-form-label">Deadline  <span style="color:red">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="dueDate" id="dueDate" placeholder="Due Date" />
                                </div>
                            </div>

                            <!-- Action -->
                            <div class="form-group row">
                                <!-- <label for="addAction" class="col-sm-3 col-form-label">Action</label> -->
                                <div class="col-sm-9">
                                    <select style="display: none;"  class="form-control" name="addAction" id="addAction">
                                        <!-- <option value="New">Select Task</option> -->
                                        <option value="Process">Process</option>
                                        <!-- <option value="Complete">complete</option> -->
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-clear" id="clearFormBtn">Clear</button>
                    <button type="submit" id="addTask" class="btn btn-save">Save</button>
                </div>
            </form>
            <!-- table start -->
            <div class="border border-secondary" style="padding:20px;">
                <div class="table-responsive" style="overflow-x:scroll;">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <!-- <th class="border border-secondary">S/N</th>
                                <th class="border border-secondary">Employee Name</th>
                                <th class="border border-secondary">Deadline</th> -->
                                <!-- <th class="border border-secondary">Size</th>
                                <th class="border border-secondary" colspan="2">Action</th> -->

                            </tr>


                        </thead>

                        <tbody class="tbody listAddWork">



                        </tbody>
                    </table>
                </div>

            </div>
            <!-- table end here -->
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-clear" id="clearFormBtn" aria-label="Close" data-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {

        $(document).on('click', '#addImageBtn', function() {
            var lsthmtl = $(".clone").html();
            $(".increment").append(lsthmtl);
        });

        $(document).on("click", "#removeImage", function() {
            $(this).parent().parent().remove();
        });

    });
    // Get employee name

    getEmployee();

    function getEmployee() {
        $.ajax({
            type: "GET",
            url: "{{route('SA-selectEmployeeName')}}",
            success: function(response) {
                $('#username').html('');
                $('#username').append('<option value="">Select Employee Name</option>');
                jQuery.each(response, function(key, value) {
                    $('#username').append(
                        '<option value="' + value["users_id"] + '">\
        ' + value["name"] + '\
        </option>'
                    );

                });
            }
        });
    }
    // Get Department Name(End)



    $(document).ready(function() {
        jQuery('#assignTask').submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
        }).validate({
            rules: {
                "username[]": {
                    required: true,
                    minlength: 1,
                },
                dueDate: {
                    required: true,
                }
            },
            messages: {
                "username[]": {
                    required: "This field is required"

                },
                dueDate: {
                    required: "This field is required"
                }
            },
            submitHandler: function() {
                bootbox.confirm(" DO YOU WANT TO SAVE?", function(result) {
                    if (result) {
                        jQuery.ajax({
                            url: "{{ route('SA-AddNewTask') }}",
                            data: jQuery("#assignTask").serialize(),
                            enctype: "multipart/form-data",
                            type: "post",
                            success: function(result) {
                                if (result.error != null) {} else if (result.barerror != null) {
                                    errorMsg(result.barerror);
                                } else if (result.success != null) {
                                    successMsg(result.success);
                                    jQuery("#assignTask")["0"].reset();
                                    $('#taskClose').click();
                                    window.location.href = "";
                                    // getUserDetails();
                                }
                            }
                        });
                    }
                })
            }
        })
    });

    // $(document).ready(function() {

    //     $(document).on('click', '#addImageBtn', function() {
    //         var lsthmtl = $(".clone").html();
    //         $(".increment").append(lsthmtl);
    //     });

    //     $(document).on("click", "#removeImage", function() {
    //         $(this).parent().parent().remove();
    //     });

    // });
</script>
<script>
    $('#dueDate').datepicker({
        dateFormat: 'dd-mm-yy'
    }).val();
</script>