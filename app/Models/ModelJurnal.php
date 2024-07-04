<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelJurnal extends Model
{
    protected $table = "tb_jurnal";
    protected $primaryKey = "id_jurnal";
    protected $returnType = "object";
    protected $allowedFields = ['id_akun', 'id_akun_pembantu', 'tanggal', 'no_bukti', 'ket', 'debit', 'kredit', 'created_by', 'edited_by'];

    public function allData()
    {
        return $this->db->table('tb_jurnal')
            ->select('
                tb_jurnal.*, 
                tb_akun.kd_akun AS akun_kd_akun, 
                tb_akun.nm_akun AS akun_nm_akun,
                tb_akun.tb_bantuan AS akun_tb_bantuan,
                tb_akun.pos_saldo AS akun_pos_saldo,
                tb_akun.pos_laporan AS akun_pos_laporan,
                tb_akun.debit AS akun_debit,
                tb_akun.kredit AS akun_kredit,
                tb_akun.created_at AS akun_created_at,
                tb_akun.created_by AS akun_created_by,
                tb_akun.edited_at AS akun_edited_at,
                tb_akun.edited_by AS akun_edited_by,
                tb_akun_pembantu.kd_akun AS akun_pembantu_kd_akun, 
                tb_akun_pembantu.nm_akun AS akun_pembantu_nm_akun,
                tb_akun_pembantu.tb_bantuan AS akun_pembantu_tb_bantuan,
                tb_akun_pembantu.saldo_normal AS akun_pembantu_saldo_normal,
                tb_akun_pembantu.saldo_awal AS akun_pembantu_saldo_awal,
                tb_akun_pembantu.created_at AS akun_pembantu_created_at,
                tb_akun_pembantu.created_by AS akun_pembantu_created_by,
                tb_akun_pembantu.edited_at AS akun_pembantu_edited_at,
                tb_akun_pembantu.edited_by AS akun_pembantu_edited_by
            ')
            ->join('tb_akun', 'tb_akun.id_akun = tb_jurnal.id_akun', 'left')
            ->join('tb_akun_pembantu', 'tb_akun_pembantu.id_akun_pembantu = tb_jurnal.id_akun_pembantu', 'left')
            ->join('tb_pengurus', 'tb_pengurus.id = tb_akun_pembantu.created_by OR tb_pengurus.id = tb_akun_pembantu.edited_by', 'left')
            ->orderBy('tb_jurnal.tanggal', 'ASC')
            ->get()->getResultArray();
    }
}
