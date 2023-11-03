@extends('layouts.templates')

@section('page_css')
	<link rel="stylesheet" href="{{ asset('plugin/flatpickr/flatpickr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugin/filepond/filepond.css') }}">
	<link rel="stylesheet" href="{{ asset('plugin/filepond-image-preview/filepond-plugin-image-preview.min.css') }}">
@endsection

@section('content')
<header class="mb-3">
	<a href="#" class="burger-btn d-block d-xl-none">
		<i class="bi bi-justify fs-3"></i>
	</a>
</header>

<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Edit Data Pembayaran</h3>
				<p class="text-subtitle text-muted">Edit form jika diperlukan.</p>
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav
					aria-label="breadcrumb"
					class="breadcrumb-header float-start float-lg-end"
				>
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Edit Data Pembayaran
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>

	<!-- // Basic multiple Column Form section start -->
	<section id="multiple-column-form">
		<div class="row match-height">
			<div class="col-12">
				<div class="card">
					<div class="card-content">
						<div class="card-body">
							<form class="form" action="{{ route('pembayaran.update', $bill->id) }}" enctype="multipart/form-data" method="POST" id="createPost">
								@method('PATCH')
								@csrf
								<div class="row">
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="description-column">Deskripsi*</label>
											<input
												type="text"
												id="description-column"
												class="form-control"
												placeholder="Abis bayar apa ..."
												name="description"
												value="{{ $bill->description }}"
											/>
											@if ($errors->has('description'))
												<span class="help-block text-danger">
													<p>{{ $errors->first('description') }}</p>
												</span>
											@endif
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="type-column">
												Jenis Pembayaran*
											</label>
											<fieldset class="form-group">
												<select class="form-select" name="type_id">
													<option value="{{ $bill->type_id }}">{{ $bill->billType->name }}</option>
													@foreach ($billTypes as $type)
														<option value="{{ $type->id }}">{{ $type->name }}</option>
													@endforeach
												</select>
											</fieldset>
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="total-column">Jumlah Bayar*</label>
											<input
												type="number"
												id="total-column"
												class="form-control"
												placeholder="Total bayarnya berapa ..."
												name="total_paid"
												value="{{ $bill->total_paid }}"
											/>
											@if ($errors->has('total_paid'))
												<span class="help-block text-danger">
													<p>{{ $errors->first('total_paid') }}</p>
												</span>
											@endif
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="date-floating">
												Tanggal Bayar*
											</label>
											<input
												type="date"
												class="form-control mb-3 flatpickr-no-config"
												name="paid_date"
												placeholder="Pilih tanggal ..."
												value="{{ $bill->paid_date }}"
											/>
											@if ($errors->has('paid_date'))
												<span class="help-block text-danger">
													<p>{{ $errors->first('paid_date') }}</p>
												</span>
											@endif
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label for="company-column">Bukti Bayar</label>

											<div class="form-group clearfix mt-2">
												<div class="form-check">
													<input
														class="form-check-input"
														type="radio"
														name="imageUpload"
														id="localUpload"
														value="Local"
														checked
													/>
													<label
														class="form-check-label"
														for="localUpload"
													>
														Penyimpanan Lokal
													</label>
												</div>
												<div class="form-check">
													<input
														class="form-check-input"
														type="radio"
														name="imageUpload"
														id="fromUrl"
														value="Url"
													/>
													<label class="form-check-label" for="fromUrl">
														Link URL
													</label>
												</div>
											</div>

											<!-- local upload -->
											<div class="image-form" id="showLocal">
												<input
													type="file"
													class="image-preview-filepond"
													name="image"
													data-image-url="{{ isset($bill) ? asset('uploads/' . $bill->image) : '' }}"
												/>
											</div>

											<!-- from URL -->
											<div class="image-form" id="showUrl">
												<input
													type="url"
													class="form-control"
													placeholder="Salin link URL disini ..."
													id="imageUrl"
													name="image_url"
												/>
											</div>

											<img id="preview_image" class="w-50 mt-2" src="{{ isset($bill) ?  $bill->image : '' }}"/>
										</div>
									</div>
									<div class="col-12 d-flex justify-content-center">
										<button
											type="submit"
											class="btn btn-primary me-1 mb-1 btn-block"
										>
											Save
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection

@section('page_scripts')
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('plugin/flatpickr/flatpickr.min.js') }}"></script>
	<script src="{{ asset('plugin/filepond-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
	<script src="{{ asset('plugin/filepond/filepond.js') }}"></script>

	<script>
		// date picker
		flatpickr(".flatpickr-no-config", {
			// enableTime: true,
			dateFormat: "Y-m-d",
		});

		// image upload
		FilePond.registerPlugin(FilePondPluginImagePreview);

		const inputElement = document.querySelector('.image-preview-filepond');
		const getImageUrl = inputElement.getAttribute('data-image-url');

		// console.log(getImageUrl);

		FilePond.create(inputElement, {
			credits: null,
			allowImagePreview: true,
			allowImageFilter: false,
			allowImageExifOrientation: false,
			allowImageCrop: false,
			acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg"],
			fileValidateTypeDetectType: (source, type) =>
				new Promise((resolve, reject) => {
					// Do custom type detection here and return with promise
					resolve(type);
				}),
			storeAsFile: true,
			files: [
				{
					source: getImageUrl,
					options: {
						type: 'local'
					}
				}
			],
			server: {
				load: (uniqueFileId, load) => {
					// you would get the file data from your server here
					fetch(uniqueFileId)
						.then(res => res.blob())
						.then(load);
				}
			}
		});
	</script>

	<script>
		// show image form based on radio input
   	$(document).ready(function () {
			$("div.image-form").hide();

			var checkedRadio = $('input[type="radio"]:checked');
			if (checkedRadio.length > 0) {
				var demovalue = checkedRadio.val();
				$("#show" + demovalue).show();
			}

			$('input[type="radio"]').click(function () {
				var demovalue = $(this).val();
				$("div.image-form").hide();
				$("#show" + demovalue).show();
			});
		});

		// show image preview from url
		$(document).ready(function() {
			$('#imageUrl').on('input', function() {
				var imageUrl = $(this).val();
				var previewImage = $('#preview_image');

				if (imageUrl.trim() !== '') {
					previewImage.attr('src', imageUrl);
					previewImage.css('display', 'block');
				} else {
					previewImage.css('display', 'none');
				}
			});
    });

	</script>
@endsection

