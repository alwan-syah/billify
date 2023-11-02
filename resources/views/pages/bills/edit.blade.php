@extends('layouts.templates')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Edit Data Pembayaran</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Edit Data Pembayaran</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<form action="{{ route('pembayaran.update', $bill->id) }}" enctype="multipart/form-data" method="POST" id="createPost">
						@method('PATCH')
						@csrf
						<div class="card-body">
							<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
								<label class="form-label" for="description">Deskripsi*</label>
								<input type="text" class="form-control" name="description" placeholder="Habis bayar apa.." value="{{ $bill->description }}"/>
								@if ($errors->has('description'))
									<span class="help-block text-danger">
										<p>{{ $errors->first('description') }}</p>
									</span>
								@endif
							</div>
							<div class="form-group">
								<label>Jenis Pembayaran*</label>
								<select class="form-control" style="width: 100%;" name="type_id">
									<option value="{{ $bill->type_id }}">{{ $bill->billType->name }}</option>
									@foreach ($billTypes as $type)
										<option value="{{ $type->id }}">{{ $type->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group{{ $errors->has('total_paid') ? ' has-error' : '' }}">
								<label class="form-label" for="total_paid">Jumlah Bayar*</label>
								<input
									name="total_paid"
									class="form-control"
									type="number"
									placeholder="Total pembayarannya berapa.."
									value="{{ $bill->total_paid }}"
								/>
								@if ($errors->has('total_paid'))
									<span class="help-block text-danger">
										<p>{{ $errors->first('total_paid') }}</p>
									</span>
								@endif
							</div>
							<div class="form-group{{ $errors->has('paid_date') ? ' has-error' : '' }}">
								<label class="form-label" for="paid_date">Tanggal Bayar*</label>
								<input name="paid_date" class="form-control" type="date" value="{{ $bill->paid_date }}" />
								@if ($errors->has('paid_date'))
									<span class="help-block text-danger">
										<p>{{ $errors->first('paid_date') }}</p>
									</span>
								@endif
							</div>

							<div class="form-group {{ $errors->has('image') ? ' has-error ':''}}">
								<label class="form-label" for="feature_image">Bukti Bayar</label>
								<div class="col-sm-6">
									<div class="form-group clearfix">
										<div class="custom-control custom-radio d-inline">
											<input type="radio" id="imgLocal" name="r1" class="custom-control-input" value="Local" checked>
											<label for="imgLocal" class="custom-control-label">
												Penyimpanan Lokal
											</label>
										</div>
										<div class="custom-control custom-radio d-inline ml-2">
											<input type="radio" id="imgUrl" name="r1" class="custom-control-input" value="Url">
											<label for="imgUrl" class="custom-control-label">
												Image Link URL
											</label>
										</div>
										
									</div>
								</div>
								<div class="input-group image-form" id="showLocal">
									<div class="custom-file">
										<input class="form-control custom-file-input" type="file" name="image" id="image">
										<label
											class="custom-file-label"
											id="file-label"
											>Choose file</label
										>
									</div>
								</div>
								<div class="input-group image-form" id="showUrl">
									<div class="custom-file">
										<input class="form-control" type="text" name="image_url" id="imageUrl" placeholder="Salin URL gambar disini">
									</div>
								</div>
								<img id="preview_image" class="inputImgPreview w-25 mt-2" src="{{ isset($bill) ? $bill->image : '' }}" />

								@if ($errors->has('image'))
									<span class="help-block text-danger">
										<p>{{ $errors->first('image') }}</p>
									</span>
								@endif
							</div>
						</div>						
						<div class="card-footer">
							<input type="submit" class="btn btn-block btn-primary" value="Save"/>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('page_scripts')
<script>
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

	<script type="text/javascript">
		document.getElementById('image').addEventListener('change', function(e) {
			var fileName = e.target.files[0].name;
			document.getElementById('file-label').textContent = fileName;
		});

		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				var targetPreview = 'preview_'+$(input).attr('id');
				reader.onload = function(e) {
					$('#'+targetPreview).attr('src', e.target.result).show();
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#image").change(function() {
			readURL(this);
		});
	</script>
@endsection

