<div class="row justify-content-center mb-5">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-white">
                <div class="row">
                    <div class="col d-flex">
                        <h3 class="h5 mb-0 card-title align-self-center">
                            Tambah <?= $title; ?>
                        </h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?= base_url('user') ?>" class="btn btn-sm btn-secondary">
                            <i class="fas fa-chevron-left"></i> Batal
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('msg'); ?>
                <?= form_open_multipart(); ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="idUser">ID User</label>
                            <input readonly value="<?= set_value('idUser', $idUser); ?>" type="text" id="idUser" class="form-control" placeholder="ID User...">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input autofocus onfocus="this.select()" value="<?= set_value('username'); ?>" type="text" id="username" name="username" class="form-control" placeholder="Username...">
                            <?= form_error('username'); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input value="<?= set_value('password'); ?>" type="password" id="password" name="password" class="form-control" placeholder="Password...">
                            <?= form_error('password'); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="konfpass">Konfirmasi Password</label>
                            <input value="<?= set_value('konfpass'); ?>" type="password" id="konfpass" name="konfpass" class="form-control" placeholder="Konfirmasi Password...">
                            <?= form_error('konfpass'); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select name="level" class="form-control">
                                <option value="">Pilih Level User</option>
                                <option value="administrator">Administrator</option>
                                <option value="petugas">Petugas</option>
                                <option value="kepala toko">Kepala Toko</option>
                            </select>
                            <?= form_error('level'); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input value="<?= set_value('nama'); ?>" type="text" id="nama" name="nama" class="form-control" placeholder="Nama...">
                            <?= form_error('nama'); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="noTelp">Nomor Telepon</label>
                            <input value="<?= set_value('noTelp'); ?>" type="text" id="noTelp" name="noTelp" class="form-control" placeholder="Nomor Telepon...">
                            <?= form_error('noTelp'); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <!-- <div class="custom-file">
                                <input type="file" class="custom-file-input" name="foto" id="foto">
                                <label class="custom-file-label" for="foto">
                                    <span class="custom-file-text">Pilih File</span>
                                    <span class="custom-file-button"></span>
                                </label>
                            </div> -->
                            <input type="file" name="foto" id="foto" class="form-control">
                            <?= form_error('foto'); ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>