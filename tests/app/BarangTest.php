<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class BarangTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testIndexBarang()
    {
        $result = $this->get('pengurus/master/barang');
        $result->assertOK();
    }

    public function testAddBarang()
    {
        $data = [
            'id_agen' => '1',
            'id_satuan' => '2',
            'kd_barang' => 'BRG00003',
            'nm_barang' => 'Minyak Goreng 1.5 Liter',
            'jenis_barang' => '1',
            'harga_pokok' => '35000',
            'harga_jual' => '40000',
            'stok' => '10',
            'created_by' => '1'
        ];
        $result = $this->post('pengurus/master/barang/add', $data);
        $result->assertRedirect('pengurus/master/barang');
    }

    public function testEditBarang()
    {
        $id_barang = 4;
        $data = [
            'id_barang' => $id_barang,
            'id_agen' => '2',
            'id_satuan' => '2',
            'kd_barang' => 'BRG00003',
            'nm_barang' => 'Minyak Goreng 2 Liter',
            'jenis_barang' => '1',
            'harga_pokok' => '40000',
            'harga_jual' => '45000',
            'stok' => '15',
            'edited_by' => '1'
        ];
        $result = $this->post('pengurus/master/barang/edit/' . $id_barang, $data);
        $result->assertRedirect('pengurus/master/barang');
    }

    public function testDeleteBarang()
    {
        $id_barang = 4;
        $result = $this->get('pengurus/master/barang/delete/' . $id_barang);
        $result->assertRedirect('pengurus/master/barang');
    }
}
