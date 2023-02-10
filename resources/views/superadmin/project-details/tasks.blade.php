<head>
    <link href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
</head>
<div class="border border-secondary" style="padding:20px;">

    <div class="page-header flex-wrap">
        <h4 class="mb-0">
            Tasks
        </h4>
        <div class="d-flex">
            <!-- <a href="#" id="newbutton" data-toggle="modal" data-target="#noteCreate"> Create Note </a> -->
        </div>
    </div>



    <div class="row d-flex justify-content-around">
        <!-- new -->
        <div class="col-sm-3 rounded border border-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New </h5>
                <h5 class="modal-title" id="exampleModalLabel">
                    @foreach ($data as $data)

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

                            @foreach($excel_data as $excelD)

                            <!-- foreach(json_decode(json_decode(($data->task1))) as $key => $value) -->
                            <div id=" " class="bg-main p-2 m-1">


                                <a href="#" name="taskId" id="taskId" data-id=" {{$excelD->id}}" data-toggle="modal" data-target="#addTask">


                                    <p>{{$excelD->heading}}</p>

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
        <!-- Progress -->
        <div class="col-sm-3 rounded border border-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Progress </h5>
                <!-- <div id="drop" style="height:200px;width: 200px; border:2px solid green;"></div>
            </div> -->
            </div>
            <div class="table-responsive" style="overflow-x:scroll;">
                <table class="table text-center table-hover">
                    <caption class="project-main-table"></caption>
                    <thead class="fw-bold text-dark">
                        <tr class="col" style="border: 1px ridge blue;">

                            <!-- <input type="text" id="taskNumber" name="taskNumber" value="{{$data->project_no}}"> -->

                            @foreach($excel_data1 as $excelD1)

                            <!-- foreach(json_decode(json_decode(($data->task1))) as $key => $value) -->
                            <div id=" " class="bg-main p-2 m-1">


                                <a href="#" name="UpdateWorkId" id="workId" data-id="{{$excelD1->sub_task_id}} " data-toggle="modal" data-target="#work">

                                
                                    <p>{{$excelD1->heading}}</p>

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
        <div class="col-sm-3 rounded border border-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Completed </h5>
                <!-- <div id="drop" style="height:200px;width: 200px; border:2px solid green;"></div>
            </div> -->
            </div>
            <div class="table-responsive" style="overflow-x:scroll;">
                <table class="table text-center table-hover">
                    <caption class="project-main-table"></caption>
                    <thead class="fw-bold text-dark">
                        <tr class="col" style="border: 1px ridge blue;">

                            <!-- <input type="text" id="taskNumber" name="taskNumber" value="{{$data->project_no}}"> -->

                            @foreach($excel_data0 as $excelD0)


                            <!-- foreach(json_decode(json_decode(($data->task1))) as $key => $value) -->
                            <div id=" " class="bg-main p-2 m-1">


                                <a href="#" name="workId" id="WorkId" data-id="{{$excelD0->sub_task_id}} " data-toggle="modal" data-target="#viewWork">


                                    <p>{{$excelD0->heading}}</p>

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

        @include('superadmin.task.taskdetail')

    </div>

</div>
@include('superadmin.work.addWork')
@include('superadmin.work.editWork')
@include('superadmin.work.viewWork')


<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- backend js file -->


