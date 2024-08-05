@extends('admin.layouts.main')

@section('style')
    <style>
        .circle-dots{
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 1px solid blue;
        }
    </style>
    
@endsection

@section('main-content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
              class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
  </div>

  <!-- Content Row -->
  <div class="row">

      <!-- Count Books -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                              Book Titles</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countBooks }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="bi bi-book-half fs-2 text-gray-400"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Count Categories -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                              Genre (Categories)</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countCategories }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="bi bi-tag-fill fs-2 text-gray-400"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Count Bookings -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Transaction (Bookings)
                          </div>
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $countBookings }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="bi bi-journal-bookmark-fill fs-2 text-gray-400"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Count Users -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                              Users (Member)</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countUsers }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="bi bi-people-fill fs-2 text-gray-400"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Content Row -->

  <div class="row">

      <!-- Area Chart -->
      <div class="col-xl-8 col-lg-7">
          {{-- ... --}}
          <div class="card shadow mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Transaction Graph</h6>
              </div>
              <div class="card-body">
                .
              </div>
          </div>

          <!-- Today's Transaction (Booking) -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Today's Transaction (Booking)</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-table" class="table mb-0 table-striped" role="grid">
                       <thead>
                          <tr>
                             {{-- <th>Nama</th> --}}
                             <th>Kode Peminjaman</th>
                             <th>Judul Buku</th>
                          </tr>
                       </thead>
                       <tbody>
                          @forelse ($todayBookings as $todayBooking)
                          <tr>
                            {{-- <td>
                               <div class="d-flex align-items-center">
                                  <img class="rounded bg-soft-primary img-fluid avatar-40 me-3" src="{{ asset('storage/' .$todayBooking->user->profile .'') }}" alt="profile">
                                  <h6>{{ $todayBooking->user->name }}</h6>
                               </div>
                            </td> --}}
                            <td>
                               {{ $todayBooking->code }}
                            </td>
                            <td>{{ $todayBooking->book->title }}</td>
                         </tr>
                          @empty
                              <tr>
                               <td colspan="3" class="text-center">Tidak ada peminjaman hari ini</td>
                              </tr>
                          @endforelse
                       </tbody>
                    </table>
                 </div>
            </div>
        </div>
      </div>

      <!-- Pie Chart -->
      <div class="col-xl-4 col-lg-5">
          <div class="card shadow mb-4">
              <!-- Card Header - Dropdown -->
              <div
                  class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Latest Books</h6>
              </div>
              <!-- Card Body -->
              <div class="card-body">
                    @forelse ($latestBooks as $latestBook)
                        <div class="mb-2  d-flex profile-media align-items-top">
                           <div class="mt-1 circle-dots"></div>
                           <div class="ms-4">
                              <h6 class="mb-1 ">{{ $latestBook->title }}</h6>
                              <span class="mb-0 text-secondary">{{ $latestBook->created_at->diffForHumans()}}</span>
                           </div>
                        </div>
                    @empty
                        <div class="mb-2  d-flex profile-media align-items-top">
                           <div class="mt-1 circle-dots"></div>
                           <div class="ms-4">
                              <span class="mb-0">Tidak ada data terbaru</span>
                           </div>
                        </div>
                    @endforelse
              </div>
          </div>
      </div>

  </div>


</div>
@endsection