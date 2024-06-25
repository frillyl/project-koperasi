<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBarang extends Model
{
    protected $table = "tb_barang";
    protected $primaryKey = "id_barang";
    protected $returnType = "object";
    protected $allowedFields = ['id_agen', 'kd_barang', 'nm_barang', 'jenis_barang', 'ket', 'harga_pokok', 'harga_jual', 'barcode', 'stok', 'image', 'created_by', 'edited_by'];

    public function allData()
    {
        return $this->db->table('tb_barang')
            ->select('tb_barang.*, tb_barang.created_at AS barang_created_at, tb_barang.created_by AS barang_created_by, tb_barang.edited_at AS barang_edited_at, tb_barang.edited_by AS barang_edited_by')
            ->select('tb_pengurus.*')
            ->select('tb_agen.*, tb_agen.created_at AS agen_created_at, tb_agen.created_by AS agen_created_by, tb_agen.edited_at AS agen_edited_at, tb_agen.edited_by AS agen_edited_by')
            ->select('tb_satuan.*')
            ->join('tb_pengurus', 'tb_pengurus.id = tb_barang.created_by OR tb_pengurus.id = tb_barang.edited_by', 'left')
            ->join('tb_agen', 'tb_agen.id_agen = tb_barang.id_agen', 'left')
            ->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang.id_satuan', 'left')
            ->orderBy('tb_barang.nm_barang', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_barang)
    {
        return $this->db->table('tb_barang')
            ->where('id_barang', $id_barang)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_barang')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_barang')
            ->where('id_barang', $data['id_barang'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_barang')
            ->where('id_barang', $data['id_barang'])
            ->delete($data);
    }

    public function getMaxId()
    {
        $query = $this->db->table('tb_barang')->selectMax('kd_barang');
        $result = $query->get()->getRowArray();
        return (int) str_replace('BRG', '', $result['kd_barang']);
    }
}
