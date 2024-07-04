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
                        <li class="breadcrumb-item">Akun Pembantu Header</li>
                        <li class="breadcrumb-item active">Daftar Akun Pembantu Header</li>
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
                            <table id="example2" class="table table-bordered table-hover">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Akun</th>
                                        <th>Ditambahkan Pada</th>
                                        <th>Ditambahkan Oleh</th>
                                        <th>Diubah Pada</th>
                                        <th>Diubah Oleh</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php $no = 1;
                                    foreach ($header as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['nm_akun'] ?></td>
                                            <td><?= date('j F Y H:i:s', strtotime($value['created_at'])) ?></td>
                                            <td><?= $value['nm_pengurus'] ?></td>
                                            <td><?php if ($value['edited_at'] == '') : ?>
                                                    Data anggota belum pernah diubah.
                                                <?php else : ?>
                                                    <?= date('j F Y H:i:s', strtotime($value['edited_at'])) ?>
                                                <?php endif; ?></td>
                                            <td><?php if ($value['edited_by'] == 0) : ?>
                                                    Data anggota belum pernah diubah.
                                                <?php else : ?>
                                                    <?= $value['nm_pengurus'] ?>
                                                <?php endif; ?></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value['id_akun_header'] ?>"><i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value['id_akun_header'] ?>"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot style="text-align: center;">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Akun</th>
                                        <th>Ditambahkan Pada</th>
                                        <th>Ditambahkan Oleh</th>
                                        <th>Diubah Pada</th>
                                        <th>Diubah Oleh</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- Modal Add -->
                    <div class="modal fade" id="add">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Akun Header</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    echo form_open('pengurus/akuntansi/akun_header/add');
                                    ?>

                                    <div class="form-group">
                                        <label for="nm_akun">Nama Akun</label>
                                        <input type="text" name="nm_akun" class="form-control" id="nm_akun" placeholder="Nama Akun">
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
                    <?php foreach ($header as $key => $value) { ?>
                        <div class="modal fade" id="edit<?= $value['id_akun_header'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ubah Data Akun Header</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        echo form_open('pengurus/akuntansi/akun_header/edit/' . $value['id_akun_header']);
                                        ?>

                                        <div class="form-group">
                                            <label for="nm_akun">Nama Akun</label>
                                            <input type="text" name="nm_akun" value="<?= $value['nm_akun'] ?>" class="form-control" id="nm_akun" placeholder="Nama Akun">
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
                    <?php foreach ($header as $key => $value) { ?>
                        <div class="modal fade" id="delete<?= $value['id_akun_header'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Data Akun Header</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda Yakin Ingin Menghapus Data Akun Header <b><?= $value['nm_akun'] ?></b> ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                        <a href="<?= base_url('pengurus/akuntansi/akun_header/delete/' . $value['id_akun_header']) ?>" class="btn btn-danger">Hapus</a>
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