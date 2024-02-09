<!-- memanggil tamplate layout  -->
<?= $this->extend('dashboard/layout/v_template'); ?>
<!-- end  -->

<!-- memberi tau section  -->
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card">
        <p class="btn btn-primary my-3">Data Centroid</p>
        <div class="card-body">

            <!-- <a href="/jenis/create" class="mb-4 btn btn-outline-primary">Tambah Jenis Barang</a> -->

            <?php
            if (session()->getFlashdata('pesan')) {
            ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php   } ?>

            <table class="table table-striped" style="width:100%" border="2">
                <thead class="text-primary">
                    <tr>
                        <th>#</th>
                        <th>Centroid</th>
                        <th>Nama Barang</th>
                        <th>Nilai</th>
                        <!-- <th width="10%">Ubah</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($cent as $c) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $c['centroid_nama'] ?></td>
                            <td><?= $c['barang_nama'] ?> ( <?= $c['barang_id'] ?>)</td>
                            <td>[ <?= $c['barang_stokApril'] . ", " . $c['barang_terjualApril'] . ", " . $c['barang_stokMei'] . ", " . $c['barang_terjualMei'] . ", " . $c['barang_stokJuni'] . ", " . $c['barang_terjualJuni'] . ", " . $c['barang_stokJuli'] . ", " . $c['barang_terjualJuli'] . ", " . $c['barang_stokAgus'] . ", " . $c['barang_terjualAgus'] . ", " . $c['barang_stokSept'] . ", " . $c['barang_terjualSept'] ?> ]</td>
                        </tr>
                    <?php  } ?>
                </tbody>


            </table>
            
                <a href="/centroid/ubah" class="btn btn-primary">Ubah Centroid</a> 
           
           
        </div>
    </div>
</div>
<?= $this->endSection() ?>