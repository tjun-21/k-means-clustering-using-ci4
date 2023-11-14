<!-- memanggil tamplate layout  -->
<?= $this->extend('dashboard/layout/v_template'); ?>
<!-- end  -->

<!-- memberi tau section  -->
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card">
        <p class="btn btn-primary my-3">Data Satuan Barang</p>
        <div class="card-body">

            <a href="/satuan/create" class="mb-4 btn btn-outline-primary">Tambah Satuan Barang</a>

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
                        <th>#</th>
                        <th>Satuan Barang</th>
                        <th>Satuan</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($satuan as $a) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $a['satuan_baca'] ?></td>
                            <td><?= $a['satuan_nama'] ?></td>
                            <td>
                                <a href="/satuan/edit/<?= $a['satuan_id'] ?>" class="ti ti-pencil"></a> |

                                <form action="/satuan/hapus/<?= $a['satuan_id'] ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="ti ti-trash text-primary border-none" style="border: none; background: none;" onclick="return confirm('apakah anda yakin ingin menghapus data Satuan dengan nama <?= $a['satuan_nama'] ?> ?')"></button>
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