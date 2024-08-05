@extends('admin.layouts.main')

@section('main-content')
<div class="container mt-4" style="margin-bottom: 6rem">
  {{-- breadcrumb --}}
  <nav class="my-4" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin" class="text-decoration-none">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="/admin/booking" class="text-decoration-none">Daftar Peminjaman</a></li>
      <li class="breadcrumb-item active" aria-current="page">Peminjaman {{ $booking->code }}</li>
    </ol>
  </nav>

  {{-- card --}}
  <div class="row">

    <!-- Cover Image -->
    <div class="col-md-3">
      <div class="card shadow mb-4">
          <div class="card-body">
            @if($booking->book->cover)
          <img class="card-img-top" src="/storage/{{ $booking->book->cover }}" alt="Card image cap">
          @else
          <img class="card-img-top" src="{{ asset('img/bookCoverDefault.png') }}" alt="Card image cap">
          @endif
          </div>
      </div>
    </div>

      <!-- Information -->
      <div class="col-md-9">
          <div class="card shadow mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 fw-bold">Detail Buku</h6>
              </div>
              <!-- Card Body -->
              <div class="card-body">
                <table>
                  <tr class="d-flex gap-4">
                    <td class="fw-medium">Kode Peminjaman : </td>
                    <td>{{$booking->code}}</td>
                  </tr>
                  <tr class="d-flex gap-4">
                    <td class="fw-medium">Status : </td>
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
                  </tr>
                  <tr class="d-flex gap-4">
                    <td class="fw-medium">Waktu Pinjam : </td>
                    <td>{{$booking->created_at->format('d M Y')}}</td>
                  </tr>
                  <tr class="d-flex gap-4">
                    <td class="fw-medium">Tenggat Kembali : </td>
                    <td>{{ date('d M Y', strtotime($booking->expired_at)) }}</td>
                  </tr>
                  <tr class="d-flex gap-4">
                    <td class="fw-medium">Alasan Pinjam : </td>
                    <td>{{ $booking->alasan }}</td>
                  </tr>
                </table>
              </div>

              {{-- proses --}}
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 fw-bold">Informasi Buku</h6>
              </div>
              <div class="card-body">
                <table>
                  <tr class="d-flex gap-4">
                    <td class="fw-medium">Judul Buku : </td>
                    <td>{{$booking->book->title}}</td>
                  </tr>
                  <tr class="d-flex gap-4">
                    <td class="fw-medium">Penulis : </td>
                    <td>{{$booking->book->author}}</td>
                  </tr>
                  <tr class="d-flex gap-4">
                    <td class="fw-medium">Penerbit : </td>
                    <td>{{$booking->book->publisher}}</td>
                  </tr>
                  <tr class="d-flex gap-4">
                    <td class="fw-medium">Stock Buku : </td>
                    <td>{{$booking->book->stock}}</td>
                  </tr>
                </table>
              </div>

              {{-- proses --}}
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 fw-bold">Proses Peminjaman</h6>
              </div>
              <div class="card-body">
                <form action="/admin/booking/{{ $booking->id }}" method="post">
                  @csrf
                  @method('put')
                  <select class="form-select" name="status">
                    @if($booking->status == 'Diajukan')
                      <option value="Disetujui">Setujui Peminjaman</option>
                      <option value="Ditolak">Tolak Peminjaman</option>
                    @elseif($booking->status == "Disetujui")
                      <option value="Dikembalikan">Peminjaman Dikembalikan</option>
                    @endif
                  </select>

                  <button type="submit" class="btn btn-info mt-2">Proses</button>
                </form>
              </div>
          </div>
      </div>

  </div>
  
</div>
@endsection