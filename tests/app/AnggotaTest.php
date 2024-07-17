<?php

namespace Tests\App\Controller;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class AnggotaTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testIndexAnggota()
    {
        $result = $this->get('pengurus/master/anggota');

        $result->assertOK();
        // Anda juga bisa menambahkan asersi untuk memeriksa tampilan data anggota jika perlu
    }

    public function testAddAnggota()
    {
        $data = [
            'nrp' => '123456',
            'id_pangkat' => '1',
            'nm_anggota' => 'John Doe',
            'email' => 'johndoe@example.com',
            'no_hp' => '081234567890',
            'created_by' => '1'
        ];

        $result = $this->post('pengurus/master/anggota/add', $data);

        $result->assertRedirect('pengurus/master/anggota'); // Pastikan redirect setelah berhasil
        // Anda juga bisa menambahkan asersi untuk pesan sukses jika perlu
    }

    public function testEditAnggota()
    {
        $id_anggota = 1; // Sesuaikan dengan ID anggota yang ada dalam database
        $data = [
            'id_anggota' => $id_anggota,
            'nrp' => '654321',
            'id_pangkat' => '2',
            'nm_anggota' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'no_hp' => '087654321098',
            'status' => 'Aktif',
            'edited_by' => '1'
        ];

        $result = $this->post('pengurus/master/anggota/edit/' . $id_anggota, $data);

        $result->assertRedirect('pengurus/master/anggota'); // Pastikan redirect setelah berhasil
        // Anda juga bisa menambahkan asersi untuk pesan sukses jika perlu
    }

    public function testDeleteAnggota()
    {
        $id_anggota = 1; // Sesuaikan dengan ID anggota yang ada dalam database

        $result = $this->get('pengurus/master/anggota/delete/' . $id_anggota);

        $result->assertRedirect('pengurus/master/anggota'); // Pastikan redirect setelah berhasil
        // Anda juga bisa menambahkan asersi untuk pesan sukses jika perlu
    }
}
