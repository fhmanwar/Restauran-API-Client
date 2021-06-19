{{-- <div class="main-header" data-background-color="orange "> --}}
<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" style="background-color: #B8860B;color: #fff">

        <a href="index.html" class="logo" style="color:azure;">
            {{-- <img src="{{ asset('template/assets/img/logoazzara.svg') }}" alt="navbar brand" class="navbar-brand"> --}}
            <i class="fas fa-swatchbook"></i>
            Piezo Cafe
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fa fa-bars"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
        <div class="navbar-minimize">
            <button class="btn btn-minimize btn-rounded">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" style="background-color: #DAA520;color: #fff">

        <div class="container-fluid">

            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center"> </ul>
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="{{ route('logout') }}" role="button">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
