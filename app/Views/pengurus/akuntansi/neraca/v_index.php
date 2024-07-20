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
                        <li class="breadcrumb-item active">Neraca</li>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center"><strong>PRIMER KOPERASI DARMA PUTRA KUJANG I</strong></h4>
                            <h4 class="text-center"><strong>PERUBAHAN POSISI KEUANGAN</strong></h4>
                            <h5 class="text-center">Untuk Tahun <?= date('Y') ?></h5>

                            <div class="row mt-5">
                                <div class="col-12">
                                    <table class="table table-bordered table-hover table-head-fixed text-nowrap">
                                        <thead style="text-align: center; background-color: #3d9970; color: white;">
                                            <tr>
                                                <th rowspan="2" style="vertical-align: middle; background-color: #3d9970; color: white;" width="250px">Uraian</th>
                                                <th rowspan="2" style="vertical-align: middle; background-color: #3d9970; color: white;" width="100px">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Aset -->
                                            <tr>
                                                <td colspan="2" style="font-weight: bold;">Aset</td>
                                            </tr>
                                            <!-- Aset Lancar -->
                                            <tr>
                                                <td colspan="2" style="padding-left: 25px; font-weight: bold;">Aset Lancar</td>
                                            </tr>
                                            <?php foreach ($accounts['Aset Lancar'] as $kategori => $items) : ?>
                                                <tr>
                                                    <td colspan="2" style="padding-left: 50px; font-weight: bold;"><?= $kategori ?></td>
                                                </tr>
                                                <?php foreach ($items as $item) : ?>
                                                    <tr>
                                                        <td style="padding-left: 75px;"><?= esc($item['uraian']) ?></td>
                                                        <td style="text-align: right;"><?= number_format(esc($item['jumlah']), 2, ',', '.') ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td style="font-weight: bold; padding-left: 50px;">Total <?= $kategori ?></td>
                                                    <td style="text-align: right; font-weight: bold;">
                                                        <?php
                                                        $totalVariable = 'total' . str_replace(' ', '', $kategori);
                                                        echo number_format(esc($totals[$totalVariable]), 2, ',', '.');
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td style="font-weight: bold; padding-left: 50px;">Total Aset Lancar</td>
                                                <td style="text-align: right; font-weight: bold;"><?= number_format(esc($totals['totalAsetLancar']), 2, ',', '.') ?></td>
                                            </tr>

                                            <!-- Aset Tetap -->
                                            <tr>
                                                <td colspan="2" style="padding-left: 25px; font-weight: bold;">Aset Tetap</td>
                                            </tr>
                                            <?php foreach ($accounts['Aset Tetap'] as $item) : ?>
                                                <tr>
                                                    <td style="padding-left: 50px;"><?= esc($item['uraian']) ?></td>
                                                    <td style="text-align: right;"><?= number_format(esc($item['jumlah']), 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td style="font-weight: bold; padding-left: 25px;">Total Aset Tetap</td>
                                                <td style="text-align: right; font-weight: bold;"><?= number_format(esc($totals['totalAsetTetap']), 2, ',', '.') ?></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold; padding-left: 25px;">Total Aset</td>
                                                <td style="text-align: right; font-weight: bold;"><?= number_format(esc($totals['totalAset']), 2, ',', '.') ?></td>
                                            </tr>

                                            <!-- Hutang -->
                                            <tr>
                                                <td colspan="2" style="font-weight: bold;">Hutang</td>
                                            </tr>
                                            <?php foreach ($accounts['Hutang'] as $item) : ?>
                                                <tr>
                                                    <td style="padding-left: 20px;"><?= esc($item['uraian']) ?></td>
                                                    <td style="text-align: right;"><?= number_format(esc($item['jumlah']), 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td style="font-weight: bold;">Total Hutang</td>
                                                <td style="text-align: right; font-weight: bold;"><?= number_format(esc($totals['totalHutang']), 2, ',', '.') ?></td>
                                            </tr>

                                            <!-- Equity -->
                                            <tr>
                                                <td colspan="2" style="font-weight: bold;">Equity</td>
                                            </tr>
                                            <?php foreach ($accounts['Equity'] as $item) : ?>
                                                <?php if ($item['uraian'] === 'LABA (RUGI) BULAN BERJALAN') : ?>
                                                    <tr>
                                                        <td style="padding-left: 20px;"><?= esc($item['uraian']) ?></td>
                                                        <td style="text-align: right;"><?= number_format(esc($totals['labaSebelumPajak']), 2, ',', '.') ?></td>
                                                    </tr>
                                                <?php else : ?>
                                                    <tr>
                                                        <td style="padding-left: 20px;"><?= esc($item['uraian']) ?></td>
                                                        <td style="text-align: right;"><?= number_format(esc($item['jumlah']), 2, ',', '.') ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td style="font-weight: bold;">Total Modal</td>
                                                <td style="text-align: right; font-weight: bold;"><?= number_format(esc($totals['totalModal']), 2, ',', '.') ?></td>
                                            </tr>

                                            <!-- Total Liabilitas + Equity -->
                                            <tr>
                                                <td style="font-weight: bold;">Total Liabilitas + Equity</td>
                                                <td style="text-align: right; font-weight: bold;"><?= number_format(esc($totals['totalLiabilitasEquity']), 2, ',', '.') ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->