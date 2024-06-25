<?php

namespace App\Controllers;

use App\Models\ModelPengurus;

class Pengurus extends BaseController
{
    protected $ModelPengurus;

    public function __construct()
    {
        helper('form');
        $this->ModelPengurus = new ModelPengurus();
    }

    public function index()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Masuk'
        ];
        return view('pengurus/v_index', $data);
    }

    public function auth()
    {
        if ($this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ])) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $check = $this->ModelPengurus->login($username);
            if ($check != '') {
                if (password_verify($password, $check['password'])) {
                    session()->set('id', $check['id']);
                    session()->set('id_pengurus', $check['id_pengurus']);
                    session()->set('nm_pengurus', $check['nm_pengurus']);
                    session()->set('pp_pengurus', $check['pp_pengurus']);
                    session()->set('role', $check['role']);
                    session()->set('isLoggedIn', true);

                    return redirect()->to(base_url('pengurus/dashboard'));
                } else {
                    session()->setFlashdata('pesan', 'Login Gagal. Username atau Password Salah.');
                    return redirect()->to(base_url('pengurus'));
                }
            } else {
                session()->setFlashdata('pesan', 'Login Gagal. Akun Anda Tidak Ditemukan.');
                return redirect()->to(base_url('pengurus'));
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pengurus'));
        }
    }

    public function logout()
    {
        session()->remove('log');
        session()->remove('id');
        session()->remove('id_pengurus');
        session()->remove('nm_pengurus');
        session()->remove('profile_pic');
        session()->remove('role');
        session()->remove('isLoggedIn');

        return redirect()->to(base_url('pengurus'));
    }
}
