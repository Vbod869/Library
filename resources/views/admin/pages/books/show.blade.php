@extends('admin.layouts.main')

@section('main-content')
<div class="container mt-4" style="margin-bottom: 6rem">
  {{-- breadcrumb --}}
  <nav class="my-4" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin" class="text-decoration-none">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="/admin/books" class="text-decoration-none">Koleksi Buku</a></li>
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
          <img class="card-img-top" src="{{ asset('storage/'.$book->cover) }}" alt="{{$book->cover}}">
          @else
          <img class="card-img-top" src="{{ asset('img/sijuki.jpeg') }}" alt="Card image cap">
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
                <h6 class="m-0 fw-bold">Aksi</h6>
              </div>
              <div class="card-body d-flex align-items-start gap-2">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $book->id }}"><i class="bi bi-pencil-square"></i> Edit</button>
                <form action="/admin/books/{{ $book->id }}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger"><i class="bi bi-x-circle"></i> Delete</button>
                </form>
              </td>
              </div>
          </div>
      </div>

  </div>
  
</div>
@endsection

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit{{ $book->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/admin/books/{{ $book->id }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Buku</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
            <label for="title" class="form-label">Judul <small>(minimal 3 karakter)</small></label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}">
          </div>
          <div class="mb-3">
            <label for="code" class="form-label">Kode <small>(minimal 5 karakter)</small></label>
            <input type="text" class="form-control" id="code" name="code" value="{{ $book->code }}">
          </div>
          <div class="mb-3">
            <label for="cover" class="form-label">Cover Buku</label>
            <input class="form-control" type="file" id="cover" name="cover">
          </div>
          <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select class="form-select" id="category" name="category_id">
              @foreach ($categories as $category)
              @if ($category->name === $book->category->name)
              <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
              @else
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="publisher" class="form-label">Penerbit</label>
            <input type="text" class="form-control" id="publisher" name="publisher" value="{{ $book->publisher }}">
          </div>
          <div class="mb-3">
            <label for="author" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}">
          </div>
          <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ $book->stock }}">
          </div>
          <div class="mb-3">
            <label for="description">Deskripsi <small>(minimal 10 karakter)</small></label>
            <textarea class="form-control" id="description" name="description">{{ $book->description }}</textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>
      </div>
    </form>
    </div>
</div>