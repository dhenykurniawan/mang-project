<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Mang- Belanja Fresh di mang aja !</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- <link rel="manifest" href="manifest.json" />!-->

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon180.png') }}" sizes="180x180">
    <link rel="icon" href="{{ asset('assets/img/favicon32.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('assets/img/favicon16.png') }}" sizes="16x16" type="image/png">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400&amp;display=swap"
        rel="stylesheet">

    <!-- bootstrap icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.6.0/font/bootstrap-icons.min.css">

    <!-- nouislider CSS -->
    <link href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}" rel="stylesheet">

    <!-- swiper css -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiperjs-6.6.2/swiper-bundle.min.css') }}">

    <!-- style css for this template -->
    <link href="{{ asset('assets/css/style-green.css') }}" rel="stylesheet" id="style">
</head>

<body class="body-scroll d-flex flex-column h-100 dark-bg bg1" data-page="thankyou">

    <!-- loader section -->
    <div class=" loader-wrap">
        <div class="row h-100">
            <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto text-center align-self-center">
                <div class="loader-cube-wrap mx-auto">
                    <div class="loader-cube1 loader-cube"></div>
                    <div class="loader-cube2 loader-cube"></div>
                    <div class="loader-cube4 loader-cube"></div>
                    <div class="loader-cube3 loader-cube"></div>
                </div>
                <p>Di Mang <br><strong>Belanja semakin mudah !</strong></p>
            </div>
        </div>
    </div>
    <!-- loader section ends -->

    <!-- Begin page content -->
    <main class=" h-100">
        <div class="row h-100">
            <!--<div class="col-12 text-center">
                <div class="logo-small">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="" class="img">
                    <h6>PINGKIFRESH</h6>
                </div>
            </div>!-->
            <div class="col-12 mx-auto text-center">
                <div class="row h-100">
                    <div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-3 mx-auto align-self-center">
                        <img src="{{ asset('assets/img/i_thanks.png') }}" alt="Logo" class="mw-100">
                        <h3 class="text-center">Sudah Order di MANG!!</h3>
                        <p class=" mb-4">Order kamu akan segera Mang proses.</p>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Required jquery and libraries -->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>

    <!-- cookie js -->
    <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>

    <!-- swiper script -->
    <script src="{{ asset('assets/vendor/swiperjs-6.6.2/swiper-bundle.min.js') }}"></script>

    <!-- nouislider js -->
    <script src="{{ asset('assets/vendor/nouislider/nouislider.min.js') }}"></script>

    <!-- Customized jquery file  -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/color-scheme.js') }}"></script>

    <!-- page level custom script -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script type="text/javascript">
        setTimeout(function() {
            window.location.href = "{{ route('index') }}";
        }, 3000);
    </script>

</body>

</html>
