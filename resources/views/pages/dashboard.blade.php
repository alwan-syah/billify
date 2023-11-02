@extends('layouts.templates')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Dashboard</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-lg-4 col-6">
				<div class="small-box bg-indigo">
					<div class="inner">
						<h3>{{ $totalBills }}</h3>
						<p>Data Pembayaran</p>
					</div>
					<div class="icon">
						<i class="fas fa-file-invoice"></i>
					</div>
					<a href="{{ route('pembayaran.index') }}" class="small-box-footer"
						>View Details <i class="fas fa-arrow-circle-right"></i
					></a>
				</div>
			</div>
			<div class="col-lg-4 col-6">
				<div class="small-box bg-maroon">
					<div class="inner">
						<h3>{{ $totalBillTypes }}</h3>
						<p>Jenis Pembayaran</p>
					</div>
					<div class="icon">
						<i class="fa-solid fa-wallet"></i>
					</div>
					<a href="{{ route('jenis-pembayaran.index') }}" class="small-box-footer"
						>View Details <i class="fas fa-arrow-circle-right"></i
					></a>
				</div>
			</div>
			<div class="col-lg-4 col-6">
				<div class="small-box bg-fuchsia">
					<div class="inner">
						<h3>{{ number_format($sumTotalPaid) }}</h3>
						<p>Total Pembayaran</p>
					</div>
					<div class="icon">
						<i class="fa-solid fa-money-bills"></i>
					</div>
					<a href="javascript:void(0)" class="small-box-footer"
						>View Details <i class="fas fa-arrow-circle-right"></i
					></a>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
