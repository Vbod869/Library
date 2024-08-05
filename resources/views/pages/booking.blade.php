@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection

@section('main-content')
<div class="container mt-5">

  <table class="table" id="myTable">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Code</th>
        <th scope="col">Judul Buku</th>
        <th scope="col">Status</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($bookings as $booking)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $booking->code }}</td>
        <td>{{ $booking->book->title }}</td>
        <td>
          @if($booking->status == 'Dikembalikan')
            @if ($booking->expired_at < now())
              <p class="badge text-bg-danger mb-0">{{ $booking->status }} terlambat</p>
            @else
              <p class="badge text-bg-secondary mb-0">{{ $booking->status }}</p>
            @endif
          @elseif($booking->expired_at < now())
            <p class="badge text-bg-danger mb-0">Terlambat</p>
          @else
            <p class="badge {{ ($booking->status == 'Diajukan') ? 'text-bg-warning' : '' }} {{ ($booking->status == 'Disetujui') ? 'text-bg-success' : '' }} {{ ($booking->status == 'Ditolak') ? 'text-bg-dark' : '' }} mb-0">{{ $booking->status }}</p>
          @endif  
        </td>
        <td>
          <a href="/booking/{{ $booking->id }}" class="btn btn-info badge"><i class="bi bi-eye"></i></a>  
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('script')

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
      let table = new DataTable('#myTable');
    </script>
@endsection