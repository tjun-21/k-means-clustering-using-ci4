<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model

{
    protected $table = 'tb_user';
    protected $primaryKey = 'user_id';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $dateFormat    = 'datetime';
    protected $allowedFields = [
        'user_id',
        'user_nama',
        'user_email',
        'user_role',
        'user_pass',
        'user_foto'
    ];

    public function getData($data = false)
    {
        if ($data == false) {
            return $this->findAll();
        }

        return $this->where(['user_id' => $data])->first();
    }

    public function cekLogin($where)
    {
        return $this->Where($where)->first();
    }
}
