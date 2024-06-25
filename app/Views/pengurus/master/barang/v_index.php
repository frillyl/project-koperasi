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
                                        <th>Nama Barang</th>
                                        <th>Stok (Satuan)</th>
                                        <th>Harga Pokok</th>
                                        <th>Harga Jual</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php $no = 1;
                                    foreach ($barang as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['nm_barang'] ?></td>
                                            <td><?= $value['stok'] ?> <?= $value['satuan'] ?></td>
                                            <td><?= $value['harga_pokok'] ?></td>
                                            <td><?= $value['harga_jual'] ?></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#info<?= $value['id_barang'] ?>"><i class="fa-solid fa-circle-info"></i></button>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value['id_barang'] ?>"><i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value['id_barang'] ?>"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot style="text-align: center;">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Barang</th>
                                        <th>Stok (Satuan)</th>
                                        <th>Harga Pokok</th>
                                        <th>Harga Jual</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- Modal Info -->
                    <?php foreach ($barang as $key => $value) { ?>
                        <div class="modal fade" id="info<?= $value['id_barang'] ?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detail Data Barang</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table no-border">
                                            <tbody>
                                                <tr>
                                                    <th></th>
                                                    <td><img src="<?= base_url('public/assets/images/' . $value['image']) ?>" class="img-fluid pad" width="113px" height="151px"></td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Agen</th>
                                                    <td><?= $value['nm_agen'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Kode Barang</th>
                                                    <td><?= $value['kd_barang'] ?></td>
                                                </tr>
                                                <tr>
                                                <tr>
                                                    <th>Nama Barang</th>
                                                    <td><?= $value['nm_barang'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Jenis Barang</th>
                                                    <td><?php if ($value['jenis_barang'] == '1') {
                                                            echo 'Milik Koperasi';
                                                        } elseif ($value['jenis_barang'] == '2') {
                                                            echo 'Konsinyasi';
                                                        } ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Harga Pokok</th>
                                                    <td><?= $value['harga_pokok'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Harga Jual</th>
                                                    <td><?= $value['harga_jual'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Stok (Satuan)</th>
                                                    <td><?= $value['stok'] ?> <?= $value['satuan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Keterangan</th>
                                                    <td><?= $value['ket_barang'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Ditambahkan Pada</th>
                                                    <td><?= date('j F Y H:i:s', strtotime($value['barang_created_at'])) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Ditambahkan Oleh</th>
                                                    <td><?= $value['nm_pengurus'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Diubah Pada</th>
                                                    <td><?php if ($value['barang_edited_at'] == '') : ?>
                                                            Data barang belum pernah diubah.
                                                        <?php else : ?>
                                                            <?= date('j F Y H:i:s', strtotime($value['barang_edited_at'])) ?>
                                                        <?php endif; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Diubah Oleh</th>
                                                    <td><?php if ($value['barang_edited_by'] == 0) : ?>
                                                            Data barang belum pernah diubah.
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
                                    <h4 class="modal-title">Tambah Data Barang</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    echo form_open_multipart('pengurus/master/barang/add');
                                    ?>

                                    <div class="form-group">
                                        <label for="id_agen">Agen</label>
                                        <select name="id_agen" class="form-control select2bs4 select2-hidden-accessible" id="id_agen" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="">-- Pilih Agen --</option>
                                            <?php foreach ($agen as $key => $value) { ?>
                                                <option value="<?= $value['id_agen'] ?>"><?= $value['nm_agen'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="kd_barang">Kode Barang</label>
                                        <input type="text" name="kd_barang" class="form-control" value="<?= $kd_barang ?>" id="kd_barang" placeholder="Kode Barang" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nm_barang">Nama Barang</label>
                                        <input type="text" name="nm_barang" class="form-control" id="nm_barang" placeholder="Nama Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectBorderWidth2">Jenis Barang</label>
                                        <select name="jenis_barang" class="form-control" id="jenis_barang" style="width: 100%;">
                                            <option value="">-- Pilih Jenis Barang --</option>
                                            <option value="1">Milik Koperasi</option>
                                            <option value="2">Konsinyasi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_pokok">Harga Pokok</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="harga_pokok" class="form-control" id="harga_pokok" placeholder="100000">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_jual">Harga Jual</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="harga_jual" class="form-control" id="harga_jual" placeholder="100000">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="stok">Stok</label>
                                                <input type="number" name="stok" class="form-control" id="stok" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="satuan">Satuan Barang</label>
                                                <select name="id_satuan" class="form-control select2bs4 select2-hidden-accessible" id="id_satuan" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true">
                                                    <option value="">-- Pilih Satuan Barang --</option>
                                                    <?php foreach ($satuan as $key => $value) { ?>
                                                        <option value="<?= $value['id_satuan'] ?>"><?= $value['satuan'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="ket">Keterangan</label>
                                        <textarea name="ket" class="form-control" id="ket" placeholder="Keterangan"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <img src="<?= base_url('public/assets/images/no_image.png') ?>" id="gambar_load" class="img-fluid pad" width="113px" height="151px">
                                    </div>
                                    <div class="form-group">
                                        <label>Gambar Barang</label>
                                        <input name="foto" id="preview_gambar" class="form-control" type="file">
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
                    <?php foreach ($barang as $key => $value) { ?>
                        <div class="modal fade" id="edit<?= $value['id_barang'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ubah Data Barang</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        echo form_open_multipart('pengurus/master/barang/edit/' . $value['id_barang']);
                                        ?>

                                        <div class="form-group">
                                            <label for="id_agen">Agen</label>
                                            <select name="id_agen" class="form-control select2bs4 select2-hidden-accessible" id="id_agen" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option <?php if ($value['id_agen'] == '') {
                                                            echo 'selected';
                                                        } ?> value="">----- Pilih Agen -----</option>
                                                <?php foreach ($agen as $key => $value2) { ?>
                                                    <option <?php if ($value['id_agen'] == $value2['id_agen']) {
                                                                echo 'selected';
                                                            } ?> value="<?= $value2['id_agen'] ?>"><?= $value2['nm_agen'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kd_barang">Kode Barang</label>
                                            <input type="text" name="kd_barang" class="form-control" value="<?= $value['kd_barang'] ?>" id="kd_barang" placeholder="Kode Barang" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nm_barang">Nama Barang</label>
                                            <input type="text" name="nm_barang" class="form-control" id="nm_barang" placeholder="Nama Barang" value="<?= $value['nm_barang'] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelectBorderWidth2">Jenis Barang</label>
                                            <select name="jenis_barang" class="form-control">
                                                <option <?php if ($value['jenis_barang'] == '') {
                                                            echo 'selected';
                                                        } ?> value="">----- Pilih Jenis Barang -----</option>
                                                <option <?php if ($value['jenis_barang'] == 1) {
                                                            echo 'selected';
                                                        } ?> value="1">Milik Koperasi</option>
                                                <option <?php if ($value['jenis_barang'] == 2) {
                                                            echo 'selected';
                                                        } ?> value="2">Konsinyasi</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_pokok">Harga Pokok</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="text" name="harga_pokok" class="form-control" id="harga_pokok" placeholder="100000" value="<?= $value['harga_pokok'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_jual">Harga Jual</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="text" name="harga_jual" class="form-control" id="harga_jual" placeholder="100000" value="<?= $value['harga_jual'] ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="stok">Stok</label>
                                                    <input type="number" min="0" name="stok" class="form-control" id="stok" placeholder="0" value="<?= $value['stok'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="satuan">Satuan Barang</label>
                                                    <select name="id_satuan" class="form-control select2 select2-hidden-accessible" id="id_satuan" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true">
                                                        <option <?php if ($value['id_satuan'] == '') {
                                                                    echo 'selected';
                                                                } ?> value="">----- Pilih Satuan Barang -----</option>
                                                        <?php foreach ($satuan as $key => $value2) { ?>
                                                            <option <?php if ($value['id_satuan'] == $value2['id_satuan']) {
                                                                        echo 'selected';
                                                                    } ?> value="<?= $value2['id_satuan'] ?>"><?= $value2['satuan'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="ket">Keterangan</label>
                                            <textarea name="ket" class="form-control" id="ket" placeholder="Keterangan"><?= $value['ket_barang'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <img src="<?= base_url('public/assets/images/' . $value['image']) ?>" id="gambar_load" class="img-fluid pad" width="113px" height="151px">
                                        </div>
                                        <div class="form-group">
                                            <label>Ganti Gambar Barang</label>
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
                    <?php foreach ($barang as $key => $value) { ?>
                        <div class="modal fade" id="delete<?= $value['id_barang'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Data Barang</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda Yakin Ingin Menghapus Data Barang <b><?= $value['nm_barang'] ?></b> ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                        <a href="<?= base_url('pengurus/master/barang/delete/' . $value['id_barang']) ?>" class="btn btn-danger">Hapus</a>
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