<div class="modal fade" id="viewrolepreviledges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-2">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" id="viewEmployee">
                <div class="modal-body bg-white px-3">
                    <!-- info & alert section -->
                    <div class="alert alert-success alert-dismissible fade show" id="addUserAlert" style="display:none" role="alert">
                        <strong>Info ! </strong> <span id="addUserSuccessAlert"></span>
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="alert alert-danger alert-dismissible fade show" id="addUserErrorAlert" style="display:none" role="alert">
                        <strong>Info ! </strong> <span id="addUserDangerAlert"></span>
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- end -->

                    <div class=" form-group row">
                        <div class="col-md-2 col-form-label">Role Name</div>
                        <div class="col-md-4"><input type="text" class="form-control" name="viewrolename" id="viewrolenameId" placeholder="Role Name"></div>
                        <!-- <div class="col-md-2 col-form-label">Select Access </div>
                        <div class="col-md-4">
                            <select class="form-control" name="viewaccess" id="viewacessId">
                                <option value="">Select Access </option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div> -->

                    </div>

                    <div class="form-group row">
                        <div class="col-md-2 col-form-label">Resources</div>
                        <div class="col-md-10 ml-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check form-check-primary">
                                        <label class="">
                                            <input type="checkbox" class="form-check-input require-one cb_child" value="staff" name="list[]" id="viewStaff" disabled style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> Staff
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-check-primary">
                                        <label class="">
                                            <input type="checkbox" class="form-check-input require-one cb_child" value="timesheet" name="list[]" id="viewTimesheet" disabled style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> Time sheet
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-check-primary">
                                        <label class="">
                                            <input type="checkbox" class="form-check-input require-one cb_child" value="projects" name="list[]" id="viewProjects" disabled style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> Projects
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-check form-check-primary">
                                        <label class="">
                                            <input type="checkbox" class="form-check-input require-one cb_child" value="filemanage" name="list[]" id="viewFilemanage" disabled style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> File manage
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check form-check-primary">
                                        <label class="">
                                            <input type="checkbox" class="form-check-input require-one cb_child" value="crm" name="list[]" id="viewCrm" disabled style="width: 18px;height: 18px;border-radius: 2px;border: solid #7057d2 !important;border-width: 2px;margin-top: 0px;" /> CRM
                                        </label>
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