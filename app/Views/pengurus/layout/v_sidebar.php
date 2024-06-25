<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-olive elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>/public/template/index3.html" class="brand-link">
        <img src="<?= base_url() ?>/public/assets/images/logo_primkopad.png" alt="Logo Primkopad" class="brand-image img-circle">
        <span class="brand-text font-weight-light"><strong>PRIMKOP DPK I</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('public/assets/profile_pic/' . session()->get('pp_pengurus')) ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= session('nm_pengurus') ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url('pengurus/dashboard') ?>" class="nav-link">
                        <i class="nav-icon fa-solid fa-gauge"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <?php if (session()->get('role') == '1') : ?>
                    <li class="nav-header">DATA INDUK</li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/master/anggota') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-users"></i>
                            <p>
                                Data Anggota
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/master/pengurus') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-user-tie"></i>
                            <p>
                                Data Pengurus
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/master/agen') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-truck-ramp-box"></i>
                            <p>
                                Data Agen/Pemasok
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/master/satuan') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-ruler"></i>
                            <p>
                                Data Satuan Barang
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/master/barang') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-boxes-stacked"></i>
                            <p>
                                Data Barang
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>