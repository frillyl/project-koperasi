<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSimpanan extends Model
{
    protected $table = "tb_simpanan";
    protected $primaryKey = "id_simpanan";
    protected $returnType = "object";
    protected $allowedFields = ['id_anggota', 'jenis_simpanan', 'jumlah', 'tanggal', 'created_by', 'edited_by'];

    public function allData()
    {
        return $this->db->table('tb_simpanan')
            ->join('tb_anggota', 'tb_anggota.id_anggota = tb_simpanan.id_anggota', 'left')
            ->orderBy('tb_simpanan.tanggal', 'DESC')
            ->get()->getResultArray();
    }

    public function detailData($id_simpanan)
    {
        return $this->db->table('tb_simpanan')
            ->where('id_simpanan', $id_simpanan)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_simpanan')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_simpanan')
            ->where('id_simpanan', $data['id_simpanan'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_simpanan')
            ->where('id_simpanan', $data['id_simpanan'])
            ->delete($data);
    }
}
