<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class LoginTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testIndex()
    {
        $result = $this->call('get', 'pengurus/login');
        $result->assertStatus(200);
        $result->assertSee('Primer Koperasi Darma Putra Kujang I');
        $result->assertSee('Masuk');
    }

    public function testAuthSuccess()
    {
        $data = [
            'username' => 'admin',
            'password' => 'iniakunpengurus',
        ];

        $result = $this->call('post', 'pengurus/login/auth', $data);
        $result->assertRedirect(base_url('pengurus/dashboard')); // Menggunakan base_url
    }


    public function testAuthFailure()
    {
        $data = [
            'username' => 'manajemen',
            'password' => 'iniakunmanajemen',
        ];

        $result = $this->call('post', 'pengurus/login/auth', $data);
        $result->assertRedirect(base_url('pengurus/login')); // Menggunakan base_url
    }


    public function testLogout()
    {
        session()->set('isLoggedIn', true);
        session()->set('id_pengurus', 1);  // Set ID sesuai dengan salah satu data pengurus yang ada

        $result = $this->call('get', 'pengurus/logout');
        $result->assertRedirect(base_url('pengurus/login')); // Menggunakan base_url
    }
}
