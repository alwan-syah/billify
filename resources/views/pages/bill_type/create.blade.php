@extends('layouts.templates')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Buat Pembayaran</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Buat Pembayaran</li>
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
					<form action="{{ route('pembayaran.store') }}" enctype="multipart/form-data" method="POST" id="createPost">
						@csrf
						<div class="card-body">
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label class="form-label" for="name">Deskripsi*</label>
								<input type="text" class="form-control" name="name" placeholder="Habis bayar apa.." />
								@if ($errors->has('name'))
									<span class="help-block text-danger">
										<p>{{ $errors->first('name') }}</p>
									</span>
								@endif
							</div>
							<div class="form-group">
								<label>Jenis Pembayaran*</label>
								<select class="form-control" style="width: 100%;" name="type_id">
									{{-- @foreach ($categories as $category)
										<option value="{{ $category->id }}">{{ $category->name }}</option>
										@endforeach --}}
									<option value="1">Motor</option>
									<option value="1">BPJS</option>
									<option value="1">Listrik</option>
								</select>
							</div>
							<div class="form-group {{ $errors->has('image') ? ' has-error ':''}}">
								<label class="form-label" for="feature_image">Image</label>
								<div class="input-group">
									<div class="custom-file">
										<input class="form-control custom-file-input" type="file" name="image" id="image">
										<label
											class="custom-file-label"
											id="file-label"
											>Choose file</label
										>
									</div>
								</div>
								<img id="preview_image" class="inputImgPreview w-25 mt-2" src="{{ isset($bill) ? $bill->image : '' }}" />

								@if ($errors->has('image'))
									<span class="help-block text-danger">
										<p>{{ $errors->first('image') }}</p>
									</span>
								@endif
							</div>

							<div class="form-group{{ $errors->has('paid_date') ? ' has-error' : '' }}">
								<label class="form-label" for="paid_date">Tanggal Bayar*</label>
								<input name="paid_date" class="form-control" type="date" />
								@if ($errors->has('paid_date'))
									<span class="help-block text-danger">
										<p>{{ $errors->first('paid_date') }}</p>
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

