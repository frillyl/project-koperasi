<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Dashboard',
            'isi'   => 'pengurus/v_dashboard',
        ];
        return view('pengurus/layout/v_Wrapper', $data);
    }
}
