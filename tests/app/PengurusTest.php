<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class PengurusTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testIndexPengurus()
    {
        $result = $this->get('pengurus/master/pengurus');
        $result->assertOK();
    }

    public function testAddPengurus()
    {
        $data = [
            'id_pengurus' => 'johndoe123',
            'nm_pengurus' => 'John Doe',
            'role' => '2',
            'created_by' => '1'
        ];

        $result = $this->post('pengurus/master/pengurus/add', $data);
        $result->assertRedirect('pengurus/master/pengurus');
    }

    public function testEditPengurus()
    {
        $id = 7;
        $data = [
            'id' => $id,
            'nm_pengurus' => 'John Doe 123',
            'role' => '2'
        ];

        $result = $this->post('pengurus/master/pengurus/edit/' . $id, $data);
        $result->assertRedirect('pengurus/master/pengurus');
    }

    public function testDeletePengurus()
    {
        $id = 7;
        $result = $this->get('pengurus/master/pengurus/delete/' . $id);
        $result->assertRedirect('pengurus/master/pengurus');
    }
}
