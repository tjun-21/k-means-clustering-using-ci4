<?php

namespace App\Controllers;

use App\Models\CentroidModel;
use App\Models\PenjualanModel;

class Centroid extends BaseController
{
    protected $centroidModel;
    protected $penjualanModel;

    public function __construct()
    {

        $this->centroidModel = new CentroidModel();
        $this->penjualanModel = new PenjualanModel();
    }

    public function index()
    {
        $myQuery = 'SELECT * FROM tb_centroid as c, tb_barang  as b where b.barang_id = c.c_barang_id ';
        $data = [
            'title' => 'K-Means Clustering',
            'sub_title' => "Centroid",
            'cent' => $this->centroidModel->query($myQuery)->getResult('array')
        ];
        // echo view('layouts/v_header', $data);
        return view('dashboard/pages/v_centroid', $data);
        // echo view('layouts/v_footer');
    }



    public function ubah()
    {
        $data = [
            'title' => 'K-Means Clustering',
            'sub_title' => "Form Ubah Centroid",
            'validation' => \Config\Services::validation(),
            'centroid' => $this->centroidModel->getData(),
            'penjualan' => $this->penjualanModel->get_data()
        ];
        return view('dashboard/pages/v_ubah_centroid', $data);
    }

    public function update()
    {
        // ambil data alumni berdasarkan nisn
        $jenis = $this->centroidModel->getData();
        // dd($jenis);

        // cek kesamaan data inputan nisn dengan yang di database 
        // if ($jenis['jenis_nama'] == $this->request->getVar('nama')) {
        //     $rule_nama = 'required';
        // } else {
        //     $rule_nama = 'required|is_unique[tb_jenis.jenis_nama]';
        // }


        // if (!$this->validate([
        //     'nama' => [
        //         'rules' => $rule_nama,
        //         'errors' => [
        //             'required' => '{field} tidak boleh kosong',
        //             'is_unique' => '{field} sudah terdaftar'
        //         ],
        //     ]
        // ])) {
        //     $validation = \Config\Services::validation();
        //     $data = [
        //         'title' => 'K-Means Clustering',
        //         'sub_title' => "Form Edit Jenis Barang",
        //         'validation' => $validation,
        //         'jenis' => $this->jenisModel->getJenis($id)
        //     ];
        //     // dd($data);
        //     return view('/dashboard/pages/v_edit_jenis', $data);
        //     // return redirect()->to('/alumni/create')->withInput()->with('validation', $validation);
        // }
        for ($i = 1; $i <= 3; $i++) {
            $idcentro[$i] = $this->request->getVar('cent' . $i);
            $this->centroidModel->save([
                'centroid_id' => $i,
                'c_barang_id' => $idcentro[$i]
            ]);
        }
        // dd($idcentro);
        session()->setFlashdata('pesan', 'Data Centroid  Berhasil di Ubah');
        return redirect()->to('/Centroid');
    }

    // public function hapus($data)
    // {
    //     session()->setFlashdata('pesan', 'Data Jenis Barang Berhasil di Hapus');
    //     $this->jenisModel->delete($data);
    //     return redirect()->to('/jenis');
    // }
}
