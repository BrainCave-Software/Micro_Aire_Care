<div class="modal fade viewclient" tabindex="-1" role="dialog" aria-labelledby="1myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Client Details
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class=" form-group row">
                            <!-- Name -->
                            <div class="col-md-2 col-form-label">Name </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="firstname" id="nameView" disabled placeholder=" Name">
                            </div>
                            <!-- Status -->
                            <div class="col-md-2 col-form-label">Status </div>
                            <div class="col-md-4">
                                <select name="customerstatusview" id="statusIdView" class="form-control text-dark" disabled>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <!--  Email  -->
                            <div class="col-md-2 col-form-label">Email ID </div>
                            <div class="col-md-4"><input type="text" class="form-control text-dark" id="emailIdView" name="emailidview" placeholder="Email ID" disabled /></div>
                            <!--  Mobile  -->
                            <div class="col-md-2 col-form-label">Mobile Number </div>
                            <div class="col-md-4"><input type="text" class="form-control text-dark" id="phoneNumberView" name="phonenumber" placeholder="Mobile Number" disabled /></div>
                        </div>
                        <div class=" form-group row">
                            <!--  Address  -->
                            <div class="col-md-2 col-form-label">Address </div>
                            <div class="col-md-4"> <textarea name="address" id="addressView" class="form-control text-dark" cols="30" rows="3" placeholder="Address" disabled></textarea></div>
                            <!--  Postal Code  -->
                            <div class="col-md-2 col-form-label">Postal Code </div>
                            <div class="col-md-4"><input type="text" class="form-control" name="customerpostalcodeview" id="customerPostalCodeView" disabled placeholder="Postal Code"></div>
                        </div>
                        <div class=" form-group row">
                            <!--  Open projects   -->
                            <div class="col-md-2 col-form-label">Open projects </div>
                            <div class="col-md-4"><input type="text" class="form-control" name="" id="" disabled placeholder="00 "></div>
                            <!--  Completed Projects  -->
                            <div class="col-md-2 col-form-label">Completed Projects </div>
                            <div class="col-md-4"><input type="text" class="form-control" name="" id="" disabled placeholder=" 00"></div>
                        </div>
                        <div class="content-wrapper pb-0">
                            <ul id="tabs">
                                <li class="mx-2"><a href="#project">Projects</a></li>
                                <li class="mx-2"><a href="#files">Files</a></li>
                                <li class="mx-2"><a href="#notes">Notes</a></li>
                            </ul>
                            <!-- Projects Tab Content -->
                            <div class="tabContent" id="project">
                                @include('superadmin.client.projects')
                            </div>
                            <!-- Files Tab Content -->
                            <div class="tabContent" id="files">
                                @include('superadmin.client.files')
                            </div>
                            <!-- Notes Tab Content -->
                            <div class="tabContent" id="notes">
                                @include('superadmin.client.notes')
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-clear" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>