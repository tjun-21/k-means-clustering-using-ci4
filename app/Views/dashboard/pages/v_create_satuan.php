<?= $this->extend('dashboard/layout/v_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card">
        <!-- <a href="/alumni" class="btn btn-primary my-3">Kembali ke data alumni</a> -->
        <p class="btn btn-primary my-3">Form Tambah Data Satuan Barang</p>
        <div class="card-body">
            <a href="/satuan" class="mb-4 btn btn-outline-primary">Kembali</a>
            <form action="/satuan/save" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-lg-9">

                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="form-label" for="nama">Nama Satuan Barang</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama" autofocus>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="baca">Satuan Dibaca</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="baca" id="baca" autofocus>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('baca') ?>
                                    </div>
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