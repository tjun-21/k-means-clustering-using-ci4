<?php

namespace App\Controllers;

use App\Models\UserModel;



class Dashboard extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();

        if ((session()->get('status_log')) == null) {
            return redirect()->to('/login');
        }
    }
    public function index()
    {
        $db = \Config\Database::connect();
        $data = [
            'title' => 'K-Means | Dashboard',
            'sub_title' => "Main",
            'j_barang' => $db->query('SELECT * FROM tb_barang')->getNumRows(),
            'j_jenis' => $db->query('SELECT * FROM tb_jenis')->getNumRows(),
            'j_satuan' => $db->query('SELECT * FROM tb_satuan')->getNumRows(),
            'jum_hitung' => $db->query('SELECT * FROM tb_perhitungan')->getNumRows(),
            'last_hitung' => $db->query('SELECT * FROM tb_perhitungan order by perhitungan_id DESC LIMIT 1')->getResult('array'),
            // 'graph' => $db->query('SELECT tb_barang.barang_jenis, jenis_nama, COUNT(*) AS the_count FROM tb_barang INNER JOIN tb_jenis ON tb_barang.barang_jenis = tb_jenis.jenis_id GROUP BY tb_jenis.jenis_nama;')->getResult('array'),
            'graph' => $db->query('SELECT tb_barang.barang_jenis, jenis_nama, COUNT(*) AS the_count FROM tb_barang INNER JOIN tb_jenis ON tb_barang.barang_jenis = tb_jenis.jenis_id GROUP BY tb_jenis.jenis_nama;')->getResult('array')
        ];
        // echo view('layouts/v_header', $data);
        return view('dashboard/pages/v_index', $data);
        // echo view('layouts/v_footer');
    }

    public function ubah_password()
    {
        $data = [
            'title' => 'K-Means | Ubah Password',
            'sub_title' => "Ubah Password",
            'validation' => \Config\Services::validation(),
        ];
        // echo view('layouts/v_header', $data);
        return view('dashboard/pages/v_ganti_password', $data);
        // echo view('layouts/v_footer');
    }

    public function update_password()
    {
        // ambil data alumni berdasarkan nisn
        $id =  session()->get('id');

        if (!$this->validate([
            'pass' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ],
            ],
            'new' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'field tidak boleh kosong'
                ],
            ],
            'confirm' => [
                'rules' => 'required|matches[new]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'matches' => '{field} Password tidak sesuai'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            $data = [
                'title' => 'K-Means | Ubah Password',
                'sub_title' => "Ubah Password",
                'validation' => $validation
            ];
            return view('dashboard/pages/v_ganti_password', $data);
        }
        $pass = md5($this->request->getVar('pass'));
        $new = md5($this->request->getVar('new'));
        $cek = $this->userModel->getData($id);
        // dd($cek);
        if ($cek['user_pass'] == $pass) {
            echo "Success";
            $this->userModel->save([
                'user_id' => $id,
                'user_pass' => $new
            ]);
            session()->setFlashdata('pesan', 'Password Berhasil di Update');
            return redirect()->to('/ubah_password');
        } else {
            session()->setFlashdata('pesan', 'Password Gagal di Update');
            return redirect()->to('/ubah_password');
        }
    }

    public function profil()
    {
        $db = \Config\Database::connect();
        $id =  session()->get('id');
        $data = [
            'title' => 'K-Means | User ',
            'user' => $db->query("SELECT * FROM tb_user where user_id = '$id' ")->getResult('array'),
            'sub_title' => "Profil User",
            'validation' => \Config\Services::validation(),
        ];
        // echo view('layouts/v_header', $data);
        return view('dashboard/pages/v_profil', $data);
    }


    public function logout()
    {
        session()->destroy();
        session()->setFlashdata('pesan', 'Kamu baru saja Logout');
        return redirect()->to('/login');
    }
}
