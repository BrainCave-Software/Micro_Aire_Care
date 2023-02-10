@extends('superadmin.layouts.master')
@section('title','Project Dashboard | Micro Aire-Care')
@section('body')

<head>

    <!-- customer css file -->
    <link rel="stylesheet" href="{{ asset('inventorybackend/css/style.css')}}" />
    <!-- customer js file -->
    <script src="{{ asset('inventorybackend/js/action.js')}}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<div class="main-panel">
    <div class="content-wrapper pb-0">

        <div class="row">
            <div class="p-3 col">
                <!-- orders Tab -->
                <div class="page-header flex-wrap">
                    <h4 class="mb-0">
                        Job Sheet
                    </h4>
                    <div class="d-flex">


                    </div>
                    <div class="d-flex">
                    </div>
                </div>
                

                <!-- table start -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive-sm" style="overflow-x:scroll;">
                                    <table class="table text-center table-hover">
                                        <caption class="sales-orders-main-table1"></caption>
                                        <thead class="fw-bold text-dark">
                                            <tr class="col">
                                                <th>S/N</th>
                                                <th>Job Sheet No</th>
                                                <th>Starting Date</th>
                                                <th>Delivery Date</th>
                                                <!-- <th  colspan="3">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="tbody projectDashboard">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="sales-orders-pagination-refs pagination-referece-css pagination justify-content-center"></ul>
                <!-- table end here -->
            </div>
            <div class="col">
                <div id="piechart_3d" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
    </div>


    <!-- jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- // backend js file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

    <script>
        jQuery(document).ready(function() {
            ListDashboardProject();
        });
        // All project list
        function ListDashboardProject() {

            $.ajax({
                type: "GET",
                url: "{{ route('SA-GetProjectList') }}",
                success: function(response) {
                    let i = 0;
                    jQuery('.projectDashboard').html('');
                    $('.project-main-table').html('Total no. of Project : ' + response.total);
                    jQuery.each(response.data, function(key, value) {
                        $('.projectDashboard').append(`<tr>
                    <td class=" border border-secondary">${++i} </td>
                    <td class=" border border-secondary">${ value["project_title"] }</td>
                    <td class=" border border-secondary">${ value["start_date"] }</td>
                    <td class=" border border-secondary">${ value["deadline"] }</td>
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

        // pagination links css and access page
        $(function() {
            $(document).on("click", "#project_pagination a", function() {
                //get url and make final url for ajax 
                var url = $(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append;

                $.get(finalURL, function(response) {
                    let i = response.from;
                    jQuery('.projectDashboard').html('');
                    $('.project-main-table').html('Total no. of Project : ' + response.total);
                    jQuery.each(response.data, function(key, value) {

                        $('.projectDashboard').append(`<tr>
                    <td class=" border border-secondary">${i++ }</td>
                    <td class=" border border-secondary">${ value["project_title"] }</td>
                    <td class=" border border-secondary">${ value["start_date"] }</td>
                    <td class=" border border-secondary">${ value["deadline"] }</td>
                </tr>`);
                    });

                    $('.project-pagination-refs').html('');
                    jQuery.each(response.links, function(key, value) {
                        $('.project-pagination-refs').append(
                            '<li id="project_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '"><a class="page-link" href="' + value['url'] + '" >' + value["label"] + '</a></li>'
                        );
                    });
                });
                return false;
            });
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
                <?php 
                echo $chartData
                ?>
            ]);

            var options = {
                title: ' Completed/Pending Project',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
    @endsection