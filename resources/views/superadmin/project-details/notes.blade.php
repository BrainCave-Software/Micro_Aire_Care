<div class="border border-secondary" style="padding:20px;">

    <div class="page-header flex-wrap">
        <h4 class="mb-0">
            Remarks
        </h4>
        <div class="d-flex">
            <!-- <a href="#" id="newbutton" data-toggle="modal" data-target="#noteCreate"> Create Note </a> -->
        </div>
    </div>

    <!-- add note -->
    @foreach ($data as $data)
    <form method="post" id="createNotesFormRem">
        @csrf
        <div class="modal-body bg-white px-3">

            <div class="form-group row">
                <input type="text" id="projectNoteId" value="{{$data->customer_id}}" name="clientnoteid" style="display: none;">



            </div>


        </div>
    </form>


    <!-- Task -->
    <!-- new -->
    <div class="row d-flex justify-content-around m-4">
        <div class="col-sm-5 rounded border border-dark">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Task </h5>

                <h5 class="modal-title" id="exampleModalLabel">


                    <input type="hidden" id="taskNumber" name="taskNumber" value="{{$data->customer_id}}">
                    <p> {{$data->project_no}}</p>


                    <!-- <p> micro- air</p> -->
                    @endforeach

                </h5>

            </div>
            <div class="table-responsive" style="overflow-x:scroll;">
                <table class="table text-center table-hover">
                    <caption class="project-main-table"></caption>
                    <thead class="fw-bold text-dark">
                        <tr class="col" style="border: 1px ridge blue;">

                            <!-- <input type="text" id="taskNumber" name="taskNumber" value="{{$data->project_no}}"> -->


                            @foreach($note as $note)
                            <div id=" " class="bg-primary p-2 m-1">
                                <a href="#" name="remarksAdd" id="remarksAdd" data-toggle="modal" data-id=" {{$note->id}}" data-target="#addRemarks">

                                
                                    <p>{{$note->heading}}</p>
                                </a>
                            </div>
                            @endforeach

                        </tr>

                    </thead>
                    <tbody class="tbody task">

                    </tbody>
                </table>
            </div>

        </div>


        <!-- completed -->
        <div class="col-sm-5 rounded border border-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remarks </h5>
                <!-- <div id="drop" style="height:200px;width: 200px; border:2px solid green;"></div>
            </div> -->
            </div>
        </div>
        

    </div>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- backend js file -->


<script>
    
    
    
        // assign task for employee
    $(document).on("click", "a[name = 'remarksAdd']", function(e) {
        let id = $(this).data("id");
        getDelivery(id);

        function getDelivery(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('SA-GetIdTask')}}",
                data: {
                    'id': id,
                },
                success: function(response) {
                    console.log(response);
                    jQuery.each(response, function(key, value) {
                        $('#remarks_id').val(value["id"]);
                        $('#remarksId').val(value["project_id"]);
                        $('#task_all').val(value["task"]);
                        $('#reHeading').val(value["heading"]);
                    });
                }
            });
        }
    });
    
    
</script>
