<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPinjaman extends Model
{
    protected $table = 'tb_pinjaman';
    protected $primaryKey = 'id_pinjaman';
    protected $allowedFields = [
        'id_anggota', 'jml_pinjaman', 'bunga', 'tenor', 'status', 'tgl_pengajuan',
        'tgl_disetujui', 'created_at', 'created_by', 'edited_at', 'edited_by'
    ];

    public function getAllPinjaman()
    {
        return $this->select('tb_pinjaman.*, tb_anggota.nm_anggota')
            ->join('tb_anggota', 'tb_anggota.id_anggota = tb_pinjaman.id_anggota')
            ->findAll();
    }
}
