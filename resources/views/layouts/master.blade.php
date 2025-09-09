<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="payanyfee">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('public/frontend/assests/favicon.ico')}}">
    
    
    <title>@yield('title'):{{config('app.name')}}</title>
    {{-- @else
    <title>Login:{{config('app.name')}}</title>
    @endif
     --}}
    @section('head')
    @yield('css')
    <!--Core CSS -->
    <link href="{{asset('public/frontend/assests/bs3/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/assests/css/bootstrap-reset.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/assests/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    
    @show

    <link href="{{asset('public/frontend/assests/css/table-responsive.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('public/frontend/assests/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/assests/css/style-responsive.css')}}" rel="stylesheet" />
    <script src="{{asset('public/frontend/assests/pace/pace.min.js')}}"></script>
    <link href="{{asset('public/frontend/assests/pace/themes/blue/pace-theme-minimal.css')}}" rel="stylesheet" />
    

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<!-- Placed js at the end of the document so the pages load faster -->
@yield('content')



@section('extraincludes')
@show

<!--Core js-->
<script src="{{asset('public/frontend/assests/js/jquery.js')}}"></script>
<script src="{{asset('public/frontend/assests/js/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
<script src="{{asset('public/frontend/assests/bs3/js/bootstrap.min.js')}}"></script>
<script src="{{url('public/frontend/assests/js/select2/select2.js?1.1')}}"></script>
<!--dynamic table-->
<script type="text/javascript" language="javascript" src="{{url('public/frontend/assests/js/advanced-datatable/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{url('public/frontend/assests/js/data-tables/DT_bootstrap.js')}}"></script>


@section('footer')
@show

@yield('js')
<script type="text/javascript" src="{{asset('public/frontend/assests/js/jquery.validate.min.js?1.1')}}"></script>

<!--DateRangePicker-->
<script src="{{asset('public/frontend/assests/js/bootstrap-daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('public/frontend/assests/js/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<script src="{{asset('public/frontend/assests/js/jquery.customSelect.min.js')}}"></script>
<!--common script init for all pages-->
<script src="{{asset('public/frontend/assests/js/scripts.js')}}"></script>
<!--script for this page-->

<script src="{{asset('public/frontend/assests/js/site.js')}}"></script>

</body>
</html>
