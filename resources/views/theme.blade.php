<!DOCTYPE html>
<html lang="zxx">

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>LSSS Administracija</title>
    <link rel="icon" href="/img/minlogo.png" type="image/png">

{{--    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('vendors/themefy_icon/themify-icons.css')}}"/>

    <link rel="stylesheet" href="{{asset('vendors/niceselect/css/nice-select.css')}}"/>

    <link rel="stylesheet" href="{{asset('vendors/owl_carousel/css/owl.carousel.css')}}"/>

    <link rel="stylesheet" href="{{asset('vendors/gijgo/gijgo.min.css')}}"/>

    <link rel="stylesheet" href="{{asset('vendors/font_awesome/css/all.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('vendors/tagsinput/tagsinput.css')}}"/>

    <link rel="stylesheet" href="{{asset('vendors/datepicker/date-picker.css')}}"/>
    <link rel="stylesheet" href="{{asset('vendors/vectormap-home/vectormap-2.0.2.css')}}"/>

    <link rel="stylesheet" href="{{asset('vendors/scroll/scrollable.css')}}"/>

    <link rel="stylesheet" href="{{asset('vendors/text_editor/summernote-bs4.css')}}"/>

    <link rel="stylesheet" href="{{asset('vendors/morris/morris.css')}}">

    <link rel="stylesheet" href="{{asset('vendors/material_icon/material-icons.css')}}"/>

    <link rel="stylesheet" href="{{asset('css/metisMenu.css')}}">

    <link rel="stylesheet" href="{{asset('css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/colors/default.css')}}" id="colorSkinCSS">

    @yield('style')
</head>
<body class="crm_body_bg">

@include('admin.layout.navigation')

<section class="main_content dashboard_part large_header_bg">
    @yield('content')
    @include('layouts.footer')
</section>

<div id="back-top" style="display: none;">
    <a title="Go to Top" href="#">
        <i class="ti-angle-up"></i>
    </a>
</div>

<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>

<script src="{{asset('js/popper.min.js')}}"></script>

{{--<script src="{{asset('js/bootstrap.min.js')}}"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="{{asset('js/metisMenu.js')}}"></script>

<script src="{{asset('vendors/count_up/jquery.waypoints.min.js')}}"></script>

<script src="{{asset('vendors/chartlist/Chart.min.js')}}"></script>

<script src="{{asset('vendors/count_up/jquery.counterup.min.js')}}"></script>

<script src="{{asset('vendors/niceselect/js/jquery.nice-select.min.js')}}"></script>

<script src="{{asset('vendors/owl_carousel/js/owl.carousel.min.js')}}"></script>

<script src="{{asset('vendors/datepicker/datepicker.js')}}"></script>
<script src="{{asset('vendors/datepicker/datepicker.en.js')}}"></script>
<script src="{{asset('vendors/datepicker/datepicker.custom.js')}}"></script>
<script src="{{asset('js/chart.min.js')}}"></script>
<script src="{{asset('vendors/chartjs/roundedBar.min.js')}}"></script>

<script src="{{asset('vendors/progressbar/jquery.barfiller.js')}}"></script>

<script src="{{asset('vendors/tagsinput/tagsinput.js')}}"></script>

<script src="{{asset('vendors/am_chart/amcharts.js')}}"></script>

<script src="{{asset('vendors/scroll/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('vendors/scroll/scrollable-custom.js')}}"></script>

<script src="{{asset('vendors/vectormap-home/vectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('vendors/vectormap-home/vectormap-world-mill-en.js')}}"></script>

<script src="{{asset('vendors/chart_am/core.js')}}"></script>
<script src="{{asset('vendors/chart_am/charts.js')}}"></script>
<script src="{{asset('vendors/chart_am/animated.js')}}"></script>
<script src="{{asset('vendors/chart_am/kelly.js')}}"></script>
<script src="{{asset('vendors/chart_am/chart-custom.js')}}"></script>

<script src="{{asset('js/dashboard_init.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
@yield('js')
</body>

</html>
