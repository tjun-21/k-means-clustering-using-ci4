<?= $this->extend('dashboard/layout/v_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card">
        <!-- <a href="/alumni" class="btn btn-primary my-3">Kembali ke data alumni</a> -->
        <p class="btn btn-primary my-3">Form Tambah Data Alumni</p>
        <div class="card-body">
            <a href="/alumni" class="mb-4 btn btn-outline-primary">Kembali</a>
            <form action="/alumni/save" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-lg-5">

                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="form-label" for="nisn">NISN</label>
                                    <input type="number" class="form-control <?= ($validation->hasError('nisn')) ? 'is-invalid' : ''; ?>" name="nisn" id="nisn" autofocus>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nisn') ?>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" id="alamat" placeholder="Misal : Nama Jalan, Bangunan, Dll">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('alamat') ?>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <label class="form-label" for="provinsi">Provinsi</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('provinsi')) ? 'is-invalid' : ''; ?>" name="provinsi" id="provinsi">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('provinsi') ?>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <label class="form-label" for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>" name="kecamatan" id="kecamatan">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('kecamatan') ?>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <label class="form-label" for="desa">Desa</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('desa')) ? 'is-invalid' : ''; ?>" name="desa" id="desa">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('desa') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="form-label" for="nik">NIK</label>
                                    <input type="number" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" name="nik" id="nik">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nik') ?>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('t_lahir')) ? 'is-invalid' : ''; ?>" name="t_lahir" id="t_lahir">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('t_lahir') ?>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <label class="form-label" for="kabupaten">Kabupaten / Kota</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('kabupaten')) ? 'is-invalid' : ''; ?>" name="kabupaten" id="kabupaten">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('kabupaten') ?>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email') ?>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <label class="form-label" for="no">No Hp</label>
                                    <input type="number" class="form-control <?= ($validation->hasError('no')) ? 'is-invalid' : ''; ?>" name="no" id="no">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('no') ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="form-label" for="nama">Nama</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama') ?>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control <?= ($validation->hasError('tgl_lahir')) ? 'is-invalid' : ''; ?>" name="tgl_lahir" id="tgl_lahir">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tgl_lahir') ?>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <label class="form-label">Tahun Lulus</label>
                                    <select class="form-select" name="tahun">
                                        <option selected>-- Lulusan Tahun --</option>
                                        <?php
                                        foreach ($tahun as $t) {
                                        ?>
                                            <option value="<?= $t['tahun_id'] ?>"><?= $t['tahun_nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group mt-4">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" name="jk">
                                        <option selected>-- Pilih Jenis Kelamin --</option>
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group mt-4">
                                    <label class="form-label" for="Foto">Foto Alumni</label>

                                    <input type="file" name="foto" id="foto">
                                    <?php
                                    if ($validation->hasError('foto')) { ?>
                                        <p class="text-danger"><i><?= $validation->getError('foto'); ?></i></p>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>