<script>
    // assign task for employee
    $(document).on("click", "a[name = 'taskId']", function(e) {
        let id = $(this).data("id");
        getDelivery(id);

        function getDelivery(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('SA-GetSingleTask')}}",
                data: {
                    'id': id,
                },
                success: function(response) {
                    console.log(456,response);
                    jQuery.each(response.data, function(key, value) {
                        $('#projectExcel_id').val(value["id"]);
                        $('#projectId').val(value["project_id"]);
                        $('#task_all').val(value["task"]);
                        $('#projectNameId').val(value["project_no"]);
                        $('#heading_all').val(value["heading"]);
                    });
                }
            });
        }
    });
    // show table

    $(document).on("click", "a[name = 'taskId']", function(e) {
        let id = $(this).data("id");
        getDelivery(id);

        function getDelivery(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('SA-GetSingleView')}}",
                data: {
                    'sub_task_id': id,
                },
                success: function(response) {
                    let i = 0;
                    $('.listAddWork').html('');
                    $('.files-main-table').html('Total no. of files : ' + response.total);
                    jQuery.each(response, function(key, value) {
                        let date = new Date(value["created_at"])
                        $('.listAddWork').append('<tr>\
                        <td class="p-2 border border-secondary">' + ++i + '</td>\
                        <td class="p-2 border border-secondary">' + value ["employee_name"] + '</td>\
                        <td class="p-2 border border-secondary">' + value["deadline"] + '</td>\
                    </tr>');
                    });
                }
            });
        }
    });
    // view employee
    $(document).on("click", "a[name = 'workId']", function(e) {
        let id = $(this).data("id");
        getDelivery(id);

        function getDelivery(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('SA-GetSingleView')}}",
                data: {
                    'sub_task_id': id,
                },
                success: function(response) {

                    jQuery.each(response, function(key, value) {
                        $('#viewProjectExcel_id').val(value["sub_task_id"]);
                        $('#ViewProjectId').val(value["project_id"]);
                        $('#viewTask_all').val(value["Task"]);
                        $('#viewHeading_all').val(value["heading"]);
                        $('#viewHeading_all').val(value["heading"]);
                        $('#viewHeading_all').val(value["heading"]);
                    });

                    let i = 0;
                    $('.listWork').html('');
                    $('.files-main-table').html('Total no. of files : ' + response.total);
                    jQuery.each(response, function(key, value) {
                        let date = new Date(value["created_at"])
                        $('.listWork').append('<tr>\
                        <td class="p-2 border border-secondary">' + ++i + '</td>\
                        <td class="p-2 border border-secondary">' + value["employee_name"] + '</td>\
                        <td class="p-2 border border-secondary">' + date.toISOString().slice(0,10).split('-').reverse().join('-') + '</td>\
                        <td class="p-2 border border-secondary">' + value["deadline"] + '</td>\
                    </tr>');
                    });
                }
            });
        }
    });

    // update employee
    $(document).on("click", "a[name = 'UpdateWorkId']", function(e) {
        let id = $(this).data("id");
        getDelivery(id);

        function getDelivery(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('SA-GetSingleView')}}",
                data: {
                    'sub_task_id': id,
                },
                success: function(response) {
                   
                    jQuery.each(response, function(key, value) {
                        $('#progressId').val(value["id"]);
                        $('#editProjectExcel_id').val(value["sub_task_id"]);
                        $('#editProjectId').val(value["project_id"]);
                        $('#editTask_all').val(value["Task"]);
                        $('#editHeading_all').val(value["heading"]);
                        $('#editHeading_all').val(value["heading"]);
                        $('#editHeading_all').val(value["heading"]);
                    });

                    let i = 0;
                    $('.updateWork').html('');
                    $('.files-main-table').html('Total no. of files : ' + response.total);
                    jQuery.each(response, function(key, value) {
                        let date = new Date(value["created_at"])
                        $('.updateWork').append('<tr>\
                        <td class="p-2 border border-secondary">' + ++i + '</td>\
                        <td class="p-2 border border-secondary">' + value["employee_name"] + '</td>\
                        <td class="p-2 border border-secondary">' + date.toISOString().slice(0,10).split('-').reverse().join('-') + '</td>\
                        <td class="p-2 border border-secondary">' + value["deadline"] + '</td>\
                    </tr>');
                    });
                }
            });
        }
    });

    jQuery(document).ready(function(e) {
        let customer_id = $('#taskNumber').val();
        taskList(customer_id);


    });

    // All project list
    function taskList(customer_id) {

        $.ajax({
            type: "GET",
            url: "{{ route('SA-GetTaskList')}}",
            data: {
                'customer_id': customer_id,
            },
            success: function(response) {
                let i = 0;
                jQuery('.task').html('');
                $('.project-main-table').html();
                jQuery.each(response.data, function(key, value) {
                    $('.task').append(`<tr>
                    <td class=" border border-secondary">${++i} </td>
                    <td class=" border border-secondary">${value["task1"]} </td>
                </tr>`);
                });

                $('.project-pagination-refs').html('');
                jQuery.each(response.links, function(key, value) {
                    $('.project-pagination-refs').append(
                        '<li id="project_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                    );
                });


            }
        });
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>