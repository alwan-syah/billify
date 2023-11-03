<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Billify | Dashboard</title>

		<link rel="shortcut icon" href="./favicon.svg" type="image/x-icon" />

		@include('includes.head')

		@yield('page_css')
	</head>

	<body>
		<script src="{{ asset('js/initTheme.js') }}"></script>
		<div id="app">
			<div id="sidebar">
				@include('includes.header')
			</div>
			<div id="main">
				@yield('content')
			</div>
		</div>


		@include('includes.scripts')
		

		@yield('page_scripts')
	</body>
</html>
