<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="bi bi-book-fill"></i>
      </div>
      <div class="sidebar-brand-text mx-3">StarLearn</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
      <a class="nav-link" href="/admin">
        <i class="bi bi-layout-sidebar-inset"></i>
          <span>Dashboard</span></a>
  </li>

  <!-- Nav Item - Tables -->
  @can('admin')
  <li class="nav-item {{ Request::is('admin/books*') ? 'active' : '' }}">
      <a class="nav-link" href="/admin/books">
        <i class="bi bi-book-half"></i>
          <span>Books</span></a>
  </li>
  @endcan
  
  <!-- Nav Item - Tables -->
  <li class="nav-item {{ Request::is('admin/booking*') ? 'active' : '' }}">
      <a class="nav-link" href="/admin/booking">
        <i class="bi bi-journal-bookmark-fill"></i>
          <span>Peminjaman</span></a>
  </li>

  <!-- Nav Item - Tables -->
  @can('admin')    
  <li class="nav-item {{ Request::is('admin/users') ? 'active' : '' }}">
    <a class="nav-link" href="/admin">
      <i class="bi bi-people-fill"></i>
      <span>Users</span></a>
    </li>
  @endcan
    
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>


</ul>