
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('/template/assets/img/icon.ico') }}" type="image/x-icon" />

	<!-- Fonts and icons -->
    <script src="{{ asset('/template/assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":[
                        "Flaticon",
                        "Font Awesome 5 Solid",
                        "Font Awesome 5 Regular",
                        "Font Awesome 5 Brands"
                    ],
                    urls: [" {{ url('/template/assets/css/fonts.css') }} "]
                },
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('/template/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/assets/css/azzara.min.css') }}">
</head>
<body>

    <div class="login" style="background-image: url('/img/product/kppiezo.jpg');background-size: cover;background-position: center;">
        <div class="wrapper wrapper-login" style="background-color: transparent; opacity: 0.9;">
            <div class="container container-login animated fadeIn">
                <h3 class="text-center">Sign In To Admin</h3>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="login-form">
                    <form action="{{ route('auth') }}" method="POST">
                        @csrf
                        <div class="form-group form-floating-label">
                            <input id="username" name="uName" type="text" class="form-control input-border-bottom" required>
                            <label for="username" class="placeholder">Username</label>
                        </div>
                        <div class="form-group form-floating-label">
                            <input id="password" name="pass" type="password" class="form-control input-border-bottom" required>
                            <label for="password" class="placeholder">Password</label>
                            <div class="show-password">
                                <i class="flaticon-interface"></i>
                            </div>
                        </div>
                        <div class="form-action mb-3">
                            <button type="submit" class="btn btn-primary btn-rounded btn-login">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
	<script src="{{ asset('/js/plugin/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('/template/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('/template/assets/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/template/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('/template/assets/js/ready.min.js') }}"></script>
</body>
</html>
