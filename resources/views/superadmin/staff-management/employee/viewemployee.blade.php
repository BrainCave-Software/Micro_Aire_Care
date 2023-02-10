<!-- Modal -->
<div class="modal fade" id="viewEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-2">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="viewEmployeeForm">
                <!-- invoice body start here -->
                <div class="modal-body bg-white px-3">
                    <div class=" form-group row">
                        <!-- Employee id -->
                        <!-- <div class="col-md-2 col-form-label">Employee ID</div>
                        <div class="col-md-4"><input type="text" class="form-control" id="viewemployeid" placeholder="Employee ID" disabled></div> -->
                        <!-- user name -->
                        <div class="col-md-2 col-form-label">User Name</div>
                        <div class="col-md-4"><input type="text" class="form-control" id="viewusername" placeholder="User Name" disabled></div>
                        <!-- first name -->
                        <div class="col-md-2 col-form-label">Name</div>
                        <div class="col-md-4"><input type="text" class="form-control" id="viewfirstname" placeholder="First Name" disabled></div>
                    </div>
                    <div class=" form-group row">
                        <!-- email -->
                        <div class="col-md-2 col-form-label">Email ID</div>
                        <div class="col-md-4"><input type="text" class="form-control" id="viewemailid" placeholder="Email ID" disabled></div>
                        <!-- contact number -->
                        <div class="col-md-2 col-form-label">Mobile No.</div>
                        <div class="col-md-4"><input type="text" class="form-control" id="viewcontactno" placeholder="Mobile Number" disabled></div>
                    </div>
                    <div class=" form-group row">
                        <!-- gender -->
                        <div class="col-md-2 col-form-label">Gender</div>
                        <div class="col-md-4">
                            <select class="form-control" id="viewgender" disabled>
                                <option value="">Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <!-- role -->
                        <div class="col-md-2 col-form-label">Role</div>
                        <div class="col-md-4">
                            <input class="form-control" id="viewrole" disabled />
                        </div>
                    </div>
        
                    <div class=" form-group row">
                        <!-- main dipartment -->
                        <div class="col-md-2 col-form-label">Main Department</div>
                        <div class="col-md-4">
                            <input class="form-control" id="viewmaindepartment" disabled />
                        </div>
                        <!-- degination -->
                        <div class="col-md-2 col-form-label">Designation</div>
                        <div class="col-md-4">
                            <input class="form-control" id="viewdesignation" disabled />
                        </div>
                    </div>
                    <div class=" form-group row">
                        <!-- password -->
                        <div class="col-md-2 col-form-label">Password <span style="color:red;">*</span></div>
                        <div class="col-md-4"><input type="text" class="form-control" name="viewPassword" id="viewPassword" placeholder="Password" disabled></div>
                        <!-- conform password -->
                        <!-- <div class="col-md-2 col-form-label">Confirm Password <span style="color:red;">*</span></div>
                        <div class="col-md-4"><input type="text" class="form-control" name="viewConformPassword" id="viewConformPassword" placeholder="confirm Password"></div> -->
                    </div>
                </div>
                <!-- end here -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-clear" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>