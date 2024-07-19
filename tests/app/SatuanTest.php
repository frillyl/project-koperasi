<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class SatuanTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testIndexAgen()
    {
        $result = $this->get('pengurus/master/satuan');
        $result->assertOK();
    }

    public function testAddSatuan()
    {
        $data = [
            'satuan' => 'kodi',
            'ket' => 'Satuan dalam matematika yang digunakan untuk menyatakan jumlah dari keseluruhan benda atau barang seperti baju, tas, kayu, mainan, sepatu, dan sebagainya.'
        ];

        $result = $this->post('pengurus/master/satuan/add', $data);
        $result->assertRedirect('pengurus/master/satuan');
    }

    public function testEditSatuan()
    {
        $id_satuan = 12;
        $data = [
            'id_satuan' => $id_satuan,
            'satuan' => 'kodi',
            'ket' => 'Satuan dalam matematika yang digunakan untuk menyatakan jumlah dari keseluruhan benda atau barang seperti baju, tas, kayu, mainan, sepatu, dan sebagainya.'
        ];

        $result = $this->post('pengurus/master/satuan/edit/' . $id_satuan, $data);
        $result->assertRedirect('pengurus/master/satuan');
    }

    public function testDeleteSatuan()
    {
        $id_satuan = 12;
        $result = $this->get('pengurus/master/satuan/delete/' . $id_satuan);
        $result->assertRedirect('pengurus/master/satuan');
    }
}
