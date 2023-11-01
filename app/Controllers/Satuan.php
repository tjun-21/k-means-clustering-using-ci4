<?php

namespace App\Controllers;

use App\Models\SatuanModel;

class Satuan extends BaseController
{
    protected $satuanModel;

    public function __construct()
    {

        $this->satuanModel = new SatuanModel();
        // $this->tahunModel = new TahunModel();
    }

    public function index()
    {
        $data = [
            'title' => 'K-Means Clustering',
            'sub_title' => "Satuan Barang",
            'satuan' => $this->satuanModel->getSatuan()
        ];
        // echo view('layouts/v_header', $data);
        return view('dashboard/pages/v_satuan', $data);
        // echo view('layouts/v_footer');
    }

    public function create()
    {
        $data = [
            'title' => 'K-Means Clustering',
            'sub_title' => "Form Tambah Satuan Barang",
            'tahun' => $this->satuanModel->getSatuan(),
            'validation' => \Config\Services::validation()
        ];
        return view('dashboard/pages/v_create_satuan', $data);
    }

    public function save()
    {
        // validation data 
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[tb_satuan.satuan_nama]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ],
            ],
            'baca' => [
                'rules' => 'required|is_unique[tb_satuan.satuan_baca]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ],
            ]

        ])) {
            $validation = \Config\Services::validation();
            $data = [
                'title' => 'K-Means Clustering',
                'sub_title' => "Form Tambah Satuan Barang",
                'validation' => $validation,
                'satuan' => $this->satuanModel->getSatuan()
            ];
            // dd($data);
            return view('/dashboard/pages/v_create_satuan', $data);
            // return redirect()->to('/alumni/create')->withInput()->with('validation', $validation);
        }

        $this->satuanModel->save([
            'satuan_nama' => $this->request->getVar('nama'),
            'satuan_baca' => $this->request->getVar('baca')
        ]);
        session()->setFlashdata('pesan', 'Data Satuan Barang Baru Berhasil di Tambahkan');
        return redirect()->to('/satuan');
    }

    public function edit($data)
    {
        $data = [
            'title' => 'K-Means Clustering',
            'sub_title' => "Form Edit Satuan Barang",
            'validation' => \Config\Services::validation(),
            'satuan' => $this->satuanModel->getSatuan($data)
        ];
        return view('dashboard/pages/v_edit_satuan', $data);
    }

    public function update($id)
    {
        // ambil data alumni berdasarkan nisn
        $satuan = $this->satuanModel->getSatuan($id);

        // cek kesamaan data inputan nisn dengan yang di database 
        if ($satuan['satuan_nama'] == $this->request->getVar('nama')) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[tb_satuan.satuan_nama]';
        }

        if ($satuan['satuan_baca'] == $this->request->getVar('baca')) {
            $rule_baca = 'required';
        } else {
            $rule_baca  = 'required|is_unique[tb_satuan.satuan_baca]';
        }


        if (!$this->validate([
            'nama' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ],
            ],
            'baca' => [
                'rules' => $rule_baca,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            $data = [
                'title' => 'K-Means Clustering',
                'sub_title' => "Form Edit Satuan Barang",
                'validation' => $validation,
                'satuan' => $this->satuanModel->getSatuan($id)
            ];
            // dd($data);
            return view('/dashboard/pages/v_edit_satuan', $data);
            // return redirect()->to('/alumni/create')->withInput()->with('validation', $validation);
        }

        $this->satuanModel->save([
            'satuan_id' => $id,
            'satuan_nama' => $this->request->getVar('nama'),
            'satuan_baca' => $this->request->getVar('baca')
        ]);
        session()->setFlashdata('pesan', 'Data Satuan Barang Berhasil di Ubah');
        return redirect()->to('/satuan');
    }

    public function hapus($data)
    {
        session()->setFlashdata('pesan', 'Data Satuan Barang Berhasil di Hapus');
        $this->satuanModel->delete($data);
        return redirect()->to('/satuan');
    }
}
