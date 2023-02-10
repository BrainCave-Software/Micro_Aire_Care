<div class="border border-secondary">

    <div class="page-header flex-wrap">
        <h5 class="mb-0">
        Remarks13112
        </h5>
        <div class="d-flex">
            <!-- <a href="#" id="newbutton" data-toggle="modal" data-target="#noteCreate"> Create Note </a> -->
        </div>
    </div>

    <!-- add note -->
    @foreach ($data as $data)
    <form method="post" id="createNotesForm">
        @csrf
        <div class="modal-body bg-white px-3">
            <!-- alert section -->
            <!-- <div class="alert alert-success alert-dismissible fade show" id="addNotesAlertSuccess" style="display:none" role="alert">
                <span id="addNotesAlertSuccessMSG"></span>
                <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->

            <!-- <div class="alert alert-danger alert-dismissible fade show" id="addNoteAlertDanger" style="display:none" role="alert">
                <span id="addNoteAlertDangerMSG"></span>
                <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
             <!-- alert section end-->
            <div class="form-group row">
                <input type="text" id="projectNoteId" value="{{$data->customer_id}}" name="clientnoteid" style="display: none;"  >
                <label for="title" class="col-md-1 col-form-label">Remarks</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="titlename" id="titleId" placeholder="Remarks" />
                </div>
                <div class="col-md-2">
                    <button type="submit" id="addNotes" class="btn btn-save">Add</button>
                </div>

            </div>
          </div>
    </form>
    @endforeach
    <!-- table start -->
    <div class="table-responsive" style="overflow-x:scroll;">
        <table class="table text-center">
            <thead>
                <tr>
                    <th class="border border-secondary">S/N</th>
                    <th class="border border-secondary">Remarks</th>
                    <th class="border border-secondary"> Date</th>
                    <th class="border border-secondary" >Action</th>
                </tr>
            </thead>
            <tbody class=" tbody listNotes">

            </tbody>
        </table>
    </div>
    <!-- table end here -->
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- backend js file -->


<script>
    $(document).ready( function(e) {
        let customer_id = $('#projectNoteId').val();
        getAddNotes(customer_id);
        

    });
    // All Product Details
    function getAddNotes(customer_id) {
        $.ajax({
            type: "GET",
            url: "{{ route('SA-GetNotes') }}",
            data: {
                'customer_id': customer_id,
            },
            success: function(response) {
                let i = 0;
                $('.listNotes').html('');
                $('.notes-main-table').html('Total no. of Notes : ' + response.total);
                jQuery.each(response, function(key, value) {
                    let date = new Date(value["created_at"])
                    $('.listNotes').append('<tr>\
                        <td class=" border border-secondary">' + ++i + '</td>\
                        <td class=" border border-secondary">' + value["title_name"] + '</td>\
                        <td class="p-2 border border-secondary">' + date.toLocaleDateString() + '</td>\
                        <td class=" border border-secondary"><a name="deleteProjectNotes" data-toggle="" data-target="#" data-id="' + value["id"] + '" data-customerId="' + customer_id + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                });
            }
        });
    }
    // store data to database
    jQuery("#createNotesForm").submit(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        });
        jQuery.ajax({
            url: "{{ route('SA-CreatNotes') }}",
            data: jQuery("#createNotesForm").serialize(),
            enctype: "multipart/form-data",
            type: "post",
            success: function(result) {
                if (result.error != null) {
                    jQuery(".salesQuantityError").hide();
                } else if (result.barerror != null) {
                    errorMsg(result.barerror);

                    // jQuery("#addDataAlert").hide();
                    // jQuery("#addNoteAlertDanger").show();
                    // jQuery("#addNoteAlertDangerMSG").html(result.barerror);
                    // jQuery(".salesQuantityError").hide();
                    // setTimeout(() => {
                    //     jQuery("#addNoteAlertDanger").hide();

                    // }, 2000);
                } else if (result.success != null) {
                    successMsg(result.success);
                    // jQuery("#addNotesAlertDanger").hide();
                    // jQuery("#addNotesAlertSuccessMSG").html(result.success);
                    // jQuery("#addNotesAlertSuccess").show();
                    // jQuery("#createNotesForm")["0"].reset();
                    $('#titleId').val('');
                    // setTimeout(() => {
                    //     jQuery("#addNotesAlertSuccess").hide();
                    // }, 2000);
                    getAddNotes($('#projectNoteId').val());
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
    });
    // delete a single product using id
    $(document).on("click", "a[name = 'deleteProjectNotes']", function(e) {
        let id = $(this).data("id");
        let customerId = $(this).data("customerId");
        getDelivery(id, customerId);
        function getDelivery(id, customerId) {
            bootbox.confirm(" DO YOU WANT TO DELETE?", function(result) {
                if (result) {
                    $.ajax({
                        type: "GET",
                        url: "{{route('SA-DeleteNotes')}}",
                        data: {
                            'id': id,
                        },
                        success: function(result) {
                    successMsg(result.success);
                            getAddNotes($('#projectNoteId').val());
                            jQuery("#removeNotesAlert").show();
                            jQuery("#removeNotesAlert").html(response.success);

                        }
                    });
                }
            });
        }
    });
    $(document).on("click", "a[name = '']", function(e) {
        let id = $(this).data("id");
        $('#confirmRemoveSelectedNotes').data('id', id);
    });
</script>
<div class="modal fade" id="removeNotesabc1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel111" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel111">Confirm Alert</h5>
                <button class=" closenote" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">DO YOU WANT TO DELETE?<span id="removeElementId"></span> </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" id="closenotes12">NO</button>
                <a name="removeConfirmNotes" class="btn btn-primary" id="confirmRemoveSelectedNotes">
                    YES
                </a>
            </div>
        </div>
    </div>
</div>