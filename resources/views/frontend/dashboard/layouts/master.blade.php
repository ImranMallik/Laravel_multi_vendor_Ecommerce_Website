<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>One Shop || e-Commerce HTML Template</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.nice-number.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.calendar.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/add_row_custon.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/mobile_menu.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.exzoom.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/multiple-image-video.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/ranger_style.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.classycountdown.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/venobox.min.css') }} ">



    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }} ">
    {{-- Toster Css --}}

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- <link rel="stylesheet" href="css/rtl.css"> -->
</head>

<body>


    <!--=============================
    DASHBOARD MENU START
  ==============================-->
    <div class="wsus__dashboard_menu">
        <div class="wsusd__dashboard_user">
            <img src="{{ Auth::user()->image }}" alt="img" class="img-fluid">
            <p>{{ Auth::user()->name }}</p>
        </div>
    </div>
    <!--=============================
    DASHBOARD MENU END
  ==============================-->


    <!--=============================
    DASHBOARD START
  ==============================-->
    @yield('content')


    <!--=============================
    DASHBOARD START
  ==============================-->


    <!--============================
      SCROLL BUTTON START
    ==============================-->
    <div class="wsus__scroll_btn">
        <i class="fas fa-chevron-up"></i>
    </div>
    <!--============================
    SCROLL BUTTON  END
  ==============================-->


    <!--jquery library js-->
    <script src="js/jquery-3.6.0.min.js"></script>
    <!--bootstrap js-->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!--font-awesome js-->
    <script src="js/Font-Awesome.js"></script>
    <!--select2 js-->
    <script src="js/select2.min.js"></script>
    <!--slick slider js-->
    <script src="js/slick.min.js"></script>
    <!--simplyCountdown js-->
    <script src="js/simplyCountdown.js"></script>
    <!--product zoomer js-->
    <script src="js/jquery.exzoom.js"></script>
    <!--nice-number js-->
    <script src="js/jquery.nice-number.min.js"></script>
    <!--counter js-->
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.countup.min.js"></script>
    <!--add row js-->
    <script src="js/add_row_custon.js"></script>
    <!--multiple-image-video js-->
    <script src="js/multiple-image-video.js"></script>
    <!--sticky sidebar js-->
    <script src="js/sticky_sidebar.js"></script>
    <!--price ranger js-->
    <script src="js/ranger_jquery-ui.min.js"></script>
    <script src="js/ranger_slider.js"></script>
    <!--isotope js-->
    <script src="js/isotope.pkgd.min.js"></script>
    <!--venobox js-->
    <script src="js/venobox.min.js"></script>
    <!--classycountdown js-->
    <script src="js/jquery.classycountdown.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!--main/custom js-->
    <script src="js/main.js"></script>
    {{-- Toster Script --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- Toster Error --}}

    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>
</body>

</html>
