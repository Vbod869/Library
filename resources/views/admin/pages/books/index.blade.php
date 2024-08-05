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
    <h1 class="h3 mb-0 text-gray-800">Daftar Buku</h1>
    <!-- Button trigger modal -->
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalCreate">
      Tambah Buku
    </button>
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
                          <th>Judul</th>
                          <th>Penulis</th>
                          <th>Penerbit</th>
                          <th>Kategori</th>
                          <th>Stock</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $book->code }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>{{ $book->stock }}</td>
                        <td class="d-flex flex-row align-items-start gap-1">
                          <a href="/admin/books/{{ $book->id }}" class="btn btn-info"><i class="bi bi-eye"></i></a>
                          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $book->id }}"><i class="bi bi-pencil-square"></i>
                          </button>
                          <form action="/admin/books/{{ $book->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
                          </form>
                        </td>
                    </tr>

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

<!-- Modal Create -->
<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/admin/books" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Buku</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
            <label for="title" class="form-label">Judul <small>(minimal 3 karakter)</small></label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>
          <div class="mb-3">
            <label for="code" class="form-label">Kode <small>(minimal 5 karakter)</small></label>
            <input type="text" class="form-control" id="code" name="code" required>
          </div>
          <div class="mb-3">
            <label for="cover" class="form-label">Cover Buku buku</label>
            <input class="form-control" type="file" id="cover" name="cover">
          </div>
          <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select class="form-select" id="category" name="category_id" required>
              @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="publisher" class="form-label">Penerbit</label>
            <input type="text" class="form-control" id="publisher" name="publisher" required>
          </div>
          <div class="mb-3">
            <label for="author" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="author" name="author" required>
          </div>
          <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
          </div>
          <div class="mb-3">
            <label for="description">Deskripsi <small>(minimal 10 karakter)</small></label>
            <textarea class="form-control" id="description" name="description" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </div>
    </form>
    </div>
</div>