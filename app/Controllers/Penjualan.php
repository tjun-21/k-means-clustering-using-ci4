<?php

namespace App\Controllers;

$db = \Config\Database::connect();

use App\Models\PenjualanModel;
use App\Models\JenisModel;
use App\Models\SatuanModel;
use App\Models\CentroidModel;
// use App\Models\TahunModel;
use Config\App;

class Penjualan extends BaseController
{
    protected $penjualanModel;
    protected $jenisModel;
    protected $satuanModel;
    protected $centroidModel;
    protected $db;
    // protected $tahunModel;
    public function __construct()
    {

        $this->penjualanModel = new PenjualanModel();
        $this->jenisModel = new JenisModel();
        $this->satuanModel = new SatuanModel();
        $this->centroidModel = new CentroidModel();
        // $this->tahunModel = new TahunModel();
    }

    public function clustering()
    {
        $data = $this->penjualanModel->get_data();
        $banyak = $this->penjualanModel->JumlahData();
        for ($i = 0; $i < $banyak; $i++) {
            $clusterawal[$i] = "1";
        }

        // centroid dari database 
        $myQuery = 'SELECT * FROM tb_centroid as c, tb_barang  as b where b.barang_id = c.c_barang_id ';
        $centroid = $this->centroidModel->query($myQuery)->getResult('array');
        $ci = 1;
        foreach ($centroid as $c) {
            ${'centro' . $ci}[0] = array(
                $c['barang_stokApril'], $c['barang_terjualApril'], $c['barang_stokMei'], $c['barang_terjualMei'], $c['barang_stokJuni'], $c['barang_terjualJuni'], $c['barang_stokJuli'], $c['barang_terjualJuli'], $c['barang_stokAgus'], $c['barang_terjualAgus'], $c['barang_stokSept'], $c['barang_terjualSept']
            );
            $ci++;
        }



        // centroid manual 
        // $centro1[0] = array('120', '118', '125', '121', '130', '126', '135', '129', '135', '132', '135', '128');
        // $centro2[0] = array('90', '74', '95', '85', '100', '74', '105', '88', '110', '71', '87', '68');
        // $centro3[0] = array('40', '38', '45', '41', '50', '38', '50', '40', '50', '41', '50', '5');

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
                $hasilc1 = sqrt(pow($k['barang_stokApril'] - $centro1[$loop][0], 2) + pow($k['barang_terjualApril'] - $centro1[$loop][1], 2) + pow($k['barang_stokMei'] - $centro1[$loop][2], 2) + pow($k['barang_terjualMei'] - $centro1[$loop][3], 2) + pow($k['barang_stokJuni'] - $centro1[$loop][4], 2) + pow($k['barang_terjualJuni'] - $centro1[$loop][5], 2) + pow($k['barang_stokJuli'] - $centro1[$loop][6], 2) + pow($k['barang_terjualJuli'] - $centro1[$loop][7], 2) + pow($k['barang_stokAgus'] - $centro1[$loop][8], 2) + pow($k['barang_terjualAgus'] - $centro1[$loop][9], 2) + pow($k['barang_stokSept'] - $centro1[$loop][10], 2) + pow($k['barang_terjualSept'] - $centro1[$loop][11], 2));
                //Proses Pencarian Nilai Centro 2
                $hasilc2 = sqrt(pow($k['barang_stokApril'] - $centro2[$loop][0], 2) + pow($k['barang_terjualApril'] - $centro2[$loop][1], 2) + pow($k['barang_stokMei'] - $centro2[$loop][2], 2) + pow($k['barang_terjualMei'] - $centro2[$loop][3], 2) + pow($k['barang_stokJuni'] - $centro2[$loop][4], 2) + pow($k['barang_terjualJuni'] - $centro2[$loop][5], 2) + pow($k['barang_stokJuli'] - $centro2[$loop][6], 2) + pow($k['barang_terjualJuli'] - $centro2[$loop][7], 2) + pow($k['barang_stokAgus'] - $centro2[$loop][8], 2) + pow($k['barang_terjualAgus'] - $centro2[$loop][9], 2) + pow($k['barang_stokSept'] - $centro2[$loop][10], 2) + pow($k['barang_terjualSept'] - $centro2[$loop][11], 2));
                //Proses Pencarian Nilai Centro 3
                $hasilc3 = sqrt(pow($k['barang_stokApril'] - $centro3[$loop][0], 2) + pow($k['barang_terjualApril'] - $centro3[$loop][1], 2) + pow($k['barang_stokMei'] - $centro3[$loop][2], 2) + pow($k['barang_terjualMei'] - $centro3[$loop][3], 2) + pow($k['barang_stokJuni'] - $centro3[$loop][4], 2) + pow($k['barang_terjualJuni'] - $centro3[$loop][5], 2) + pow($k['barang_stokJuli'] - $centro3[$loop][6], 2) + pow($k['barang_terjualJuli'] - $centro3[$loop][7], 2) + pow($k['barang_stokAgus'] - $centro3[$loop][8], 2) + pow($k['barang_terjualAgus'] - $centro3[$loop][9], 2) + pow($k['barang_stokSept'] - $centro3[$loop][10], 2) + pow($k['barang_terjualSept'] - $centro3[$loop][11], 2));

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


            $loop += 1;

            $db      = \Config\Database::connect();

            //new centroid1
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokApril')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][0] = $c->barang_stokApril;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualApril')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][1] = $c->barang_terjualApril;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokMei')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][2] = $c->barang_stokMei;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualMei')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][3] = $c->barang_terjualMei;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokJuni')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][4] = $c->barang_stokJuni;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualJuni')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][5] = $c->barang_terjualJuni;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokJuli')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][6] = $c->barang_stokJuli;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualJuli')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][7] = $c->barang_terjualJuli;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokAgus')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][8] = $c->barang_stokAgus;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualAgus')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][9] = $c->barang_terjualAgus;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokSept')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][10] = $c->barang_stokSept;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualSept')->where('barang_cluster', 'C1');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro1[$loop][11] = $c->barang_terjualSept;
            }


            //new centroid2
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokApril')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][0] = $c->barang_stokApril;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualApril')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][1] = $c->barang_terjualApril;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokMei')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][2] = $c->barang_stokMei;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualMei')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][3] = $c->barang_terjualMei;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokJuni')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][4] = $c->barang_stokJuni;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualJuni')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][5] = $c->barang_terjualJuni;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokJuli')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][6] = $c->barang_stokJuli;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualJuli')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][7] = $c->barang_terjualJuli;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokAgus')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][8] = $c->barang_stokAgus;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualAgus')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][9] = $c->barang_terjualAgus;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokSept')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][10] = $c->barang_stokSept;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualSept')->where('barang_cluster', 'C2');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro2[$loop][11] = $c->barang_terjualSept;
            }


            //new centroid3
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokApril')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][0] = $c->barang_stokApril;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualApril')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][1] = $c->barang_terjualApril;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokMei')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][2] = $c->barang_stokMei;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualMei')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][3] = $c->barang_terjualMei;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokJuni')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][4] = $c->barang_stokJuni;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualJuni')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][5] = $c->barang_terjualJuni;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokJuli')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][6] = $c->barang_stokJuli;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualJuli')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][7] = $c->barang_terjualJuli;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokAgus')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][8] = $c->barang_stokAgus;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualAgus')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][9] = $c->barang_terjualAgus;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_stokSept')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][10] = $c->barang_stokSept;
            }
            $builder  = $db->table('tb_barang')->selectAvg('barang_terjualSept')->where('barang_cluster', 'C3');
            $query = $builder->get();
            foreach ($query->getResult() as $c) {
                $centro3[$loop][11] = $c->barang_terjualSept;
            }

            $status = 'true';

            for ($i = 0; $i < $banyak; $i++) {
                if ($clusterawal[$i] != $clusterakhir[$i]) {
                    $status = 'false';
                    $x = 0;
                }
            }

            if ($status == 'false') {
                $clusterawal = $clusterakhir;
            }
        }

        // tampilkan hasil perhitungan 
        $cluster1 = $this->centroidModel->query("SELECT * FROM tb_barang as b,tb_jenis as j,tb_satuan as s WHERE b.barang_jenis=j.jenis_id and b.barang_satuan=s.satuan_id and barang_cluster='C1' ")->getResult('array');
        $cluster2 = $this->centroidModel->query("SELECT * FROM tb_barang as b,tb_jenis as j,tb_satuan as s WHERE b.barang_jenis=j.jenis_id and b.barang_satuan=s.satuan_id and barang_cluster='C2'")->getResult('array');
        $cluster3 = $this->centroidModel->query("SELECT * FROM tb_barang as b,tb_jenis as j,tb_satuan as s WHERE b.barang_jenis=j.jenis_id and b.barang_satuan=s.satuan_id and barang_cluster='C3' ")->getResult('array');
        $penjualan = $this->centroidModel->query("SELECT * FROM tb_barang as b,tb_jenis as j,tb_satuan as s WHERE b.barang_jenis=j.jenis_id and b.barang_satuan=s.satuan_id ORDER BY barang_id ASC")->getResult('array');

        // $this->hasil_perhitungan_metode($hasil, $loop, $centro1, $centro2, $centro3);
        $data = [
            'title' => 'K-Means Clustering',
            'sub_title' => "Hasil Perhitungan Metode",
            'loop' => $loop,
            'penjualan' => $penjualan,
            'cluster1' => $cluster1,
            'cluster2' => $cluster2,
            'cluster3' => $cluster3,
            'centro1' => $centro1,
            'centro2' => $centro2,
            'centro3' => $centro3,
            'hasil' => $hasil

        ];
        // echo view('layouts/v_header', $data);
        return view('dashboard/pages/v_hasil', $data);
    }

    private function hasil_perhitungan_metode($hasil, $loop, $centro1, $centro2, $centro3)
    {
        // $data['tampil'] = $this->db->query("SELECT * FROM penjualan,tb_centroid where penjualan = penjualan_id order by centroid_id asc")->result();

        // $data['cluster1'] = $this->centroidModel->query("SELECT * FROM tb_barang as b,tb_jenis as j,tb_satuan as s WHERE b.barang_jenis=j.jenis_id and b.barang_satuan=s.satuan_id and barang_cluster='C1' ")->getResult('array');
        // $data['cluster2'] = $this->centroidModel->query("SELECT * FROM tb_barang as b,tb_jenis as j,tb_satuan as s WHERE b.barang_jenis=j.jenis_id and b.barang_satuan=s.satuan_id and barang_cluster='C2'")->getResult('array');
        // $data['cluster3'] = $this->centroidModel->query("SELECT * FROM tb_barang as b,tb_jenis as j,tb_satuan as s WHERE b.barang_jenis=j.jenis_id and b.barang_satuan=s.satuan_id and barang_cluster='C3'' ")->getResult('array');


        // // $data['kategorii'] = $this->m_data->get_data('tb_jkategori_barang')->result();
        // // // $data['graphh'] = $this->db->query("SELECT penjualan.cluster, COUNT(*) AS the_count FROM penjualan GROUP BY cluster order by the_count asc")->result();
        // // $data['penjualan'] = $this->db->query("SELECT * FROM penjualan,tb_jkategori_barang,tb_merk_barang, tb_jenis_barang WHERE barang_kat=kategori_id and barang_merk=merk_id and barang_jenis=jenis_id")->result();
        // $data['loop'] = $loop;
        // $data['hasil'] = $hasil;
        // $data['centro1'] = $centro1;
        // $data['centro2'] = $centro2;
        // $data['centro3'] = $centro3;

    }

    public function index()
    {
        $myQuery = 'SELECT * FROM tb_barang as b, tb_satuan as s, tb_jenis as j where b.barang_satuan = s.satuan_id and b.barang_jenis=j.jenis_id';
        $data = [
            'title' => 'K-Means Clustering',
            'sub_title' => "Data Penjualan Barang",
            'penjualan' => $this->penjualanModel->query($myQuery)->getResult('array')
        ];
        // echo view('layouts/v_header', $data);
        return view('dashboard/pages/v_penjualan', $data);
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

    public function edit($data)
    {
        $data = [
            'title' => 'K-Means Clustering',
            'sub_title' => "Edit Data Penjualan Barang",
            'validation' => \Config\Services::validation(),
            'penjualan' => $this->penjualanModel->get_data($data),
            'jenis' => $this->jenisModel->getJenis(),
            'satuan' => $this->satuanModel->getSatuan()
        ];
        // echo view('layouts/v_header', $data);
        // return view('dashboard/pages/v_penjualan', $data);
        // $data = [
        //     'title' => 'SMPN5 | Alumni',
        //     'sub_title' => "Alumni Edit",
        //     'validation' => \Config\Services::validation(),
        //     'alumni' => $this->alumniModel->getAlumni($data),
        //     'tahun' => $this->tahunModel->getTahun()
        // ];
        return view('dashboard/pages/v_edit', $data);
    }

    public function update($id)
    {

        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ],
            ],
            'jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ],
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'stokApril' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'terjualApril' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'stokMei' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'terjualMei' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'stokJuni' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'terjualJuni' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'stokJuli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'terjualJuli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'stokAgus' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'terjualAgus' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'stokSept' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'terjualSept' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ])) {
            $data = [
                'title' => 'K-Means Clustering',
                'sub_title' => "Edit Data Penjualan Barang",
                'validation' => \Config\Services::validation(),
                'penjualan' => $this->penjualanModel->get_data($id),
                'jenis' => $this->jenisModel->getJenis(),
                'satuan' => $this->satuanModel->getSatuan()
            ];
            // dd($data);
            return view('/dashboard/pages/v_edit', $data);
            // return redirect()->to('/alumni/create')->withInput()->with('validation', $validation);
        }

        $this->penjualanModel->save([
            'barang_id' => $id,
            'barang_nama' => $this->request->getVar('nama'),
            'barang_jenis' => $this->request->getVar('jenis'),
            'barang_satuan' => $this->request->getVar('satuan'),
            'barang_stokApril' => $this->request->getVar('stokApril'),
            'barang_terjualApril' => $this->request->getVar('terjualApril'),
            'barang_stokMei' => $this->request->getVar('stokMei'),
            'barang_terjualMei' => $this->request->getVar('terjualMei'),
            'barang_stokJuni' => $this->request->getVar('stokJuni'),
            'barang_terjualJuni' => $this->request->getVar('terjualJuni'),
            'barang_stokJuli' => $this->request->getVar('stokJuli'),
            'barang_terjualJuli' => $this->request->getVar('terjualJuli'),
            'barang_stokAgus' => $this->request->getVar('stokAgus'),
            'barang_terjualAgus' => $this->request->getVar('terjualAgus'),
            'barang_stokSept' => $this->request->getVar('stokSept'),
            'barang_terjualSept' => $this->request->getVar('terjualSept')
        ]);
        session()->setFlashdata('pesan', 'Data Penjualan Berhasil di Ubah');
        return redirect()->to('/penjualan');
    }

    public function hapus($data)
    {
        session()->setFlashdata('pesan', 'Data Penjualan Berhasil di Hapus');
        $this->penjualanModel->delete($data);
        return redirect()->to('/penjualan');
    }

    public function create()
    {
        $data = [
            'title' => 'K-Means Clustering',
            'sub_title' => "Data Penjualan Barang",
            'jenis' => $this->jenisModel->getJenis(),
            'satuan' => $this->satuanModel->getSatuan(),
            'validation' => \Config\Services::validation()
        ];

        return view('dashboard/pages/v_create', $data);
    }

    public function save()
    {

        // validation data 
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ],
            ],
            'jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ],
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'stokApril' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'terjualApril' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'stokMei' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'terjualMei' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'stokJuni' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'terjualJuni' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'stokJuli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'terjualJuli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'stokAgus' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'terjualAgus' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'stokSept' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'terjualSept' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ])) {
            $data = [
                'title' => 'K-Means Clustering',
                'sub_title' => "Data Penjualan Barang",
                'jenis' => $this->jenisModel->getJenis(),
                'satuan' => $this->satuanModel->getSatuan(),
                'validation' => \Config\Services::validation()
            ];
            // dd($data);
            return view('/dashboard/pages/v_create', $data);
            // return redirect()->to('/alumni/create')->withInput()->with('validation', $validation);
        }

        $this->penjualanModel->save([
            'barang_nama' => $this->request->getVar('nama'),
            'barang_jenis' => $this->request->getVar('jenis'),
            'barang_satuan' => $this->request->getVar('satuan'),
            'barang_stokApril' => $this->request->getVar('stokApril'),
            'barang_terjualApril' => $this->request->getVar('terjualApril'),
            'barang_stokMei' => $this->request->getVar('stokMei'),
            'barang_terjualMei' => $this->request->getVar('terjualMei'),
            'barang_stokJuni' => $this->request->getVar('stokJuni'),
            'barang_terjualJuni' => $this->request->getVar('terjualJuni'),
            'barang_stokJuli' => $this->request->getVar('stokJuli'),
            'barang_terjualJuli' => $this->request->getVar('terjualJuli'),
            'barang_stokAgus' => $this->request->getVar('stokAgus'),
            'barang_terjualAgus' => $this->request->getVar('terjualAgus'),
            'barang_stokSept' => $this->request->getVar('stokSept'),
            'barang_terjualSept' => $this->request->getVar('terjualSept')
        ]);
        session()->setFlashdata('pesan', 'Data Penjualan Baru Berhasil di Tambahkan');
        return redirect()->to('/penjualan');
    }
}
