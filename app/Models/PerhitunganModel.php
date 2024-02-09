<?php

namespace App\Models;

use CodeIgniter\Model;

class PerhitunganModel extends Model

{
    protected $table = 'tb_perhitungan';
    protected $primaryKey = 'perhitugan_id';
    protected $dateFormat    = 'datetime';
    protected $allowedFields = [
        'perhitungan_id',
        'perhitungan_tgl',
        'hasil_c1',
        'hasil_c2',
        'hasil_c3',
        'jumlah_data'
    ];

    public function getData($data = false)
    {
        if ($data == false) {
            return $this->findAll();
        }

        return $this->where(['perhitungan_id' => $data])->first();
    }
}
