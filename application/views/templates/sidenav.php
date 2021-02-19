<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark elevation-1" id="sidenavAccordion">
            <div class="sb-sidenav-menu bg-dark">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">BERANDA</div>
                    <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-fw fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <?php if (menu_role(['administrator', 'petugas'])) : ?>
                        <div class="sb-sidenav-menu-heading">MENU UTAMA</div>
                    <?php endif; ?>

                    <?php if (menu_role(['administrator'])) : ?>
                        <a class="nav-link collapsed <?= open_dropdown(['kategori', 'satuan', 'barang'], 'active'); ?>" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="false" aria-controls="collapseMaster">
                            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-table"></i></div>
                            Data Master
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse <?= open_dropdown(['kategori', 'satuan', 'barang'], 'show'); ?>" id="collapseMaster" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav ml-0">
                                <a class="nav-link" href="<?= base_url('kategori'); ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-fw fa-tags"></i></div>
                                    Kategori
                                </a>
                                <a class="nav-link" href="<?= base_url('barang'); ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-fw fa-tools"></i></div>
                                    Barang
                                </a>
                            </nav>
                        </div>
                    <?php endif; ?>


                    <?php if (menu_role(['administrator', 'petugas'])) : ?>
                        <a class="nav-link" href="<?= base_url('transaksi'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-shopping-cart"></i></div>
                            Transaksi
                        </a>
                    <?php endif; ?>

                    <?php if (menu_role(['administrator', 'kepala toko'])) : ?>
                        <div class="sb-sidenav-menu-heading">LAPORAN</div>
                        <a class="nav-link" href="<?= base_url('laporan'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-print"></i></div>
                            Laporan
                        </a>
                    <?php endif; ?>


                    <?php if (menu_role(['administrator'])) : ?>
                        <div class="sb-sidenav-menu-heading">KONFIGURASI</div>
                        <a class="nav-link" href="<?= base_url('user'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-users"></i></div>
                            Kelola User
                        </a>
                    <?php endif; ?>

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Login Sebagai:</div>
                <span class="font-weight-bold text-capitalize"><?= userdata()->level ?></span>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <div class="row mt-4 pb-2">
                    <div class="col">
                        <h1 class="h3"><?= $title; ?></h1>
                    </div>
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-light py-1 float-right">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
