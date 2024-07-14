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
                                Data Agen
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-boxes-stacked"></i>
                            <p>
                                Data Barang
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/master/satuan') ?>" class="nav-link">
                                    <i class="nav-icon fa-regular fa-circle"></i>
                                    <p>
                                        Data Satuan Barang
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/master/barang') ?>" class="nav-link">
                                    <i class="nav-icon fa-regular fa-circle"></i>
                                    <p>
                                        Stok Barang
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/laporan/barang') ?>" class="nav-link">
                                    <i class="nav-icon fa-regular fa-circle"></i>
                                    <p>
                                        Laporan Barang
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">TRANSAKSI</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-cash-register"></i>
                            <p>
                                Data Penjualan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/transaksi/penjualan') ?>" class="nav-link" target="_blank">
                                    <i class="nav-icon fa-regular fa-circle"></i>
                                    <p>
                                        Kasir
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/transaksi/penjualan/laporan') ?>" class="nav-link">
                                    <i class="nav-icon fa-regular fa-circle"></i>
                                    <p>
                                        Laporan Penjualan
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">AKUNTANSI</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-list-ol"></i>
                            <p>
                                Kode Akun
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/akuntansi/akun') ?>" class="nav-link">
                                    <i class="nav-icon fa-regular fa-circle"></i>
                                    <p>
                                        Daftar Kode Akun
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/akuntansi/akun/tambah') ?>" class="nav-link">
                                    <i class="nav-icon fa-regular fa-circle"></i>
                                    <p>
                                        Tambah Kode Akun
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/akuntansi/akun/kelola') ?>" class="nav-link">
                                    <i class="nav-icon fa-regular fa-circle"></i>
                                    <p>
                                        Kelola Kode Akun
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-list-ol"></i>
                            <p>
                                Kode Akun Pembantu
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/akuntansi/akun_header') ?>" class="nav-link">
                                    <i class="nav-icon fa-regular fa-circle"></i>
                                    <p>
                                        Kelola Akun Header
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/akuntansi/akun_pembantu') ?>" class="nav-link">
                                    <i class="nav-icon fa-regular fa-circle"></i>
                                    <p>
                                        Daftar Kode Akun Pembantu
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/akuntansi/akun/tambah') ?>" class="nav-link">
                                    <i class="nav-icon fa-regular fa-circle"></i>
                                    <p>
                                        Tambah Kode Akun Pembantu
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/akuntansi/akun/kelola') ?>" class="nav-link">
                                    <i class="nav-icon fa-regular fa-circle"></i>
                                    <p>
                                        Kelola Kode Akun Pembantu
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-book"></i>
                            <p>
                                Jurnal Umum
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/akuntansi/jurnal_umum') ?>" class="nav-link">
                                    <i class="nav-icon fa-regular fa-circle"></i>
                                    <p>
                                        Daftar Jurnal Umum
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/akuntansi/akun/tambah') ?>" class="nav-link">
                                    <i class="nav-icon fa-regular fa-circle"></i>
                                    <p>
                                        Tambah Jurnal Umum
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/akuntansi/akun/kelola') ?>" class="nav-link">
                                    <i class="nav-icon fa-regular fa-circle"></i>
                                    <p>
                                        Kelola Jurnal Umum
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/akuntansi/buku_besar') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-swatchbook"></i>
                            <p>
                                Buku Besar
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/akuntansi/buku_pembantu') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-swatchbook"></i>
                            <p>
                                Buku Pembantu
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/akuntansi/neraca_lajur') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-scale-balanced"></i>
                            <p>
                                Neraca Lajur
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/akuntansi/laba_rugi') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-money-bill-trend-up"></i>
                            <p>
                                Laba Rugi
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/akuntansi/neraca') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-scale-balanced"></i>
                            <p>
                                Neraca
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/akuntansi/perubahan_modal') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-money-check-dollar"></i>
                            <p>
                                Perubahan Modal
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">SIMPAN PINJAM</li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/usipa/simpanan') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-wallet"></i>
                            <p>
                                Simpanan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/usipa/pinjaman') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-hand-holding-dollar"></i>
                            <p>
                                Pinjaman
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/usipa/angsuran') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-address-book"></i>
                            <p>
                                Angsuran
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (session()->get('role') == '2') : ?>
                    <li class="nav-header">LAPORAN</li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/laporan/posisikeuangan') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-file-invoice-dollar"></i>
                            <p>
                                Posisi Keuangan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/laporan/labarugi') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-file-invoice-dollar"></i>
                            <p>
                                Laba Rugi
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (session()->get('role') == '3') : ?>
                    <li class="nav-header">DATA INDUK</li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/master/hutang') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-credit-card"></i>
                            <p>
                                Data Hutang
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/master/piutang') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-credit-card"></i>
                            <p>
                                Data Piutang
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/master/aset') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-shop"></i>
                            <p>
                                Data Aset
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">AKUNTANSI</li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/keuangan/akun') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-rectangle-list"></i>
                            <p>
                                Data Akun
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/keuangan/jurnalumum') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-swatchbook"></i>
                            <p>
                                Jurnal Umum
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/keuangan/bukubesar') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-book"></i>
                            <p>
                                Buku Besar
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-scale-balanced"></i>
                            <p>
                                Neraca
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/keuangan/neraca/saldoawal') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Saldo Awal</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('pengurus/keuangan/neraca/saldoakhir') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Saldo Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">LAPORAN</li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/laporan/posisikeuangan') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-file-invoice-dollar"></i>
                            <p>
                                Posisi Keuangan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/laporan/labarugi') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-file-invoice-dollar"></i>
                            <p>
                                Laba Rugi
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (session()->get('role') == '4') : ?>
                    <li class="nav-header">DATA INDUK</li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/master/anggota') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-users"></i>
                            <p>
                                Data Anggota
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">SIMPAN PINJAM</li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/simpanpinjam/simpanan') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-wallet"></i>
                            <p>
                                Simpanan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/simpanpinjam/pinjaman') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-hand-holding-dollar"></i>
                            <p>
                                Pinjaman
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/simpanpinjam/angsuran') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-money-check-dollar"></i>
                            <p>
                                Angsuran
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (session()->get('role') == '5') : ?>
                    <li class="nav-header">DATA INDUK</li>
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
                    <li class="nav-header">TRANSAKSI</li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/transaksi/penjualan') ?>" class="nav-link" target="_blank">
                            <i class="nav-icon fa-solid fa-cash-register"></i>
                            <p>
                                Penjualan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/transaksi/pembelian') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-basket-shopping"></i>
                            <p>
                                Pembelian
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">RETUR</li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/retur/penjualan') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-boxes-stacked"></i>
                            <p>
                                Penjualan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengurus/retur/pembelian') ?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-boxes-packing"></i>
                            <p>
                                Pembelian
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