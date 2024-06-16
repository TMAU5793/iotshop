@php
  $cRoute = Route::currentRouteName();  
@endphp

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="javascript:void(0)">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ auth()->user()->username }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    {{-- <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>หน้าหลัก</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        เนื้อหา
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ (str_contains($cRoute,'product') ? 'active' : '') }}">
        <a class="nav-link" href="{{ route('admin.product') }}">
            <i class="{{ (str_contains($cRoute,'product') ? 'fas' : 'far') }} fa-fw fa-circle"></i>
            <span>สินค้า</span>
        </a>
    </li>

    <li class="nav-item {{ (str_contains($cRoute,'order') ? 'active' : '') }}">
        <a class="nav-link" href="{{ route('admin.order') }}">
            <i class="{{ (str_contains($cRoute,'order') ? 'fas' : 'far') }} fa-fw fa-circle"></i>
            <span>รายการสั่งซื้อ</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item btn-logout text-center pr-3 pl-3" title="ออกจากระบบ">
        <a class="btn btn-warning d-block" href="{{ route('admin.logout') }}">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>ออกจากระบบ</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline mt-3">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
