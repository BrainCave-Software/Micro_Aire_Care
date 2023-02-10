<div class="modal fade viewTask" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lgs" role="document">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Task Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-3">

        <!-- Task Name  -->
        <div class="form-group row">
          <label for="task_name" class="col-sm-3 col-form-label">Task Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="viewtask_name" readonly/>
          </div>
        </div>

        <!-- Product Varient -->
        <div class="form-group row">
          <label for="assigned_to" class="col-sm-3 col-form-label">Assigned To</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="viewassigned_to" readonly/>
          </div>
        </div>

        <!-- SKU Code -->
        <div class="form-group row">
          <label for="start_time" class="col-sm-3 col-form-label">Start Date</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="viewstart_time" readonly/>
          </div>
        </div>

        <!-- Tax -->
        <div class="form-group row">
          <label for="end_time" class="col-sm-3 col-form-label">End Date</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="viewend_time" readonly/>
          </div>
        </div>

        <!-- Supplier Code -->
        <div class="form-group row">
          <label for="status" class="col-sm-3 col-form-label">Status</label>
          <div class="col-sm-9">
          <input type="text" class="form-control" id="viewstatus" readonly/>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>