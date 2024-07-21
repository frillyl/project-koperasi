<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .penjualan {
            margin-bottom: 30px;
            /* Jarak antar penjualan */
        }
    </style>
</head>

<body>
    <h1><?= $title ?></h1>
    <?php foreach ($penjualan as $row) : ?>
        <div class="penjualan">
            <table>
                <thead>
                    <tr>
                        <th>Kode Penjualan</th>
                        <th>Kasir</th>
                        <th>Pembeli</th>
                        <th>Tanggal Penjualan</th>
                        <th>Grand Total</th>
                        <th>Dibayar</th>
                        <th>Kembalian</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $row['kd_penjualan'] ?></td>
                        <td><?= $row['nm_pengurus'] ?></td>
                        <td><?= $row['nm_anggota'] ?></td>
                        <td><?= $row['tgl_penjualan'] ?></td>
                        <td><?= $row['grand_total'] ?></td>
                        <td><?= $row['dibayar'] ?></td>
                        <td><?= $row['kembalian'] ?></td>
                    </tr>
                </tbody>
            </table>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Jual</th>
                            <th>Qty</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($row['details'] as $detail) : ?>
                            <tr>
                                <td><?= $detail['kd_barang'] ?></td>
                                <td><?= $detail['nm_barang'] ?></td>
                                <td><?= $detail['harga_jual'] ?></td>
                                <td><?= $detail['qty'] ?></td>
                                <td><?= $detail['total_harga'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
</body>

</html>