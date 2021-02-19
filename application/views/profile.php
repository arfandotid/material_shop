<div class="row justify-content-center mb-3">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-white">
                <div class="row">
                    <div class="col d-flex">
                        <h3 class="h5 mb-0 card-title align-self-center">
                            <?= $title; ?>
                        </h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?= base_url('dashboard') ?>" class="btn btn-sm btn-secondary">
                            <i class="fas fa-chevron-left"></i> Batal
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('msg'); ?>
                <?= form_open_multipart(); ?>
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="idUser">ID User</label>
                                    <input readonly value="<?= set_value('idUser', $user->idUser); ?>" type="text" id="idUser" class="form-control" placeholder="ID User...">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input autofocus onfocus="this.select()" value="<?= set_value('username', $user->username); ?>" type="text" id="username" name="username" class="form-control" placeholder="Username...">
                                    <?= form_error('username'); ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input value="<?= set_value('nama', $user->nama); ?>" type="text" id="nama" name="nama" class="form-control" placeholder="Nama...">
                                    <?= form_error('nama'); ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="noTelp">Nomor Telepon</label>
                                    <input value="<?= set_value('noTelp', $user->noTelp); ?>" type="text" id="noTelp" name="noTelp" class="form-control" placeholder="Nomor Telepon...">
                                    <?= form_error('noTelp'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 order-first">
                        <label for="foto">Foto</label>
                        <img src="<?= base_url('assets/img/') . $user->foto; ?>" alt="" class="img-fluid img-thumbnail elevation-1 mb-2">
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>