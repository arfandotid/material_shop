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
                        <a href="<?= base_url('barang') ?>" class="btn btn-sm btn-secondary">
                            <i class="fas fa-chevron-left"></i> Batal
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open(); ?>
                <div class="form-group">
                    <label for="kdBarang">Kode Barang</label>
                    <input value="<?= set_value('kdBarang', $kdBarang); ?>" readonly="readonly" type="text" id="kdBarang" class="form-control" placeholder="Kode Barang...">
                    <?= form_error('kdBarang'); ?>
                </div>
                <div class="form-group">
                    <label for="namaBarang">Nama Barang</label>
                    <input value="<?= set_value('namaBarang'); ?>" type="text" id="namaBarang" name="namaBarang" class="form-control" placeholder="Nama Barang...">
                    <?= form_error('namaBarang'); ?>
                </div>
                <div class="form-group">
                    <label for="idKategori">Kategori</label>
                    <select id="idKategori" name="idKategori" class="form-control">
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($kategori as $k) : ?>
                            <option value="<?= $k->idKategori ?>"><?= $k->namaKategori ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('idKategori'); ?>
                </div>
                <div class="form-group">
                    <label for="stok">Stok Awal</label>
                    <input value="<?= set_value('stok'); ?>" type="number" id="stok" name="stok" class="form-control" placeholder="Stok Awal...">
                    <?= form_error('stok'); ?>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp. </span>
                        </div>
                        <input value="<?= set_value('harga'); ?>" type="number" id="harga" name="harga" class="form-control" placeholder="Harga...">
                    </div>
                    <?= form_error('harga'); ?>
                </div>
                <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                <?= form_close(); ?>
                </select>
            </div>
        </div>
    </div>