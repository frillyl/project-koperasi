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
                <div class="col-12">
                    <table id="example1" class="table table-bordered table-hover table-head-fixed p-0">
                        <thead style="text-align: center; color: white">
                            <th style="vertical-align: middle; background-color: #3d9970;">No.</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Kode Barang</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Nama Barang</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Agen</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Jenis Barang</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Harga Pokok</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Harga Jual</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Stok</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Ditambahkan Pada</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Ditambahkan oleh</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Diubah Pada</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Diubah Oleh</th>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($barang as $key => $value) { ?>
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;"><?= $no++ ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $value['kd_barang'] ?></td>
                                    <td style="vertical-align: middle;"><?= $value['nm_barang'] ?></td>
                                    <td style="vertical-align: middle;"><?= $value['nm_agen'] ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?php if ($value['jenis_barang'] == '1') {
                                                                                                echo 'Milik Koperasi';
                                                                                            } elseif ($value['jenis_barang'] == '2') {
                                                                                                echo 'Konsinyasi';
                                                                                            } ?>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $value['harga_pokok'] ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $value['harga_jual'] ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $value['stok'] ?> <?= $value['satuan'] ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= date('j F Y H:i:s', strtotime($value['barang_created_at'])) ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $value['nm_pengurus'] ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?php if ($value['barang_edited_at'] == '') : ?>
                                            Data barang belum pernah diubah.
                                        <?php else : ?>
                                            <?= date('j F Y H:i:s', strtotime($value['barang_edited_at'])) ?>
                                        <?php endif; ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?php if ($value['barang_edited_by'] == 0) : ?>
                                            Data barang belum pernah diubah.
                                        <?php else : ?>
                                            <?= $value['nm_pengurus'] ?>
                                        <?php endif; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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