<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetPenjualan extends Model
{
    protected $table = 'tb_det_penjualan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kd_penjualan', 'kd_barang', 'nm_barang', 'harga_jual', 'qty', 'total_harga'];

    public function add($data)
    {
        if ($this->insert($data)) {
            return true;
        } else {
            log_message('error', 'Insert error: ' . print_r($this->errors(), true));
            return false;
        }
    }
}
