<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBukuBesar extends Model
{
    protected $table = 'tb_akun';
    protected $primaryKey = 'id_akun';
    protected $allowedFields = ['kd_akun', 'nm_akun'];
}
