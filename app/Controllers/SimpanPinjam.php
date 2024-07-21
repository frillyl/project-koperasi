<?php

namespace App\Controllers;

use App\Models\ModelAnggota;
use App\Models\ModelPangkat;
use App\Models\ModelPinjaman;
use App\Models\ModelAngsuran;
use App\Models\ModelSimpanan;

class SimpanPinjam extends BaseController
{
    protected $ModelSimpanan;
    protected $ModelAnggota;
    protected $ModelPinjaman;
    protected $ModelAngsuran;

    public function __construct()
    {
        helper('form');
        $this->ModelSimpanan = new ModelSimpanan();
        $this->ModelAnggota = new ModelAnggota();
        $this->ModelPinjaman = new ModelPinjaman();
        $this->ModelAngsuran = new ModelAngsuran();
    }

    public function index_simpanan()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Simpanan Anggota',
            'isi'   => 'pengurus/simpanpinjam/simpanan/v_index',
            'anggota' => $this->ModelAnggota->allData(),
            'simpanan' => $this->ModelSimpanan->allData()
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    public function add_simpanan()
    {
        if ($this->validate([
            'id_anggota' => [
                'label' => 'Nama Anggota',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'jenis_simpanan' => [
                'label' => 'Jenis Simpanan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'jumlah' => [
                'label' => 'Jumlah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'tanggal' => [
                'label' => 'Tanggal',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'created_by' => [
                'label' => 'Ditambahkan Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $data = array(
                'id_anggota' => $this->request->getPost('id_anggota'),
                'jenis_simpanan' => $this->request->getPost('jenis_simpanan'),
                'jumlah' => $this->request->getPost('jumlah'),
                'tanggal' => $this->request->getPost('tanggal'),
                'created_by' => $this->request->getPost('created_by'),
            );
            $this->ModelSimpanan->add($data);
            session()->setFlashdata('success', 'Data simpanan berhasil ditambahkan!');
            return redirect()->to('/pengurus/usipa/simpanan');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/pengurus/usipa/simpanan'));
        }
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
            'isi'   => 'pengurus/simpanpinjam/angsuran/v_index',
            'pinjaman' => $this->ModelAngsuran->allData()
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    public function add_angsuran()
    {
        if ($this->validate([
            'id_pinjaman' => [
                'label' => 'Nama Anggota',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'jml_bayar' => [
                'label' => 'Jumlah Bayar',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'tgl_bayar' => [
                'label' => 'Tanggal Bayar',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'created_by' => [
                'label' => 'Ditambahkan Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $data = array(
                'id_pinjaman' => $this->request->getPost('id_pinjaman'),
                'jml_bayar' => $this->request->getPost('jml_bayar'),
                'tgl_bayar' => $this->request->getPost('tgl_bayar'),
                'created_by' => $this->request->getPost('created_by'),
            );
            $this->ModelAngsuran->add($data);
            session()->setFlashdata('success', 'Data angsuran berhasil ditambahkan!');
            return redirect()->to('/pengurus/usipa/angsuran');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/pengurus/usipa/angsuran'));
        }
    }
}
