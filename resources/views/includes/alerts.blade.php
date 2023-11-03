@if(Session::has('success'))
	<div class="alert alert-light-success alert-dismissible color-success show fade">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		<i class="bi bi-check-circle"></i>
		{{ Session::get('success') }}
	</div>
@elseif(Session::has('danger'))
	<div class="alert alert-light-danger alert-dismissible color-danger show fade">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		<i class="bi bi-exclamation-circle"></i>
		{{ Session::get('danger') }}
	</div>
@elseif(Session::has('warning'))
	<div class="alert alert-light-warning alert-dismissible color-warning show fade">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		<i class="bi bi-exclamation-triangle"></i>
		{{ Session::get('warning') }}
	</div>
@elseif(Session::has('info'))
	<div class="alert alert-light-info alert-dismissible color-info show fade">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		<i class="bi bi-info-circle"></i>
		{{ Session::get('info') }}
	</div>
@endif


