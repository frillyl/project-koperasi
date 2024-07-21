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
                        <li class="breadcrumb-item active">Simpanan Anggota</li>
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
                                        <th>Jenis Simpanan</th>
                                        <th>Jumlah</th>
                                        <th>Nama Anggota</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">

                                </tbody>
                                <tfoot style="text-align: center;">
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Simpanan</th>
                                        <th>Jumlah</th>
                                        <th>Nama Anggota</th>
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
                                    <h4 class="modal-title">Tambah Data Simpanan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    echo form_open('pengurus/usipa/simpanan/add');
                                    ?>

                                    <div class="form-group">
                                        <label for="id_anggota">Nama Anggota</label>
                                        <input type="text" name="id_anggota" class="form-control" id="id_anggota" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="simpanan">Jenis Simpanan</label>
                                        <select name="simpanan" class="form-control" id="simpanan" style="width: 100%;">
                                            <option value="">-- Pilih Jenis Simpanan --</option>
                                            <option value="1">Simpanan Pokok</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah Simpanan">
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
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