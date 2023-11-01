<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'SMPN5 | Dashboard',
            'sub_title' => "Main"
        ];
        // echo view('layouts/v_header', $data);
        return view('dashboard/pages/v_index', $data);
        // echo view('layouts/v_footer');
    }

    public function alumni()
    {
        $data = [
            'title' => 'SMPN5 | Alumni',
            'sub_title' => "Data Alumni"
        ];
        // echo view('layouts/v_header', $data);
        return view('dashboard/pages/v_alumni', $data);
        // echo view('layouts/v_footer');
    }

    public function berita()
    {
        $data = [
            'title' => 'SMPN5 | Berita',
            'sub_title' => "Berita"
        ];
        // echo view('layouts/v_header', $data);
        return view('dashboard/pages/v_berita', $data);
        // echo view('layouts/v_footer');
    }

    public function laporan()
    {
        $data = [
            'title' => 'SMPN5 | Laporan Data Alumni',
            'sub_title' => "Report"
        ];
        // echo view('layouts/v_header', $data);
        return view('dashboard/pages/v_report', $data);
        // echo view('layouts/v_footer');
    }

    public function ubah_password()
    {
        $data = [
            'title' => 'SMPN5 | Ubah Password',
            'sub_title' => "Ubah Password"
        ];
        // echo view('layouts/v_header', $data);
        return view('dashboard/pages/v_ubah_password', $data);
        // echo view('layouts/v_footer');
    }

    public function logout()
    {
    }
}
