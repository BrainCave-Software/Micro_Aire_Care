<div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lgs" role="document">
        <div class="modal-content bg-white p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" id="addTaskForm1" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-body">

                    <!-- info & alert section -->
                    <div class="alert alert-success" id="addTaskAlert" style="display:none"></div>
                    <div class="alert alert-danger" style="display:none">
                        <ul></ul>
                    </div>
                    <!-- end -->

                    <div class="card">
                        <div class="card-body">

                            <!-- Task Name  -->
                            <div class="form-group row">
                                <label for="task_name" class="col-sm-3 col-form-label">Task Name <span style="color:red; font-size:medium">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="task_name" name="task_name" placeholder="Task Name" />
                                </div>
                            </div>

                            <!-- Product Varient -->
                            <div class="form-group row">
                                <label for="assigned_to" class="col-sm-3 col-form-label">Assigned To <span style="color:red; font-size:medium">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="assigned_to" name="assigned_to" placeholder="Assigned To" />
                                </div>
                            </div>

                            <!-- SKU Code -->
                            <div class="form-group row">
                                <label for="start_time" class="col-sm-3 col-form-label">Start Date <span style="color:red; font-size:medium">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="start_time" name="start_time" placeholder="Start Date" />
                                </div>
                            </div>

                            <!-- Tax -->
                            <div class="form-group row">
                                <label for="end_time" class="col-sm-3 col-form-label">End Date <span style="color:red; font-size:medium">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="end_time" name="end_time" placeholder="End Date" />
                                </div>
                            </div>

                            <!-- Supplier Code -->
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" class="form-control">
                                        <option value="Pending">Pending</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="addTaskFormClearBtn">Clear</button>
                    <button type="submit" id="addTaskForm" class="btn btn-primary">Add Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<!-- backend js file -->

<script>

// clear form
jQuery('#addTaskFormClearBtn').on('click', function() {
    jQuery("#addTaskForm1")["0"].reset();
  });

  // validation script start here
  $(document).ready(function() {

    $.validator.addMethod("validate", function(value) {
      return /[A-Za-z]/.test(value);
    });

    

    $("#addTaskForm1").validate({
      rules: {

        task_name: {
          required: true,
          validate: true,
        },

        assigned_to: {
          required: true,
        },

        start_time: {
          required: true,
        },

        end_time: {
          required: true,
          
        },

        

      },
      messages: {
        task_name: {
          required: "Please enter valid  name.",
          validate: "Please enter valid  name.",
        },
        assigned_to: {
          required: "This field is required.",
        },
        start_time: {
          required: "This field is required.",
        },

        end_time: {
          required: "This field is required",
         
        },
        
      }

    });
  });
  // end here


    jQuery(document).ready(function() {
        jQuery("#addTaskForm1").submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
            jQuery.ajax({
                url: "{{ route('SA-AddTask') }}",
                data: jQuery("#addTaskForm1").serialize(),
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
                        jQuery("#addTaskAlert").hide();
                        jQuery(".alert-danger").show();
                        jQuery(".alert-danger").html(result.barerror);
                    } else if (result.success != null) {
                        jQuery(".alert-danger").hide();
                        jQuery("#addTaskAlert").html(result.success);
                        jQuery("#addTaskAlert").show();
                        jQuery("#addTaskForm1")["0"].reset();
                        getTasks();
                    } else {
                        jQuery(".alert-danger").hide();
                        jQuery("#addTaskAlert").hide();
                    }
                },
            });
        });
    });
</script>