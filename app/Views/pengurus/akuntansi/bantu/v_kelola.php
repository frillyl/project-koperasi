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
                        <li class="breadcrumb-item active">Kelola Kode Akun</li>
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
                                        <th>Kode Akun</th>
                                        <th>Nama Akun</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php $no = 1;
                                    foreach ($akun as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['kd_akun'] ?></td>
                                            <td><?= $value['nm_akun_pembantu'] ?></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#info<?= $value['id_akun_pembantu'] ?>"><i class="fa-solid fa-circle-info"></i></button>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value['id_akun_pembantu'] ?>"><i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value['id_akun_pembantu'] ?>"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot style="text-align: center;">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Akun</th>
                                        <th>Nama Akun</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- Modal Info -->
                    <?php foreach ($akun as $key => $value) { ?>
                        <div class="modal fade" id="info<?= $value['id_akun_pembantu'] ?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detail Data Kode Akun Pembantu</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table no-border">
                                            <tbody>
                                                <tr>
                                                    <th>Header Kode Akun Pembantu</th>
                                                    <td><?= $value['nm_akun_header'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Kode Akun</th>
                                                    <td><?= $value['kd_akun'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Akun</th>
                                                    <td><?= $value['nm_akun_pembantu'] ?></td>
                                                </tr>
                                                <tr>
                                                <tr>
                                                    <th>Tabel Bantuan</th>
                                                    <td><?= $value['tb_bantuan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Pos Saldo</th>
                                                    <td><?php if ($value['saldo_normal'] == '1') {
                                                            echo 'Debit';
                                                        } elseif ($value['saldo_normal'] == '2') {
                                                            echo 'Kredit';
                                                        } elseif ($value['saldo_normal'] == '0') {
                                                            echo '-';
                                                        } ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Saldo Awal</th>
                                                    <td><?= $value['saldo_awal'] ?></td>
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
                                                            Data kode akun belum pernah diubah.
                                                        <?php else : ?>
                                                            <?= date('j F Y H:i:s', strtotime($value['edited_at'])) ?>
                                                        <?php endif; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Diubah Oleh</th>
                                                    <td><?php if ($value['edited_by'] == 0) : ?>
                                                            Data kode akun belum pernah diubah.
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
                                    <h4 class="modal-title">Tambah Data Kode Akun Pembantu</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    echo form_open('pengurus/akuntansi/akun_pembantu/kelola/add');
                                    ?>

                                    <div class="form-group">
                                        <label for="id_akun_header">Header Kode Akun Pembantu</label>
                                        <select name="id_akun_header" class="form-control select2 select2-hidden-accessible" id="id_pangkat" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="">-- Pilih Header --</option>
                                            <?php foreach ($header as $key => $value) { ?>
                                                <option value="<?= $value['id_akun_header'] ?>"><?= $value['nm_akun'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="kd_akun">Kode Akun</label>
                                        <input type="text" name="kd_akun" class="form-control" id="kd_akun" placeholder="Kode Akun">
                                    </div>
                                    <div class="form-group">
                                        <label for="nm_akun">Nama Akun</label>
                                        <input type="text" name="nm_akun" class="form-control" id="nm_akun" placeholder="Nama Akun">
                                    </div>
                                    <div class="form-group">
                                        <label for="tb_bantuan">Kode Tabel Bantuan</label>
                                        <input type="text" name="tb_bantuan" class="form-control" id="tb_bantuan" placeholder="Kode Tabel Bantuan">
                                    </div>
                                    <div class="form-group">
                                        <label for="saldo_normal">Saldo Normal</label>
                                        <select name="saldo_normal" class="form-control" id="saldo_normal" style="width: 100%;">
                                            <option value="">-- Pilih Saldo Normal --</option>
                                            <option value="1">Debit</option>
                                            <option value="2">Kredit</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="saldo_awal">Saldo Awal</label>
                                        <input type="text" name="saldo_awal" class="form-control" id="saldo_awal" placeholder="Saldo Awal">
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
                    <?php foreach ($akun as $key => $value) { ?>
                        <div class="modal fade" id="edit<?= $value['id_akun_pembantu'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ubah Data Kode Akun Pembantu</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        echo form_open('pengurus/akuntansi/akun_pembantu/kelola/edit/' . $value['id_akun_pembantu']);
                                        ?>

                                        <div class="form-group">
                                            <label for="id_akun_header">Header Kode Akun Pembantu</label>
                                            <select name="id_akun_header" class="form-control select2 select2-hidden-accessible" id="id_akun_header" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option <?php if ($value['id_akun_header'] == '') {
                                                            echo 'selected';
                                                        } ?> value="">----- Pilih Header -----</option>
                                                <?php foreach ($header as $key => $value2) { ?>
                                                    <option <?php if ($value['id_akun_header'] == $value2['id_akun_header']) {
                                                                echo 'selected';
                                                            } ?> value="<?= $value2['id_akun_header'] ?>"><?= $value2['nm_akun'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kd_akun">Kode Akun</label>
                                            <input type="text" name="kd_akun" value="<?= $value['kd_akun'] ?>" class="form-control" id="kd_akun" placeholder="Kode Akun" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nm_akun">Nama Akun</label>
                                            <input type="text" name="nm_akun" value="<?= $value['nm_akun'] ?>" class="form-control" id="nm_akun" placeholder="Nama Akun">
                                        </div>
                                        <div class="form-group">
                                            <label for="tb_bantuan">Kode Tabel Bantuan</label>
                                            <input type="text" name="tb_bantuan" value="<?= $value['tb_bantuan'] ?>" class="form-control" id="tb_bantuan" placeholder="Kode Tabel Bantuan">
                                        </div>
                                        <div class="form-group">
                                            <label for="saldo_normal">Saldo Normal</label>
                                            <select name="saldo_normal" class="form-control">
                                                <option <?php if ($value['saldo_normal'] == '') {
                                                            echo 'selected';
                                                        } ?> value="">----- Pilih Saldo Normal -----</option>
                                                <option <?php if ($value['saldo_normal'] == 1) {
                                                            echo 'selected';
                                                        } ?> value="1">Debit</option>
                                                <option <?php if ($value['saldo_normal'] == 2) {
                                                            echo 'selected';
                                                        } ?> value="2">Kredit</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="saldo_awal">Saldo Awal</label>
                                            <input type="text" name="saldo_awal" value="<?= $value['saldo_awal'] ?>" class="form-control" id="saldo_awal" placeholder="Saldo Awal">
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
                    <?php foreach ($akun as $key => $value) { ?>
                        <div class="modal fade" id="delete<?= $value['id_akun_pembantu'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Data Kode Akun Pembantu</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda Yakin Ingin Menghapus Data Kode Akun Pembantu <b><?= $value['nm_akun_pembantu'] ?></b> ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                        <a href="<?= base_url('pengurus/akuntansi/akun_pembantu/delete/' . $value['id_akun_pembantu']) ?>" class="btn btn-danger">Hapus</a>
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