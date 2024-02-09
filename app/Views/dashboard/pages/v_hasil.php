<!-- memanggil tamplate layout  -->
<?= $this->extend('dashboard/layout/v_template'); ?>
<!-- end  -->

<!-- memberi tau section  -->
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card">
        <p class="btn btn-primary my-3">Hasil Perhitungan dengan Metode K- Means Clustering</p>
        <div class="card-body">

            <a href="/penjualan" class="mb-4 btn btn-outline-primary">Kembali</a> <br>

            <!-- <p class="btn btn-primary">Total iterasi = <?= $loop ?></p> -->


            <p>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Lihat Detail Perhitungan
                </button>
            </p>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <p>Total iterasi = <?= $loop ?></p>
                    <h4 class="text-center">centroid awal</h4>

                    <?php
                    for ($i = 0; $i < $loop; $i++) {
                    ?>
                        <table class="table table-bordered" border="1">
                            <thead>
                                <tr class="">
                                    <th>centroid</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                    <th>8</th>
                                    <th>9</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($i < 1) {
                                    for ($c = 1; $c <= 3; $c++) { ?>
                                        <tr class="">
                                            <td class="">Centroid <?= $c ?></td>
                                            <?php
                                            for ($j = 0; $j < 12; $j++) {
                                                if ($c == 1) { ?>
                                                    <td><?= $centro1[$i][$j] ?></td>

                                                <?php } elseif ($c == 2) { ?>
                                                    <td><?= $centro2[$i][$j] ?></td>
                                                <?php } elseif ($c == 3) { ?>
                                                    <td><?= $centro3[$i][$j] ?></td>
                                            <?php }
                                            } ?>


                                        </tr>
                                    <?php }
                                } else { ?>
                                    <h4 class="text-center">centroid Baru</h4>
                                    <?php
                                    for ($c = 1; $c <= 3; $c++) { ?>
                                        <tr class="">
                                            <td class="">Centroid <?= $c ?></td>
                                            <?php
                                            for ($j = 0; $j < 12; $j++) {
                                                if ($c == 1) { ?>
                                                    <td><?= number_format($centro1[$i][$j], 2) ?></td>

                                                <?php } elseif ($c == 2) { ?>
                                                    <td><?= number_format($centro2[$i][$j], 2) ?></td>
                                                <?php } elseif ($c == 3) { ?>
                                                    <td><?= number_format($centro3[$i][$j], 2) ?></td>
                                            <?php }
                                            } ?>


                                        </tr>
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                        $t = $i + 1;
                        echo "<br>";
                        echo "<h4 class='text-center'>Iterasi  " . $t . "</h4>";
                        ?>
                        <table class="table table-bordered  text-black" border="1">
                            <thead>
                                <tr class="">
                                    <th width="1%">NO</th>
                                    <th>Nama Barang</th>
                                    <th>Hasil 1</th>
                                    <th>Hasil 2</th>
                                    <th>Hasil 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                for ($d = 1; $d <= 30; $d++) { ?>
                                    <tr>
                                        <td><?= $d ?></td>
                                        <?php
                                        foreach ($penjualan as $p) {
                                            if ($p['barang_id'] == $d) { ?>
                                                <td><?= $p['barang_nama'] ?></td>

                                        <?php }
                                        }
                                        ?>
                                        <?php
                                        for ($t = 0; $t <= 2; $t++) { ?>

                                            <td><?= $hasil[$i][$d][$t] ?></td>


                                            <!-- echo $hasil[$i][$d][$t] . ' -- '; -->
                                        <?php
                                        } ?>
                                    </tr> <?php
                                        } ?>
                            </tbody>
                        </table>



                    <?php } ?>
                </div>
            </div>



            <table id="example" class="table bordered" style="width:100%" border="2">
                <h3 class="text-white bg-primary">
                    <p class="m-3">Cluster 1 (Paling Laris) </p>
                </h3>
                <thead class="text-primary">
                    <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Jenis</th>
                        <th>Satuan</th>
                        <th>Cluster</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($cluster1 as $c1) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $c1['barang_nama'] ?></td>
                            <td><?= $c1['jenis_nama'] ?></td>
                            <td><?= $c1['satuan_nama'] ?></td>
                            <td><?= $c1['barang_cluster'] ?></td>
                        </tr>
                    <?php }
                    ?>
                </tbody>

            </table>
            <br>
            <table id="example2" class="table bordered" style="width:100%" border="2">
                <h3 class="text-white bg-primary">
                    <p class="m-3">Cluster 2 ( Laris) </p>
                </h3>
                <thead class="text-primary">
                    <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Jenis</th>
                        <th>Satuan</th>
                        <th>Cluster</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($cluster2 as $c1) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $c1['barang_nama'] ?></td>
                            <td><?= $c1['jenis_nama'] ?></td>
                            <td><?= $c1['satuan_nama'] ?></td>
                            <td><?= $c1['barang_cluster'] ?></td>
                        </tr>
                    <?php }
                    ?>
                </tbody>

            </table>
            <br>
            <table id="example3" class="table bordered" style="width:100%" border="2">
                <h3 class="text-white bg-primary">
                    <p class="m-3">Cluster 3 (kurang Laris) </p>
                </h3>
                <thead class="text-primary">
                    <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Jenis</th>
                        <th>Satuan</th>
                        <th>Cluster</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($cluster3 as $c1) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $c1['barang_nama'] ?></td>
                            <td><?= $c1['jenis_nama'] ?></td>
                            <td><?= $c1['satuan_nama'] ?></td>
                            <td><?= $c1['barang_cluster'] ?></td>
                        </tr>
                    <?php }
                    ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>