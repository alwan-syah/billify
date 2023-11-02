@extends('layouts.templates')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Semua Pembayaran</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Semua Pembayaran</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="content">
	<div class="container-fluid">
		<div class="row">
      <div class="container-fluid text-right" style="margin-bottom: 16px;">
        <a class="btn btn-success" href="{{ route('pembayaran.create') }}">
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
                  <th>Deskripsi</th>
                  <th>Jenis Pembayaran</th>
                  <th>Total Bayar</th>
                  <th>Bukti Bayar</th>
                  <th>Tanggal Bayar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
			</div>
		</div>
    <div class="modal fade" id="deleteModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Hapus Pembayaran</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apa anda yakin ingin menghapus pembayaran ini?</p>
          </div>
          <div class="modal-footer justify-content-center">
            <form action="{{ url('dashboard/pembayaran/') }}" method="POST" id="data-delete-form">
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
        ajax: '{!! route('pembayaran.index') !!}',
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
          {data: 'description', name: 'description'},
          {data: 'bill_type', name: 'bill_type'},
          {data: 'total_paid', name: 'total_paid'},
          {data: 'image', name: 'image'},
          {data: 'paid_date', name: 'paid_date', searchable: true},
          {data: 'actions', name: 'actions', orderable: false, searchable: false}
        ],
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        paging: true,
        pageLength: 5,
        drawCallback: function (settings) {
          // Mengatur ulang nomor urut pada setiap halaman
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
