<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAngsuran extends Model
{
    protected $table = 'tb_angsuran';
    protected $primaryKey = 'id_angsuran';
    protected $allowedFields = ['id_pinjaman', 'jml_bayar', 'tgl_bayar', 'created_at', 'created_by', 'edited_at', 'edited_by'];

    public function getTotalAngsuran($id_pinjaman)
    {
        return $this->where('id_pinjaman', $id_pinjaman)->countAllResults();
    }

    public function allData()
    {
        return $this->db->table('tb_angsuran')
            ->join('tb_pinjaman', 'tb_pinjaman.id_pinjaman = tb_angsuran.id_pinjaman', 'left')
            ->join('tb_anggota', 'tb_anggota.id_anggota = tb_pinjaman.id_anggota', 'left')
            ->orderBy('tb_angsuran.tgl_bayar', 'DESC')
            ->get()->getResultArray();
    }

    public function detailData($id_angsuran)
    {
        return $this->db->table('tb_angsuran')
            ->where('id_angsuran', $id_angsuran)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_angsuran')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_angsuran')
            ->where('id_angsuran', $data['id_angsuran'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_angsuran')
            ->where('id_angsuran', $data['id_angsuran'])
            ->delete($data);
    }
}
