<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Billify | Log in</title>

		<link
			rel="stylesheet"
			href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
		/>
		<link rel="stylesheet" href="{{ asset('css/fontawesome-free/css/all.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}" />
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="card card-outline card-primary">
				<div class="card-header text-center">
					<a href="/" class="h1 ml-4"><b>Billify</b> Login</a>
				</div>
				<div class="card-body">
					<p class="login-box-msg">Sign in to start your session</p>
					@include('includes.alerts')
					<form id="login_form" action="/" method="POST">
						@csrf
						<div class="input-group mb-3 form-group">
							<input
								type="email"
								name="email"
								class="form-control"
								placeholder="Email"
								autofocus
							/>
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-envelope"></span>
								</div>
							</div>
						</div>
						@if ($errors->has('email'))
							<span class="help-block">
								<p class="text-danger">{{ $errors->first('email') }}</p>
							</span>
						@endif
						<div class="input-group mb-3 form-group">
							<input
								type="password"
								class="form-control"
								placeholder="Password"
								name="password"
							/>
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
							
						</div>
						@if ($errors->has('password'))
							<span class="help-block">
								<p class="text-danger">{{ $errors->first('password') }}</p>
							</span>
						@endif
						<div class="row">
							<!-- /.col -->
							<div class="col-12">
								<input type="submit" class="btn btn-primary btn-block"/>
							</div>
							<!-- /.col -->
						</div>
					</form>
				</div>
			</div>
		</div>

		<script src="{{ asset('js/jquery.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('js/adminlte.min.js') }}"></script>
	</body>
</html>
