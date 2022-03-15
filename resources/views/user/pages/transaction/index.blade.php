@extends('user.layouts.app')
@section('content')
<div class="container">
    @if (session('success'))
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('success') }}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            </div>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h6>Riwayat Transaksi</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th  style="width:20px">No</th>
                                    <th>Tanggal</th>
                                    <th>UUID</th>
                                    <th>Nama Produk</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>NIK</th>
                                    <th>Durasi</th>
                                    <th>Pembayaran</th>
                                    <th>Total</th>
                                    <th>Bukti</th>
                                    <th>Breakfast</th>
                                    <th>Verifikasi</th>
                                    <th>Konfirmasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->created_at->translatedFormat('d/m/Y') }}</td>
                                    <td>{{ $item->uuid }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->duration }}</td>
                                    <td>{{ $item->payment->name }}</td>
                                    <td>Rp {{ number_format($item->transaction_total) }}</td>
                                    <td>{{ $item->proof ?? 'Tidak Ada' }}</td>
                                    <td>
                                        @if ($item->is_breakfast == 0)
                                        <span class="badge badge-danger">Tidak</span>
                                        @else
                                        <span class="badge badge-success">ya</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->is_verified == 0)
                                        <span class="badge badge-warning">Tidak Terverifikasi</span>
                                        @else
                                        <span class="badge badge-success">Terverifikasi</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->is_confirmed == 0)
                                        <span class="badge badge-danger">Tidak</span>
                                        @else
                                        <span class="badge badge-success">ya</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
@include('admin.layouts.partials.toast')
<script>
    $(function () {
      $('#table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        columnDefs: [
            { orderable: false, targets: 0 },
            { orderable: false, targets: 11 },
        ],
      });
    });
</script>
@endpush