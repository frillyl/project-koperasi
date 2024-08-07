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
                        <li class="breadcrumb-item">Akuntansi</li>
                        <li class="breadcrumb-item active">Perubahan Modal</li>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center"><strong>PRIMER KOPERASI DARMA PUTRA KUJANG I</strong></h4>
                            <h4 class="text-center"><strong>LAPORAN PERUBAHAN MODAL</strong></h4>
                            <h5 class="text-center">Tahun <?= date('Y') ?></h5>

                            <div class="row mt-5">
                                <div class="col-12">
                                    <table class="table table-bordered table-hover table-head-fixed text-nowrap">
                                        <thead style="text-align: center; background-color: #3d9970; color: white;">
                                            <tr>
                                                <th rowspan="2" style="vertical-align: middle; background-color: #3d9970; color: white;" width="250px">Uraian</th>
                                                <th rowspan="2" style="vertical-align: middle; background-color: #3d9970; color: white;" width="100px">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Modal Awal</td>
                                                <td style="text-align: right;"><?= number_format($totals['modalAwal'], 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Laba Bersih</td>
                                                <td style=" text-align: right;"><?= number_format($totals['labaBersih'], 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="text-align: right; font-weight: bold;"><?= number_format($totals['total'], 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Deviden</td>
                                                <td style=" text-align: right;"><?= number_format($totals['devidenPrive'], 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Modal Akhir</td>
                                                <td style="text-align: right; font-weight: bold;"><?= number_format($totals['modalAkhir'], 2) ?></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->