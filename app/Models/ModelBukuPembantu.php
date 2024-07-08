<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBukuPembantu extends Model
{
    protected $table = 'tb_akun_pembantu';
    protected $primaryKey = 'id_akun_pembantu';
    protected $allowedFields = ['kd_akun', 'nm_akun'];
}
