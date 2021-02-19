<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <div class="row">
                    <div class="col d-flex">
                        <h3 class="h5 mb-0 card-title align-self-center">
                            Data Pelanggan
                        </h3>
                    </div>
                    <div class="col text-right">
                        <a onclick="return confirm('Anda yakin tidak ingin mengisi data pelanggan?');" href="<?= base_url('') ?>" class="btn btn-sm btn-secondary">
                            Lewati <i class="fas fa-step-forward"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body mb-0 pb-0">
                <?= form_open(); ?>
                <div class="form-group row">
                    <label for="namaPelanggan" class="col-sm-3 col-form-label">Nama Pelanggan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="namaPelanggan" placeholder="Nama Pelanggan...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namaPelanggan" class="col-sm-3 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="noTelp" placeholder="Nomor Telepon...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea name="alamat" class="form-control" id="alamat" rows="2" placeholder="Alamat..."></textarea>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-check"></i> OK</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>