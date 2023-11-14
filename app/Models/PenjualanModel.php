<?php

namespace App\Models;

use CodeIgniter\Model;

$db = \Config\Database::connect();

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
        'barang_stokApril',
        'barang_terjualApril',
        'barang_stokMei',
        'barang_terjualMei',
        'barang_stokJuni',
        'barang_terjualJuni',
        'barang_stokJuli',
        'barang_terjualJuli',
        'barang_stokAgus',
        'barang_terjualAgus',
        'barang_stokSept',
        'barang_terjualSept',
        'barang_cluster'
    ];

    public function get_data($data = false)
    {
        if ($data == false) {

            return $this->findAll();
        }
        return $this->where(['barang_id' => $data])->first();
    }
    public function JumlahData()
    {
        return $this->countAll();
    }
    public function query($query)
    {

        $db = db_connect();
        return $db->query($query);
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
