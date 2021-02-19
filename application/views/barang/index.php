<div class="row justify-content-center">
    <div class="col-md-12">
        <?= $this->session->flashdata('msg'); ?>
        <div class="card">
            <div class="card-header bg-white">
                <div class="row">
                    <div class="col d-flex">
                        <h3 class="h5 mb-0 card-title align-self-center">
                            Data <?= $title; ?>
                        </h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?= base_url('barang/add') ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Tambah Data
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-striped mb-0 datatable">
                    <thead>
                        <tr>
                            <th width="100">No.</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($barang as $row) : ?>
                            <tr>
                                <td><?= $no++; ?>.</td>
                                <td><?= $row->namaBarang; ?></td>
                                <td>
                                    <?= $row->stok; ?>
                                </td>
                                <td>Rp. <?= number_format($row->harga, '0', ',', '.'); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" data-stok="<?= $row->stok; ?>" data-nama="<?= $row->namaBarang; ?>" data-kode="<?= $row->kdBarang; ?>" class="btn btn-sm btn-secondary btn-tambahstok">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <a href="<?= base_url('barang/edit/') . $row->kdBarang ?>" class="btn btn-sm btn-secondary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a onclick="return confirm('Yakin ingin hapus data?')" href="<?= base_url('barang/hapus/') . $row->kdBarang ?>" class="btn btn-sm btn-secondary">
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

<!-- Modal -->
<div class="modal fade" id="tambahStok" tabindex="-1" role="dialog" aria-labelledby="tambahStokTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahStokTitle">Tambah Stok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('barang/tambah_stok') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="kdBarang">Kode Barang</label>
                    <input type="text" class="form-control" name="kdBarang" id="kdBarang" readonly>
                </div>
                <div class="form-group">
                    <label for="namaBarang">Nama Barang</label>
                    <input type="text" class="form-control" id="namaBarang" readonly>
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" autocomplete="off" min="1" name="stok" id="stok" class="form-control" placeholder="Tambahan Stok...">
                    <small id="stokHelp" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('body').on('click', '.btn-tambahstok', function() {
            $('#stok').val('');

            let kdBarang = $(this).data('kode');
            let namaBarang = $(this).data('nama');
            let stok = $(this).data('stok');

            $('#kdBarang').val(kdBarang);
            $('#namaBarang').val(namaBarang);
            $('#tambahStok').modal('show');

            $('#stokHelp').text("Jumlah Stok : " + stok);

            $('body').on('keyup', '.modal-dialog #stok', function() {
                let jumlahStok = Number(stok) + Number($(this).val());
                $('#stokHelp').text("Jumlah Stok : " + jumlahStok);
            });
        });
    });
</script>