<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $sub ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Laporan</li>
                        <li class="breadcrumb-item active">Barang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <?php
            $errors = session()->getFlashdata('errors');
            if (!empty($errors)) { ?>
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach ($errors as $key => $value) { ?>
                            <li><?= esc($value) ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-warning" role="alert">';
                echo session()->getFlashdata('pesan');
                echo '</div>';
            }

            if (session()->getFlashdata('success')) {
                echo '<div class="alert alert-success" role="alert">';
                echo session()->getFlashdata('success');
                echo '</div>';
            }
            ?>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10">

                </div>
                <div class="col-2 mb-3 d-flex justify-content-end">
                    <a href="<?= base_url('pengurus/laporan/cetak_pdf') ?>" class="btn btn-outline-success mr-2"><i class="fa-solid fa-file-pdf"></i> PDF</a>
                    <a href="<?= base_url('pengurus/laporan/cetak_penjualan') ?>" class="btn btn-outline-primary"><i class="fa-solid fa-print"></i> Cetak</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table id="example1" class="table table-bordered table-hover table-head-fixed p-0">
                        <thead style="text-align: center; color: white">
                            <th style="vertical-align: middle; background-color: #3d9970;">Kode Penjualan</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Kasir</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Pembeli</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Tanggal Penjualan</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Grand Total</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Dibayar</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Kembalian</th>
                        </thead>
                        <tbody>
                            <?php foreach ($penjualan as $row) : ?>
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <a href="#" data-toggle="modal" data-target="#detailModal" onclick="showDetail('<?= $row['kd_penjualan'] ?>')"><?= $row['kd_penjualan'] ?></a>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $row['id_pengurus'] ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $row['id_anggota'] ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $row['tgl_penjualan'] ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $row['grand_total'] ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $row['dibayar'] ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $row['kembalian'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel">Detail Penjualan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Harga Jual</th>
                                                <th>Qty</th>
                                                <th>Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody id="detailTableBody">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->