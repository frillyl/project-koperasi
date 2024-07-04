<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAkunHeader extends Model
{
    protected $table = "tb_akun_header";
    protected $primaryKey = "id_akun_header";
    protected $returnType = "object";
    protected $allowedFields = ['nm_akun', 'created_by', 'edited_by'];

    public function allData()
    {
        return $this->db->table('tb_akun_header')
            ->join('tb_pengurus', 'tb_pengurus.id = tb_akun_header.created_by OR tb_pengurus.id = tb_akun_header.edited_by', 'left')
            ->orderBy('tb_akun_header.nm_akun', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_akun_header)
    {
        return $this->db->table('tb_akun_header')
            ->where('id_akun_header', $id_akun_header)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_akun_header')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_akun_header')
            ->where('id_akun_header', $data['id_akun_header'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_akun_header')
            ->where('id_akun_header', $data['id_akun_header'])
            ->delete($data);
    }
}
