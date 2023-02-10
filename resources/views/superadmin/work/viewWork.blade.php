<!-- Modal -->
<div class="modal fade" id="viewWork" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content p-2">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Task</h5>
                <button type="button" id="taskClose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="viewAssignTask">
                <div class="modal-body bg-white px-3">
                    <div class="">
                        <div class="">
                            <input type="hidden" name="projectExcel_id" id="viewProjectExcel_id">
                            <input type="hidden" name="projectName" id="ViewProjectId">
                            <input type="hidden" name="heading_all" id="viewHeading_all">
                            <!-- sub task -->
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <textarea class="text-center" name="taskAll" id="viewTask_all" cols="70" rows="7" readonly></textarea>
                                </div>
                            </div>
                            <!-- table start -->
                            <div class="table-responsive" style="overflow-x:scroll;">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th class="border border-secondary">S/N</th>
                                            <th class="border border-secondary">Employee Name</th>
                                            <th class="border border-secondary">Start Date</th>
                                            <th class="border border-secondary">Deadline</th>
                                            <!-- <th class="border border-secondary">Size</th>
                                              <th class="border border-secondary" colspan="2">Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody class="tbody listWork">
                                    </tbody>
                                </table>
                            </div>
                            <ul class="files-pagination-refs pagination-referece-css pagination justify-content-center"></ul>
                            <!-- table end here -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-clear" id="clearFormBtn" aria-label="Close" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
