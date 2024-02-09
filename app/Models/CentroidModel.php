<?php

namespace App\Models;

use CodeIgniter\Model;

class CentroidModel extends Model

{
    protected $table = 'tb_centroid';
    protected $primaryKey = 'centroid_id';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $dateFormat    = 'datetime';
    protected $allowedFields = [
        'centroid_id',
        'centroid_nama',
        'c_barang_id'
    ];

    public function getData($data = false)
    {
        if ($data == false) {
            return $this->findAll();
        }

        return $this->where(['centroid_id' => $data])->first();
    }
}
