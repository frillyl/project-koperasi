<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSatuan extends Model
{
    protected $table = "tb_satuan";
    protected $primaryKey = "id_satuan";
    protected $returnType = "object";
    protected $allowedFields = ['satuan', 'ket'];

    public function allData()
    {
        return $this->db->table('tb_satuan')
            ->orderBy('satuan', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_satuan)
    {
        return $this->db->table('tb_satuan')
            ->where('id_satuan', $id_satuan)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_satuan')->insert($data);
    }
}
