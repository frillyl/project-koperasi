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
                        <li class="breadcrumb-item">Data Induk</li>
                        <li class="breadcrumb-item active">Pengurus</li>
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
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>No.</th>
                                        <th>ID Pengurus</th>
                                        <th>Nama Pengurus</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php $no = 1;
                                    foreach ($pengurus as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['id_pengurus'] ?></td>
                                            <td><?= $value['nm_pengurus'] ?></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#info<?= $value['id'] ?>"><i class="fa-solid fa-circle-info"></i></button>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value['id'] ?>"><i class="fa-solid fa-pencil"></i></button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value['id'] ?>"><i class="fa-solid fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot style="text-align: center;">
                                    <tr>
                                        <th>No.</th>
                                        <th>ID Pengurus</th>
                                        <th>Nama Pengurus</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- Modal Info -->
                    <?php foreach ($pengurus as $key => $value) { ?>
                        <div class="modal fade" id="info<?= $value['id'] ?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detail Data Pengurus</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table no-border">
                                            <tbody>
                                                <tr>
                                                    <th></th>
                                                    <td><img src="<?= base_url('public/assets/profile_pic/' . $value['pp_pengurus']) ?>" class="img-fluid pad" width="113px" height="151px"></td>
                                                </tr>
                                                <tr>
                                                    <th>ID Pengurus</th>
                                                    <td><?= $value['id_pengurus'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Pengurus</th>
                                                    <td><?= $value['nm_pengurus'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Posisi</th>
                                                    <td><?php if ($value['role'] == '1') {
                                                            echo 'Administrator';
                                                        } elseif ($value['role'] == '2') {
                                                            echo 'Manajemen';
                                                        } elseif ($value['role'] == '3') {
                                                            echo 'Bendahara';
                                                        } elseif ($value['role'] == '4') {
                                                            echo 'Sekretaris';
                                                        } elseif ($value['role'] == '5') {
                                                            echo 'Kasir';
                                                        } ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- Modal Edit -->
                    <?php foreach ($pengurus as $key => $value) { ?>
                        <div class="modal fade" id="edit<?= $value['id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ubah Data Pengurus</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        echo form_open_multipart('pengurus/master/pengurus/edit/' . $value['id']);
                                        ?>

                                        <div class="form-group">
                                            <label for="id_pengurus">ID Pengurus</label>
                                            <input type="text" name="id_pengurus" value="<?= $value['id_pengurus'] ?>" class="form-control" id="id_pengurus" placeholder="ID Pengurus" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nm_pengurus">Nama Pengurus</label>
                                            <input type="text" name="nm_pengurus" value="<?= $value['nm_pengurus'] ?>" class="form-control" id="nm_pengurus" placeholder="Nama Lengkap" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelectBorderWidth2">Posisi</label>
                                            <select name="role" class="form-control">
                                                <option <?php if ($value['role'] == '') {
                                                            echo 'selected';
                                                        } ?> value="">----- Pilih Posisi -----</option>
                                                <option <?php if ($value['role'] == 2) {
                                                            echo 'selected';
                                                        } ?> value="2">Manajemen</option>
                                                <option <?php if ($value['role'] == 3) {
                                                            echo 'selected';
                                                        } ?> value="3">Bendahara</option>
                                                <option <?php if ($value['role'] == 4) {
                                                            echo 'selected';
                                                        } ?> value="4">Sekretaris</option>
                                                <option <?php if ($value['role'] == 5) {
                                                            echo 'selected';
                                                        } ?> value="5">Kasir</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <img src="<?= base_url('public/assets/profile_pic/' . $value['pp_pengurus']) ?>" id="gambar_load" class="img-fluid pad" width="113px" height="151px">
                                        </div>
                                        <div class="form-group">
                                            <label>Ganti Foto</label>
                                            <input name="foto" id="preview_gambar" class="form-control" type="file">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                    <?php echo form_close() ?>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    <?php } ?>

                    <!-- Modal Delete -->
                    <?php foreach ($pengurus as $key => $value) { ?>
                        <div class="modal fade" id="delete<?= $value['id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Data Pengurus</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda Yakin Ingin Menghapus Data Pengurus <b><?= $value['nm_pengurus'] ?></b> ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                        <a href="<?= base_url('pengurus/master/pengurus/delete/' . $value['id']) ?>" class="btn btn-danger">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
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