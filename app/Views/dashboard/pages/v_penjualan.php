<!-- memanggil tamplate layout  -->
<?= $this->extend('dashboard/layout/v_template'); ?>
<!-- end  -->

<!-- memberi tau section  -->
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card">
        <p class="btn btn-primary my-3">Data Penjualan Barang</p>
        <div class="card-body">

            <a href="/penjualan/create" class="mb-4 btn btn-outline-primary">Tambah Data Penjualan</a>
            <a href="/penjualan/clustering" class="mb-4 btn btn-outline-primary mx-3">Clustering dengan K-Means</a>

            <?php
            if (session()->getFlashdata('pesan')) {
            ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php   } ?>

            <table id="example" class="table bordered" style="width:100%" border="2">
                <thead class="text-primary">
                    <tr>
                        <th rowspan="2">#</th>
                        <th rowspan="2">Nama Barang</th>
                        <!-- <th rowspan="2">Jenis Barang</th> -->
                        <th rowspan="2">Satuan Barang</th>
                        <th colspan="2">April </th>
                        <th colspan="2">Mei </th>
                        <th colspan="2">Juni </th>
                        <th colspan="2">Juli </th>
                        <th colspan="2">Agustus</th>
                        <th colspan="2">September </th>
                        <th rowspan="2" width="10%">Aksi</th>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <th>Terjual</th>
                        <th>Stok</th>
                        <th>Terjual</th>
                        <th>Stok</th>
                        <th>Terjual</th>
                        <th>Stok</th>
                        <th>Terjual</th>
                        <th>Stok</th>
                        <th>Terjual</th>
                        <th>Stok</th>
                        <th>Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($penjualan as $a) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $a['barang_nama'] ?></td>
                            <!-- <td><?= $a['jenis_nama'] ?></td> -->
                            <td><?= $a['satuan_nama'] ?></td>
                            <td><?= $a['barang_stokApril'] ?></td>
                            <td><?= $a['barang_terjualApril'] ?></td>
                            <td><?= $a['barang_stokMei'] ?></td>
                            <td><?= $a['barang_terjualMei'] ?></td>
                            <td><?= $a['barang_stokJuni'] ?></td>
                            <td><?= $a['barang_terjualJuni'] ?></td>
                            <td><?= $a['barang_stokJuli'] ?></td>
                            <td><?= $a['barang_terjualJuli'] ?></td>
                            <td><?= $a['barang_stokAgus'] ?></td>
                            <td><?= $a['barang_terjualAgus'] ?></td>
                            <td><?= $a['barang_stokSept'] ?></td>
                            <td><?= $a['barang_terjualSept'] ?></td>
                            <td>
                                <a href="/penjualan/edit/<?= $a['barang_id'] ?>" class="ti ti-pencil"></a> |

                                <form action="/penjualan/hapus/<?= $a['barang_id'] ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="ti ti-trash text-primary border-none" style="border: none; background: none;" onclick="return confirm('apakah anda yakin ingin menghapus data penjualan barang dengan nama <?= $a['barang_nama'] ?> ?')"></button>
                                </form>

                            </td>

                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>