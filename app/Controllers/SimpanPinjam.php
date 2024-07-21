<?php

namespace App\Controllers;

use App\Models\ModelAnggota;
use App\Models\ModelPangkat;
use App\Models\ModelPinjaman;
use App\Models\ModelAngsuran;

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
        $modelPinjaman = new ModelPinjaman();
        $modelAngsuran = new ModelAngsuran();
        $modelAnggota = new ModelAnggota();
        $pinjaman = $modelPinjaman->getAllPinjaman();

        foreach ($pinjaman as &$p) {
            $totalAngsuran = $modelAngsuran->getTotalAngsuran($p['id_pinjaman']);
            $p['sisa_tenor'] = $p['tenor'] - $totalAngsuran;

            if (empty($p['tgl_disetujui'])) {
                $p['status'] = 'Diajukan';
            } elseif (!empty($p['tgl_disetujui']) && $p['sisa_tenor'] == 0) {
                $p['status'] = 'Selesai';
            } elseif (!empty($p['tgl_disetujui']) && $p['sisa_tenor'] !== 0) {
                $p['status'] = 'Berjalan';
            }
        }
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Pinjaman Anggota',
            'isi'   => 'pengurus/simpanpinjam/pinjaman/v_index',
            'anggota' => $modelAnggota->getAnggota(),
            'pinjaman' => $pinjaman
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    public function add_pinjaman()
    {
        $modelPinjaman = new ModelPinjaman();
        $data = $this->request->getPost();
        $data['bunga'] = $data['jml_pinjaman'] * $data['tenor'] * 1.5 / 100;

        $modelPinjaman->save($data);
        return redirect()->to('/pengurus/usipa/pinjaman');
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
