<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark shadow-sm">
    <button class="btn btn-link btn-sm" id="sidebarToggle" href="#">
        <i class="fas fa-bars fa-fw font-weight-bold text-white"></i>
    </button>
    <a class="navbar-brand order-lg-first text-sm-center font-weight-bold" href="<?= base_url(); ?>">Material Shop</a>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto mr-0 mr-md-3">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="<?= base_url('assets/img/') . userdata()->foto; ?>" class="rounded-circle" style="height: 30px;width:30px;margin-right:10px;">
                <?= userdata()->nama ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url(); ?>dashboard/profile">Profile</a>
                <a class="dropdown-item" href="<?= base_url(); ?>dashboard/edit_password">Ganti Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#logoutModal" data-toggle="modal">Logout</a>
            </div>
        </li>
    </ul>
</nav>