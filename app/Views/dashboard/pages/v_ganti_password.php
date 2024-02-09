<!-- memanggil tamplate layout  -->
<?= $this->extend('dashboard/layout/v_template'); ?>
<!-- end  -->

<!-- memberi tau section  -->
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="col-lg-6">
        <div class="card">
            <p class="btn btn-primary my-3"><?= $sub_title ?></p>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-12">

                        <div class="box box-primary">
                            <div class="box-header">
                                <!-- <h3 class="box-title">Ganti Password</h3> -->
                            </div>
                            <div class="box-body">
                                <?php
                                if (session()->getFlashdata('pesan')) {
                                ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('pesan') ?>
                                    </div>
                                <?php   } ?>
                                <form action="/dashboard/update_password" method="post" enctype="multipart/form-data">
                                    <?= csrf_field() ?>

                                    <div class="row">
                                        <div class="col-lg-9">

                                            <div class="box box-primary">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label class="form-label" for="nama">Password Lama</label>
                                                        <input type="text" class="form-control <?= ($validation->hasError('pass')) ? 'is-invalid' : ''; ?>" name="pass" id="pass" autofocus>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('pass') ?>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label class="form-label" for="nama">Password Baru</label>
                                                        <input type="text" class="form-control <?= ($validation->hasError('new')) ? 'is-invalid' : ''; ?>" name="new" id="new">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('new') ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="nama">Konfirmasi Password</label>
                                                        <input type="text" class="form-control <?= ($validation->hasError('confirm')) ? 'is-invalid' : ''; ?>" name="confirm" id="confirm">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('confirm') ?>
                                                        </div>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">Update Password</button>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>