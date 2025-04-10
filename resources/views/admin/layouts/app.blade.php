<!doctype html>
<html lang="en" data-layout="vertical" data-sidebar="dark" data-sidebar-size="lg" data-preloader="disable" data-theme="default" data-topbar="light" data-bs-theme="light">


<head>

  <meta charset="utf-8">
  <title> @yield('page-title') |  Admin </title>


  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
 

  <!-- Fonts css load -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin> 
  <link id="fontsLink" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">

  <!-- dropzone css -->
  {{-- <link href="{{url('')}}/admin/assets/libs/dropzone/dropzone.css" rel="stylesheet" type="text/css"> --}}

  {{-- <link href="{{url('')}}/admin/assets/libs/leaflet/leaflet.css" rel="stylesheet" type="text/css"> --}}

  <!-- Layout config Js -->
  <script src="{{url('')}}/assets/js/layout.js"></script>
  <!-- Bootstrap Css -->
  <link href="{{url('')}}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <!-- Icons Css -->
  <link href="{{url('')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
  <!-- App Css-->
  <link href="{{url('')}}/assets/css/app.min.css" rel="stylesheet" type="text/css">
  <!-- custom Css-->
  {{-- <link href="{{url('')}}/admin/assets/css/custom.min.css" rel="stylesheet" type="text/css"> --}}

</head>


<!--begin::Body-->

<body>

  <!-- Begin page -->
  <div id="layout-wrapper">


@include('admin.layouts.aside')
    @yield('content')

    <!-- sa-app__body / end -->
    <!-- sa-app__footer -->
    <footer class="main-footer">
      <div class="pull-right d-none d-sm-inline-block">
        <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
          <li class="nav-item">
            <!-- <a class="nav-link" href="javascript:void(0)">FAQ</a> -->
          </li>

        </ul>
      </div>
    </footer>
    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->

    <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- JAVASCRIPT -->
<script src="{{url('')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{url('')}}/assets/libs/simplebar/simplebar.min.js"></script>
{{-- <script src="{{url('')}}/admin/assets/js/plugins.js"></script> --}}

<script src="{{url('')}}/assets/libs/list.js/list.min.js"></script>

<!-- echarts js -->
{{-- <script src="{{url('')}}/admin/assets/libs/echarts/echarts.min.js"></script> --}}

<!-- apexcharts -->
{{-- <script src="{{url('')}}/admin/assets/libs/apexcharts/apexcharts.min.js"></script> --}}

<script src="{{url('')}}/assets/js/pages/dashboard-real-estate.init.js"></script>

<!-- App js -->
<script src="{{url('')}}/assets/js/app.js"></script>

<!-- leaflet plugin -->
{{-- <script src="{{url('')}}/admin/assets/libs/leaflet/leaflet.js"></script> --}}



</body>


</html>
