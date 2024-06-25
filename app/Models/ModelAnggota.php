<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAnggota extends Model
{
    protected $table = "tb_anggota";
    protected $primaryKey = "id_anggota";
    protected $returnType = "object";
    protected $allowedFields = ['id_pangkat', 'nrp', 'nm_anggota', 'email', 'no_hp', 'password', 'role', 'status', 'pp_anggota', 'created_by', 'edited_by'];

    public function allData()
    {
        return $this->db->table('tb_anggota')
            ->join('tb_pangkat', 'tb_pangkat.id_pangkat = tb_anggota.id_pangkat', 'left')
            ->join('tb_pengurus', 'tb_pengurus.id = tb_anggota.created_by OR tb_pengurus.id = tb_anggota.edited_by', 'left')
            ->orderBy('tb_anggota.nm_anggota', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_anggota)
    {
        return $this->db->table('tb_anggota')
            ->where('id_anggota', $id_anggota)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_anggota')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_anggota')
            ->where('id_anggota', $data['id_anggota'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_anggota')
            ->where('id_anggota', $data['id_anggota'])
            ->delete($data);
    }
}
