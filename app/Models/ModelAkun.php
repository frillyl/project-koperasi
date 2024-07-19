<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAkun extends Model
{
    protected $table = "tb_akun";
    protected $primaryKey = "id_akun";
    // protected $returnType = "object";
    protected $allowedFields = ['kd_akun', 'nm_akun', 'tb_bantuan', 'pos_saldo', 'pos_laporan', 'debit', 'kredit', 'created_by', 'edited_by'];

    public function allData()
    {
        return $this->db->table('tb_akun')
            ->join('tb_pengurus', 'tb_pengurus.id = tb_akun.created_by OR tb_pengurus.id = tb_akun.edited_by', 'left')
            ->orderBy('kd_akun', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_akun)
    {
        return $this->db->table('tb_akun')
            ->where('id_akun', $id_akun)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_akun')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_akun')
            ->where('id_akun', $data['id_akun'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_akun')
            ->where('id_akun', $data['id_akun'])
            ->delete($data);
    }
}
