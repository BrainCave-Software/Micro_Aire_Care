<div class="border border-secondary" style="padding: 20px;">

    <div class="page-header flex-wrap">
        <h4 class="mb-0">
            Files
        </h4>
        <!-- <div class="d-flex">
            <a href="#" id="newbutton" data-toggle="modal" data-target="#noteCreate"> Create Note </a>
        </div> -->
    </div>
    <!-- alert section -->
    <!-- <div class="alert alert-success alert-dismissible fade show" id="addFilesAlertSuccess" style="display:none" role="alert">
        <span id="addFilesAlertSuccessMSG"></span>
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> -->

    <!-- <div class="alert alert-danger alert-dismissible fade show" id="addFilesAlertDanger" style="display:none" role="alert">
        <span id="addFilesAlertDangerMSG"></span>
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> -->
    <!-- alert section end-->

    <!-- form -->
    <form method="post" enctype="multipart/form-data" id="createFileForm">
        @csrf
        <div class=" form-group row">
            <!-- hiden customer id -->
            <input type="text" id="clientFileeId" name="clientfileid" style="display: none;">

            <!--  Project name  -->
            <div class="col-sm-3 col-form-label">Project Name </div>
            <div class="col-sm-4"><input type="text" class="form-control text-dark" id="addFileProjectName" name="addfileprojectname" placeholder="Project Name" /></div>


            <div class="col-sm-3">
                <input type="file" name="project_document" id="pdfFile" accept="pdf/*" />
            </div>
            <div class="col-sm-2">
                <button type="submit" id="uploadSize" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </form>
    <!-- form end -->
    <!-- table start -->
    <div class="table-responsive" style="overflow-x:scroll;">
        <table class="table text-center">
            <thead>
                <tr>
                    <th class="border border-secondary">S/N</th>
                    <th class="border border-secondary">Project Name</th>
                    <th class="border border-secondary"> Uploaded On</th>
                    <th class="border border-secondary">Size</th>
                    <th class="border border-secondary" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody class="tbody listfiles">

            </tbody>
        </table>
    </div>
    <ul class="files-pagination-refs pagination-referece-css pagination justify-content-center"></ul>
    <!-- table end here -->
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- backend js file -->
<script>
    $(document).on("click", "a[name = 'viewManagement']", function(e) {
        let customer_id = $(this).data("id");
        getfiles(customer_id);
    });
    // All Product Details
    function getfiles(customer_id) {
        $.ajax({
            type: "GET",
            url: "{{route('SA-GetFiles')}}",
            data: {
                'customer_id': customer_id,
            },
            success: function(response) {
                let i = 0;
                $('.listfiles').html('');
                $('.files-main-table').html('Total no. of files : ' + response.total);
                jQuery.each(response, function(key, value) {
                    let date = new Date(value["created_at"])
                    $('.listfiles').append('<tr>\
                        <td class="p-2 border border-secondary">' + ++i + '</td>\
                        <td class="p-2 border border-secondary">' + value["project_Name"] + '</td>\
                        <td class="p-2 border border-secondary">' + date.toLocaleDateString() + '</td>\
                        <td class="p-2 border border-secondary">' + value["size"] + '</td>\
                        <td class="p-2 border border-secondary"><a   target="_blank"  href="' + value["file"] + '"> <i class="mdi mdi-download"></i> </a></td>\
                        <td  class="p-2 border border-secondary"><a name="deletefiles" data-toggle="modal" data-target="#removefiles" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                });
                $('.files-pagination-refs').html('');
                jQuery.each(response.links, function(key, value) {
                    $('.files-pagination-refs').append(
                        '<li id="files_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '" ><a href="' + value['url'] + '" class="page-link" >' + value["label"] + '</a></li>'
                    );
                });
            }
        });
    }

    // End function here

    // pagination links css and access page
    $(function() {
        $(document).on("click", "#files_pagination", function() {
            //get url and make final url for ajax
            var url = $(this).attr("href");
            var append = url.indexOf("?") == -1 ? "?" : "&";
            var finalURL = url + append;


            $.get(finalURL, function(response) {
                let i = response.from;

                $('.listfiles').html('');
                $('.files-main-table').html('Total no. of files : ' + response.total);
                jQuery.each(response.data, function(key, value) {
                    $('.listfiles').append('<tr>\
                        <td class="border border-primary">' + i++ + '</td>\
                        <td class="p-2 border border-secondary">' + value["project_Name"] + '</td>\
                        <td class="p-2 border border-secondary">' + value[""] + '</td>\
                        <td class="border border-primary"><a name="downloadfile"  data-toggle="" data-id="' + value["id"] + '"  data-target="#"> <i class="mdi mdi-download"></i> </a></td>\
                        <td class="border border-primary"><a name="deletefiles" data-toggle="" data-target="#" data-id="' + value["id"] + '" data-customerId="' + customer_id + '"> <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                });
                $('.files-pagination-refs').html('');
                jQuery.each(response.links, function(key, value) {
                    $('.files-pagination-refs').append(
                        '<li id="files_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '" ><a href="' + value['url'] + '" class="page-link" >' + value["label"] + '</a></li>'
                    );
                });
            });
            return false;
        });
    });
    // pagination end here

    // validation with add data
    $(document).ready(function() {
        jQuery('#createFileForm').submit(function(e) {
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
                const formData = new FormData($('#createFileForm')["0"]);
                jQuery.ajax({
                    url: "{{ route('SA-addFile') }}",
                    enctype: "multipart/form-data",
                    type: "post",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        if (result.error != null) {
                            jQuery(".salesQuantityError").hide();
                        } else if (result.barerror != null) {
                            errorMsg(result.barerror);
                            // jQuery("#addDataAlert").hide();
                            // jQuery("#addFilesAlertDanger").show();
                            // jQuery("#addFilesAlertDangerMSG").html(result.barerror);
                            jQuery(".salesQuantityError").hide();
                            // setTimeout(() => {
                            //     jQuery("#addFilesAlertDanger").hide();

                            // }, 2000);
                        } else if (result.success != null) {
                            successMsg(result.success);
                            // jQuery("#addNotesAlertDanger").hide();
                            // jQuery("#addFilesAlertSuccessMSG").html(result.success);
                            // jQuery("#addFilesAlertSuccess").show();
                            // jQuery("#createNotesForm")["0"].reset();
                            $('#addFileProjectName').val('');
                            $('#pdfFile').val('');
                            // setTimeout(() => {
                            //     jQuery("#addFilesAlertSuccess").hide();
                            // }, 2000);
                            getfiles($('#clientFileeId').val());
                            // jQuery("#ordersTable1 tbody").html('');
                            // jQuery("#productTableBody1").html('');
                            // jQuery(".salesQuantityError").hide();
                        } else if (result.salesQuantityError != null) {
                            // jQuery(".salesQuantityError").show();
                            // jQuery("#ordersTable1 tbody").html('');
                            // jQuery("#productTableBody1").html('');
                        } else {
                            // jQuery(".salesQuantityError").hide();
                            // jQuery("#addNotesAlertDanger").hide();
                            // jQuery("#addDataAlert").hide();
                        }

                    },
                });
            }
        })
    });
    // delete a single File using id
    $(document).on("click", "a[name = 'deletefiles']", function(e) {
        let id = $(this).data("id");
        let customerId = $(this).data("customerId");
        getFiles(id, customerId);
        function getFiles(id, customerId) {
            bootbox.confirm(" DO YOU WANT TO DELETE?", function(result) {
                if (result) {
                    $.ajax({
                        type: "GET",
                        url: "{{route('SA-DeleteFiles')}}",
                        data: {
                            'id': id,
                        },
                        success: function(result) {
                            successMsg(result.success);
                            getfiles($('#clientFileeId').val());

                        }
                    });
                }
            });
        }
    });
    // Download a single File using id
    $(document).on("click", "a[name = 'downloadfile']", function(e) {
        let id = $(this).data("id");
        let customerId = $(this).data("customerId");
        getFiles(id, customerId);
        e.preventDefault();

        function getFiles(id, customerId) {

            $.ajax({
                type: "GET",
                url: "{{route('SA-DownloadFile')}}",
                data: {
                    'id': id,
                },
                success: function(response) {
                    getfiles($('#clientFileeId').val());
                    window.location.href = "File/randomfile.docx";
                    window.location.href = 'uploads/file.doc';
                }
            });


        }
    });
</script>