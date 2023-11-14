<?= $this->extend('dashboard/layout/v_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card">
        <!-- <a href="/barang" class="btn btn-primary my-3">Kembali ke data barang</a> -->
        <p class="btn btn-primary my-3">Form Ubah Data Penjualan</p>
        <div class="card-body">
            <a href="/penjualan" class="mb-4 btn btn-outline-primary">Kembali</a>
            <form action="/penjualan/update/<?= $penjualan['barang_id'] ?>" method="post">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-lg-9">

                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="form-label" for="nisn">Nama</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama" autofocus value="<?= $penjualan['barang_nama'] ?>" placeholder="masukkan nama barang">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4 text-primary">
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="mb-2">Stok April</label>
                                                <input type="number" class="form-control <?= ($validation->hasError('stokApril')) ? 'is-invalid' : ''; ?>" name="stokApril" id="stok19" placeholder="Masukkan Stock April..." value="<?= $penjualan['barang_stokApril'] ?>">
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('stokApril') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="mb-2">Terjual April</label>
                                                <input type="number" name="terjualApril" class="form-control <?= ($validation->hasError('terjualApril')) ? 'is-invalid' : ''; ?>" placeholder="Masukkan jumlah terjual April..." value="<?= $penjualan['barang_terjualApril'] ?>">
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('terjualApril') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 text-primary">
                                    <div class="col-md-6 ">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="mb-2">Stok Mei</label>
                                                <input type="number" name="stokMei" class="form-control <?= ($validation->hasError('stokMei')) ? 'is-invalid' : ''; ?>" placeholder="Masukkan jumlah Stok Mei..." value="<?= $penjualan['barang_stokMei'] ?>">
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('stokMei') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="mb-2">Terjual Mei</label>
                                                <input type="number" name="terjualMei" class="form-control <?= ($validation->hasError('terjualMei')) ? 'is-invalid' : ''; ?>" placeholder="Masukkan jumlah Terjual Mei..." value="<?= $penjualan['barang_terjualMei'] ?>">
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('terjualMei') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 text-primary">
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="mb-2">Stok Juni</label>
                                                <input type="number" name="stokJuni" class="form-control <?= ($validation->hasError('stokJuni')) ? 'is-invalid' : ''; ?>" placeholder="Masukkan jumlah Stok  juni..." value="<?= $penjualan['barang_stokJuni'] ?>">
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('stokJuni') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="mb-2">Terjual Juni</label>
                                                <input type="number" name="terjualJuni" class="form-control <?= ($validation->hasError('terjualJuni')) ? 'is-invalid' : ''; ?>" placeholder="Masukkan jumlah Terjual Juni..." value="<?= $penjualan['barang_terjualJuni'] ?>">
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('terjualJuni') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 text-primary">
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="mb-2">Stok Juli</label>
                                                <input type="number" name="stokJuli" class="form-control <?= ($validation->hasError('stokJuli')) ? 'is-invalid' : ''; ?>" placeholder="Masukkan jumlah Stok  Juli..." value="<?= $penjualan['barang_stokJuli'] ?>">
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('stokJuli') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="mb-2">Terjual Juli</label>
                                                <input type="number" name="terjualJuli" class="form-control <?= ($validation->hasError('terjualJuli')) ? 'is-invalid' : ''; ?>" placeholder="Masukkan jumlah Terjual Juli..." value="<?= $penjualan['barang_terjualJuli'] ?>">
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('terjualJuli') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 text-primary">
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="mb-2">Stok Agustus</label>
                                                <input type="number" name="stokAgus" class="form-control <?= ($validation->hasError('stokAgus')) ? 'is-invalid' : ''; ?>" placeholder="Masukkan jumlah Stok  Agustus..." value="<?= $penjualan['barang_stokAgus'] ?>">
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('stokAgus') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="mb-2">Terjual Agustus</label>
                                                <input type="number" name="terjualAgus" class="form-control <?= ($validation->hasError('terjualAgus')) ? 'is-invalid' : ''; ?>" placeholder="Masukkan jumlah Terjual Agustus..." value="<?= $penjualan['barang_terjualAgus'] ?>">
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('terjualAgus') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 text-primary">
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="mb-2">Stok September</label>
                                                <input type="number" name="stokSept" class="form-control <?= ($validation->hasError('stokSept')) ? 'is-invalid' : ''; ?>" placeholder="Masukkan jumlah Stok  September..." value="<?= $penjualan['barang_stokSept'] ?>">
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('stokSept') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="mb-2">Terjual September</label>
                                                <input type="number" name="terjualSept" class="form-control <?= ($validation->hasError('terjualSept')) ? 'is-invalid' : ''; ?>" placeholder="Masukkan jumlah Terjual September..." value="<?= $penjualan['barang_terjualSept'] ?>">
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('terjualSept') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-3 text-primary">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="mb-2">Jenis</label>
                                    <select class="form-control <?= ($validation->hasError('jenis')) ? 'is-invalid' : ''; ?>" name="jenis">
                                        <option value="">- Pilih Jenis Barang -</option>
                                        <?php foreach ($jenis as $j) { ?>
                                            <option <?php if ($penjualan['barang_jenis'] == $j['jenis_id']) {
                                                        echo "selected='selected' ";
                                                    } ?> value="<?= $j['jenis_id'] ?>"><?= $j['jenis_nama'] ?></option>
                                            <div class=" invalid-feedback">
                                                <?= $validation->getError('jenis') ?>
                                            </div>
                                        <?php } ?>
                                    </select>

                                </div>

                                <div class="form-group mt-4 mb-4">
                                    <label class="mb-2">Satuan</label>
                                    <select class="form-control <?= ($validation->hasError('satuan')) ? 'is-invalid' : ''; ?>" name="satuan">
                                        <option value="">- Pilih Satuan Barang -</option>
                                        <?php foreach ($satuan as $s) { ?>
                                            <option <?php if ($penjualan['barang_satuan'] == $s['satuan_id']) {
                                                        echo "selected='selected'";
                                                    } ?> value="<?= $s['satuan_id'] ?>"><?= $s['satuan_nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">Update Data</button>

                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>