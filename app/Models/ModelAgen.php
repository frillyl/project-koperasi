<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAgen extends Model
{
    protected $table = "tb_agen";
    protected $primaryKey = "id_agen";
    protected $returnType = "object";
    protected $allowedFields = ['kd_agen', 'nm_agen', 'alamat', 'no_hp', 'email', 'ket', 'created_by', 'edited_by'];

    public function allData()
    {
        return $this->db->table('tb_agen')
            ->join('tb_pengurus', 'tb_pengurus.id = tb_agen.created_by OR tb_pengurus.id = tb_agen.edited_by', 'left')
            ->orderBy('tb_agen.nm_agen', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_agen)
    {
        return $this->db->table('tb_agen')
            ->where('id_agen', $id_agen)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_agen')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_agen')
            ->where('id_agen', $data['id_agen'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_agen')
            ->where('id_agen', $data['id_agen'])
            ->delete($data);
    }

    public function getMaxId()
    {
        $query = $this->db->table('tb_agen')->selectMax('kd_agen');
        $result = $query->get()->getRowArray();
        return (int) str_replace('AGEN', '', $result['kd_agen']);
    }
}
