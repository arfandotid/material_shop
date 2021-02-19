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
                        <a href="<?= base_url('user/add') ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Tambah User
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-striped mb-0 datatable">
                    <thead>
                        <tr>
                            <th width="70">No.</th>
                            <th>Foto</th>
                            <th>ID User</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($user as $row) : ?>
                            <tr>
                                <td><?= $no++; ?>.</td>
                                <td>
                                    <img style="height: 40px;width:40px;" src="<?= base_url('assets/img/' . $row->foto); ?>" alt="<?= $row->nama; ?>" class="img-fluid rounded-circle img-thumbnail">
                                </td>
                                <td><?= $row->idUser; ?></td>
                                <td><?= $row->username; ?></td>
                                <td><?= $row->level; ?></td>
                                <td><?= $row->nama; ?></td>
                                <td><?= $row->noTelp; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('user/edit/') . $row->idUser ?>" class="btn btn-sm btn-secondary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a onclick="return confirm('Yakin ingin hapus data?')" href="<?= base_url('user/hapus/') . $row->idUser ?>" class="btn btn-sm btn-secondary">
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