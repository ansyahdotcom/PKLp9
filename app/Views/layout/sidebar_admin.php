<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-tie"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin <b>PEMILOS</b></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php $uri = service('uri'); if($uri->getSegment(1) == 'admin') { echo 'active'; } ?>">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <!-- List Master Menu -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-users"></i>
            <span>Manajemen User</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-building"></i>
            <span>Manajemen Kelas</span>
        </a>
    </li>
    <li class="nav-item <?php $uri = service('uri'); if($uri->getSegment(1) == 'kandidat') { echo 'active'; } ?>">
        <a class="nav-link" href="/kandidat">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Manajemen Kandidat</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->