<div class="row justify-content-center">
    <div class="col-md-5">
        <?= $this->session->flashdata('msg'); ?>
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
                <?= form_open(); ?>
                <div class="form-group">
                    <label for="oldpassword">Password Lama</label>
                    <input type="password" id="oldpassword" name="oldpassword" class="form-control" placeholder="Password Lama...">
                    <?= form_error('oldpassword'); ?>
                </div>
                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password Baru...">
                    <?= form_error('password'); ?>
                </div>
                <div class="form-group">
                    <label for="konfpassword">Konfirmasi Password</label>
                    <input type="password" id="konfpassword" name="konfpassword" class="form-control" placeholder="Konfirmasi Password...">
                    <?= form_error('konfpassword'); ?>
                </div>
                <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>