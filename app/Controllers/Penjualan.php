<?php

namespace App\Controllers;

$db = \Config\Database::connect();

use App\Models\PenjualanModel;
// use App\Models\TahunModel;
use Config\App;

class Penjualan extends BaseController
{
    protected $penjualanModel;
    protected $db;
    // protected $tahunModel;
    public function __construct()
    {

        $this->penjualanModel = new PenjualanModel();
        // $this->tahunModel = new TahunModel();
    }
    public function index()
    {
        // $alumni = $this->alumniModel->getAlumni();

        // dd($alumni);
        // $data = [
        //     'title' => 'SMPN5 | Alumni',
        //     'sub_title' => "Alumni",
        //     'alumni' => $this->penjualanModel->get_data(),
        //     // 'tahun' => $this->tahunModel->getTahun()
        // ];


        $data = $this->penjualanModel->get_data();
        $banyak = $this->penjualanModel->JumlahData();
        for ($i = 0; $i < $banyak; $i++) {
            $clusterawal[$i] = "1";
        }

        $centro1[0] = array('80', '40', '100', '78', '160', '80');
        $centro2[0] = array('400', '300', '400', '380', '500', '350');
        $centro3[0] = array('65', '40', '60', '45', '76', '50');

        $status = 'false';
        $loop = '0';
        $x = 0;

        while ($status == 'false') {
            // ambil semua data penjulan 
            $data2 = $this->penjualanModel->get_data();


            foreach ($data2 as $k) {
                $hasilc1 = 0;
                $hasilc2 = 0;
                $hasilc3 = 0;


                //Proses Pencarian Nilai Centro 1
                $hasilc1 = sqrt(pow($k['barang_stok19'] - $centro1[$loop][0], 2) + pow($k['barang_terjual19'] - $centro1[$loop][1], 2) + pow($k['barang_stok20'] - $centro1[$loop][2], 2) + pow($k['barang_terjual20'] - $centro1[$loop][3], 2) + pow($k['barang_stok21'] - $centro1[$loop][4], 2) + pow($k['barang_terjual21'] - $centro1[$loop][5], 2));

                //Proses Pencarian Nilai Centro 2
                $hasilc2 = sqrt(pow($k['barang_stok19'] - $centro2[$loop][0], 2) + pow($k['barang_terjual19'] - $centro2[$loop][1], 2) + pow($k['barang_stok20'] - $centro2[$loop][2], 2) + pow($k['barang_terjual20'] - $centro2[$loop][3], 2) + pow($k['barang_stok21'] - $centro2[$loop][4], 2) + pow($k['barang_terjual21'] - $centro2[$loop][5], 2));

                //Proses Pencarian Nilai Centro 3
                $hasilc3 = sqrt(pow($k['barang_stok19'] - $centro3[$loop][0], 2) + pow($k['barang_terjual19'] - $centro3[$loop][1], 2) + pow($k['barang_stok20'] - $centro3[$loop][2], 2) + pow($k['barang_terjual20'] - $centro3[$loop][3], 2) + pow($k['barang_stok21'] - $centro3[$loop][4], 2) + pow($k['barang_terjual21'] - $centro3[$loop][5], 2));

                // hilangkan komen untuk melihat hasil perhitungan

                $hasil[$loop][$k['barang_id']] =  array($hasilc1, $hasilc2, $hasilc3);




                // echo "<pre>";
                // echo "<hr>";


                if ($hasilc1 < $hasilc2 && $hasilc1 < $hasilc3) {
                    $clusterakhir[$x] = 'C1';
                    $cluster = 'C1';
                    // $where = array(
                    //     'penjualan_id' => $k->penjualan_id
                    // );

                    // $data = array(
                    //     'cluster' => $cluster
                    // );
                    $this->penjualanModel->save([
                        'barang_id' => $k['barang_id'],
                        'barang_cluster' => $cluster
                    ]);

                    // $this->m_data->update_data($where, $data, 'penjualan');
                } else if ($hasilc2 < $hasilc1 && $hasilc2 < $hasilc3) {
                    $clusterakhir[$x] = 'C2';
                    // update_mahasiswa($mysqli, $id, 'C2');
                    $cluster = 'C2';

                    $this->penjualanModel->save([
                        'barang_id' => $k['barang_id'],
                        'barang_cluster' => $cluster
                    ]);
                } else {
                    $clusterakhir[$x] = 'C3';
                    $cluster = 'C3';
                    $this->penjualanModel->save([
                        'barang_id' => $k['barang_id'],
                        'barang_cluster' => $cluster
                    ]);
                    // update_mahasiswa($mysqli, $id, 'C3');
                }

                //Penambhan Counter Index
                $x += 1;
            }
            // dd($clusterakhir);

            $loop += 1;

            $db      = \Config\Database::connect();

            //new centroid1
            $builder  = $db->table('tb_barang')->selectAvg('barang_stok19')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][0] = $c->barang_stok19;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjual19')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][1] = $c->barang_terjual19;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stok20')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][2] = $c->barang_stok20;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjual20')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][3] = $c->barang_terjual20;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stok21')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][4] = $c->barang_stok21;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjual21')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][5] = $c->barang_terjual21;
            }

            //new centroid2
            $builder  = $db->table('tb_barang')->selectAvg('barang_stok19')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][0] = $c->barang_stok19;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjual19')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][1] = $c->barang_terjual19;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stok20')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][2] = $c->barang_stok20;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjual20')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][3] = $c->barang_terjual20;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stok21')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][4] = $c->barang_stok21;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjual21')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][5] = $c->barang_terjual21;
            }


            //new centroid3
            $builder  = $db->table('tb_barang')->selectAvg('barang_stok19')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][0] = $c->barang_stok19;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjual19')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][1] = $c->barang_terjual19;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stok20')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][2] = $c->barang_stok20;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjual20')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][3] = $c->barang_terjual20;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stok21')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][4] = $c->barang_stok21;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjual21')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][5] = $c->barang_terjual21;
            }


            // dd($centro3);


            // dd($x);
            $status = 'true';

            for ($i = 0; $i < $banyak; $i++) {
                if ($clusterawal[$i] != $clusterakhir[$i]) {
                    $status = 'false';
                    $x = 0;
                }
            }
            // dd($clusterakhir);

            if ($status == 'false') {
                $clusterawal = $clusterakhir;
            }

            // dd($clusterawal);
        }

        dd($hasil);



        // coding lama 
        // $data = $this->penjualanModel->get_data();
        // $banyak = $this->penjualanModel->JumlahData();
        // for ($i = 0; $i < $banyak; $i++) {
        //     $clusterawal[$i] = "1";
        // }

        // $centro1[0] = array('15', '11', '139000', '0', '0', '0', '0', '0', '0');
        // $centro2[0] = array('20', '19', '130000', '20', '20', '130000', '18', '14', '135000');
        // $centro3[0] = array('6', '4', '365000', '5', '4', '365000', '0', '0', '0');

        // $status = 'false';
        // $loop = '0';
        // $x = 0;

        // while ($status == 'false') {
        //     // ambil semua data penjulan 
        //     $data2 = $this->penjualanModel->get_data();


        //     foreach ($data2 as $k) {
        //         $hasilc1 = 0;
        //         $hasilc2 = 0;
        //         $hasilc3 = 0;


        //         //Proses Pencarian Nilai Centro 1
        //         $hasilc1 = sqrt(pow($k['stok19'] - $centro1[$loop][0], 2) + pow($k['terjual19'] - $centro1[$loop][1], 2) + pow($k['harga19'] - $centro1[$loop][2], 2) + pow($k['stok20'] - $centro1[$loop][3], 2) + pow($k['terjual20'] - $centro1[$loop][4], 2) + pow($k['harga20'] - $centro1[$loop][5], 2) + pow($k['stok21'] - $centro1[$loop][6], 2) + pow($k['terjual21'] - $centro1[$loop][7], 2) + pow($k['harga21'] - $centro1[$loop][8], 2));

        //         //Proses Pencarian Nilai Centro 2
        //         $hasilc2 = sqrt(pow($k['stok19'] - $centro2[$loop][0], 2) + pow($k['terjual19'] - $centro2[$loop][1], 2) + pow($k['harga19'] - $centro2[$loop][2], 2) + pow($k['stok20'] - $centro2[$loop][3], 2) + pow($k['terjual20'] - $centro2[$loop][4], 2) + pow($k['harga20'] - $centro2[$loop][5], 2) + pow($k['stok21'] - $centro2[$loop][6], 2) + pow($k['terjual21'] - $centro2[$loop][7], 2) + pow($k['harga21'] - $centro2[$loop][8], 2));

        //         //Proses Pencarian Nilai Centro 3
        //         $hasilc3 = sqrt(pow($k['stok19'] - $centro3[$loop][0], 2) + pow($k['terjual19'] - $centro3[$loop][1], 2) + pow($k['harga19'] - $centro3[$loop][2], 2) + pow($k['stok20'] - $centro3[$loop][3], 2) + pow($k['terjual20'] - $centro3[$loop][4], 2) + pow($k['harga20'] - $centro3[$loop][5], 2) + pow($k['stok21'] - $centro3[$loop][6], 2) + pow($k['terjual21'] - $centro3[$loop][7], 2) + pow($k['harga21'] - $centro3[$loop][8], 2));

        //         // hilangkan komen untuk melihat hasil perhitungan

        //         $hasil[$loop][$k['penjualan_id']] =  array($hasilc1, $hasilc2, $hasilc3);




        //         // echo "<pre>";
        //         // echo "<hr>";


        //         if ($hasilc1 < $hasilc2 && $hasilc1 < $hasilc3) {
        //             $clusterakhir[$x] = 'C1';
        //             $cluster = 'C1';
        //             // $where = array(
        //             //     'penjualan_id' => $k->penjualan_id
        //             // );

        //             // $data = array(
        //             //     'cluster' => $cluster
        //             // );
        //             $this->penjualanModel->save([
        //                 'penjualan_id' => $k['penjualan_id'],
        //                 'cluster' => $cluster
        //             ]);

        //             // $this->m_data->update_data($where, $data, 'penjualan');
        //         } else if ($hasilc2 < $hasilc1 && $hasilc2 < $hasilc3) {
        //             $clusterakhir[$x] = 'C2';
        //             // update_mahasiswa($mysqli, $id, 'C2');
        //             $cluster = 'C2';

        //             $this->penjualanModel->save([
        //                 'penjualan_id' => $k['penjualan_id'],
        //                 'cluster' => $cluster
        //             ]);
        //         } else {
        //             $clusterakhir[$x] = 'C3';
        //             $cluster = 'C3';
        //             $this->penjualanModel->save([
        //                 'penjualan_id' => $k['penjualan_id'],
        //                 'cluster' => $cluster
        //             ]);
        //             // update_mahasiswa($mysqli, $id, 'C3');
        //         }

        //         //Penambhan Counter Index
        //         $x += 1;
        //     }
        //     // dd($clusterakhir);

        //     $loop += 1;

        //     $db      = \Config\Database::connect();

        //     //new centroid1
        //     $builder  = $db->table('penjualan')->selectAvg('stok19')->where('cluster', 'C1');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro1[$loop][0] = $c->stok19;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('terjual19')->where('cluster', 'C1');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro1[$loop][1] = $c->terjual19;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('harga19')->where('cluster', 'C1');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro1[$loop][2] = $c->harga19;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('stok20')->where('cluster', 'C1');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro1[$loop][3] = $c->stok20;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('terjual20')->where('cluster', 'C1');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro1[$loop][4] = $c->terjual20;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('harga20')->where('cluster', 'C1');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro1[$loop][5] = $c->harga20;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('stok21')->where('cluster', 'C1');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro1[$loop][6] = $c->stok21;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('terjual21')->where('cluster', 'C1');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro1[$loop][7] = $c->terjual21;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('harga21')->where('cluster', 'C1');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro1[$loop][8] = $c->harga21;
        //     }

        //     //new centroid2
        //     $builder  = $db->table('penjualan')->selectAvg('stok19')->where('cluster', 'C2');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro2[$loop][0] = $c->stok19;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('terjual19')->where('cluster', 'C2');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro2[$loop][1] = $c->terjual19;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('harga19')->where('cluster', 'C2');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro2[$loop][2] = $c->harga19;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('stok20')->where('cluster', 'C2');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro2[$loop][3] = $c->stok20;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('terjual20')->where('cluster', 'C2');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro2[$loop][4] = $c->terjual20;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('harga20')->where('cluster', 'C2');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro2[$loop][5] = $c->harga20;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('stok21')->where('cluster', 'C2');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro2[$loop][6] = $c->stok21;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('terjual21')->where('cluster', 'C2');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro2[$loop][7] = $c->terjual21;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('harga21')->where('cluster', 'C2');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro2[$loop][8] = $c->harga21;
        //     }

        //     //new centroid3
        //     $builder  = $db->table('penjualan')->selectAvg('stok19')->where('cluster', 'C3');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro3[$loop][0] = $c->stok19;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('terjual19')->where('cluster', 'C3');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro3[$loop][1] = $c->terjual19;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('harga19')->where('cluster', 'C3');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro3[$loop][2] = $c->harga19;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('stok20')->where('cluster', 'C3');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro3[$loop][3] = $c->stok20;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('terjual20')->where('cluster', 'C3');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro3[$loop][4] = $c->terjual20;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('harga20')->where('cluster', 'C3');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro3[$loop][5] = $c->harga20;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('stok21')->where('cluster', 'C3');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro3[$loop][6] = $c->stok21;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('terjual21')->where('cluster', 'C3');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro3[$loop][7] = $c->terjual21;
        //     }
        //     $builder  = $db->table('penjualan')->selectAvg('harga21')->where('cluster', 'C3');
        //     $query = $builder->get();
        //     foreach ($query->getResult() as $c) {
        //         $centro3[$loop][8] = $c->harga21;
        //     }

        //     // dd($centro3);


        //     // dd($x);
        //     $status = 'true';

        //     for ($i = 0; $i < $banyak; $i++) {
        //         if ($clusterawal[$i] != $clusterakhir[$i]) {
        //             $status = 'false';
        //             $x = 0;
        //         }
        //     }
        //     // dd($clusterakhir);

        //     if ($status == 'false') {
        //         $clusterawal = $clusterakhir;
        //     }

        //     // dd($clusterawal);
        // }

        // dd($hasil);
    }


    // public function detail($nisn)
    // {
    //     $data = [
    //         'title' => 'SMPN5 | Alumni',
    //         'sub_title' => "Data Alumni",
    //         'alumni' => $this->alumniModel->getAlumni($nisn)
    //     ];

    //     if (empty($data['alumni'])) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException("Data Alumni dengan NISN " . $nisn . ' tidak ditemukan');
    //     }
    //     // $alumni = $this->alumniModel->getAlumni($data);
    //     // dd($data);
    //     return view('dashboard/pages/v_detail', $data);
    // }

    // public function edit($data)
    // {
    //     $data = [
    //         'title' => 'SMPN5 | Alumni',
    //         'sub_title' => "Alumni Edit",
    //         'validation' => \Config\Services::validation(),
    //         'alumni' => $this->alumniModel->getAlumni($data),
    //         'tahun' => $this->tahunModel->getTahun()
    //     ];
    //     return view('dashboard/pages/v_edit', $data);
    // }

    // public function update($id)
    // {
    //     // ambil data alumni berdasarkan nisn
    //     $alumni = $this->alumniModel->getAlumniID($id);

    //     // cek kesamaan data inputan nisn dengan yang di database 
    //     if ($alumni['alumni_nik'] == $this->request->getVar('nik')) {
    //         $rule_nisn = 'required';
    //     } else {
    //         $rule_nisn = 'required|is_unique[tb_alumni.alumni_nik]';
    //     }
    //     // cek kesamaan data inputan nisn dengan yang di database
    //     if ($alumni['alumni_nik'] == $this->request->getVar('nik')) {
    //         $rule_nik = 'required';
    //     } else {
    //         $rule_nik = 'required|is_unique[tb_alumni.alumni_nik]';
    //     }

    //     if (!$this->validate([
    //         'nisn' => [
    //             'rules' => $rule_nisn,
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong',
    //                 'is_unique' => '{field} sudah terdaftar'
    //             ],
    //         ],
    //         'nik' => [
    //             'rules' => $rule_nik,
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong',
    //                 'is_unique' => '{field} sudah terdaftar'
    //             ],
    //         ],
    //         'nama' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'tahun' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'alamat' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'provinsi' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'kecamatan' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'desa' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         't_lahir' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'kabupaten' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'email' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'no' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'tgl_lahir' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} lahir tidak boleh kosong'
    //             ]
    //         ],
    //         'tahun' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'jk' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //     ])) {
    //         $validation = \Config\Services::validation();
    //         $data = [
    //             'title' => 'SMPN5 | Alumni',
    //             'sub_title' => "Alumni",
    //             'validation' => $validation,
    //             'alumni' => $this->alumniModel->getAlumniID($id),
    //             'tahun' => $this->tahunModel->getTahun()
    //         ];
    //         // dd($data);
    //         return view('/dashboard/pages/v_edit', $data);
    //         // return redirect()->to('/alumni/create')->withInput()->with('validation', $validation);
    //     }

    //     $this->alumniModel->save([
    //         'alumni_id' => $id,
    //         'alumni_nisn' => $this->request->getVar('nisn'),
    //         'alumni_nik' => $this->request->getVar('nik'),
    //         'alumni_nama' => $this->request->getVar('nama'),
    //         'alumni_t_lahir' => $this->request->getVar('t_lahir'),
    //         'alumni_tgl_lahir' => $this->request->getVar('tgl_lahir'),
    //         'alumni_jk' => $this->request->getVar('jk'),
    //         'alumni_alamat' => $this->request->getVar('alamat'),
    //         'alumni_prov' => $this->request->getVar('provinsi'),
    //         'alumni_kab' => $this->request->getVar('kabupaten'),
    //         'alumni_kec' => $this->request->getVar('kecamatan'),
    //         'alumni_desa' => $this->request->getVar('desa'),
    //         'alumni_email' => $this->request->getVar('email'),
    //         'alumni_no' => $this->request->getVar('no'),
    //         'alumni_tahun_lulus' => $this->request->getVar('tahun')
    //     ]);
    //     session()->setFlashdata('pesan', 'Data Alumni Berhasil di Ubah');
    //     return redirect()->to('/alumni');
    // }

    // public function hapus($data)
    // {
    //     session()->setFlashdata('pesan', 'Data Alumni Berhasil di Hapus');
    //     $this->alumniModel->delete($data);
    //     return redirect()->to('/alumni');
    // }
    // public function create()
    // {
    //     $data = [
    //         'title' => 'SMPN5 | Alumni',
    //         'sub_title' => "Alumni",
    //         'tahun' => $this->tahunModel->getTahun(),
    //         'validation' => \Config\Services::validation()
    //     ];
    //     return view('dashboard/pages/v_create', $data);
    // }

    // public function save()
    // {

    //     // validation data 
    //     if (!$this->validate([
    //         'nisn' => [
    //             'rules' => 'required|is_unique[tb_alumni.alumni_nisn]',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong',
    //                 'is_unique' => '{field} sudah terdaftar'
    //             ],
    //         ],
    //         'nik' => [
    //             'rules' => 'required|is_unique[tb_alumni.alumni_nik]',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong',
    //                 'is_unique' => '{field} sudah terdaftar'
    //             ],
    //         ],
    //         'nama' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'tahun' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'alamat' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'provinsi' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'kecamatan' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'desa' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         't_lahir' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'kabupaten' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'email' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'no' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'tgl_lahir' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} lahir tidak boleh kosong'
    //             ]
    //         ],
    //         'tahun' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'jk' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong'
    //             ]
    //         ],
    //         'foto' => [
    //             'rules' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
    //             'errors' => [
    //                 'uploaded' => '{field} tidak boleh kosong',
    //                 'max_size' => 'gambar terlalu besar, ukuran max 1 Mb',
    //                 'is_image' => 'file yang anda upload bukan gambar',
    //                 'mime_in' => 'ekstensi yang di izinkan jpg,jpeg,png'
    //             ]
    //         ]
    //     ])) {
    //         $validation = \Config\Services::validation();
    //         $data = [
    //             'title' => 'SMPN5 | Alumni',
    //             'sub_title' => "Alumni",
    //             'validation' => $validation,
    //             'tahun' => $this->tahunModel->getTahun()
    //         ];
    //         // dd($data);
    //         return view('/dashboard/pages/v_create', $data);
    //         // return redirect()->to('/alumni/create')->withInput()->with('validation', $validation);
    //     }
    //     //ambil data gambar yang di upload
    //     $foto = $this->request->getFile('foto');

    //     // generate nama file random 
    //     $namaFoto = $foto->getRandomName();

    //     // pindahkan data gambar ke folder img di public
    //     $foto->move('img/alumni', $namaFoto);

    //     // // dd($namaFoto);





    //     $this->alumniModel->save([
    //         'alumni_nisn' => $this->request->getVar('nisn'),
    //         'alumni_nik' => $this->request->getVar('nik'),
    //         'alumni_nama' => $this->request->getVar('nama'),
    //         'alumni_t_lahir' => $this->request->getVar('t_lahir'),
    //         'alumni_tgl_lahir' => $this->request->getVar('tgl_lahir'),
    //         'alumni_jk' => $this->request->getVar('jk'),
    //         'alumni_alamat' => $this->request->getVar('alamat'),
    //         'alumni_prov' => $this->request->getVar('provinsi'),
    //         'alumni_kab' => $this->request->getVar('kabupaten'),
    //         'alumni_kec' => $this->request->getVar('kecamatan'),
    //         'alumni_desa' => $this->request->getVar('desa'),
    //         'alumni_email' => $this->request->getVar('email'),
    //         'alumni_no' => $this->request->getVar('no'),
    //         'alumni_tahun_lulus' => $this->request->getVar('tahun'),
    //         'alumni_foto' => $namaFoto
    //     ]);
    //     session()->setFlashdata('pesan', 'Data Alumni Baru Berhasil di Tambahkan');
    //     return redirect()->to('/alumni');
    // }
}
