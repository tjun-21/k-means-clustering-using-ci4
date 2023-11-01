<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumniModel extends Model
{
    protected $table = 'tb_alumni';
    protected $primaryKey = 'alumni_id';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $dateFormat    = 'datetime';
    protected $allowedFields = [
        'alumni_nisn',
        'alumni_nik',
        'alumni_nama',
        'alumni_t_lahir',
        'alumni_tgl_lahir',
        'alumni_jk',
        'alumni_alamat',
        'alumni_prov',
        'alumni_kab',
        'alumni_kec',
        'alumni_desa',
        'alumni_email',
        'alumni_no',
        'alumni_foto',
        'alumni_tahun_lulus'
    ];

    public function getAlumni($data = false)
    {
        if ($data == false) {
            return $this->findAll();
        }

        return $this->where(['alumni_nisn' => $data])->first();
    }

    public function getAlumniID($data = false)
    {
        return $this->where(['alumni_id' => $data])->first();
    }
}
