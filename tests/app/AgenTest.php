<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class AgenTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testIndexAgen()
    {
        $result = $this->get('pengurus/master/agen');
        $result->assertOK();
    }

    public function testAddAgen()
    {
        $data = [
            'kd_agen' => 'AGEN0003',
            'nm_agen' => 'Agen Arjuna',
            'alamat' => 'Jalan Arjuna Raya No. 14',
            'no_hp' => '081234567890',
            'email' => 'agenarjuna@example.com',
            'created_by' => '1'
        ];

        $result = $this->post('pengurus/master/agen/add', $data);
        $result->assertRedirect('pengurus/master/agen');
    }

    public function testEditAgen()
    {
        $id_agen = 3;
        $data = [
            'id_agen' => $id_agen,
            'kd_agen' => 'AGEN0003',
            'nm_agen' => 'Agen Arjuna',
            'alamat' => 'Jalan Arjuna Raya No. 12',
            'no_hp' => '081234567891',
            'email' => 'arjunaagen@example.com',
            'edited_by' => '1'
        ];

        $result = $this->post('pengurus/master/agen/edit/1', $data);
        $result->assertRedirect('pengurus/master/agen');
    }

    public function testDeleteAgen()
    {
        $id_agen = 3;
        $result = $this->get('pengurus/master/agen/delete/' . $id_agen);
        $result->assertRedirect('pengurus/master/agen');
    }
}
