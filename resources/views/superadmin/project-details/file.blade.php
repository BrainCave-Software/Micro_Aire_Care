<div class="border border-secondary" style="padding:20px;">

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
    @foreach ($data as $data)
    <form  enctype="multipart/form-data" id="createProjectFileFormAll">
        @csrf
        <div class=" form-group row">
            <!-- hiden customer id -->
            <input type="text" id="projectFileeId" value="{{$data->project_id}}" name="clientfileid" style="display: none;" >
            <!--  Project name  -->
            <div class="col-sm-2 col-form-label">File Name: </div>
            <!-- <div class="col-sm-3"><input type="text" class="form-control text-dark" id="addFileProjectNameId" name="addfileprojectname" placeholder="Project Name" /></div> -->
            <div class="col-sm-8">
                <input type="file" name="project_document" id="pdfFileId" accept="pdf/*"/>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </form>
    @endforeach
    
    <!-- form end -->

    <!-- table start -->
    <div class="table-responsive" style="overflow-x:scroll;">
        <table class="table text-center">
            <thead>
                <tr>
                    <th class="border border-secondary">S/N</th>
                    <th class="border border-secondary">Project Name</th>
                    <th class="border border-secondary"> Uploaded On</th>
                    <!-- <th class="border border-secondary">Size</th> -->
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
    $(document).ready(function(e) {
        let project_id = $('#projectFileeId').val();
       
        getfiles(project_id);
    });
    // All Product Details
    function getfiles(project_id) {
        $.ajax({
            type: "GET",
            url: "{{route('SA-GetFiles')}}",
            data: {
                'project_id': project_id,
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
                        <td class="p-2 border border-secondary"><a href="' + value["file"] + '"  data-target="_blank"> <i class="mdi mdi-download"></i> </a></td>\
                        <td  class="p-2 border border-secondary"><a name="deletePfiles" data-toggle="modal" data-target="#removefiles" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
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

   

    // validation with add data
    $(document).ready(function() {
        $('#createProjectFileFormAll').submit(function(e) {
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
                const formData = new FormData($('#createProjectFileFormAll')["0"]);
                $.ajax({
                    url: "{{route('SA-addFile')}}",
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
                            jQuery(".salesQuantityError").hide();
                        } else if (result.success != null) {
                            successMsg(result.success);
                            $('#addFileProjectNameId').val('');
                            $('#pdfFileId').val('');
                            getfiles($('#projectFileeId').val());
                        } else if (result.salesQuantityError != null) {} else {}

                    },
                });
            }
        })
    });
    // delete a single File using id
    $(document).on("click", "a[name = 'deletePfiles']", function(e) {
        let id = $(this).data("id");
        let customerId = $(this).data("customerId");
        getDlFiles(id, customerId);

        function getDlFiles(id, customerId) {
            // bootbox.confirm(" DO YOU WANT TO DELETE Test?", function(result) {
            //     if (result) {
            $.ajax({
                type: "GET",
                url: "{{route('SA-DeleteFiles')}}",
                data: {
                    'id': id,
                },
                success: function(result) {
                    successMsg(result.success);
                    getfiles($('#projectFileeId').val());

                }
            });
            //     }
            // });
        }
    });
    // Download a single File using id
    $(document).on("click", "a[name = 'downloadfile']", function(e) {
        let id = $(this).data("id");
        let customerId = $(this).data("customerId");
        getFilesDwn(id, customerId);
        e.preventDefault();

        function getFilesDwn(id, customerId) {

            $.ajax({
                type: "GET",
                url: "{{route('SA-DownloadFile')}}",
                data: {
                    'id': id,
                },
                success: function(response) {
                    getfiles($('#projectFileeId').val());
                    window.location.href = "File/randomfile.docx";
                    window.location.href = 'uploads/file.doc';
                }
            });


        }
    });
</script>