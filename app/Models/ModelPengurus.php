<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengurus extends Model
{
    protected $table = "tb_pengurus";
    protected $primaryKey = "id";
    protected $returnType = "object";
    protected $allowedFields = ['id_pengurus', 'nm_pengurus', 'password', 'profile_pic', 'role'];

    public function login($username)
    {
        return $this->db->table('tb_pengurus')->where('id_pengurus', $username)
            ->get()
            ->getRowArray();
    }

    public function allData()
    {
        return $this->db->table('tb_pengurus')
            ->orderBy('nm_pengurus', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id)
    {
        return $this->db->table('tb_pengurus')
            ->where('id', $id)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_pengurus')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_pengurus')
            ->where('id', $data['id'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_pengurus')
            ->where('id', $data['id'])
            ->delete($data);
    }
}
