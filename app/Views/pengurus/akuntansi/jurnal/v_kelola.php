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
                        <li class="breadcrumb-item active">Kelola Jurnal Umum</li>
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
                                        <th>Tanggal</th>
                                        <th>No. Bukti</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php $no = 1;
                                    foreach ($jurnal as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= date('j F Y', strtotime($value['tanggal'])) ?></td>
                                            <td><?= $value['no_bukti'] ?></td>
                                            <td><?= $value['ket'] ?></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#info<?= $value['id_jurnal'] ?>"><i class="fa-solid fa-circle-info"></i></button>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value['id_jurnal'] ?>"><i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value['id_jurnal'] ?>"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot style="text-align: center;">
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>No. Bukti</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- Modal Info -->
                    <?php foreach ($jurnal as $key => $value) { ?>
                        <div class="modal fade" id="info<?= $value['id_jurnal'] ?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detail Data Jurnal</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table no-border">
                                            <tbody>
                                                <tr>
                                                    <th>Nama Akun</th>
                                                    <td><?= $value['akun_nm_akun'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Kode Akun Pembantu</th>
                                                    <td><?= $value['akun_pembantu_nm_akun'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <td><?= date('j F Y', strtotime($value['tanggal'])) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Nomor Bukti</th>
                                                    <td><?= $value['no_bukti'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Keterangan</th>
                                                    <td><?= $value['ket'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Debit</th>
                                                    <td><?= $value['debit'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Kredit</th>
                                                    <td><?= $value['kredit'] ?></td>
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
                                    <h4 class="modal-title">Tambah Data Jurnal</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    echo form_open('pengurus/akuntansi/jurnal_umum/kelola/add');
                                    ?>

                                    <div class="form-group">
                                        <label for="id_akun">Akun</label>
                                        <select name="id_akun" class="form-control select2 select2-hidden-accessible" id="id_akun" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="">-- Pilih Akun --</option>
                                            <?php foreach ($akun as $key => $value) { ?>
                                                <option value="<?= $value['id_akun'] ?>"><?= $value['nm_akun'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_akun_pembantu">Akun Pembantu</label>
                                        <select name="id_akun_pembantu" class="form-control select2 select2-hidden-accessible" id="id_akun_pembantu" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="">-- Pilih Akun Pembantu --</option>
                                            <?php foreach ($bantu as $key => $value) { ?>
                                                <option value="<?= $value['id_akun_pembantu'] ?>"><?= $value['nm_akun_pembantu'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="tanggal" data-target="#reservationdate">
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_bukti">Nomor Bukti</label>
                                        <input type="text" name="no_bukti" class="form-control" id="no_bukti" placeholder="Nomor Bukti">
                                    </div>
                                    <div class="form-group">
                                        <label for="ket">Keterangan</label>
                                        <textarea name="ket" class="form-control" id="ket" placeholder="Keterangan"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="debit">Debit</label>
                                        <input type="text" name="debit" class="form-control" id="debit" placeholder="Debit">
                                    </div>
                                    <div class="form-group">
                                        <label for="kredit">Kredit</label>
                                        <input type="text" name="kredit" class="form-control" id="kredit" placeholder="Kredit">
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
                    <?php foreach ($jurnal as $key => $value) { ?>
                        <div class="modal fade" id="edit<?= $value['id_jurnal'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ubah Data Jurnal</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        echo form_open('pengurus/akuntansi/jurnal_umum/kelola/edit/' . $value['id_jurnal']);
                                        ?>

                                        <div class="form-group">
                                            <label for="id_akun">Akun</label>
                                            <select name="id_akun" class="form-control select2 select2-hidden-accessible" id="id_akun" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option <?php if ($value['id_akun'] == '') {
                                                            echo 'selected';
                                                        } ?> value="">----- Pilih Akun -----</option>
                                                <?php foreach ($akun as $key => $value2) { ?>
                                                    <option <?php if ($value['id_akun'] == $value2['id_akun']) {
                                                                echo 'selected';
                                                            } ?> value="<?= $value2['id_akun'] ?>"><?= $value2['nm_akun'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_akun_pembantu">Akun Pembantu</label>
                                            <select name="id_akun_pembantu" class="form-control select2 select2-hidden-accessible" id="id_akun_pembantu" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option <?php if ($value['id_akun_pembantu'] == '') {
                                                            echo 'selected';
                                                        } ?> value="">----- Pilih Akun Pembantu-----</option>
                                                <?php foreach ($bantu as $key => $value2) { ?>
                                                    <option <?php if ($value['id_akun_pembantu'] == $value2['id_akun_pembantu']) {
                                                                echo 'selected';
                                                            } ?> value="<?= $value2['id_akun_pembantu'] ?>"><?= $value2['nm_akun_pembantu'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" name="tanggal" value="<?= $value['tanggal'] ?>" data-target="#reservationdate">
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_bukti">Nomor Bukti</label>
                                            <input type="text" name="no_bukti" value="<?= $value['no_bukti'] ?>" class="form-control" id="no_bukti" placeholder="Nomor Bukti">
                                        </div>
                                        <div class="form-group">
                                            <label for="ket">Keterangan</label>
                                            <textarea name="ket" class="form-control" id="ket" placeholder="Keterangan"><?= $value['ket'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="debit">Debit</label>
                                            <input type="text" name="debit" value="<?= $value['debit'] ?>" class="form-control" id="debit" placeholder="Debit">
                                        </div>
                                        <div class="form-group">
                                            <label for="kredit">Kredit</label>
                                            <input type="text" name="kredit" value="<?= $value['kredit'] ?>" class="form-control" id="kredit" placeholder="Kredit">
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
                    <?php foreach ($jurnal as $key => $value) { ?>
                        <div class="modal fade" id="delete<?= $value['id_jurnal'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Data Jurnal</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda Yakin Ingin Menghapus Data Jurnal?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                        <a href="<?= base_url('pengurus/akuntansi/jurnal_umum/kelola/delete/' . $value['id_jurnal']) ?>" class="btn btn-danger">Hapus</a>
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