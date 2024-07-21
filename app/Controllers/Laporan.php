<?php

namespace App\Controllers;

use App\Models\ModelLaporan;
use Dompdf\Dompdf;
use Dompdf\Options;

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
            'penjualan' => $this->ModelLaporan->allDataPenjualan()
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    public function getDetailPenjualan()
    {
        $kd_penjualan = $this->request->getGet('kd_penjualan');
        $detailPenjualan = $this->ModelLaporan->getDetailPenjualan($kd_penjualan);
        echo json_encode($detailPenjualan);
    }

    public function cetak_penjualan()
    {
        $penjualan = $this->ModelLaporan->allDataPenjualan();

        // Fetch detail for each sale
        foreach ($penjualan as &$sale) {
            $sale['details'] = $this->ModelLaporan->getDetailPenjualan($sale['kd_penjualan']);
        }

        $data = [
            'title' => 'Laporan Penjualan',
            'penjualan' => $penjualan
        ];
        return view('pengurus/laporan/v_cetak_penjualan', $data);
    }

    public function cetak_pdf()
    {
        $penjualan = $this->ModelLaporan->allDataPenjualan();

        // Fetch detail for each sale
        foreach ($penjualan as &$sale) {
            $sale['details'] = $this->ModelLaporan->getDetailPenjualan($sale['kd_penjualan']);
        }

        $data = [
            'title' => 'Laporan Penjualan',
            'penjualan' => $penjualan
        ];

        // Load DomPDF library
        $dompdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // Load view into DomPDF
        $html = view('pengurus/laporan/v_cetak_penjualan', $data);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the PDF (first pass will generate the PDF document)
        $dompdf->render();

        // Stream the file to the browser
        $dompdf->stream('laporan_penjualan.pdf', array('Attachment' => 1));
    }
}
