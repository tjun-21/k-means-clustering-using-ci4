<?php

namespace App\Controllers;

use App\Models\JenisModel;

class Jenis extends BaseController
{
    protected $jenisModel;

    public function __construct()
    {

        $this->jenisModel = new JenisModel();
        // $this->tahunModel = new TahunModel();
    }

    public function index()
    {
        $data = [
            'title' => 'K-Means Clustering',
            'sub_title' => "Jenis Barang",
            'jenis' => $this->jenisModel->getJenis()
        ];
        // echo view('layouts/v_header', $data);
        return view('dashboard/pages/v_jenis', $data);
        // echo view('layouts/v_footer');
    }

    public function create()
    {
        $data = [
            'title' => 'K-Means Clustering',
            'sub_title' => "Form Tambah Jenis Barang",
            'jenis' => $this->jenisModel->getJenis(),
            'validation' => \Config\Services::validation()
        ];
        return view('dashboard/pages/v_create_jenis', $data);
    }

    public function save()
    {
        // validation data 
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[tb_jenis.jenis_nama]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            $data = [
                'title' => 'K-Means Clustering',
                'sub_title' => "Form Tambah Jenis Barang",
                'validation' => $validation,
                'tahun' => $this->jenisModel->getJenis()
            ];
            // dd($data);
            return view('/dashboard/pages/v_create_jenis', $data);
            // return redirect()->to('/alumni/create')->withInput()->with('validation', $validation);
        }

        $this->jenisModel->save([
            'jenis_nama' => $this->request->getVar('nama')
        ]);
        session()->setFlashdata('pesan', 'Data Jenis Barang Baru Berhasil di Tambahkan');
        return redirect()->to('/jenis');
    }

    public function edit($data)
    {
        $data = [
            'title' => 'K-Means Clustering',
            'sub_title' => "Form Edit Jenis Barang",
            'validation' => \Config\Services::validation(),
            'jenis' => $this->jenisModel->getJenis($data)
        ];
        return view('dashboard/pages/v_edit_jenis', $data);
    }

    public function update($id)
    {
        // ambil data alumni berdasarkan nisn
        $jenis = $this->jenisModel->getJenis($id);

        // cek kesamaan data inputan nisn dengan yang di database 
        if ($jenis['jenis_nama'] == $this->request->getVar('nama')) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[tb_jenis.jenis_nama]';
        }


        if (!$this->validate([
            'nama' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            $data = [
                'title' => 'K-Means Clustering',
                'sub_title' => "Form Edit Jenis Barang",
                'validation' => $validation,
                'jenis' => $this->jenisModel->getJenis($id)
            ];
            // dd($data);
            return view('/dashboard/pages/v_edit_jenis', $data);
            // return redirect()->to('/alumni/create')->withInput()->with('validation', $validation);
        }

        $this->jenisModel->save([
            'jenis_id' => $id,
            'jenis_nama' => $this->request->getVar('nama')
        ]);
        session()->setFlashdata('pesan', 'Data Jenis Barang Berhasil di Ubah');
        return redirect()->to('/jenis');
    }

    public function hapus($data)
    {
        session()->setFlashdata('pesan', 'Data Jenis Barang Berhasil di Hapus');
        $this->jenisModel->delete($data);
        return redirect()->to('/jenis');
    }
}
