@extends('admin.layouts.main')

@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <style>
      @media print{
        .table thead tr th:last-child{
          display: none !important;
        }
        .table tbody tr td:last-child{
          display: none !important;
        }
      }
    </style>
@endsection

@section('main-content')
<div class="container-fluid">

  <!-- Page Heading -->
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Peminjaman</h1>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>No.</th>
                          <th>Kode</th>
                          <th>Judul Buku</th>
                          <th>Peminjam</th>
                          <th>Tgl Pinjam</th>
                          <th>Tgl Kembali</th>
                          {{-- <th>Stock Buku</th> --}}
                          <th>Status</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->code }}</td>
                        <td>{{ $booking->book->title }}</td>
                        <td>{{ $booking->user->username }}</td>
                        <td>{{ $booking->created_at->format('d-m-Y') }}</td>
                        <td>{{ date('d-m-Y', strtotime($booking->expired_at)) }}</td>
                        {{-- <td>{{ $booking->book->stock }}</td> --}}
                        <td>
                          @if($booking->status == 'Dikembalikan')
                            @if ($booking->expired_at < now())
                              <p class="badge text-bg-danger">{{ $booking->status }} terlambat</p>
                            @else
                              <p class="badge text-bg-secondary">{{ $booking->status }}</p>
                            @endif
                          @elseif($booking->expired_at < now())
                            <p class="badge text-bg-danger">Terlambat</p>
                          @else
                          <p class="badge {{ ($booking->status == 'Diajukan') ? 'text-bg-warning' : '' }} {{ ($booking->status == 'Disetujui') ? 'text-bg-success' : '' }} {{ ($booking->status == 'Ditolak') ? 'text-bg-dark' : '' }} mb-0">{{ $booking->status }}</p>
                          @endif
                        </td>
                        <td class="d-flex flex-row align-items-start gap-1">
                          <a href="/admin/booking/{{ $booking->id }}" class="btn btn-info">Proses Peminjaman</a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>

</div>
@endsection

@section('script')
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script> --}}
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
      // let table = new DataTable('#myTable');

      $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            // 'pdf',
            // 'excel',
            'print'
        ]
      } );
    </script>
@endsection