<?php

namespace Tests\App\Controller;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class KasirTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testGetPenjualanIndex()
    {
        $result = $this->call('get', '/pengurus/transaksi/penjualan');
        $result->assertOK();
    }

    public function testPostCekBarangTidakTerdaftar()
    {
        $data = ['kd_barang' => 'BRG00003'];
        $result = $this->call('post', '/pengurus/transaksi/penjualan/cek_barang', $data);
        $result->assertStatus(302);
        $result->assertJSON(['nm_barang' => '', 'icon' => 'warning']);
    }

    public function testPostCekBarangTerdaftar()
    {
        $data = ['kd_barang' => 'BRG00001'];
        $result = $this->call('post', '/pengurus/transaksi/penjualan/cek_barang', $data);
        $result->assertStatus(302);
        $result->assertJSON(['nm_barang' => 'Air Mineral 250ml', 'icon' => 'success']);
    }

    public function testTambahItem()
    {
        $result = $this->post('/pengurus/transaksi/penjualan/tambah_barang', [
            'kd_barang' => 'BRG00001',
            'nm_barang' => 'Air Mineral 250ml',
            'jenis_barang' => '1',
            'satuan' => 'pcs',
            'harga_jual' => 4500,
            'qty' => 2,
            'total_harga' => 4500 * 2
        ]);
        $result->assertStatus(302); // Pastikan respons OK
        $result->assertJSON(['status' => 'success', 'nm_barang' => 'Air Mineral 250ml']);
    }

    public function testTambahItemStokTidakCukup()
    {
        $result = $this->post('/pengurus/transaksi/penjualan/tambah_barang', [
            'kd_barang' => 'BRG00001',
            'nm_barang' => 'Air Mineral 250ml',
            'jenis_barang' => '1',
            'satuan' => 'pcs',
            'harga_jual' => 4500,
            'qty' => 10, // Jumlah yang melebihi stok
            'total_harga' => 4500 * 10
        ]);
        $result->assertStatus(302); // Pastikan respons OK
        $result->assertJSON(['status' => 'error', 'message' => 'Stok barang tidak mencukupi!']);
    }

    public function testPostSimpanPenjualan()
    {
        $data = [
            'form' => [
                ['name' => 'kd_penjualan', 'value' => '202307170001'],
                ['name' => 'id_pengurus', 'value' => '1'],
                ['name' => 'id_anggota', 'value' => '1'],
                ['name' => 'tgl_penjualan', 'value' => '2023-07-16'],
                ['name' => 'jam', 'value' => '22:00:00'],
                ['name' => 'grand_total', 'value' => '9000'],
                ['name' => 'dibayar', 'value' => '10000'],
                ['name' => 'kembalian', 'value' => '1000']
            ],
            'items' => [
                [
                    'kd_barang' => 'BRG00001',
                    'harga_jual' => 4500,
                    'qty' => 2,
                    'total_harga' => 9000
                ]
            ]
        ];
        $result = $this->call('post', '/pengurus/transaksi/penjualan/simpan', $data);
        $result->assertOK();
    }
}
