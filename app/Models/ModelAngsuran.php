<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAngsuran extends Model
{
    protected $table = 'tb_angsuran';
    protected $primaryKey = 'id_angsuran';
    protected $allowedFields = ['id_pinjaman', 'jml_bayar', 'tgl_bayar', 'created_at', 'created_by', 'edited_at', 'edited_by'];

    public function getTotalAngsuran($id_pinjaman)
    {
        return $this->where('id_pinjaman', $id_pinjaman)->countAllResults();
    }
}
