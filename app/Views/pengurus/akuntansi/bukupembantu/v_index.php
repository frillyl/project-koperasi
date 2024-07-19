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
                        <li class="breadcrumb-item active">Buku Pembantu</li>
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
                <div class="col-lg-5">
                    <select class="form-control select2" name="akun2" style="width: 100%;">
                        <option selected="selected">-- Pilih Akun Pembantu --</option>
                        <?php foreach ($akun_pembantu as $row) : ?>
                            <option value="<?= $row['id_akun_pembantu']; ?>"><?= $row['nm_akun']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-5">
                    <select class="form-control select2" name="bulan2" style="width: 100%;">
                        <option selected="selected">-- Pilih Bulan --</option>
                        <option value="semua">Semua</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <button type="button" name="cari2" class="btn btn-block bg-gradient-primary"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover table-head-fixed">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th style="vertical-align: middle; background-color: #3d9970; color: white;" width="50px">Tanggal</th>
                                        <th style="vertical-align: middle; background-color: #3d9970; color: white;" width="50px">No. Bukti</th>
                                        <th style="vertical-align: middle; background-color: #3d9970; color: white;" width="200px">Keterangan</th>
                                        <th style="vertical-align: middle; background-color: #3d9970; color: white;" width="100px">Debit</th>
                                        <th style="vertical-align: middle; background-color: #3d9970; color: white;" width="100px">Kredit</th>
                                        <th style="vertical-align: middle; background-color: #3d9970; color: white;" width="100px">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->