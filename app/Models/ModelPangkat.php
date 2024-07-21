<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPangkat extends Model
{
    protected $table = "tb_pangkat";
    protected $primaryKey = "id_pangkat";
    protected $returnType = "object";
    protected $allowedFields = ['golongan', 'pangkat', 'ket'];

    public function allData()
    {
        return $this->db->table('tb_pangkat')
            ->orderBy('id_pangkat', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_pangkat)
    {
        return $this->db->table('tb_pangkat')
            ->where('id_pangkat', $id_pangkat)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_pangkat')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_pangkat')
            ->where('id_pangkat', $data['id_pangkat'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_pangkat')
            ->where('id_pangkat', $data['id_pangkat'])
            ->delete($data);
    }

    public function getPangkatById($id_pangkat)
    {
        return $this->where('id_pangkat', $id_pangkat)->first();
    }
}
