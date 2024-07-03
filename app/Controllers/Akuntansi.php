<?php

namespace App\Controllers;

use App\Models\ModelAkun;

class Akuntansi extends BaseController
{
    protected $ModelAkun;

    public function __construct()
    {
        helper('form');
        $this->ModelAkun = new ModelAkun();
    }

    public function index_akun()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Kode Akun',
            'isi'   => 'pengurus/akuntansi/akun/v_index',
            'akun'  => $this->ModelAkun->allData()
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }
}
