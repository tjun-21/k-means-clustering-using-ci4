<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    protected $userModel;

    public function __construct()
    {

        $this->userModel = new UserModel();
    }

    public function index()
    {
        $validation = \Config\Services::validation();
        $data = [
            'title' => 'K-Means Clustering',
            'sub_title' => "Login Page",
            'validation' => $validation
        ];
        // echo view('layouts/v_header', $data);
        return view('dashboard/layout/v_login', $data);
        // echo view('layouts/v_footer');
    }

    public function aksi()
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            $data = [
                'title' => 'K-Means Clustering',
                'sub_title' => "Login Page",
                'validation' => $validation
            ];
            $t = $this->request->getVar('email');
            session()->setFlashdata('email', $t);

            return view('dashboard/layout/v_login', $data);
        }
        $email = $this->request->getVar('email');
        $pw = $this->request->getVar('password');

        $where =  array(
            'user_email' => $email,
            'user_pass' => md5($pw)
        );

        $cek = $this->userModel->cekLogin($where);

        if ($cek) {
            $session = \Config\Services::session();
            $data_sess = array(
                'id' => $cek['user_id'],
                'username' => $cek['user_nama'],
                'role' => $cek['user_role'],
                'foto' => $cek['user_foto'],
                'status_log' => 'login'
            );
            $session->set($data_sess);
            return redirect()->to('/');
        } else {
            $validation = \Config\Services::validation();
            $data = [
                'title' => 'K-Means Clustering',
                'sub_title' => "Login Page",
                'validation' => $validation
            ];
            $t = $this->request->getVar('email');
            session()->setFlashdata('email', $t);
            session()->setFlashdata('pesan', 'Email dan Password Tidak sesuai');

            return view('dashboard/layout/v_login', $data);
        }


        // $this->jenisModel->save([
        //     'jenis_nama' => $this->request->getVar('nama')
        // ]);
        // session()->setFlashdata('pesan', 'Data Jenis Barang Baru Berhasil di Tambahkan');
        // return redirect()->to('/jenis');
    }
}
