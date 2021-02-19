<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white">
                <div class="row">
                    <div class="col d-flex">
                        <h3 class="h5 mb-0 card-title align-self-center">
                            Data <?= $title; ?>
                        </h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?= base_url('transaksi/add') ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Tambah Baru
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-striped mb-0 datatable">
                    <thead>
                        <tr>
                            <th width="100">No.</th>
                            <th>ID Transaksi</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Total Harga</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($transaksi as $row) : ?>
                            <tr>
                                <td><?= $no++; ?>.</td>
                                <td>
                                    <a href="<?= base_url('transaksi/detail/') . $row->idTransaksi; ?>">
                                        <?= $row->idTransaksi; ?>
                                    </a>
                                </td>
                                <td><?= indo_date($row->tanggal); ?></td>
                                <td><?= $row->namaPelanggan; ?></td>
                                <td><?= format_uang($row->totalHarga); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a onclick="return confirm('Yakin ingin hapus data?')" href="<?= base_url('transaksi/hapus/') . $row->idTransaksi ?>" class="btn btn-sm btn-secondary">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>