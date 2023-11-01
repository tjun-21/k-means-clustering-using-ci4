<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisModel extends Model

{
    protected $table = 'tb_jenis';
    protected $primaryKey = 'jenis_id';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $dateFormat    = 'datetime';
    protected $allowedFields = [
        'jenis_id',
        'jenis_nama'
    ];

    public function getJenis($data = false)
    {
        if ($data == false) {
            return $this->findAll();
        }

        return $this->where(['jenis_id' => $data])->first();
        // return $this->findAll();
    }

    // public function getAlumniID($data = false)
    // {
    //     return $this->where(['alumni_id' => $data])->first();
    // }
}
