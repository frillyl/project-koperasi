<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLaporan extends Model
{
    public function allDataBarang()
    {
        return $this->db->table('tb_barang')
            ->select('tb_barang.*, tb_barang.created_at AS barang_created_at, tb_barang.created_by AS barang_created_by, tb_barang.edited_at AS barang_edited_at, tb_barang.edited_by AS barang_edited_by')
            ->select('tb_agen.*, tb_agen.created_at AS agen_created_at, tb_agen.created_by AS agen_created_by, tb_agen.edited_at AS agen_edited_at, tb_agen.edited_by AS agen_edited_by')
            ->select('tb_satuan.*')
            ->select('tb_pengurus.*')
            ->join('tb_agen', 'tb_agen.id_agen = tb_barang.id_agen', 'left')
            ->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang.id_satuan', 'left')
            ->join('tb_pengurus', 'tb_pengurus.id = tb_barang.created_by OR tb_pengurus.id = tb_barang.edited_by', 'left')
            ->orderBy('tb_barang.kd_barang', 'ASC')
            ->get()->getResultArray();
    }

    public function allDataPenjualan()
    {
        return $this->db->table('tb_penjualan')
            ->get()->getResultArray();
    }
}
