<?php

namespace App\Controllers;

use App\Models\ModelAnggota;

class Penjualan extends BaseController
{
    protected $ModelAnggota;

    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelAnggota = new ModelAnggota();
    }

    public function index()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Penjualan',
            'anggota' => $this->ModelAnggota->allData()
        ];
        return view('pengurus/transaksi/penjualan/v_index', $data);
    }
}
