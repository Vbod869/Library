@extends('layouts.main')

@section('main-content')
<div class="container mt-4" style="margin-bottom: 6rem">
  {{-- breadcrumb --}}
  <nav class="my-4" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Beranda</a></li>
      <li class="breadcrumb-item"><a href="/books" class="text-decoration-none">Koleksi Buku</a></li>
      <li class="breadcrumb-item active" aria-current="page">Title</li>
    </ol>
  </nav>

  {{-- card --}}
  <div class="row">

    <!-- Cover Image -->
    <div class="col-md-3">
      <div class="card shadow mb-4">
          <div class="card-body">
            @if($book->cover)
          <!-- <img class="card-img-top" src="/storage/{{ $book->cover }}" alt="Card image cap"> -->
          <img class="card-img-top" src="{{ asset('storage/' . $book->cover) }}" alt="Card image cap">
          @else
          <img class="card-img-top" src="{{ asset('img/sijuki.jpeg') }}" alt="Card image cap">
          @endif
          </div>
      </div>
    </div>

      <!-- Information -->
      <div class="col-md-8">
          <div class="card shadow mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 fw-bold">Detail Buku</h6>
              </div>
              <!-- Card Body -->
              <div class="card-body">
                <table>
                  <tr class="d-flex gap-4">
                    <td class="fw-medium">Judul : </td>
                    <td>{{$book->title}}</td>
                  </tr>
                  <tr class="d-flex gap-4">
                    <td class="fw-medium">Penulis : </td>
                    <td>{{$book->author}}</td>
                  </tr>
                  <tr class="d-flex gap-4">
                    <td class="fw-medium">Penerbit : </td>
                    <td>{{$book->publisher}}</td>
                  </tr>
                  <tr class="d-flex gap-4">
                    <td class="fw-medium">Kategori : </td>
                    <td>{{$book->category->name}}</td>
                  </tr>
                  <tr class="d-flex gap-4">
                    <td class="fw-medium">Deskripsi : </td>
                    <td>{{$book->description}}</td>
                  </tr>
                  <tr class="d-flex gap-4">
                    <td class="fw-medium">Stock : </td>
                    <td>{{$book->stock}}</td>
                  </tr>
                </table>
              </div>

              {{-- proses --}}
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 fw-bold">Peminjaman</h6>
              </div>
              <div class="card-body">
                @auth
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Pinjam Buku
                </button>
                @else
                <a href="/login" class="btn btn-warning" >Pinjam Buku</a>
                @endauth
              </div>
          </div>
      </div>

  </div>
  
</div>
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="/booking" method="post">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Pinjam Buku {{ $book->title }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="alasan" class="form-label">Alasan Pinjam</label>
            <textarea class="form-control" id="alasan" rows="3" name="alasan"></textarea>
          </div>
          <div class="mb-3">
            <label for="tgl_kembali" class="form-label">Tanggal Pengembalian</label>
            <input type="date" class="form-control" id="tgl_kembali" name="expired_at">
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            {{-- <input type="text" name="user_id" value="{{ auth()->user->id }}" hidden> --}}
            <input type="text" name="book_id" value="{{ $book->id }}" hidden>
            <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
            <input type="text" name="status" value="{{ 'Diajukan' }}" hidden>
            <input type="text" name="is_denda" value="{{ 0 }}" hidden>
            <button type="submit" class="btn btn-warning">Setuju Pinjam</button>
        </div>
      </form>
    </div>
  </div>
</div>