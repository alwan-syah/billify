@extends('layouts.templates')

@section('page_css')
  <link rel="stylesheet" href="{{ asset('plugin/datatables/table-datatable-jquery.css') }}">
  <link rel="stylesheet" href="{{ asset('plugin/datatables/dataTables.bootstrap5.min.css') }}">
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
        <h3>Semua Pembayaran</h3>
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
              Semua Pembayaran
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <section class="section mt-2">
    <div class="d-flex justify-content-end align-content-end mb-3">
      <a href="{{ route('pembayaran.create') }}" class="btn btn-success">
        &#43; Buat baru
      </a>
    </div>
    @include('includes.alerts')
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table" id="list-table">
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
              {{-- render data here --}}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="deleteModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Pembayaran</h4>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
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
@endsection

@section('page_scripts')
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('plugin/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugin/datatables/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('plugin/datatables/datatables.js') }}"></script>

  <script>
    $(function () {
      "use strict";

      //Delete Button on dataTables
      $(".table").on("click", ".delete-data", function (e) {
        e.preventDefault();
        var actionUrl = $(this).data("delete-url");
        var action = $("#data-delete-form").attr("action", actionUrl);
      });
    });
  </script>

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
