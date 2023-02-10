<div class="modal fade" id="editTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lgs" role="document">
        <div class="modal-content bg-white p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" id="editTaskForm1" method="post">
                @csrf
                <div class="modal-body">

                    <!-- info & alert section -->
                    <div class="alert alert-success" id="editTaskAlert" style="display:none"></div>
                    <div class="alert alert-danger" style="display:none">
                        <ul></ul>
                    </div>
                    <!-- end -->

                    <input type="text" name="id" id="editTaskId" style="display: none;">

                    <div class="card">
                        <div class="card-body">
                            <!-- Task Name  -->
                            <div class="form-group row">
                                <label for="task_name" class="col-sm-3 col-form-label">Task Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edittask_name" name="task_name" placeholder="Task Name" />
                                </div>
                            </div>

                            <!-- Product Varient -->
                            <div class="form-group row">
                                <label for="assigned_to" class="col-sm-3 col-form-label">Assigned To</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editassigned_to" name="assigned_to" placeholder="Assigned To" />
                                </div>
                            </div>

                            <!-- SKU Code -->
                            <div class="form-group row">
                                <label for="start_time" class="col-sm-3 col-form-label">Start Date</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="editstart_time" name="start_time" placeholder="Start Date" />
                                </div>
                            </div>

                            <!-- Tax -->
                            <div class="form-group row">
                                <label for="end_time" class="col-sm-3 col-form-label">End Date</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="editend_time" name="end_time" placeholder="End Date" />
                                </div>
                            </div>

                            <!-- Supplier Code -->
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="status" id="editstatus" class="form-control">
                                        <option value="Pending">Pending</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="editTaskForm" class="btn btn-primary">Update</button>
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
    jQuery(document).ready(function() {
        jQuery("#editTaskForm1").submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });
            $.ajax({
                url: "{{ route('SA-EditTask') }}",
                data: jQuery("#editTaskForm1").serialize(),
                type: "post",
                success: function(result) {
                    jQuery(".alert-danger>ul").html(
                        "<li> Info ! Please complete below mentioned fields : </li>"
                    );
                    if (result.error != null) {
                        jQuery.each(result.error, function(key, value) {
                            jQuery(".alert-danger").show();
                            jQuery(".alert-danger>ul").append(
                                "<li>" + key + " : " + value + "</li>"
                            );
                        });
                    } else if (result.barerror != null) {
                        jQuery("#editTaskAlert").hide();
                        jQuery(".alert-danger").show();
                        jQuery(".alert-danger").html(result.barerror);
                    } else if (result.success != null) {
                        jQuery(".alert-danger").hide();
                        jQuery("#editTaskAlert").html(result.success);
                        jQuery("#editTaskAlert").show();
                        jQuery("#editTaskForm1")["0"].reset();
                        getTasks();
                    } else {
                        jQuery(".alert-danger").hide();
                        jQuery("#editTaskAlert").hide();
                    }
                }
            });
        });
    });
</script>