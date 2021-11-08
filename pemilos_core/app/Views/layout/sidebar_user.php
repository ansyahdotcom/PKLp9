<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Siswa <b>PEMILOS</b></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php $uri = service('uri');
                        if ($uri->getSegment(1) == 'landingpage' && $uri->getSegment(2) == '') {
                            echo 'active';
                        } ?>">
        <a class="nav-link" href="<?= base_url(); ?>/landingpage">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Landing page</span></a>
    </li>

    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php $uri = service('uri');
                        if ($uri->getSegment(1) == 'landingpage' && $uri->getSegment(2) == 'vote') {
                            echo 'active';
                        } ?>">
        <a class="nav-link" href="<?= base_url(); ?>/landingpage/vote">
            <i class="fas fa-fw fa-pencil-alt"></i>
            <span>Voting Ketua OSIS</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php if ($user == null) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url(); ?>/login">
                <i class="fas fa-fw fa-sign-in-alt"></i>
                <span>Login</span>
            </a>
        </li>
    <?php else : ?>
        <li class="nav-item">
            <a class="nav-link" href="logout" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->