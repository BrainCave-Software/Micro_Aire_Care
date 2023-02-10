@section('title','Project details | Micro Aire-Care ')
@include('superadmin.layouts.header')
@include('superadmin.layouts.aside')
@include('superadmin.layouts.nav')

<body onload="init()">

    <!-- sales css file -->
    <link rel="stylesheet" href="{{ asset('inventorybackend/css/style.css')}}" />


    <div class="main-panel">
        <div class="content-wrapper pb-0">
            <h4 class="mb-4">
                Project:
                @foreach ($data as $data6)

                {{$data6->project_title}}

                @endforeach

            </h4>

            <ul id="tabs">
                <li><a href="#overview">Overview</a></li>
                <li><a href="#tasks">Tasks</a></li>
                <li><a href="#file">File</a></li>
                <li><a href="#notes">Remarks</a></li>
                <li><a href="#variantion">Variation</a></li>
                <li><a href="#incidentReport">Incident Report</a></li>
            </ul>

            <!-- overview Tab Content -->

            <div class="tabContent" id="overview">
                @include('superadmin.project-details.overview')
            </div>

            <!-- tasks Tab Content -->
            <div class="tabContent" id="tasks">
                @include('superadmin.project-details.tasks')
            </div>

            <!-- file Tab Content -->
            <div class="tabContent" id="file">
            @include('superadmin.project-details.file')

            </div>
            <!-- notes Tab Content -->
            <div class="tabContent" id="notes">
                @include('superadmin.project-details.notes')
            </div>
            <!-- variantion Tab Content -->
            <div class="tabContent" id="variantion">
                @include('superadmin.project-details.variantion')
            </div>
            
            <!-- Incident Report Tab Content -->
            <div class="tabContent" id="incidentReport">
                @include('superadmin.project-details.Incident-report')
            </div>

        </div>

    
        <!-- sales js file -->
        <script src="{{ asset('inventorybackend/js/action.js')}}"></script>

</body>
@include('superadmin.layouts.footer')