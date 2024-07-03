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
                        <li class="breadcrumb-item">Kode Akun</li>
                        <li class="breadcrumb-item active">Daftar Kode Akun</li>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover table-head-fixed text-nowrap">
                                <thead style="text-align: center; background-color: #3d9970; color: white;">
                                    <tr>
                                        <th rowspan="2" style="vertical-align: middle; background-color: #3d9970; color: white;" width="50px">Kode Akun</th>
                                        <th rowspan="2" style="vertical-align: middle; background-color: #3d9970; color: white;" width="225px">Nama Akun</th>
                                        <th rowspan="2" style="vertical-align: middle; background-color: #3d9970; color: white;" width="50px">Tabel Bantuan</th>
                                        <th rowspan="2" style="vertical-align: middle; background-color: #3d9970; color: white;" width="100px">Pos Saldo</th>
                                        <th rowspan="2" style="vertical-align: middle; background-color: #3d9970; color: white;" width="100px">Pos Laporan</th>
                                        <th colspan="2" style="background-color: #3d9970; color: white;">Saldo Awal</th>
                                    </tr>
                                    <tr>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    foreach ($akun as $key => $value) { ?>
                                        <tr>
                                            <td rowspan="2" style="vertical-align: middle;"><?= $value['kd_akun'] ?></td>
                                            <td rowspan="2" style="vertical-align: middle;"><?= $value['nm_akun'] ?></td>
                                            <td rowspan="2" style="vertical-align: middle;"><?= $value['tb_bantuan'] ?></td>
                                            <td rowspan="2" style="vertical-align: middle;"><?php if ($value['pos_saldo'] == '0') {
                                                                                                echo '-';
                                                                                            } elseif ($value['pos_saldo'] == '1') {
                                                                                                echo 'Debit';
                                                                                            } elseif ($value['pos_saldo'] == '2') {
                                                                                                echo 'Kredit';
                                                                                            } ?></td>
                                            <td rowspan="2" style="vertical-align: middle;"><?php if ($value['pos_laporan'] == '0') {
                                                                                                echo '-';
                                                                                            } elseif ($value['pos_laporan'] == '1') {
                                                                                                echo 'Neraca';
                                                                                            } elseif ($value['pos_laporan'] == '2') {
                                                                                                echo 'Laba Rugi';
                                                                                            } ?></td>
                                        <tr>
                                            <td><?= $value['debit'] ?></td>
                                            <td><?= $value['kredit'] ?></td>
                                        </tr>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->