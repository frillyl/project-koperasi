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


    public function index_labarugi()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Laba Rugi',
            'isi'   => 'pengurus/akuntansi/labarugi/v_index'
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    public function index_neraca()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Neraca',
            'isi'   => 'pengurus/akuntansi/neraca/v_index'
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    public function index_pmodal()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Perubahan Modal',
            'isi'   => 'pengurus/akuntansi/pmodal/v_index'
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }
}
