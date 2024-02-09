<?= $this->extend('dashboard/layout/v_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card">
        <!-- <a href="/barang" class="btn btn-primary my-3">Kembali ke data barang</a> -->
        <p class="btn btn-primary my-3">Form Ubah Data Centroid</p>
        <div class="card-body">
            <a href="/centroid" class="mb-4 btn btn-outline-primary">Kembali</a>
            <form action="/centroid/update" method="post">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-lg-9 text-primary">
                        <div class="box box-primary">
                            <div class="box-body">
                                <?php
                                foreach ($centroid as $c) {
                                    if ($c['centroid_id'] == 1) { ?>
                                        <div class="form-group mb-4">
                                            <label class="mb-2">Centroid 1</label>
                                            <select class="form-control <?= ($validation->hasError('cent1')) ? 'is-invalid' : ''; ?>" name="cent1">
                                                <option value="">- Pilih Jenis Barang -</option>
                                                <?php foreach ($penjualan as $j) { ?>
                                                    <option <?php if ($c['c_barang_id'] == $j['barang_id']) {
                                                                echo "selected='selected' ";
                                                            } ?> value="<?= $j['barang_id'] ?>">( <?= $j['barang_id'] ?> ) <?= $j['barang_nama'] . " " ?>[ &nbsp; <?= $j['barang_stokApril'] ?>, <?= $j['barang_terjualApril'] ?>, <?= $j['barang_stokMei'] ?>, <?= $j['barang_terjualMei'] ?>, <?= $j['barang_stokJuni'] ?>, <?= $j['barang_terjualJuni'] ?>, <?= $j['barang_stokJuli'] ?>, <?= $j['barang_terjualJuli'] ?>, <?= $j['barang_stokAgus'] ?>, <?= $j['barang_terjualAgus'] ?>, <?= $j['barang_stokSept'] ?>, <?= $j['barang_terjualSept'] ?> ] </option>
                                                    <div class=" invalid-feedback">
                                                        <?= $validation->getError('cent1') ?>
                                                    </div>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    <?php
                                    } elseif ($c['centroid_id'] == 2) { ?>
                                        <div class="form-group mb-4">
                                            <label class="mb-2">Centroid 2</label>
                                            <select class="form-control <?= ($validation->hasError('cent2')) ? 'is-invalid' : ''; ?>" name="cent2">
                                                <option value="">- Pilih Jenis Barang -</option>
                                                <?php foreach ($penjualan as $j) { ?>
                                                    <option <?php if ($c['c_barang_id'] == $j['barang_id']) {
                                                                echo "selected='selected' ";
                                                            } ?> value="<?= $j['barang_id'] ?>">( <?= $j['barang_id'] ?> ) <?= $j['barang_nama'] . " " ?>[ &nbsp; <?= $j['barang_stokApril'] ?>, <?= $j['barang_terjualApril'] ?>, <?= $j['barang_stokMei'] ?>, <?= $j['barang_terjualMei'] ?>, <?= $j['barang_stokJuni'] ?>, <?= $j['barang_terjualJuni'] ?>, <?= $j['barang_stokJuli'] ?>, <?= $j['barang_terjualJuli'] ?>, <?= $j['barang_stokAgus'] ?>, <?= $j['barang_terjualAgus'] ?>, <?= $j['barang_stokSept'] ?>, <?= $j['barang_terjualSept'] ?> ] </option>
                                                    <div class=" invalid-feedback">
                                                        <?= $validation->getError('cent2') ?>
                                                    </div>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    <?php
                                    } elseif ($c['centroid_id'] == 3) { ?>
                                        <div class="form-group">
                                            <label class="mb-2">Centroid 3</label>
                                            <select class="form-control <?= ($validation->hasError('cent3')) ? 'is-invalid' : ''; ?>" name="cent3">
                                                <option value="">- Pilih Jenis Barang -</option>
                                                <?php foreach ($penjualan as $j) { ?>
                                                    <option <?php if ($c['c_barang_id'] == $j['barang_id']) {
                                                                echo "selected='selected' ";
                                                            } ?> value="<?= $j['barang_id'] ?>">( <?= $j['barang_id'] ?> ) <?= $j['barang_nama'] . " " ?>[ &nbsp; <?= $j['barang_stokApril'] ?>, <?= $j['barang_terjualApril'] ?>, <?= $j['barang_stokMei'] ?>, <?= $j['barang_terjualMei'] ?>, <?= $j['barang_stokJuni'] ?>, <?= $j['barang_terjualJuni'] ?>, <?= $j['barang_stokJuli'] ?>, <?= $j['barang_terjualJuli'] ?>, <?= $j['barang_stokAgus'] ?>, <?= $j['barang_terjualAgus'] ?>, <?= $j['barang_stokSept'] ?>, <?= $j['barang_terjualSept'] ?> ] </option>
                                                    <div class=" invalid-feedback">
                                                        <?= $validation->getError('cent3') ?>
                                                    </div>
                                                <?php } ?>
                                            </select>
                                        </div>
                                <?php }
                                }
                                ?>




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