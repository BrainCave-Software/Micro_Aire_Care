<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<div class="border border-secondary" style="padding:20px;">

    <div class="page-header flex-wrap">
        <h4 class="mb-0">
            Overview
        </h4>
        <div class="d-flex">
            <!-- <a href="#" id="newbutton" data-toggle="modal" data-target="#noteCreate"> Create Note </a> -->
        </div>
    </div>

    @foreach ($data as $data)

    <div class="row">
        <div class="col-sm-7 rounded border border-dark">
            <!-- Progress  -->
            <div class="form-group row">
                <label for="project_title" class="col-sm-2 col-form-label">Progress </label>

            </div>
            <hr>
            <div class="form-group row">
                <label for="project_title" class="col-sm-3 col-form-label">Project Title </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{$data->project_title}}" id="viewprojectTitle" name="viewprojecttitle" placeholder="Project Title" disabled />
                </div>
                <!-- client Name -->

                <!-- <label for="client_name" class="col-sm-2 col-form-label">client Name <span style="color:red; font-size:medium">*</span> </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="viewclientname" id="viewclientName">

                </div> -->
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="project_title" class=" col-form-label">Sale Person </label>
                    <div>
                        <input type="text" class="form-control" value="{{$data->assign_to}}" id="viewassignTo" name="viewprojecttitle" placeholder="Project Title" disabled />
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- client Name -->

                    <label for="client_name" class=" col-form-label">Client Name </label>
                    <div class="">
                        <input type="text" class="form-control" value="{{$data->clientExcel_name}}" name="viewclientname" id="viewmanager" disabled>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="project_title" class=" col-form-label">Start Date </label>
                    <div>
                        <input type="text" class="form-control" value="{{$data->start_date}}" id="viewstartDate" name="viewprojecttitle" placeholder="Project Title" disabled />
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- client Name -->

                    <label for="client_name" class=" col-form-label">Due Date </label>
                    <div class="">
                        <input type="text" class="form-control" value="{{$data->deadline}}" name="viewclientname" id="viewdeadline" disabled>

                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">


            </div>
            <div class="form-group row">
                <!-- Demo -->
                <label for="project_title" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-4">
                </div>
                <!-- Demo -->
                <label for="client_name" class="col-sm-2 col-form-label"> </label>
                <div class="col-sm-4">
                </div>
            </div>
        </div>
        @endforeach

        <div class="col-sm-5 rounded border border-dark">
            <div>
                <h1>Micro Aire</h1>
            </div>
            <div id="piechart_3d" style="width: 100%; height: 500px;"></div>

            <!-- table start -->
            <div class="table-responsive" style="overflow-x:scroll;">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th class="border border-secondary">Employee Name</th>
                        </tr>
                    </thead>
                    @foreach($empName as $empName)
                    <tbody class="tbody ">
                        <tr>
                            <td>
                                {{$empName->name}}
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- backend js file -->


<script>
    $(document).on("click", "a[name = 'viewprojectId']", function(e) {

        console.log('test55');

    });
</script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            @foreach($arr as $key => $value)["{{$value[0]}}", parseInt("{{$value[1]}}")],
            @endforeach
        ]);

        var options = {
            title: 'Pending & Complete',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }
</script>