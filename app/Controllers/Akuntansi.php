<?php

namespace App\Controllers;

use App\Models\ModelAkun;
use App\Models\ModelAkunPembantu;
use App\Models\ModelAkunHeader;
use App\Models\ModelJurnal;

class Akuntansi extends BaseController
{
    protected $ModelAkun;
    protected $ModelAkunPembantu;
    protected $ModelAkunHeader;
    protected $ModelJurnal;

    public function __construct()
    {
        helper('form');
        $this->ModelAkun = new ModelAkun();
        $this->ModelAkunPembantu = new ModelAkunPembantu();
        $this->ModelAkunHeader = new ModelAkunHeader();
        $this->ModelJurnal = new ModelJurnal();
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

    // MASTER HEADER AKUN PEMBANTU
    public function index_header()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Akun Pembantu Header',
            'isi'   => 'pengurus/akuntansi/header/v_index',
            'header' => $this->ModelAkunHeader->allData()
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    public function add_header()
    {
        if ($this->validate([
            'nm_akun' => [
                'label' => 'Nama Akun Header',
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
                'nm_akun' => $this->request->getPost('nm_akun'),
                'created_by' => $this->request->getPost('created_by'),
            );
            $this->ModelAkunHeader->add($data);
            session()->setFlashdata('success', 'Data akun header berhasil ditambahkan!');
            return redirect()->to('pengurus/akuntansi/akun_header');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pengurus/akuntansi/akun_header'));
        }
    }

    public function edit_header($id_akun_header)
    {
        if ($this->validate([
            'nm_akun' => [
                'label' => 'Nama Akun',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'edited_by' => [
                'label' => 'Diubah Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $data = array(
                'id_akun_header' => $id_akun_header,
                'nm_akun' => $this->request->getPost('nm_akun'),
            );
            $this->ModelAkunHeader->edit($data);
            session()->setFlashdata('success', 'Data akun header berhasil diubah!');
            return redirect()->to(base_url('pengurus/akuntansi/akun_header'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pengurus/akuntansi/akun_header'));
        }
    }

    public function delete_header($id_akun_header)
    {
        $data = [
            'id_akun_header' => $id_akun_header
        ];
        $this->ModelAkunHeader->delete_data($data);
        session()->setFlashdata('success', 'Data akun header berhasil dihapus!');
        return redirect()->to(base_url('pengurus/akuntansi/akun_header'));
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

    // JURNAL UMUM
    public function index_jurnal()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Jurnal Umum',
            'isi'   => 'pengurus/akuntansi/jurnal/v_index',
            'jurnal' => $this->ModelJurnal->allData()
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }
}
