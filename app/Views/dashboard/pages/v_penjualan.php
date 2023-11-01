<!-- memanggil tamplate layout  -->
<?= $this->extend('dashboard/layout/v_template'); ?>
<!-- end  -->

<!-- memberi tau section  -->
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card">
        <p class="btn btn-primary my-3">Data Alumni</p>
        <div class="card-body">

            <a href="/alumni/create" class="mb-4 btn btn-outline-primary">Tambah Data Alumni</a>

            <?php
            if (session()->getFlashdata('pesan')) {
            ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php   } ?>

            <table id="example" class="table table-striped" style="width:100%" border="2">
                <thead class="text-primary">
                    <tr>
                        <th rowspan="2">#</th>
                        <th rowspan="2">Nama Barang</th>
                        <th colspan="3" align="middle">2019 </th>
                        <th colspan="3">2020 </th>
                        <th colspan="3">2021 </th>
                        <th rowspan="2" width="10%">Aksi</th>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <th>Terjual</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Terjual</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Terjual</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($alumni as $a) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $a['nama_barang'] ?></td>
                            <td><?= $a['stok19'] ?></td>
                            <td><?= $a['terjual19'] ?></td>
                            <td><?= $a['harga19'] ?></td>
                            <td><?= $a['stok20'] ?></td>
                            <td><?= $a['terjual20'] ?></td>
                            <td><?= $a['harga20'] ?></td>
                            <td><?= $a['stok21'] ?></td>
                            <td><?= $a['terjual21'] ?></td>
                            <td><?= $a['harga21'] ?></td>
                            <td>
                                <a href="/penjualan/<?= $a['penjualan_id'] ?>" class="ti ti-article"></a> |
                                <a href="/penjualan/edit/<?= $a['penjualan_id'] ?>" class="ti ti-pencil"></a> |

                                <form action="/penjualan/hapus/<?= $a['penjualan_id'] ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="ti ti-trash text-primary border-none" style="border: none; background: none;" onclick="return confirm('apakah anda yakin ingin menghapus data alumni dengan nama <?= $a['nama_barang'] ?> ?')"></button>
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