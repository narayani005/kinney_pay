<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/kinney.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <style>
    /* New Design changes */

    .btn-primary {
        color: #fff7f7 !important;
        background-color: #e54a1d !important;
        border-color: #ff0303 !important;
        font-weight: 700;
    }

    .card {
        backdrop-filter: blur(10px);
        background : #6868a2;
        color: white!important;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    .text-muted {
        color: #f1f1f1!important;
    }
    .account-pages {
            background-image: linear-gradient(to left bottom, #677084, #626e8a, #5c6c90, #576a95, #51689b) !important;
        }

        .btn.disabled, .btn:disabled, fieldset:disabled .btn {
            pointer-events: visiblepainted;
            opacity: 0.65;
            font-size: 15px;
            font-weight: 700;
            background-color: #e54a1d !important;
        }
    </style>

    <body data-topbar="colored">

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->

        <!-- Background -->
        <div class="account-pages"></div>
        <!-- Begin page -->
        <div class="wrapper-page">

        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif

            @yield('content')
            
            <div class="text-center">
                <p class="text-white-50"> @yield('acc_avail')  </p>
                <p class="text-muted">
                    ©
                    <script>document.write(new Date().getFullYear())</script> Kinney Wallet. Crafted with <i
                        class="mdi mdi-heart text-primary"></i> by
                    Kinney Infotech
                </p>
            </div>

        </div>


        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.js')}}"></script>


        <script>
        document.getElementById('termsChkbx').addEventListener('click', function (e) {
        document.getElementById('reg').disabled = !e.target.checked;
        });
        </script>
    </body>

</html>