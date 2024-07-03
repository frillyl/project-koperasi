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
                        <li class="breadcrumb-item">Kode Akun Pembantu</li>
                        <li class="breadcrumb-item active">Daftar Kode Akun Pembantu</li>
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
                                        <th style="background-color: #3d9970; color: white;" width="50px">Kode Akun</th>
                                        <th style="background-color: #3d9970; color: white;" width="500px">Nama Akun</th>
                                        <th style="background-color: #3d9970; color: white;" width="50px">Tabel Bantuan</th>
                                        <th style="background-color: #3d9970; color: white;" width="100px">Saldo Normal</th>
                                        <th style="background-color: #3d9970; color: white;" width="100px">Saldo Awal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($grouped_data as $id_header => $group) : ?>
                                        <tr>
                                            <td></td>
                                            <td class="font-weight-bold"><?= $group['nm_akun_header'] ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php foreach ($group['data'] as $value) : ?>
                                            <tr>
                                                <td class="text-center"><?= $value['kd_akun'] ?></td>
                                                <td><?= $value['nm_akun_pembantu'] ?></td>
                                                <td class="text-center"><?= $value['tb_bantuan'] ?></td>
                                                <td class="text-center"><?= $value['saldo_normal'] == '1' ? 'Debit' : 'Kredit' ?></td>
                                                <td class="text-right"><?= $value['saldo_awal'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
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