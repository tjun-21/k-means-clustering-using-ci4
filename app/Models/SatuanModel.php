<?php

namespace App\Models;

use CodeIgniter\Model;

class SatuanModel extends Model

{
    protected $table = 'tb_satuan';
    protected $primaryKey = 'satuan_id';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $dateFormat    = 'datetime';
    protected $allowedFields = [
        'satuan_id',
        'satuan_nama',
        'satuan_baca'
    ];

    public function getSatuan($data = false)
    {
        if ($data == false) {
            return $this->findAll();
        }

        return $this->where(['satuan_id' => $data])->first();
    }

    // public function getAlumniID($data = false)
    // {
    //     return $this->where(['alumni_id' => $data])->first();
    // }
}
