<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Laporan Data Penjualan Makanan</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('/template/assets/img/icon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('/template/assets/js/plugin/webfont/webfont.min.js') }}"></script>

    <script>
        WebFont.load({
            google: {
                "families": ["Open+Sans:300,400,600,700"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands"
                ],
                urls: [" {{ url('/template/assets/css/fonts.css') }} "]
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });

    </script>

    <!-- CSS Files -->
    {{-- <link rel="stylesheet" href="{{ asset('/css/plugin/jquery.dataTables.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('/template/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/assets/css/azzara.min.css') }}">
</head>

<body>
    <div class="wrapper">
        @include('admin.layout.navbar')
        @include('admin.layout.sidebar')

        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">@yield('title')</h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="flaticon-home"></i>
                                    @yield('page')
                                </a>
                            </li>
                        </ul>
                    </div>
                    @yield('content')
                </div>
            </div>

        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('/js/plugin/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('/template/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('/template/assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('/template/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/template/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('/js/plugin/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('/js/Plugin/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="{{ asset('/template/assets/js/plugin/moment/moment.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('/template/assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('/template/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('/template/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/js/plugin/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/js/plugin/dataTables.editor.min.js') }}"></script>
    <script src="{{ asset('/js/plugin/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('/js/plugin/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/js/plugin/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/js/plugin/jszip.min.js') }}"></script>
    <script src="{{ asset('/js/plugin/pdfmake.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('/js/plugin/bootstrap-notify.min.js') }}"></script>

    <!-- Bootstrap Toggle -->
    <script src="{{ asset('/js/plugin/bootstrap-toggle.min.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ url('js/plugin/sweetalert2@9.js') }}"></script>

    <!-- Azzara JS -->
    <script src="{{ asset('/template/assets/js/ready.min.js') }}"></script>
    @yield('script')
</body>

</html>
