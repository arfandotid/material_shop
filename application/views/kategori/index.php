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
                        <a href="<?= base_url('kategori/add') ?>" class="btn btn-sm btn-primary">
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
                            <th>Nama Kategori</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($kategori as $row) : ?>
                            <tr>
                                <td><?= $no++; ?>.</td>
                                <td><?= $row->namaKategori; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('kategori/edit/') . $row->idKategori ?>" class="btn btn-sm btn-secondary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a onclick="return confirm('Yakin ingin hapus data?')" href="<?= base_url('kategori/hapus/') . $row->idKategori ?>" class="btn btn-sm btn-secondary">
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