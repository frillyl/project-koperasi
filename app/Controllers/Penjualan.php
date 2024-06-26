<?php

namespace App\Controllers;

use App\Models\ModelAnggota;
use App\Models\ModelPenjualan;
use App\Models\ModelDetPenjualan;
use App\Models\ModelBarang;

class Penjualan extends BaseController
{
    protected $ModelAnggota;
    protected $ModelPenjualan;
    protected $ModelDetPenjualan;
    protected $ModelBarang;

    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelAnggota = new ModelAnggota();
        $this->ModelPenjualan = new ModelPenjualan();
        $this->ModelDetPenjualan = new ModelDetPenjualan();
        $this->ModelBarang = new ModelBarang();
    }

    public function index()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Penjualan',
            'anggota' => $this->ModelAnggota->allData(),
            'kd_penjualan' => $this->ModelPenjualan->kodePenjualan()
        ];
        return view('pengurus/transaksi/penjualan/v_index', $data);
    }

    public function cek_barang()
    {
        $kd_barang = $this->request->getPost('kd_barang');
        $barang = $this->ModelPenjualan->cekBarang($kd_barang);
        if ($barang == null) {
            $data = [
                'nm_barang' => '',
                'jenis_barang' => '',
                'satuan' => '',
                'harga_jual' => ''
            ];
        } else {
            $data = [
                'nm_barang' => $barang['nm_barang'],
                'jenis_barang' => $barang['jenis_barang'],
                'satuan' => $barang['satuan'],
                'harga_jual' => $barang['harga_jual']
            ];
        }
        echo json_encode($data);
    }

    public function tambah_barang()
    {
        $kd_barang = $this->request->getPost('kd_barang');
        $nm_barang = $this->request->getPost('nm_barang');
        $jenis_barang = $this->request->getPost('jenis_barang');
        $satuan = $this->request->getPost('satuan');
        $harga_jual = $this->request->getPost('harga_jual');
        $qty = $this->request->getPost('qty');
        $total_harga = $harga_jual * $qty;

        if (!$this->ModelPenjualan->cekStok($kd_barang, $qty)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Stok barang tidak mencukupi!']);
        }

        $data = [
            'kd_barang' => $kd_barang,
            'nm_barang' => $nm_barang,
            'jenis_barang' => $jenis_barang,
            'satuan' => $satuan,
            'harga_jual' => $harga_jual,
            'qty' => $qty,
            'total_harga' => $total_harga
        ];

        return $this->response->setJSON(['status' => 'success', 'data' => $data]);
    }

    public function simpan()
    {
        $request = service('request');

        $formData = $request->getPost('form');
        $items = $request->getPost('items');

        $penjualanData = [];
        foreach ($formData as $field) {
            $penjualanData[$field['name']] = $field['value'];
        }

        $this->ModelPenjualan->insert($penjualanData);

        foreach ($items as $item) {
            $detPenjualanData = [
                'kd_penjualan' => $penjualanData['kd_penjualan'],
                'kd_barang' => $item['kd_barang'],
                'harga_jual' => $item['harga_jual'],
                'qty' => $item['qty'],
                'total_harga' => $item['total_harga']
            ];

            $this->ModelDetPenjualan->insert($detPenjualanData);

            // Update stok barang
            $this->ModelBarang->set('stok', 'stok - ' . $item['qty'], false)
                ->where('kd_barang', $item['kd_barang'])
                ->update();
        }

        return $this->response->setJSON(['status' => 'success']);
    }
}
