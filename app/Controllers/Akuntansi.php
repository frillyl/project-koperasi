<?php

namespace App\Controllers;

use App\Models\ModelAkun;
use App\Models\ModelAkunPembantu;

class Akuntansi extends BaseController
{
    protected $ModelAkun;
    protected $ModelAkunPembantu;

    public function __construct()
    {
        helper('form');
        $this->ModelAkun = new ModelAkun();
        $this->ModelAkunPembantu = new ModelAkunPembantu();
    }

    // MASTER KODE AKUN
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

    // MASTER KODE AKUN PEMBANTU
    public function index_bantu()
    {
        $bantu = $this->ModelAkunPembantu->allData();
        $grouped_data = [];
        foreach ($bantu as $value) {
            $id_header = $value['id_akun_header'];
            if (!isset($grouped_data[$id_header])) {
                $grouped_data[$id_header] = [
                    'nm_akun_header' => $value['nm_akun_header'],
                    'data' => []
                ];
            }
            $grouped_data[$id_header]['data'][] = $value;
        }
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Kode Akun Pembantu',
            'isi'   => 'pengurus/akuntansi/bantu/v_index',
            'grouped_data' => $grouped_data
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }
}
