<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title ?? 'Ngajar.in' }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">

    <!-- Livewire -->
    @livewireStyles

    <!-- Midtrans -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-8Rus11nWUJcOOuuV"></script>

    <style type="text/css">
        body {
            background: #101123;
        }

        .main {
            margin: auto 10%;
            padding-top: 8%;
            text-align: center;
            color: #696969;
        }

        #clock>div {
            border-radius: 5px;
            background: #ffa500;
            padding: 20px 20px 10px 20px;
            color: #fff;
            display: inline-block;
        }

        #clock>div>p {
            font-size: 16px;
        }

        #days,
        #hours,
        #minutes,
        #seconds {
            padding: 5px;
            border-radius: 5px;
            font-size: 20px;
            background: #fb8e00;
            display: inline-block;
            width: 40px;
        }

        span.turn {
            animation: turn 0.7s ease;
        }

        @keyframes turn {
            0% {
                transform: rotateX(0deg)
            }

            100% {
                transform: rotateX(360deg)
            }
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layout.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layout.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('layout/footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script>
        $(function() {
            $('[data-toggle="popover"]').popover()
        })
    </script>

    <!-- Livewire -->
    @livewireScripts

    @yield('script')
</body>

</html>