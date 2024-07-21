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
                        <li class="breadcrumb-item active">Pinjaman Anggota</li>
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
                                        <th>Tanggal Pengajuan</th>
                                        <th>Tanggal Disetujui</th>
                                        <th>Nama Anggota</th>
                                        <th>Jumlah Pinjaman</th>
                                        <th>Bunga</th>
                                        <th>Tenor</th>
                                        <th>Sisa Tenor</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php $no = 1; ?>
                                    <?php foreach ($pinjaman as $p) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= !empty($p['tgl_pengajuan']) ? date('j F Y', strtotime($p['tgl_pengajuan'])) : 'Tanggal Tidak Tersedia'; ?></td>
                                            <td><?= !empty($p['tgl_disetujui']) ? date('j F Y', strtotime($p['tgl_disetujui'])) : 'Belum Disetujui'; ?></td>
                                            <td><?= $p['nm_anggota']; ?></td>
                                            <td><?= number_format($p['jml_pinjaman'], 2, ',', '.'); ?></td>
                                            <td><?= number_format($p['bunga'], 2, ',', '.'); ?></td>
                                            <td><?= $p['tenor']; ?></td>
                                            <td><?= $p['sisa_tenor']; ?></td>
                                            <td><?= $p['status']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot style="text-align: center;">
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Tanggal Disetujui</th>
                                        <th>Nama Anggota</th>
                                        <th>Jumlah Pinjaman</th>
                                        <th>Bunga</th>
                                        <th>Tenor</th>
                                        <th>Sisa Tenor</th>
                                        <th>Status</th>
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
                                    <h4 class="modal-title">Tambah Data Pinjaman</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?= form_open('pengurus/usipa/pinjaman/add'); ?>

                                    <div class="form-group">
                                        <label for="id_anggota">Nama Anggota</label>
                                        <select name="id_anggota" class="form-control" id="id_anggota">
                                            <option value="">--- Pilih Anggota ---</option>
                                            <?php foreach ($anggota as $a) : ?>
                                                <option value="<?= $a['id_anggota']; ?>"><?= $a['nm_anggota']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jml_pinjaman">Jumlah Pinjaman</label>
                                        <input type="number" name="jml_pinjaman" class="form-control" id="jml_pinjaman" placeholder="Jumlah Pinjaman">
                                    </div>
                                    <div class="form-group">
                                        <label for="bunga">Bunga</label>
                                        <input type="text" name="bunga" value="" class="form-control" id="bunga" placeholder="Bunga" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="tenor">Tenor</label>
                                        <input type="number" name="tenor" class="form-control" id="tenor" placeholder="Tenor">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="tgl_pengajuan" data-target="#reservationdate">
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
                                <?= form_close() ?>
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