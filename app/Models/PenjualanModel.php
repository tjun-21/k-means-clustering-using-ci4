<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'tb_barang';
    protected $primaryKey = 'barang_id';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    protected $dateFormat    = 'datetime';
    protected $allowedFields = [
        'barang_id',
        'barang_nama',
        'barang_jenis',
        'barang_satuan',
        'barang_stok19',
        'barang_terjual19',
        'barang_stok20',
        'barang_terjual20',
        'barang_stok21',
        'barang_terjual21',
        'barang_cluster'
    ];

    // public function getAlumni($data = false)
    // {
    //     if ($data == false) {
    //         return $this->findAll();
    //     }

    //     // return $this->where(['alumni_nisn' => $data])->first();
    // }

    // public function getAlumniID($data = false)
    // {
    //     return $this->where(['alumni_id' => $data])->first();
    // }
    public function get_data()
    {
        return $this->findAll();
    }
    public function JumlahData()
    {
        return $this->countAll();
    }

    public function customQuery()
    {
        $builder = $this->builder();
        $query = $builder->get();
        dd($query);
    }
}

// function get_data($table)
// {
//     return $this->db->get($table);
// }

// // fungsi untuk menginput data ke database
// function insert_data($data, $table)
// {
//     $this->db->insert($table, $data);
// }

// // fungsi untuk mengedit data
// function edit_data($where, $table)
// {
//     return $this->db->get_where($table, $where);
// }

// // fungsi untuk mengupdate atau mengubah data di database
// function update_data($where, $data, $table)
// {
//     $this->db->where($where);
//     $this->db->update($table, $data);
// }

// // fungsi untuk menghapus data dari database
// function delete_data($where, $table)
// {
//     $this->db->delete($table, $where);
// }
