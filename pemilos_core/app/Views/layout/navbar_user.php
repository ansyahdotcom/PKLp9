<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url(); ?>/assets/img/logo.png" alt="" width="40px">
        </div>
        <h3 class="font-weight-bold mx-3 my-3" style="color: #6579b4;">SMAN 8 Surakarta</h3>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 my-3 d-none d-lg-inline text-gray-600 small"></span>
                <img class="img-profile rounded-circle" src="<?= base_url(); ?>/assets/img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url(); ?>/profile">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <?php if ($user == null) : ?>
                    <a class="dropdown-item" href="<?= base_url(); ?>/login">
                        <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Login
                    </a>
                <?php else : ?>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a <?php endif; ?> </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->