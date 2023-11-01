<!-- memanggil tamplate layout  -->
<?= $this->extend('dashboard/layout/v_template'); ?>
<!-- end  -->

<!-- memberi tau section  -->
<?= $this->section('content') ?>
<div class="container-fluid">

    <div class="card">
        <a href="/alumni" class="btn btn-primary my-3">Kembali ke data alumni</a>
        <div class="card-body">
            <div class="card mb-3">
                <div class=" row g-0">
                    <div class="col-md-2">
                        <?php if ($alumni['alumni_foto'] != null) { ?>
                            <img src="../img/alumni/<?= $alumni['alumni_foto'] ?>" class="img-fluid rounded-start m-4 " width="180" alt="" />
                        <?php } else { ?>
                            <img src="../assets/images/profile/user-1.jpg" class="img-fluid rounded-start m-4 " width="180" alt="" />
                        <?php } ?>
                    </div>
                    <div class="col-md-10">
                        <div class="card-body" style="float:left">
                            <h5 class="card-title">Detail Data Siswa</h5>
                            <table class="table table-borderless" align=left>

                                <tr>
                                    <td>NISN </td>
                                    <td>:</td>
                                    <td><?= $alumni['alumni_nisn'] ?></td>
                                    <td width="100px"></td>
                                    <td>Tahun Lulus </td>
                                    <td>:</td>
                                    <td>2021</td>
                                </tr>
                                <tr>
                                    <td>NIK </td>
                                    <td>:</td>
                                    <td><?= $alumni['alumni_nik'] ?></td>
                                    <td width="100px"></td>
                                    <td>No. HP </td>
                                    <td>:</td>
                                    <td><?= $alumni['alumni_no'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama </td>
                                    <td>:</td>
                                    <td><?= $alumni['alumni_nama'] ?></td>
                                    <td width="100px"></td>
                                    <td>Alamat Email </td>
                                    <td>:</td>
                                    <td><?= $alumni['alumni_email'] ?></td>
                                </tr>
                                <tr class="mt-0">
                                    <td>Tempat & Tanggal Lahir </td>
                                    <td>:</td>
                                    <td colspan="2"><?= $alumni['alumni_t_lahir'] ?>, <?= $alumni['alumni_tgl_lahir'] ?></td>

                                    <td>Jenis Kelamin </td>
                                    <td>:</td>
                                    <td>Laki - Laki</td>
                                </tr>
                                <tr>
                                    <td>Alamat </td>
                                    <td>:</td>
                                    <td colspan="3"><?= $alumni['alumni_alamat'] ?>,Desa <?= $alumni['alumni_desa'] ?>, Kec. <?= $alumni['alumni_kec'] ?>,<br> Kab. <?= $alumni['alumni_kab'] ?>, <br> <?= $alumni['alumni_prov'] ?></td>


                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>