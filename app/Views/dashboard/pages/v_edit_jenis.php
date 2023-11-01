<?= $this->extend('dashboard/layout/v_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card">
        <!-- <a href="/alumni" class="btn btn-primary my-3">Kembali ke data alumni</a> -->
        <p class="btn btn-primary my-3">Form Tambah Data Jenis Barang</p>
        <div class="card-body">
            <a href="/jenis" class="mb-4 btn btn-outline-primary">Kembali</a>
            <form action="/jenis/update/<?= $jenis['jenis_id'] ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-lg-9">

                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="form-label" for="nama">Nama Jenis Barang</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama" value="<?= $jenis['jenis_nama'] ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama') ?>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>