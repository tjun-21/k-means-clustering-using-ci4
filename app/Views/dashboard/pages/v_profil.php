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
                                                    <?php 
                                                    foreach ($user as $u) {
                                                    ?>
                                                    <div class="form-group">
                                                        <label class="form-label" for="nama">Username</label>
                                                        <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" name="name" id="name" value="<?= $u['user_nama'] ?>">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('name') ?>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label class="form-label" for="nama">Email</label>
                                                        <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?= $u['user_email'] ?>">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('email') ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="nama">Foto</label>
                                                        <input type="file" class="form-control <?= ($validation->hasError('confirm')) ? 'is-invalid' : ''; ?>" name="foto" id="foto">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('foto') ?>
                                                        </div>
                                                        <span><i>Kosongkan jika tidak ingin mengubah foto</i></span>
                                                    </div>

                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">Update Profil</button>
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