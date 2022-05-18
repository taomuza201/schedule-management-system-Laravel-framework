<!DOCTYPE html>
<!--
* CoreUI Free Laravel Bootstrap Admin Template
* @version v2.0.1
* @link https://coreui.io
* Copyright (c) 2020 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    {{-- <meta name="description" content="octus logicus">
    <meta name="author" content="octus logicus"> --}}
    {{-- <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard"> --}}
    {{-- <title>ระบบบริหารจัดการภายใน octuslog</title> --}}


    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="John Doe">

    <title>ระบบบริหารจัดการภายใน octuslog - @yield('title')</title>

    <link rel="icon" type="image/png"  href="assets/octopus.png">
  
    {{-- <link rel="manifest" href="assets/favicon/manifest.json"> --}}
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Icons-->
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet"> <!-- icons -->
    {{-- <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet">
    <!-- icons --> --}}
    <!-- Main styles for this application-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('js/datatable/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('mycss/this.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">

    @yield('css')

    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');

    </script>

    <link href="{{ asset('css/coreui-chartjs.css') }}" rel="stylesheet">
</head>



<body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

        @include('dashboard.shared.nav-builder')

        @include('dashboard.shared.header')

        <div class="c-body">

            <main class="c-main">

                @yield('content')

            </main>
            @include('dashboard.shared.footer')
        </div>
    </div>



    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('js/coreui-utils.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    {{-- <script src="{{ asset('js/jquery.add-input-area.min.js') }}"></script> --}}
 
    
    @yield('javascript')




</body>

<script>
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);

</script>

</html>
