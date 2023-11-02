<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"
				><i class="fa-solid fa-bars"></i
			></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="{{ route('dashboard') }}" class="nav-link">Home</a>
		</li>
	</ul>

	<ul class="navbar-nav ml-auto">
		<li class="nav-item">
			<a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
				<i class="fa-solid fa-sign-out-alt"></i>
			</a>
		</li>

		<form
			id="logout-form"
			action="{{ route('logout') }}"
			method="POST"
			style="display: none"
		>
			@csrf
		</form>
	</ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="{{ route('home') }}" class="brand-link">
		<img
			src="{{ asset('images/AdminLTELogo.png') }}"
			alt="AdminLTE Logo"
			class="brand-image img-circle elevation-3"
			style="opacity: 0.8"
		/>
		<span class="brand-text font-weight-light">Billify</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul
				class="nav nav-pills nav-sidebar flex-column"
				data-widget="treeview"
				role="menu"
				data-accordion="false"
			>
				<!-- Add icons to the links using the .nav-icon class
					with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
						<i class="nav-icon fa-solid fa-gauge"></i>
						<p>Dashboard</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('pembayaran.index') }}" class="nav-link {{ request()->routeIs('pembayaran.index') ? 'active' : '' }}">
						<i class="nav-icon fa-solid fa-file-invoice"></i>
						<p>Pembayaran</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('jenis-pembayaran.index') }}" class="nav-link {{ request()->routeIs('jenis-pembayaran.index') ? 'active' : '' }}">
						<i class="nav-icon fa-solid fa-wallet"></i>
						<p>Jenis pembayaran</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>