<?php

namespace App\Controllers;

class SimpanPinjam extends BaseController
{
    public function __construct()
    {
        helper('form');
    }

    public function index_simpanan()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Simpanan Anggota',
            'isi'   => 'pengurus/simpanpinjam/simpanan/v_index'
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    public function index_pinjaman()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Pinjaman Anggota',
            'isi'   => 'pengurus/simpanpinjam/pinjaman/v_index'
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    public function index_angsuran()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Angsuran Pinjaman Anggota',
            'isi'   => 'pengurus/simpanpinjam/angsuran/v_index'
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }
}
