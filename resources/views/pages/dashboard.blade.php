@extends('layouts.templates')

@section('page_css')
	<link rel="stylesheet" href="{{ asset('css/iconly.css') }}">
@endsection

@section('content')
<header class="mb-3">
	<a href="#" class="burger-btn d-block d-xl-none">
		<i class="bi bi-justify fs-3"></i>
	</a>
</header>

<div class="page-heading">
	<h3>Statistik</h3>
</div>
<div class="page-content">
	<section class="row d-flex justify-content-center align-items-center">
		<div class="col-12 col-lg-10">
			<div class="row">
				<div class="col-6 col-lg-4 col-md-4">
					<div class="card">
						<div class="card-body px-4 py-4-5">
							<div class="row">
								<div
									class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
								>
									<div class="stats-icon purple mb-2">
										<i class="iconly-boldPaper"></i>
									</div>
								</div>
								<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
									<h6 class="text-muted font-semibold">
										Data Pembayaran
									</h6>
									<h6 class="font-extrabold mb-0">{{ $totalBills }}</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-4 col-md-4">
					<div class="card">
						<div class="card-body px-4 py-4-5">
							<div class="row">
								<div
									class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
								>
									<div class="stats-icon blue mb-2">
										<i class="iconly-boldWallet"></i>
									</div>
								</div>
								<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
									<h6 class="text-muted font-semibold">
										Jenis Pembayaran
									</h6>
									<h6 class="font-extrabold mb-0">{{ $totalBillTypes }}</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-4 col-md-4">
					<div class="card">
						<div class="card-body px-4 py-4-5">
							<div class="row">
								<div
									class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
								>
									<div class="stats-icon green mb-2">
										<i class="iconly-boldChart"></i>
									</div>
								</div>
								<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
									<h6 class="text-muted font-semibold">
										Total Pembayaran
									</h6>
									<h6 class="font-extrabold mb-0">Rp. {{ number_format($sumTotalPaid) }}</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection

@section('page_scripts')
	<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection