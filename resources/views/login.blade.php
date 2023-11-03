<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Billify | Login</title>

		<link rel="shortcut icon" href="favicon.svg" type="image/x-icon" />

		<link rel="stylesheet" href="{{ asset('css/app.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/auth.css') }}" />
	</head>

	<body>
		<script src="{{ asset('js/initTheme.js') }}"></script>
		<div id="auth">
			<div class="row h-100">
				<div class="col-lg-5 col-12">
					<div id="auth-left">
						<div class="auth-logo">
							<a href="#">
								<h1 class="auth-title">Billify</h1>
							</a>
						</div>
						<h1>Log in.</h1>
						<p class="auth-subtitle mb-5">Log in with admin credential.</p>
						@include('includes.alerts')
						<form action="{{ route('login') }}" method="POST">
							@csrf
							<div class="form-group position-relative has-icon-left mb-4">
								<input
									type="email"
									class="form-control form-control-xl"
									placeholder="Email"
									name="email"
									autofocus
								/>
								<div class="form-control-icon">
									<i class="bi bi-envelope"></i>
								</div>
								@if ($errors->has('email'))
									<span class="help-block">
										<p class="text-danger">{{ $errors->first('email') }}</p>
									</span>
								@endif
							</div>
							<div class="form-group position-relative has-icon-left mb-4">
								<input
									type="password"
									class="form-control form-control-xl"
									placeholder="Password"
									name="password"
								/>
								<div class="form-control-icon">
									<i class="bi bi-shield-lock"></i>
								</div>

								@if ($errors->has('password'))
									<span class="help-block">
										<p class="text-danger">{{ $errors->first('password') }}</p>
									</span>
								@endif
							</div>
							<button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">
								Log in
							</button>
						</form>
					</div>
				</div>
				<div class="col-lg-7 d-none d-lg-block">
					<div id="auth-right"></div>
				</div>
			</div>
		</div>
	</body>
</html>
