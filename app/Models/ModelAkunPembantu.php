<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAkunPembantu extends Model
{
    protected $table = "tb_akun_pembantu";
    protected $primary = "id_akun_pembantu";
    protected $returnType = "object";
    protected $allowedFields = ['id_akun_header', 'kd_akun', 'nm_akun', 'tb_bantuan', 'saldo_normal', 'saldo_awal', 'created_by', 'edited_by'];

    public function allData()
    {
        return $this->db->table('tb_akun_pembantu')
            ->select('tb_akun_pembantu.*, tb_akun_pembantu.nm_akun AS nm_akun_pembantu, tb_akun_header.nm_akun AS nm_akun_header')
            ->join('tb_akun_header', 'tb_akun_header.id_akun_header = tb_akun_pembantu.id_akun_header', 'left')
            ->join('tb_pengurus', 'tb_pengurus.id = tb_akun_pembantu.created_by OR tb_pengurus.id = tb_akun_pembantu.edited_by', 'left')
            ->orderBy('tb_akun_pembantu.kd_akun', 'ASC')
            ->get()->getResultArray();
    }
}
