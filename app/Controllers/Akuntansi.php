<?php

namespace App\Controllers;

use App\Models\ModelAkun;
use App\Models\ModelAkunPembantu;
use App\Models\ModelAkunHeader;
use App\Models\ModelJurnal;
use App\Models\ModelBukuBesar;
use App\Models\ModelBukuPembantu;

class Akuntansi extends BaseController
{
    protected $ModelAkun;
    protected $ModelAkunPembantu;
    protected $ModelAkunHeader;
    protected $ModelJurnal;
    protected $ModelBukuBesar;
    protected $ModelBukuPembantu;

    public function __construct()
    {
        helper('form');
        $this->ModelAkun = new ModelAkun();
        $this->ModelAkunPembantu = new ModelAkunPembantu();
        $this->ModelAkunHeader = new ModelAkunHeader();
        $this->ModelJurnal = new ModelJurnal();
        $this->ModelBukuBesar = new ModelBukuBesar();
        $this->ModelBukuPembantu = new ModelBukuPembantu();
    }

    // MASTER KODE AKUN
    // Daftar Kode Akun
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

    // Kelola Kode Akun
    public function kelola_akun()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Kelola Kode Akun',
            'isi'   => 'pengurus/akuntansi/akun/v_kelola',
            'akun'  => $this->ModelAkun->allData()
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    // Tambah Kode Akun
    public function add_akun()
    {
        if ($this->validate([
            'kd_akun' => [
                'label' => 'Kode Akun',
                'rules' => 'required|is_unique[tb_akun.kd_akun]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} telah terdaftar!'
                ]
            ],
            'nm_akun' => [
                'label' => 'Nama Akun',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'tb_bantuan' => [
                'label' => 'Kode Tabel Bantuan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'pos_saldo' => [
                'label' => 'Pos Saldo',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'pos_laporan' => [
                'label' => 'Pos Laporan',
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
                'kd_akun' => $this->request->getPost('kd_akun'),
                'nm_akun' => $this->request->getPost('nm_akun'),
                'tb_bantuan' => $this->request->getPost('tb_bantuan'),
                'pos_saldo' => $this->request->getPost('pos_saldo'),
                'pos_laporan' => $this->request->getPost('pos_laporan'),
                'debit' => $this->request->getPost('debit'),
                'kredit' => $this->request->getPost('kredit'),
                'created_by' => $this->request->getPost('created_by'),
            );
            $this->ModelAkun->add($data);
            session()->setFlashdata('success', 'Data akun berhasil ditambahkan!');
            return redirect()->to('/pengurus/akuntansi/akun/kelola');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/pengurus/akuntansi/akun/kelola'));
        }
    }

    // Ubah Kode Akun
    public function edit_akun($id_akun)
    {
        if ($this->validate([
            'kd_akun' => [
                'label' => 'Kode Akun',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'nm_akun' => [
                'label' => 'Nama Akun',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'tb_bantuan' => [
                'label' => 'Kode Tabel Bantuan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'pos_saldo' => [
                'label' => 'Pos Saldo',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'pos_laporan' => [
                'label' => 'Pos Laporan',
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
                'id_akun' => $id_akun,
                'kd_akun' => $this->request->getPost('kd_akun'),
                'nm_akun' => $this->request->getPost('nm_akun'),
                'tb_bantuan' => $this->request->getPost('tb_bantuan'),
                'pos_saldo' => $this->request->getPost('pos_saldo'),
                'pos_laporan' => $this->request->getPost('pos_laporan'),
                'debit' => $this->request->getPost('debit'),
                'kredit' => $this->request->getPost('kredit'),
                'edited_by' => $this->request->getPost('edited_by'),
            );
            $this->ModelAkun->edit($data);
            session()->setFlashdata('success', 'Data akun berhasil diubah!');
            return redirect()->to('/pengurus/akuntansi/akun/kelola');
        }
    }

    // Hapus Kode Akun
    public function delete_akun($id_akun)
    {
        $data = [
            'id_akun' => $id_akun
        ];
        $this->ModelAkun->delete_data($data);
        session()->setFlashdata('success', 'Data akun berhasil dihapus!');
        return redirect()->to('/pengurus/akuntansi/akun/kelola');
    }

    // MASTER HEADER KODE AKUN PEMBANTU
    // Daftar Header Kode Akun Pembantu
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

    // Tambah Header Kode Akun Pembantu
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

    // Ubah Header Kode Akun Pembantu
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

    // Hapus Header Kode Akun Pembantu
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
    // Daftar Kode Akun Pembantu
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

    // Kelola Kode Akun Pembantu
    public function kelola_bantu()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Kelola Kode Akun Pembantu',
            'isi'   => 'pengurus/akuntansi/bantu/v_kelola',
            'akun'  => $this->ModelAkunPembantu->allData(),
            'header' => $this->ModelAkunHeader->allData()
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    // Tambah Kode Akun Pembantu
    public function add_bantu()
    {
        if ($this->validate([
            'id_akun_header' => [
                'label' => 'Header Akun',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'kd_akun' => [
                'label' => 'Kode Akun',
                'rules' => 'required|is_unique[tb_akun.kd_akun]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} telah terdaftar!'
                ]
            ],
            'nm_akun' => [
                'label' => 'Nama Akun',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'tb_bantuan' => [
                'label' => 'Kode Tabel Bantuan',
                'rules' => 'required|is_unique[tb_akun.tb_bantuan]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} telah terdaftar!'
                ]
            ],
            'saldo_normal' => [
                'label' => 'Saldo Normal',
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
                'id_akun_header' => $this->request->getPost('id_akun_header'),
                'kd_akun' => $this->request->getPost('kd_akun'),
                'nm_akun' => $this->request->getPost('nm_akun'),
                'tb_bantuan' => $this->request->getPost('tb_bantuan'),
                'saldo_normal' => $this->request->getPost('pos_saldo'),
                'saldo_awal' => $this->request->getPost('pos_laporan'),
                'created_by' => $this->request->getPost('created_by'),
            );
            $this->ModelAkunPembantu->add($data);
            session()->setFlashdata('success', 'Data akun pembantu berhasil ditambahkan!');
            return redirect()->to('/pengurus/akuntansi/akun_pembantu/kelola');
        }
    }

    // Ubah Kode Akun Pembantu
    public function edit_bantu($id_akun_pembantu)
    {
        if ($this->validate([
            'id_akun_header' => [
                'label' => 'Header Akun',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'kd_akun' => [
                'label' => 'Kode Akun',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'nm_akun' => [
                'label' => 'Nama Akun',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'tb_bantuan' => [
                'label' => 'Kode Tabel Bantuan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'saldo_normal' => [
                'label' => 'Saldo Normal',
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
                'id_akun_pembantu' => $id_akun_pembantu,
                'id_akun_header' => $this->request->getPost('id_akun_header'),
                'kd_akun' => $this->request->getPost('kd_akun'),
                'nm_akun' => $this->request->getPost('nm_akun'),
                'tb_bantuan' => $this->request->getPost('tb_bantuan'),
                'pos_saldo' => $this->request->getPost('pos_saldo'),
                'pos_laporan' => $this->request->getPost('pos_laporan'),
                'debit' => $this->request->getPost('debit'),
                'kredit' => $this->request->getPost('kredit'),
                'edited_by' => $this->request->getPost('edited_by'),
            );
            $this->ModelAkunPembantu->edit($data);
            session()->setFlashdata('success', 'Data akun pembantu berhasil diubah!');
            return redirect()->to('/pengurus/akuntansi/akun_pembantu/kelola');
        }
    }

    // Hapus Kode Akun Pembantu
    public function delete_bantu($id_akun_pembantu)
    {
        $data = [
            'id_akun_pembantu' => $id_akun_pembantu
        ];
        $this->ModelAkunPembantu->delete_data($data);
        session()->setFlashdata('success', 'Data akun pembantu berhasil dihapus!');
        return redirect()->to('/pengurus/akuntansi/akun_pembantu/kelola');
    }

    // JURNAL UMUM
    // Daftar Jurnal Umum
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

    // Kelola Jurnal Umum
    public function kelola_jurnal()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Kelola Jurnal Umum',
            'isi'   => 'pengurus/akuntansi/jurnal/v_kelola',
            'akun'  => $this->ModelAkun->allData(),
            'bantu' => $this->ModelAkunPembantu->allData(),
            'jurnal' => $this->ModelJurnal->allData()
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    // Tambah Jurnal Umum
    public function add_jurnal()
    {
        if ($this->validate([
            'id_akun' => [
                'label' => 'Kode Akun',
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
            'debit' => [
                'label' => 'Debit',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'kredit' => [
                'label' => 'Kredit',
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
                'id_akun' => $this->request->getPost('id_akun'),
                'id_akun_pembantu' => $this->request->getPost('id_akun_pembantu'),
                'tanggal' => $this->request->getPost('tanggal'),
                'no_bukti' => $this->request->getPost('no_bukti'),
                'ket' => $this->request->getPost('ket'),
                'debit' => $this->request->getPost('debit'),
                'kredit' => $this->request->getPost('kredit'),
                'created_by' => $this->request->getPost('created_by'),
            );
            $this->ModelJurnal->add($data);
            session()->setFlashdata('success', 'Data jurnal berhasil ditambahkan!');
            return redirect()->to('/pengurus/akuntansi/jurnal/kelola');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/pengurus/akuntansi/jurnal/kelola'));
        }
    }

    // Ubah Jurnal Umum
    public function edit_jurnal($id_jurnal)
    {
        if ($this->validate([
            'id_akun' => [
                'label' => 'Kode Akun',
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
            'debit' => [
                'label' => 'Debit',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'kredit' => [
                'label' => 'Kredit',
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
                'id_jurnal' => $id_jurnal,
                'id_akun' => $this->request->getPost('id_akun'),
                'id_akun_pembantu' => $this->request->getPost('id_akun_pembantu'),
                'tanggal' => $this->request->getPost('tanggal'),
                'no_bukti' => $this->request->getPost('no_bukti'),
                'ket' => $this->request->getPost('ket'),
                'debit' => $this->request->getPost('debit'),
                'kredit' => $this->request->getPost('kredit'),
                'edited_by' => $this->request->getPost('edited_by'),
            );
            $this->ModelJurnal->edit($data);
            session()->setFlashdata('success', 'Data jurnal berhasil diubah!');
            return redirect()->to('/pengurus/akuntansi/jurnal/kelola');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/pengurus/akuntansi/jurnal/kelola'));
        }
    }

    public function delete_jurnal($id_jurnal)
    {
        $data = [
            'id_jurnal' => $id_jurnal
        ];
        $this->ModelJurnal->delete_data($data);
        session()->setFlashdata('success', 'Data jurnal berhasil dihapus!');
        return redirect()->to('/pengurus/akuntansi/jurnal/kelola');
    }

    // MASTER BUKU BESAR
    // Daftar Buku Besar
    public function index_bukubesar()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Buku Besar',
            'isi'   => 'pengurus/akuntansi/bukubesar/v_index',
            'akun'  => $this->ModelBukuBesar->findAll()
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    // Cari Data Buku Besar
    public function cariData()
    {
        $akunId = $this->request->getPost('akun');
        $bulan = $this->request->getPost('bulan');

        $db = \Config\Database::connect();
        $builder = $db->table('tb_jurnal');
        $builder->select('tanggal, no_bukti, ket, debit, kredit');
        $builder->where('id_akun', $akunId);

        if ($bulan !== 'semua') {
            $builder->like('tanggal', date('Y') . '-' . $bulan, 'after');
        } elseif ($bulan == 'semua') {
            $builder;
        }

        $query = $builder->get();
        $result = $query->getResultArray();

        // Ambil nilai saldo awal dari tb_akun berdasarkan pos_saldo
        $akunBuilder = $db->table('tb_akun');
        $akunBuilder->select('debit, kredit, pos_saldo');
        $akunBuilder->where('id_akun', $akunId);
        $akunQuery = $akunBuilder->get();
        $akunResult = $akunQuery->getRow();

        $saldoAwal = 0;
        if ($akunResult->pos_saldo == 1) {
            $saldoAwal = $akunResult->debit;
        } elseif ($akunResult->pos_saldo == 2) {
            $saldoAwal = $akunResult->kredit;
        }

        $output = '<tr>';
        $output .= '<td></td>';
        $output .= '<td></td>';
        $output .= '<td></td>';
        $output .= '<td></td>';
        $output .= '<td></td>';
        $output .= '<td style="text-align: right;">' . $saldoAwal . '</td>';
        $output .= '</tr>';

        $saldo = $saldoAwal;

        foreach ($result as $row) {
            if ($akunResult->pos_saldo == 1) {
                $saldo = $saldo + $row['debit'] - $row['kredit'];
            } elseif ($akunResult->pos_saldo == 2) {
                $saldo = $saldo - $row['debit'] + $row['kredit'];
            }

            $output .= '<tr>';
            $output .= '<td>' . $row['tanggal'] . '</td>';
            $output .= '<td>' . $row['no_bukti'] . '</td>';
            $output .= '<td>' . $row['ket'] . '</td>';
            $output .= '<td style="text-align: right;">' . $row['debit'] . '</td>';
            $output .= '<td style="text-align: right;">' . $row['kredit'] . '</td>';
            $output .= '<td style="text-align: right;">' . $saldo . '</td>';
            $output .= '</tr>';
        }

        echo $output;
    }

    // MASTER BUKU BESAR PEMBANTU
    // Daftar Buku Besar Pembantu
    public function index_bukupembantu()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Buku Pembantu',
            'isi'   => 'pengurus/akuntansi/bukupembantu/v_index',
            'akun_pembantu'  => $this->ModelBukuPembantu->findAll()
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    // Cari Data Buku Besar Pembantu
    public function cariDataBantu()
    {
        try {
            $akunId = $this->request->getPost('akun2');
            $bulan = $this->request->getPost('bulan2');

            // Validasi input
            if (!$akunId || !$bulan) {
                throw new \Exception('Input tidak valid');
            }

            $db = \Config\Database::connect();
            $builder = $db->table('tb_jurnal');
            $builder->select('tanggal, no_bukti, ket, debit, kredit');
            $builder->where('id_akun_pembantu', $akunId);

            if ($bulan !== 'semua') {
                $builder->like('tanggal', date('Y') . '-' . $bulan, 'after');
            } elseif ($bulan == 'semua') {
                $builder;
            }

            $query = $builder->get();
            $result = $query->getResultArray();

            // Ambil nilai saldo awal dari tb_akun berdasarkan pos_saldo
            $akunBuilder = $db->table('tb_akun_pembantu');
            $akunBuilder->select('saldo_normal, saldo_awal');
            $akunBuilder->where('id_akun_pembantu', $akunId);
            $akunQuery = $akunBuilder->get();
            $akunResult = $akunQuery->getRow();

            if (!$akunResult) {
                throw new \Exception('Akun tidak ditemukan');
            }

            $saldoAwal = $akunResult->saldo_awal;

            $output = '<tr>';
            $output .= '<td></td>';
            $output .= '<td></td>';
            $output .= '<td></td>';
            $output .= '<td></td>';
            $output .= '<td></td>';
            $output .= '<td style="text-align: right;">' . $saldoAwal . '</td>';
            $output .= '</tr>';

            $saldo = $saldoAwal;

            foreach ($result as $row) {
                if ($akunResult->saldo_normal == 1) {
                    $saldo = $saldo + $row['debit'] - $row['kredit'];
                } elseif ($akunResult->saldo_normal == 2) {
                    $saldo = $saldo - $row['debit'] + $row['kredit'];
                }

                $output .= '<tr>';
                $output .= '<td>' . $row['tanggal'] . '</td>';
                $output .= '<td>' . $row['no_bukti'] . '</td>';
                $output .= '<td>' . $row['ket'] . '</td>';
                $output .= '<td style="text-align: right;">' . $row['debit'] . '</td>';
                $output .= '<td style="text-align: right;">' . $row['kredit'] . '</td>';
                $output .= '<td style="text-align: right;">' . $saldo . '</td>';
                $output .= '</tr>';
            }

            echo $output;
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // MASTER NERACA LAJUR
    // Daftar Neraca Lajur
    public function index_neracalajur()
    {
        // Ambil semua data dari tb_akun sebagai array asosiatif
        $akunData = $this->ModelAkun->asArray()->findAll();
        $accountData = [];

        foreach ($akunData as $akun) {
            // Hitung nilai debit dan kredit dari tb_jurnal
            $totalDebit = $this->ModelJurnal->where('id_akun', $akun['id_akun'])->selectSum('debit')->first()['debit'];
            $totalKredit = $this->ModelJurnal->where('id_akun', $akun['id_akun'])->selectSum('kredit')->first()['kredit'];

            $neracaSaldoDebit = 0;
            $neracaSaldoKredit = 0;
            $neracaDebit = 0;
            $neracaKredit = 0;
            $labaRugiDebit = 0;
            $labaRugiKredit = 0;

            if ($akun['pos_saldo'] == '1') {
                $neracaSaldoDebit = $akun['debit'] + $totalDebit - $totalKredit;
            } else {
                $neracaSaldoKredit = $akun['kredit'] + $totalKredit - $totalDebit;
            }

            if ($akun['pos_saldo'] == '1' && $akun['pos_laporan'] == '1') {
                $neracaDebit = $neracaSaldoDebit;
            } elseif ($akun['pos_saldo'] == '2' && $akun['pos_laporan'] == '1') {
                $neracaKredit = $neracaSaldoKredit;
            } elseif ($akun['pos_saldo'] == '1' && $akun['pos_laporan'] == '2') {
                $labaRugiDebit = $neracaSaldoDebit;
            } elseif ($akun['pos_saldo'] == '2' && $akun['pos_laporan'] == '2') {
                $labaRugiKredit = $neracaSaldoKredit;
            }

            $accountData[] = [
                'kd_akun' => $akun['kd_akun'],
                'nm_akun' => $akun['nm_akun'],
                'pos_saldo' => $akun['pos_saldo'],
                'pos_laporan' => $akun['pos_laporan'],
                'neraca_saldo_debit' => $neracaSaldoDebit,
                'neraca_saldo_kredit' => $neracaSaldoKredit,
                'neraca_debit' => $neracaDebit,
                'neraca_kredit' => $neracaKredit,
                'laba_rugi_debit' => $labaRugiDebit,
                'laba_rugi_kredit' => $labaRugiKredit
            ];
        }

        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub' => 'Neraca Lajur',
            'isi' => 'pengurus/akuntansi/neracalajur/v_index',
            'accounts' => $accountData
        ];

        return view('pengurus/layout/v_wrapper', $data);
    }

    // MASTER LABA RUGI
    // Daftar Laba Rugi
    public function index_labarugi()
    {
        // Ambil semua data dari tb_akun sebagai array asosiatif
        $akunData = $this->ModelAkun->where('pos_laporan', 2)->asArray()->findAll();
        $groupedData = [
            'Pendapatan' => [],
            'Biaya' => [],
            'Pendapatan Lain-Lain' => [],
            'Biaya Lain-Lain' => [],
        ];
        $totals = [
            'Pendapatan' => 0,
            'Biaya' => 0,
            'Pendapatan Lain-Lain' => 0,
            'Biaya Lain-Lain' => 0,
        ];

        foreach ($akunData as $akun) {
            // Hitung nilai debit dan kredit dari tb_jurnal
            $totalDebit = $this->ModelJurnal->where('id_akun', $akun['id_akun'])->selectSum('debit')->first()['debit'];
            $totalKredit = $this->ModelJurnal->where('id_akun', $akun['id_akun'])->selectSum('kredit')->first()['kredit'];

            $neracaSaldoDebit = 0;
            $neracaSaldoKredit = 0;
            $neracaDebit = 0;
            $neracaKredit = 0;
            $labaRugiDebit = 0;
            $labaRugiKredit = 0;

            if ($akun['pos_saldo'] == '1') {
                $neracaSaldoDebit = $akun['debit'] + $totalDebit - $totalKredit;
            } else {
                $neracaSaldoKredit = $akun['kredit'] + $totalKredit - $totalDebit;
            }

            if ($akun['pos_saldo'] == '1' && $akun['pos_laporan'] == '1') {
                $neracaDebit = $neracaSaldoDebit;
            } elseif ($akun['pos_saldo'] == '2' && $akun['pos_laporan'] == '1') {
                $neracaKredit = $neracaSaldoKredit;
            } elseif ($akun['pos_saldo'] == '1' && $akun['pos_laporan'] == '2') {
                $labaRugiDebit = $neracaSaldoDebit;
            } elseif ($akun['pos_saldo'] == '2' && $akun['pos_laporan'] == '2') {
                $labaRugiKredit = $neracaSaldoKredit;
            }

            $accountData = [
                'kd_akun' => $akun['kd_akun'],
                'nm_akun' => $akun['nm_akun'],
                'pos_saldo' => $akun['pos_saldo'],
                'pos_laporan' => $akun['pos_laporan'],
                'neraca_saldo_debit' => $neracaSaldoDebit,
                'neraca_saldo_kredit' => $neracaSaldoKredit,
                'neraca_debit' => $neracaDebit,
                'neraca_kredit' => $neracaKredit,
                'laba_rugi_debit' => $labaRugiDebit,
                'laba_rugi_kredit' => $labaRugiKredit
            ];

            $kd_akun = $akun['kd_akun'];
            $firstDigit = substr($kd_akun, 0, 1);
            $amount = $akun['pos_saldo'] == '1' ? $labaRugiDebit : $labaRugiKredit;

            switch ($firstDigit) {
                case '4':
                    $groupedData['Pendapatan'][] = $accountData;
                    $totals['Pendapatan'] += $amount;
                    break;
                case '5':
                    $groupedData['Biaya'][] = $accountData;
                    $totals['Biaya'] += $amount;
                    break;
                case '6':
                    $groupedData['Pendapatan Lain-Lain'][] = $accountData;
                    $totals['Pendapatan Lain-Lain'] += $amount;
                    break;
                case '7':
                    $groupedData['Biaya Lain-Lain'][] = $accountData;
                    $totals['Biaya Lain-Lain'] += $amount;
                    break;
            }
        }

        // Perhitungan tambahan
        $labaKotor = $totals['Pendapatan'] - $totals['Biaya'];
        $labaSebelumPajak = $labaKotor + $totals['Pendapatan Lain-Lain'] - $totals['Biaya Lain-Lain'];
        $pajakPPH = $labaSebelumPajak * 0.11;
        $labaSetelahPajak = $labaSebelumPajak - $pajakPPH;

        session()->set('labaSebelumPajak', $labaSebelumPajak);

        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub' => 'Laporan Keuangan',
            'isi' => 'pengurus/akuntansi/labarugi/v_index',
            'accounts' => $groupedData,
            'totals' => $totals,
            'labaKotor' => $labaKotor,
            'labaSebelumPajak' => $labaSebelumPajak,
            'pajakPPH' => $pajakPPH,
            'labaSetelahPajak' => $labaSetelahPajak
        ];

        return view('pengurus/layout/v_wrapper', $data);
    }

    // MASTER NERACA
    // Daftar Neraca
    public function index_neraca()
    {
        $akunData = $this->ModelAkun->asArray()->where('pos_laporan', '1')->findAll();
        $accountData = [
            'Aset Lancar' => [
                'Kas dan Bank' => [],
                'Piutang' => [],
                'Persediaan' => [],
                'Uang Muka' => [],
            ],
            'Aset Tetap' => [],
            'Hutang' => [],
            'Equity' => [],
        ];
        $totalKasBank = $totalPiutang = $totalPersediaan = $totalUangMuka = $totalAsetTetap = $totalHutang = $totalModal = 0;

        // Perhitungan laba rugi seperti di index_labarugi
        $akunDataLabaRugi = $this->ModelAkun->where('pos_laporan', 2)->asArray()->findAll();
        $groupedData = [
            'Pendapatan' => [],
            'Biaya' => [],
            'Pendapatan Lain-Lain' => [],
            'Biaya Lain-Lain' => [],
        ];
        $totals = [
            'Pendapatan' => 0,
            'Biaya' => 0,
            'Pendapatan Lain-Lain' => 0,
            'Biaya Lain-Lain' => 0,
        ];

        foreach ($akunDataLabaRugi as $akun) {
            $totalDebit = $this->ModelJurnal->where('id_akun', $akun['id_akun'])->selectSum('debit')->first()['debit'];
            $totalKredit = $this->ModelJurnal->where('id_akun', $akun['id_akun'])->selectSum('kredit')->first()['kredit'];

            $neracaSaldoDebit = 0;
            $neracaSaldoKredit = 0;
            $neracaDebit = 0;
            $neracaKredit = 0;
            $labaRugiDebit = 0;
            $labaRugiKredit = 0;

            if ($akun['pos_saldo'] == '1') {
                $neracaSaldoDebit = $akun['debit'] + $totalDebit - $totalKredit;
            } else {
                $neracaSaldoKredit = $akun['kredit'] + $totalKredit - $totalDebit;
            }

            if ($akun['pos_saldo'] == '1' && $akun['pos_laporan'] == '1') {
                $neracaDebit = $neracaSaldoDebit;
            } elseif ($akun['pos_saldo'] == '2' && $akun['pos_laporan'] == '1') {
                $neracaKredit = $neracaSaldoKredit;
            } elseif ($akun['pos_saldo'] == '1' && $akun['pos_laporan'] == '2') {
                $labaRugiDebit = $neracaSaldoDebit;
            } elseif ($akun['pos_saldo'] == '2' && $akun['pos_laporan'] == '2') {
                $labaRugiKredit = $neracaSaldoKredit;
            }

            $accountData = [
                'kd_akun' => $akun['kd_akun'],
                'nm_akun' => $akun['nm_akun'],
                'pos_saldo' => $akun['pos_saldo'],
                'pos_laporan' => $akun['pos_laporan'],
                'neraca_saldo_debit' => $neracaSaldoDebit,
                'neraca_saldo_kredit' => $neracaSaldoKredit,
                'neraca_debit' => $neracaDebit,
                'neraca_kredit' => $neracaKredit,
                'laba_rugi_debit' => $labaRugiDebit,
                'laba_rugi_kredit' => $labaRugiKredit
            ];

            $kd_akun = $akun['kd_akun'];
            $firstDigit = substr($kd_akun, 0, 1);
            $amount = $akun['pos_saldo'] == '1' ? $labaRugiDebit : $labaRugiKredit;

            switch ($firstDigit) {
                case '4':
                    $groupedData['Pendapatan'][] = $accountData;
                    $totals['Pendapatan'] += $amount;
                    break;
                case '5':
                    $groupedData['Biaya'][] = $accountData;
                    $totals['Biaya'] += $amount;
                    break;
                case '6':
                    $groupedData['Pendapatan Lain-Lain'][] = $accountData;
                    $totals['Pendapatan Lain-Lain'] += $amount;
                    break;
                case '7':
                    $groupedData['Biaya Lain-Lain'][] = $accountData;
                    $totals['Biaya Lain-Lain'] += $amount;
                    break;
            }
        }

        $labaKotor = $totals['Pendapatan'] - $totals['Biaya'];
        $labaSebelumPajak = $labaKotor + $totals['Pendapatan Lain-Lain'] - $totals['Biaya Lain-Lain'];
        $pajakPPH = $labaSebelumPajak * 0.11;
        $labaSetelahPajak = $labaSebelumPajak - $pajakPPH;

        foreach ($akunData as $akun) {
            // Hitung nilai debit dan kredit dari tb_jurnal
            $totalDebit = $this->ModelJurnal->where('id_akun', $akun['id_akun'])->selectSum('debit')->first()['debit'];
            $totalKredit = $this->ModelJurnal->where('id_akun', $akun['id_akun'])->selectSum('kredit')->first()['kredit'];

            $neracaSaldoDebit = 0;
            $neracaSaldoKredit = 0;
            $neracaDebit = 0;
            $neracaKredit = 0;
            $labaRugiDebit = 0;
            $labaRugiKredit = 0;

            if ($akun['pos_saldo'] == '1') {
                $neracaSaldoDebit = $akun['debit'] + $totalDebit - $totalKredit;
            } else {
                $neracaSaldoKredit = $akun['kredit'] + $totalKredit - $totalDebit;
            }

            if ($akun['pos_saldo'] == '1' && $akun['pos_laporan'] == '1') {
                $neracaDebit = $neracaSaldoDebit;
            } elseif ($akun['pos_saldo'] == '2' && $akun['pos_laporan'] == '1') {
                $neracaKredit = $neracaSaldoKredit;
            } elseif ($akun['pos_saldo'] == '1' && $akun['pos_laporan'] == '2') {
                $labaRugiDebit = $neracaSaldoDebit;
            } elseif ($akun['pos_saldo'] == '2' && $akun['pos_laporan'] == '2') {
                $labaRugiKredit = $neracaSaldoKredit;
            }

            $kdAkun = $akun['kd_akun'];
            if ($akun['pos_saldo'] == '1') {
                $jumlah = $neracaDebit;
            } elseif ($akun['pos_saldo'] == '2') {
                $jumlah = $neracaKredit;
            }

            if ($kdAkun[0] == '1') {
                if ($kdAkun[1] == '1') {
                    $accountData['Aset Lancar']['Kas dan Bank'][] = [
                        'uraian' => $akun['nm_akun'],
                        'jumlah' => $jumlah
                    ];
                    $totalKasBank += $jumlah;
                } elseif ($kdAkun[1] == '2') {
                    $accountData['Aset Lancar']['Piutang'][] = [
                        'uraian' => $akun['nm_akun'],
                        'jumlah' => $jumlah
                    ];
                    $totalPiutang += $jumlah;
                } elseif ($kdAkun[1] == '3') {
                    $accountData['Aset Lancar']['Persediaan'][] = [
                        'uraian' => $akun['nm_akun'],
                        'jumlah' => $jumlah
                    ];
                    $totalPersediaan += $jumlah;
                } elseif ($kdAkun[1] == '4') {
                    $accountData['Aset Lancar']['Uang Muka'][] = [
                        'uraian' => $akun['nm_akun'],
                        'jumlah' => $jumlah
                    ];
                    $totalUangMuka += $jumlah;
                } elseif (in_array($kdAkun[1], ['5', '6'])) {
                    $accountData['Aset Tetap'][] = [
                        'uraian' => $akun['nm_akun'],
                        'jumlah' => $jumlah
                    ];
                    $totalAsetTetap += $jumlah;
                }
            } elseif ($kdAkun[0] == '2') {
                $accountData['Hutang'][] = [
                    'uraian' => $akun['nm_akun'],
                    'jumlah' => $jumlah
                ];
                $totalHutang += $jumlah;
            } elseif ($kdAkun[0] == '3') {
                $accountData['Equity'][] = [
                    'uraian' => $akun['nm_akun'],
                    'jumlah' => $jumlah
                ];
                $totalModal += $jumlah;
            }
        }
        $totalAsetLancar = $totalKasBank + $totalPiutang + $totalPersediaan + $totalUangMuka;
        $totalAset = $totalAsetLancar + $totalAsetTetap;
        $totalLiabilitasEquity = $totalHutang + $totalModal + $labaSebelumPajak;
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Neraca',
            'isi'   => 'pengurus/akuntansi/neraca/v_index',
            'accounts' => $accountData,
            'totals' => [
                'totalKasdanBank' => $totalKasBank,
                'totalPiutang' => $totalPiutang,
                'totalPersediaan' => $totalPersediaan,
                'totalUangMuka' => $totalUangMuka,
                'totalAsetLancar' => $totalAsetLancar,
                'totalAsetTetap' => $totalAsetTetap,
                'totalAset' => $totalAset,
                'totalHutang' => $totalHutang,
                'totalModal' => $totalModal + $labaSebelumPajak,
                'totalLiabilitasEquity' => $totalLiabilitasEquity,
                'labaSebelumPajak' => $labaSebelumPajak
            ]
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    // MASTER PERUBAHAN MODAL
    // Daftar Perubahan Modal
    public function index_pmodal()
    {
        $akunData = $this->ModelAkun->asArray()->where('pos_laporan', '1')->findAll();
        $accountData = [
            'Aset Lancar' => [
                'Kas dan Bank' => [],
                'Piutang' => [],
                'Persediaan' => [],
                'Uang Muka' => [],
            ],
            'Aset Tetap' => [],
            'Hutang' => [],
            'Equity' => [],
        ];
        $totalKasBank = $totalPiutang = $totalPersediaan = $totalUangMuka = $totalAsetTetap = $totalHutang = $totalModal = 0;

        // Perhitungan laba rugi seperti di index_labarugi
        $akunDataLabaRugi = $this->ModelAkun->where('pos_laporan', 2)->asArray()->findAll();
        $groupedData = [
            'Pendapatan' => [],
            'Biaya' => [],
            'Pendapatan Lain-Lain' => [],
            'Biaya Lain-Lain' => [],
        ];
        $totals = [
            'Pendapatan' => 0,
            'Biaya' => 0,
            'Pendapatan Lain-Lain' => 0,
            'Biaya Lain-Lain' => 0,
        ];

        foreach ($akunDataLabaRugi as $akun) {
            $totalDebit = $this->ModelJurnal->where('id_akun', $akun['id_akun'])->selectSum('debit')->first()['debit'];
            $totalKredit = $this->ModelJurnal->where('id_akun', $akun['id_akun'])->selectSum('kredit')->first()['kredit'];

            $neracaSaldoDebit = 0;
            $neracaSaldoKredit = 0;
            $neracaDebit = 0;
            $neracaKredit = 0;
            $labaRugiDebit = 0;
            $labaRugiKredit = 0;

            if ($akun['pos_saldo'] == '1') {
                $neracaSaldoDebit = $akun['debit'] + $totalDebit - $totalKredit;
            } else {
                $neracaSaldoKredit = $akun['kredit'] + $totalKredit - $totalDebit;
            }

            if ($akun['pos_saldo'] == '1' && $akun['pos_laporan'] == '1') {
                $neracaDebit = $neracaSaldoDebit;
            } elseif ($akun['pos_saldo'] == '2' && $akun['pos_laporan'] == '1') {
                $neracaKredit = $neracaSaldoKredit;
            } elseif ($akun['pos_saldo'] == '1' && $akun['pos_laporan'] == '2') {
                $labaRugiDebit = $neracaSaldoDebit;
            } elseif ($akun['pos_saldo'] == '2' && $akun['pos_laporan'] == '2') {
                $labaRugiKredit = $neracaSaldoKredit;
            }

            $accountData = [
                'kd_akun' => $akun['kd_akun'],
                'nm_akun' => $akun['nm_akun'],
                'pos_saldo' => $akun['pos_saldo'],
                'pos_laporan' => $akun['pos_laporan'],
                'neraca_saldo_debit' => $neracaSaldoDebit,
                'neraca_saldo_kredit' => $neracaSaldoKredit,
                'neraca_debit' => $neracaDebit,
                'neraca_kredit' => $neracaKredit,
                'laba_rugi_debit' => $labaRugiDebit,
                'laba_rugi_kredit' => $labaRugiKredit
            ];

            $kd_akun = $akun['kd_akun'];
            $firstDigit = substr($kd_akun, 0, 1);
            $amount = $akun['pos_saldo'] == '1' ? $labaRugiDebit : $labaRugiKredit;

            switch ($firstDigit) {
                case '4':
                    $groupedData['Pendapatan'][] = $accountData;
                    $totals['Pendapatan'] += $amount;
                    break;
                case '5':
                    $groupedData['Biaya'][] = $accountData;
                    $totals['Biaya'] += $amount;
                    break;
                case '6':
                    $groupedData['Pendapatan Lain-Lain'][] = $accountData;
                    $totals['Pendapatan Lain-Lain'] += $amount;
                    break;
                case '7':
                    $groupedData['Biaya Lain-Lain'][] = $accountData;
                    $totals['Biaya Lain-Lain'] += $amount;
                    break;
            }
        }

        $labaKotor = $totals['Pendapatan'] - $totals['Biaya'];
        $labaSebelumPajak = $labaKotor + $totals['Pendapatan Lain-Lain'] - $totals['Biaya Lain-Lain'];
        $pajakPPH = $labaSebelumPajak * 0.11;
        $labaSetelahPajak = $labaSebelumPajak - $pajakPPH;

        // Ambil modal awal dari tb_akun
        $modalAwal = $this->ModelAkun->where('kd_akun', '3101')->first(); // Sesuaikan 'akun_kredit_modal_awal' dengan kd_akun yang relevan
        $totalModalAwal = $modalAwal['kredit'];

        // Ambil deviden/prive dari tb_akun
        $devidenPrive = $this->ModelAkun->where('kd_akun', '3102')->first(); // Sesuaikan 'akun_kredit_deviden_prive' dengan kd_akun yang relevan
        $totalDevidenPrive = $devidenPrive['kredit'];

        // Hitung total dan modal akhir
        $total = $totalModalAwal + $labaSetelahPajak;
        $modalAkhir = $total - $totalDevidenPrive;

        foreach ($akunData as $akun) {
            // Hitung nilai debit dan kredit dari tb_jurnal
            $totalDebit = $this->ModelJurnal->where('id_akun', $akun['id_akun'])->selectSum('debit')->first()['debit'];
            $totalKredit = $this->ModelJurnal->where('id_akun', $akun['id_akun'])->selectSum('kredit')->first()['kredit'];

            $neracaSaldoDebit = 0;
            $neracaSaldoKredit = 0;
            $neracaDebit = 0;
            $neracaKredit = 0;
            $labaRugiDebit = 0;
            $labaRugiKredit = 0;

            if ($akun['pos_saldo'] == '1') {
                $neracaSaldoDebit = $akun['debit'] + $totalDebit - $totalKredit;
            } else {
                $neracaSaldoKredit = $akun['kredit'] + $totalKredit - $totalDebit;
            }

            if ($akun['pos_saldo'] == '1' && $akun['pos_laporan'] == '1') {
                $neracaDebit = $neracaSaldoDebit;
            } elseif ($akun['pos_saldo'] == '2' && $akun['pos_laporan'] == '1') {
                $neracaKredit = $neracaSaldoKredit;
            } elseif ($akun['pos_saldo'] == '1' && $akun['pos_laporan'] == '2') {
                $labaRugiDebit = $neracaSaldoDebit;
            } elseif ($akun['pos_saldo'] == '2' && $akun['pos_laporan'] == '2') {
                $labaRugiKredit = $neracaSaldoKredit;
            }

            $kdAkun = $akun['kd_akun'];
            if ($akun['pos_saldo'] == '1') {
                $jumlah = $neracaDebit;
            } elseif ($akun['pos_saldo'] == '2') {
                $jumlah = $neracaKredit;
            }

            if ($kdAkun[0] == '1') {
                if ($kdAkun[1] == '1') {
                    $accountData['Aset Lancar']['Kas dan Bank'][] = [
                        'uraian' => $akun['nm_akun'],
                        'jumlah' => $jumlah
                    ];
                    $totalKasBank += $jumlah;
                } elseif ($kdAkun[1] == '2') {
                    $accountData['Aset Lancar']['Piutang'][] = [
                        'uraian' => $akun['nm_akun'],
                        'jumlah' => $jumlah
                    ];
                    $totalPiutang += $jumlah;
                } elseif ($kdAkun[1] == '3') {
                    $accountData['Aset Lancar']['Persediaan'][] = [
                        'uraian' => $akun['nm_akun'],
                        'jumlah' => $jumlah
                    ];
                    $totalPersediaan += $jumlah;
                } elseif ($kdAkun[1] == '4') {
                    $accountData['Aset Lancar']['Uang Muka'][] = [
                        'uraian' => $akun['nm_akun'],
                        'jumlah' => $jumlah
                    ];
                    $totalUangMuka += $jumlah;
                } elseif (in_array($kdAkun[1], ['5', '6'])) {
                    $accountData['Aset Tetap'][] = [
                        'uraian' => $akun['nm_akun'],
                        'jumlah' => $jumlah
                    ];
                    $totalAsetTetap += $jumlah;
                }
            } elseif ($kdAkun[0] == '2') {
                $accountData['Hutang'][] = [
                    'uraian' => $akun['nm_akun'],
                    'jumlah' => $jumlah
                ];
                $totalHutang += $jumlah;
            } elseif ($kdAkun[0] == '3') {
                $accountData['Equity'][] = [
                    'uraian' => $akun['nm_akun'],
                    'jumlah' => $jumlah
                ];
                $totalModal += $jumlah;
            }
        }
        $totalAsetLancar = $totalKasBank + $totalPiutang + $totalPersediaan + $totalUangMuka;
        $totalAset = $totalAsetLancar + $totalAsetTetap;
        $totalLiabilitasEquity = $totalHutang + $totalModal + $labaSebelumPajak;
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Perubahan Modal',
            'isi'   => 'pengurus/akuntansi/pmodal/v_index',
            'accounts' => $accountData,
            'totals' => [
                'totalKasdanBank' => $totalKasBank,
                'totalPiutang' => $totalPiutang,
                'totalPersediaan' => $totalPersediaan,
                'totalUangMuka' => $totalUangMuka,
                'totalAsetLancar' => $totalAsetLancar,
                'totalAsetTetap' => $totalAsetTetap,
                'totalAset' => $totalAset,
                'totalHutang' => $totalHutang,
                'totalModal' => $totalModal + $labaSebelumPajak,
                'totalLiabilitasEquity' => $totalLiabilitasEquity,
                'labaSebelumPajak' => $labaSebelumPajak,
                'modalAwal' => $totalModalAwal,
                'labaBersih' => $labaSetelahPajak,
                'total' => $total,
                'devidenPrive' => $totalDevidenPrive,
                'modalAkhir' => $modalAkhir
            ]
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }
}
