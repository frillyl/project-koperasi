<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenjualan extends Model
{
    protected $table = "tb_penjualan";
    protected $primaryKey = "id_penjualan";
    protected $returnType = "object";
    protected $allowedFields = ['id_pengurus', 'id_anggota', 'kd_penjualan', 'tgl_penjualan', 'jam', 'grand_total', 'dibayar', 'kembalian'];

    public function kodePenjualan()
    {
        $tgl = date('Ymd');
        $query = $this->db->query("SELECT MAX(RIGHT(kd_penjualan, 4)) as no_urut from tb_penjualan WHERE DATE(tgl_penjualan) = '$tgl'");
        $hasil = $query->getRowArray();
        if ($hasil['no_urut'] > 0) {
            $tmp = $hasil['no_urut'] + 1;
            $kd = sprintf("%04s", $tmp);
        } else {
            $kd = "0001";
        }
        $kd_penjualan = date('Ymd') . $kd;
        return $kd_penjualan;
    }

    public function cekBarang($kd_barang)
    {
        return $this->db->table('tb_barang')
            ->select('tb_barang.*, tb_barang.created_at AS barang_created_at, tb_barang.created_by AS barang_created_by, tb_barang.edited_at AS barang_edited_at, tb_barang.edited_by AS barang_edited_by')
            ->select('tb_pengurus.*')
            ->select('tb_agen.*, tb_agen.created_at AS agen_created_at, tb_agen.created_by AS agen_created_by, tb_agen.edited_at AS agen_edited_at, tb_agen.edited_by AS agen_edited_by')
            ->select('tb_satuan.*')
            ->join('tb_pengurus', 'tb_pengurus.id = tb_barang.created_by OR tb_pengurus.id = tb_barang.edited_by', 'left')
            ->join('tb_agen', 'tb_agen.id_agen = tb_barang.id_agen', 'left')
            ->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang.id_satuan', 'left')
            ->where('kd_barang', $kd_barang)
            ->get()->getRowArray();
    }

    public function cekStok($kd_barang, $qty)
    {
        $barang = $this->db->table('tb_barang')
            ->select('stok')
            ->where('kd_barang', $kd_barang)
            ->get()->getRowArray();
        if ($barang) {
            return $barang['stok'] >= $qty;
        }
        return false;
    }
}
