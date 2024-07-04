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
                        <li class="breadcrumb-item">Jurnal Umum</li>
                        <li class="breadcrumb-item active">Daftar Jurnal Umum</li>
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
                            <table class="table table-bordered table-hover table-head-fixed">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th style="vertical-align: middle; background-color: #3d9970; color: white;" width="50px">Tanggal</th>
                                        <th style="vertical-align: middle; background-color: #3d9970; color: white;" width="50px">No. Bukti</th>
                                        <th style="vertical-align: middle; background-color: #3d9970; color: white;" width="200px">Keterangan</th>
                                        <th style="vertical-align: middle; background-color: #3d9970; color: white;" width="50px">Nama Akun</th>
                                        <th style="vertical-align: middle; background-color: #3d9970; color: white;" width="50px">Akun</th>
                                        <th style="vertical-align: middle; background-color: #3d9970; color: white;" width="50px">Nama Akun Bantu</th>
                                        <th style="vertical-align: middle; background-color: #3d9970; color: white;" width="50px">Akun Bantu</th>
                                        <th style="vertical-align: middle; background-color: #3d9970; color: white;" width="100px">Debit</th>
                                        <th style="vertical-align: middle; background-color: #3d9970; color: white;" width="100px">Kredit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $previousDate = null;
                                    foreach ($jurnal as $key => $value) {
                                        // Check if the current date is different from the previous date
                                        if ($previousDate !== null && $previousDate !== $value['tanggal']) {
                                            // Add an empty row for spacing
                                            echo '<tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            </tr>';
                                        }
                                        // Update the previous date to the current date
                                        $previousDate = $value['tanggal'];
                                    ?>
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;"><?= $value['tanggal'] ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= $value['no_bukti'] ?></td>
                                            <td><?= $value['ket'] ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= $value['akun_nm_akun'] ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= $value['akun_kd_akun'] ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= $value['akun_pembantu_nm_akun'] ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= $value['akun_pembantu_kd_akun'] ?></td>
                                            <td style="text-align: right; vertical-align: middle;"><?= $value['debit'] ?></td>
                                            <td style="text-align: right; vertical-align: middle;"><?= $value['kredit'] ?></td>
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