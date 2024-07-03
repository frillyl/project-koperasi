<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAkun extends Model
{
    protected $table = "tb_akun";
    protected $primaryKey = "id_akun";
    protected $returnType = "object";
    protected $allowedFields = ['kd_akun', 'nm_akun', 'tb_bantuan', 'pos_saldo', 'pos_laporan', 'debit', 'kredit', 'created_by', 'edited_by'];

    public function allData()
    {
        return $this->db->table('tb_akun')
            ->orderBy('kd_akun', 'ASC')
            ->get()->getResultArray();
    }
}
