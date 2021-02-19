<div class="row justify-content-center">
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
                        <a href="<?= base_url('kategori') ?>" class="btn btn-sm btn-secondary">
                            <i class="fas fa-chevron-left"></i> Batal
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open(); ?>
                <div class="form-group">
                    <label for="namaKategori">Nama Kategori</label>
                    <input value="<?= set_value('namaKategori'); ?>" type="text" id="namaKategori" name="namaKategori" class="form-control" placeholder="Nama Kategori...">
                    <?= form_error('namaKategori'); ?>
                </div>
                <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>