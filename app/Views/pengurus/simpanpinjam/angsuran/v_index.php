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
                        <li class="breadcrumb-item">Simpan Pinjam</li>
                        <li class="breadcrumb-item active">Angsuran Pinjaman Anggota</li>
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
                                        <th>Nama Anggota</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Tanggal Bayar</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php $no = 1;
                                    foreach ($pinjaman as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['nm_anggota'] ?></td>
                                            <td><?= $value['jml_bayar'] ?></td>
                                            <td><?= date('j F Y', strtotime($value['tgl_bayar'])) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot style="text-align: center;">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Anggota</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Tanggal Bayar</th>
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
                                    <h4 class="modal-title">Tambah Data Angsuran</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    echo form_open('pengurus/usipa/angsuran/add');
                                    ?>

                                    <div class="form-group">
                                        <label for="id_pinjaman">Nama Anggota</label>
                                        <select name="id_pinjaman" class="form-control select2 select2-hidden-accessible" id="id_pinjaman" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="">-- Pilih Anggota --</option>
                                            <?php foreach ($pinjaman as $key => $value) { ?>
                                                <option value="<?= $value['id_pinjaman'] ?>"><?= $value['nm_anggota'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jml_bayar">Jumlah Bayar</label>
                                        <input type="text" name="jml_bayar" class="form-control" id="jml_bayar" placeholder="Jumlah Bayar">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_bayar">Tanggal Bayar</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="tgl_bayar" data-target="#reservationdate">
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
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