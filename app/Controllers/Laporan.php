<?php

namespace App\Controllers;

use App\Models\ModelLaporan;

class Laporan extends BaseController
{
    protected $ModelLaporan;

    public function __construct()
    {
        helper('form');
        $this->ModelLaporan = new ModelLaporan;
    }

    public function index_barang()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Laporan Barang',
            'isi'   => 'pengurus/laporan/v_barang',
            'barang' => $this->ModelLaporan->allDataBarang()
        ];
        return view('pengurus/layout/v_Wrapper', $data);
    }

    public function index_penjualan()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Laporan Penjualan',
            'isi'   => 'pengurus/laporan/v_penjualan',
            'barang' => $this->ModelLaporan->allDataPenjualan()
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }
}
