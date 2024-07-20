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
                        <li class="breadcrumb-item active">Laba Rugi</li>
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
                            <h4 class="text-center"><strong>LAPORAN LABA RUGI</strong></h4>
                            <h5 class="text-center">Untuk Tahun <?= date('Y') ?></h5>

                            <div class="row mt-5">
                                <div class="col-12">
                                    <table class="table table-bordered table-hover table-head-fixed text-nowrap">
                                        <thead style="text-align: center; background-color: #3d9970; color: white;">
                                            <tr>
                                                <th rowspan="2" style="vertical-align: middle; background-color: #3d9970; color: white;" width="50px">Kode Akun</th>
                                                <th rowspan="2" style="vertical-align: middle; background-color: #3d9970; color: white;" width="250px">Keterangan</th>
                                                <th rowspan="2" style="vertical-align: middle; background-color: #3d9970; color: white;" width="100px">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($accounts as $category => $accounts) : ?>
                                                <tr>
                                                    <td colspan="3" style="text-align: left; font-weight: bold; text-transform:uppercase;"><?= esc($category) ?></td>
                                                </tr>
                                                <?php foreach ($accounts as $account) : ?>
                                                    <tr>
                                                        <td class="text-center" style="vertical-align: middle;"><?= esc($account['kd_akun']) ?></td>
                                                        <td><?= esc($account['nm_akun']) ?></td>
                                                        <td style="vertical-align: middle; text-align: right;">
                                                            <?= $account['pos_saldo'] == '1' ? esc($account['laba_rugi_debit']) : esc($account['laba_rugi_kredit']) ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="2" style="text-align: left; font-weight: bold; text-transform: uppercase;">Total <?= esc($category) ?></td>
                                                    <td style="text-align: right; font-weight: bold;"><?= esc($totals[$category]) ?></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="2" style="text-align: left; font-weight: bold;">Laba Kotor</td>
                                                <td style="text-align: right;"><?= esc($labaKotor) ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left; font-weight: bold;">Laba (Rugi) Sebelum Pajak</td>
                                                <td style="text-align: right;"><?= esc($labaSebelumPajak) ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left; font-weight: bold;">Pajak PPH Badan</td>
                                                <td style="text-align: right;"><?= esc($pajakPPH) ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left; font-weight: bold;">Laba (Rugi) Setelah Pajak</td>
                                                <td style="text-align: right;"><?= esc($labaSetelahPajak) ?></td>
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