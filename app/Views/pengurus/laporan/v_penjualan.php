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
                            <th style="vertical-align: middle; background-color: #3d9970;">Kode Penjualan</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Tanggal Penjualan</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Barang</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Qty</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Total Harga</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Harga Jual</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Stok</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Ditambahkan Pada</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Ditambahkan oleh</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Diubah Pada</th>
                            <th style="vertical-align: middle; background-color: #3d9970;">Diubah Oleh</th>
                        </thead>
                        <tbody>

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