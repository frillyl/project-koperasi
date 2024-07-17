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
                        <li class="breadcrumb-item active">Anggota</li>
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
                        <div class="card-header">
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add">
                                    <i class="fa-solid fa-plus"></i> Tambah Data
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>No.</th>
                                        <th>NRP</th>
                                        <th>Nama Anggota</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php $no = 1;
                                    foreach ($anggota as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['nrp'] ?></td>
                                            <td><?= $value['nm_anggota'] ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#assign<?= $value['id_anggota'] ?>"><i class="fa-solid fa-user-plus"></i></button>
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#info<?= $value['id_anggota'] ?>"><i class="fa-solid fa-circle-info"></i></button>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value['id_anggota'] ?>"><i class="fa-solid fa-pencil"></i></button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value['id_anggota'] ?>"><i class="fa-solid fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot style="text-align: center;">
                                    <tr>
                                        <th>No.</th>
                                        <th>NRP</th>
                                        <th>Nama Anggota</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- Modal Assign -->
                    <?php foreach ($anggota as $key => $value) { ?>
                        <div class="modal fade" id="assign<?= $value['id_anggota'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Data Pengurus</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        echo form_open('pengurus/master/pengurus/add');
                                        ?>

                                        <div class="form-group">
                                            <label for="id_pengurus">ID Pengurus</label>
                                            <input type="text" name="id_pengurus" value="<?= $value['nrp'] ?>" class="form-control" id="id_pengurus" placeholder="ID Pengurus" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nm_pengurus">Nama Anggota</label>
                                            <input type="text" name="nm_pengurus" value="<?= $value['nm_anggota'] ?>" class="form-control" id="nm_pengurus" placeholder="Nama Lengkap" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelectBorderWidth2">Posisi</label>
                                            <select name="role" class="form-control" id="role" style="width: 100%;">
                                                <option value="">-- Pilih Posisi --</option>
                                                <option value="2">Manajemen</option>
                                                <option value="3">Bendahara</option>
                                                <option value="4">Sekretaris</option>
                                                <option value="5">Kasir</option>
                                            </select>
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

                    <!-- Modal Info -->
                    <?php foreach ($anggota as $key => $value) { ?>
                        <div class="modal fade" id="info<?= $value['id_anggota'] ?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detail Data Anggota</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table no-border">
                                            <tbody>
                                                <tr>
                                                    <th></th>
                                                    <td><img src="<?= base_url('public/assets/profile_pic/' . $value['pp_anggota']) ?>" class="img-fluid pad" width="113px" height="151px"></td>
                                                </tr>
                                                <tr>
                                                    <th>NRP</th>
                                                    <td><?= $value['nrp'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Pangkat</th>
                                                    <td><?= $value['pangkat'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Anggota</th>
                                                    <td><?= $value['nm_anggota'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td><?= $value['email'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Nomor HP</th>
                                                    <td><?= $value['no_hp'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td><?php if ($value['status'] == '1') {
                                                            echo 'Anggota [Aktif]';
                                                        } elseif ($value['status'] == '2') {
                                                            echo 'Anggota [Tidak Aktif]';
                                                        } ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Ditambahkan Pada</th>
                                                    <td><?= date('j F Y H:i:s', strtotime($value['created_at'])) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Ditambahkan Oleh</th>
                                                    <td><?= $value['nm_pengurus'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Diubah Pada</th>
                                                    <td><?php if ($value['edited_at'] == '') : ?>
                                                            Data anggota belum pernah diubah.
                                                        <?php else : ?>
                                                            <?= date('j F Y H:i:s', strtotime($value['edited_at'])) ?>
                                                        <?php endif; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Diubah Oleh</th>
                                                    <td><?php if ($value['edited_by'] == 0) : ?>
                                                            Data anggota belum pernah diubah.
                                                        <?php else : ?>
                                                            <?= $value['nm_pengurus'] ?>
                                                        <?php endif; ?></td>
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

                    <!-- Modal Add -->
                    <div class="modal fade" id="add">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Anggota</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    echo form_open('pengurus/master/anggota/add');
                                    ?>

                                    <div class="form-group">
                                        <label for="nrp">NRP</label>
                                        <input type="text" name="nrp" class="form-control" id="nrp" placeholder="NRP">
                                    </div>
                                    <div class="form-group">
                                        <label for="id_pangkat">Pangkat</label>
                                        <select name="id_pangkat" class="form-control select2 select2-hidden-accessible" id="id_pangkat" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="">-- Pilih Pangkat --</option>
                                            <?php foreach ($pangkat as $key => $value) { ?>
                                                <option value="<?= $value['id_pangkat'] ?>"><?= $value['pangkat'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nm_anggota">Nama Anggota</label>
                                        <input type="text" name="nm_anggota" class="form-control" id="nm_anggota" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp">Nomor HP</label>
                                        <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Nomor HP">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="created_by" class="form-control" id="created_by" placeholder="Ditambahkan Oleh" value="<?= session('id') ?>" hidden>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Tambah</button>
                                </div>
                                <?php echo form_close() ?>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <?php foreach ($anggota as $key => $value) { ?>
                        <div class="modal fade" id="edit<?= $value['id_anggota'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ubah Data Anggota</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        echo form_open_multipart('pengurus/master/anggota/edit/' . $value['id_anggota']);
                                        ?>

                                        <div class="form-group">
                                            <label for="nrp">NRP</label>
                                            <input type="text" name="nrp" value="<?= $value['nrp'] ?>" class="form-control" id="nrp" placeholder="NRP" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_pangkat">Pangkat</label>
                                            <select name="id_pangkat" class="form-control select2 select2-hidden-accessible" id="id_pangkat" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option <?php if ($value['id_pangkat'] == '') {
                                                            echo 'selected';
                                                        } ?> value="">----- Pilih Pangkat -----</option>
                                                <?php foreach ($pangkat as $key => $value2) { ?>
                                                    <option <?php if ($value['id_pangkat'] == $value2['id_pangkat']) {
                                                                echo 'selected';
                                                            } ?> value="<?= $value2['id_pangkat'] ?>"><?= $value2['pangkat'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nm_anggota">Nama Anggota</label>
                                            <input type="text" name="nm_anggota" value="<?= $value['nm_anggota'] ?>" class="form-control" id="nm_anggota" placeholder="Nama Lengkap">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" value="<?= $value['email'] ?>" class="form-control" id="email" placeholder="Email" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp">Nomor HP</label>
                                            <input type="text" name="no_hp" value="<?= $value['no_hp'] ?>" class="form-control" id="no_hp" placeholder="Nomor HP" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelectBorderWidth2">Status Keanggotaan</label>
                                            <select name="status" class="form-control">
                                                <option <?php if ($value['status'] == '') {
                                                            echo 'selected';
                                                        } ?> value="">----- Pilih Status Keanggotaan -----</option>
                                                <option <?php if ($value['status'] == 1) {
                                                            echo 'selected';
                                                        } ?> value="1">Anggota [Aktif]</option>
                                                <option <?php if ($value['status'] == 2) {
                                                            echo 'selected';
                                                        } ?> value="2">Anggota [Tidak Aktif]</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <img src="<?= base_url('public/assets/profile_pic/' . $value['pp_anggota']) ?>" id="gambar_load" class="img-fluid pad" width="113px" height="151px">
                                        </div>
                                        <div class="form-group">
                                            <label>Ganti Foto</label>
                                            <input name="foto" id="preview_gambar" class="form-control" type="file">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="edited_by" value="<?= session('id') ?>" class="form-control" id="edited_by" placeholder="Diubah Oleh" hidden>
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
                    <?php foreach ($anggota as $key => $value) { ?>
                        <div class="modal fade" id="delete<?= $value['id_anggota'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Data Anggota</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda Yakin Ingin Menghapus Data Anggota <b><?= $value['nm_anggota'] ?></b> ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                        <a href="<?= base_url('pengurus/master/anggota/delete/' . $value['id_anggota']) ?>" class="btn btn-danger">Hapus</a>
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