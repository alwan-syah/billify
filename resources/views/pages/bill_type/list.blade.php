@extends('layouts.templates')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Semua Jenis Pembayaran</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Semua Jenis Pembayaran</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="content">
	<div class="container-fluid">
		<div class="row">
      <div class="container-fluid text-right" style="margin-bottom: 16px;">
        <a class="btn btn-primary" href="#createModal" data-toggle="modal">
          + Buat Baru
        </a>
      </div>
			<div class="col-md-12">
        @include('includes.alerts')
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered table-striped" id="list-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Total Item</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                {{-- data --}}
              </tbody>
            </table>
          </div>
        </div>
			</div>
		</div>
    {{-- Create Modal --}}
    <div class="modal fade" id="createModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Buat Jenis Pembayaran</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('jenis-pembayaran.store') }}" method="POST">
            @csrf
            <div class="modal-body">
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="form-label" for="name">Jenis Pembayaran*</label>
                <input type="text" class="form-control" name="name" placeholder="Contoh: Listrik, BPJS, dll" />
                @if ($errors->has('name'))
                  <span class="help-block text-danger">
                    <p>{{ $errors->first('name') }}</p>
                  </span>
                @endif
              </div>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Hapus Jenis Pembayaran</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apa anda yakin ingin menghapus jenis pembayaran ini?</p>
          </div>
          <div class="modal-footer justify-content-center">
            <form action="{{ url('dashboard/jenis-pembayaran/') }}" method="POST" id="data-delete-form">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
          </div>
        </div>
      </div>
    </div>
	</div>
</section>
@endsection

@section('page_scripts')
  <script type="text/javascript">
    $(function () {
      var table = $('#list-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('jenis-pembayaran.index') !!}',
        columns: [
          {
            data: null,
            searchable: false,
            orderable: false,
            render: function (data, type, row, meta) {
              var start = meta.settings._iDisplayStart;
              var length = meta.settings._iDisplayLength;
              return start + meta.row + 1;
            }
          },
          {data: 'name', name: 'name'},
          {data: 'total_item', name: 'total_item'},
          {data: 'actions', name: 'actions', orderable: false, searchable: false}
        ],
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        paging: true,
        pageLength: 5,
        drawCallback: function (settings) {
          var api = this.api();
          var startIndex = api.context[0]._iDisplayStart;
          api.column(0, {order: 'applied', search: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = startIndex + i + 1;
          });
        }
      });
    });
  </script>
@endsection
