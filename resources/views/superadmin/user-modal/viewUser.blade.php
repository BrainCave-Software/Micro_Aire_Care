<!-- Modal -->
<div class="modal fade" id="viewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="viewUserForm">
        <div class="modal-body bg-white px-3">
          <div class="card">
            <div class="card-body">
              <!-- Name -->
              <div class="form-group row">
                <label for="username" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control text-dark" name="username" id="usernameView" placeholder="Name" readonly />
                </div>
              </div>
              <!-- Email ID -->
              <div class="form-group row">
                <label for="emailid" class="col-sm-3 col-form-label">Email ID</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control text-dark" name="emailid" id="emailidView" placeholder="Email ID" readonly />
                </div>
              </div>
              <!-- Mobile Number -->
              <div class="form-group row">
                <label for="mobilenumber" class="col-sm-3 col-form-label">Mobile Number</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control text-dark" name="mobilenumber" id="mobilenumberView" placeholder="Mobile Number" readonly />
                </div>
              </div>
              <!-- phone number -->
              <div class="form-group row">
                <label for="phonnumber" class="col-sm-3 col-form-label">Home Number</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control text-dark" name="phonenumber" id="phonnumberView" placeholder="Home Number" readonly />
                </div>
              </div>
              <!-- checkbox -->
              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">User Rights</label>
                <div class="col-sm-9 ml-3">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-check form-check-primary">
                          <label class="">
                            <input type="checkbox" class="form-check-input require-one" name="list[]" value="staffmanagement" id="staffManagementView" style="width: 18px;height: 18px;border-radius: 2px;border: solid black !important;border-width: 2px;margin-top: 0px;" onclick="return false" /> Staff Management
                          </label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-check form-check-primary">
                          <label class="">
                            <input type="checkbox" class="form-check-input require-one" value="timesheet" name="list[]" id="timesheetView" style="width: 18px;height: 18px;border-radius: 2px;border: solid black !important;border-width: 2px;margin-top: 0px;" onclick="return false" /> Timesheet
                          </label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-check form-check-primary">
                          <label class="">
                            <input type="checkbox" class="form-check-input require-one" value="projectmanagement" name="list[]" id="projectManagementView" style="width: 18px;height: 18px;border-radius: 2px;border: solid black !important;border-width: 2px;margin-top: 0px;" onclick="return false" /> Project Management
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-check form-check-primary">
                          <label class="">
                            <input type="checkbox" class="form-check-input require-one" value="crm" name="list[]" id="crmView" style="width: 18px;height: 18px;border-radius: 2px;border: solid black !important;border-width: 2px;margin-top: 0px;" onclick="return false" /> CRM
                          </label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-check form-check-primary">
                          <label class="">
                            <input type="checkbox" class="form-check-input require-one" value="reports" name="list[]" id="reportsView" style="width: 18px;height: 18px;border-radius: 2px;border: solid black !important;border-width: 2px;margin-top: 0px;" onclick="return false" /> Reports
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-clear" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>