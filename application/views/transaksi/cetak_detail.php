<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
</head>

<body>
    <style type="text/css">
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data tr th,
        .table-data tr td {
            border: 1px solid black;
            font-size: 11pt;
            padding: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        h3 {
            text-transform: uppercase;
        }

        .py-2 {
            padding: 40px 0;
        }
    </style>

    <div class="text-center">
        <h3>Laporan Transaksi</h3>
        <p class="desc">No.<?= $transaksi->idTransaksi; ?></p>
    </div>
    <br />
    <table class="py-2">
        <tr>
            <td>Tanggal</td>
            <td>: <?= indo_date($transaksi->tanggal) ?></td>
        </tr>
        <tr>
            <td>Petugas</td>
            <td>: <?= $transaksi->nama; ?></td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td>: <?= $transaksi->namaPelanggan; ?></td>
        </tr>
        <tr>
            <td>Alamat Pelanggan</td>
            <td>: <?= $transaksi->alamatPelanggan; ?></td>
        </tr>
    </table>
    <table class="table-data">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Jumlah Beli</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($detail as $row) : ?>
                <tr>
                    <td align="center"><?= $no++; ?>.</td>
                    <td><?= $row->namaBarang; ?></td>
                    <td align="right"><?= format_uang($row->harga) ?></td>
                    <td align="center"><?= $row->qty; ?></td>
                    <td align="right"><?= format_uang($row->subtotal) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Total Harga</th>
                <th class="text-right"><?= format_uang($transaksi->totalHarga) ?></th>
            </tr>
            <tr>
                <th colspan="4" class="text-right">Uang Bayar</th>
                <th class="text-right"><?= format_uang($transaksi->uangBayar) ?></th>
            </tr>
            <tr>
                <th colspan="4" class="text-right">Kembali</th>
                <th class="text-right"><?= format_uang($transaksi->kembalian) ?></th>
            </tr>
        </tfoot>
    </table>

</body>

</html>