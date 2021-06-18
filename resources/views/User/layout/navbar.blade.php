<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <div id="colorlib-logo"><a href="{{ route('home') }}">Piezo Coffee</a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        {{-- <li><a href="{{ route('cart/'.session()) }}"><i class="icon-shopping-cart"></i> Cart </a></li> --}}
                        <li><a href="{{ url('cart/'.session('noMeja')) }}"><i class="icon-shopping-cart"></i> Keranjang </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
