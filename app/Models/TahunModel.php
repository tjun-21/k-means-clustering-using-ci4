<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunModel extends Model
{
    protected $table = 'tb_tahun';
    protected $primaryKey = 'tahun_id';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $dateFormat    = 'datetime';

    public function getTahun($data = false)
    {
        if ($data == false) {
            return $this->findAll();
        }

        // return $this->where(['alumni_nisn' => $data])->first();
    }
}
