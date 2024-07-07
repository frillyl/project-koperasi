<?php

namespace App\Controllers;

use App\Models\ModelAnggota;
use App\Models\ModelPangkat;
use App\Models\ModelPengurus;
use App\Models\ModelAgen;
use App\Models\ModelSatuan;
use App\Models\ModelBarang;

class Master extends BaseController
{
    protected $ModelAnggota;
    protected $ModelPangkat;
    protected $ModelPengurus;
    protected $ModelAgen;
    protected $ModelSatuan;
    protected $ModelBarang;

    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelAnggota = new ModelAnggota();
        $this->ModelPangkat = new ModelPangkat();
        $this->ModelPengurus = new ModelPengurus();
        $this->ModelAgen = new ModelAgen();
        $this->ModelSatuan = new ModelSatuan();
        $this->ModelBarang = new ModelBarang();
    }

    // MASTER DATA ANGGOTA
    // Index Anggota
    public function index_anggota()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Master Data Anggota',
            'isi'   => 'pengurus/master/anggota/v_index',
            'anggota' => $this->ModelAnggota->allData(),
            'pangkat' => $this->ModelPangkat->allData()
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    // Tambah Anggota
    public function add_anggota()
    {
        if ($this->validate([
            'nrp' => [
                'label' => 'NRP',
                'rules' => 'required|is_unique[tb_anggota.nrp]|min_length[6]|max_length[15]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} telah terdaftar!',
                    'min_length' => '{field} minimal terdiri dari 6 digit!',
                    'max_length' => '{field} maksimal terdiri dari 15 digit!'
                ]
            ],
            'id_pangkat' => [
                'label' => 'Pangkat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'nm_anggota' => [
                'label' => 'Nama Anggota',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|is_unique[tb_anggota.email]|valid_email',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} telah terdaftar!',
                    'valid_email' => '{field} tidak valid!'
                ]
            ],
            'no_hp' => [
                'label' => 'No HP',
                'rules' => 'required|is_unique[tb_anggota.no_hp]|min_length[10]|max_length[13]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} telah terdaftar!',
                    'min_length' => '{field} minimal terdiri dari 10 digit!',
                    'max_length' => '{field} maksimal terdiri dari 13 digit!'
                ]
            ],
            'created_by' => [
                'label' => 'Ditambahkan Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $data = array(
                'nrp' => $this->request->getPost('nrp'),
                'id_pangkat' => $this->request->getPost('id_pangkat'),
                'nm_anggota' => $this->request->getPost('nm_anggota'),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp'),
                'created_by' => $this->request->getPost('created_by'),
            );
            $this->ModelAnggota->add($data);
            session()->setFlashdata('success', 'Data anggota berhasil ditambahkan!');
            return redirect()->to('pengurus/master/anggota');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pengurus/master/anggota'));
        }
    }

    // Ubah Anggota
    public function edit_anggota($id_anggota)
    {
        if ($this->validate([
            'nrp' => [
                'label' => 'NRP',
                'rules' => 'required|min_length[6]|max_length[15]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'min_length' => '{field} minimal terdiri dari 6 digit!',
                    'max_length' => '{field} maksimal terdiri dari 15 digit!'
                ]
            ],
            'id_pangkat' => [
                'label' => 'Pangkat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'nm_anggota' => [
                'label' => 'Nama Anggota',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'valid_email' => '{field} tidak valid!'
                ]
            ],
            'no_hp' => [
                'label' => 'No HP',
                'rules' => 'required|min_length[10]|max_length[13]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'min_length' => '{field} minimal terdiri dari 10 digit!',
                    'max_length' => '{field} maksimal terdiri dari 13 digit!'
                ]
            ],
            'status' => [
                'label' => 'Status Keanggotaan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => '{field} tidak boleh lebih dari 1MB!',
                    'is_image' => '{field} harus berupa gambar!',
                    'mime_in' => '{field} harus berformat JPG/PNG/JPEG!'
                ]
            ],
            'edited_by' => [
                'label' => 'Diubah Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $foto = $this->request->getFile('foto');
            if ($foto->getError() == 4) {
                $data = array(
                    'id_anggota' => $id_anggota,
                    'nrp' => $this->request->getPost('nrp'),
                    'id_pangkat' => $this->request->getPost('id_pangkat'),
                    'nm_anggota' => $this->request->getPost('nm_anggota'),
                    'email' => $this->request->getPost('email'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'status' => $this->request->getPost('status'),
                    'edited_by' => $this->request->getPost('edited_by'),
                );
                $this->ModelAnggota->edit($data);
            } else {
                $anggota = $this->ModelAnggota->detailData($id_anggota);
                if ($anggota['pp_anggota'] != "" && $anggota['pp_anggota'] != "user.png") {
                    unlink('public/assets/profile_pic/' . $anggota['pp_anggota']);
                }
                $nm_file = $foto->getRandomName();
                $data = array(
                    'id_anggota' => $id_anggota,
                    'nrp' => $this->request->getPost('nrp'),
                    'id_pangkat' => $this->request->getPost('id_pangkat'),
                    'nm_anggota' => $this->request->getPost('nm_anggota'),
                    'email' => $this->request->getPost('email'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'status' => $this->request->getPost('status'),
                    'edited_by' => $this->request->getPost('edited_by'),
                    'foto' => $nm_file
                );
                $foto->move('public/assets/profile_pic', $nm_file);
                $this->ModelAnggota->edit($data);
            }
            session()->setFlashdata('success', 'Data anggota berhasil diubah!');
            return redirect()->to(base_url('pengurus/master/anggota'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pengurus/master/anggota'));
        }
    }

    // Hapus Anggota
    public function delete_anggota($id_anggota)
    {
        $anggota = $this->ModelAnggota->detailData($id_anggota);
        if ($anggota['pp_anggota'] != "" && $anggota['pp_anggota'] != "user.png") {
            unlink('public/assets/profile_pic/' . $anggota['pp_anggota']);
        }

        $data = [
            'id_anggota' => $id_anggota
        ];
        $this->ModelAnggota->delete_data($data);
        session()->setFlashdata('success', 'Data anggota berhasil dihapus!');
        return redirect()->to(base_url('pengurus/master/anggota'));
    }

    // MASTER DATA PENGURUS
    // Index Pengurus
    public function index_pengurus()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Master Data Pengurus',
            'isi'   => 'pengurus/master/pengurus/v_index',
            'pengurus' => $this->ModelPengurus->allData()
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    // Tambah Pengurus
    public function add_pengurus()
    {
        if ($this->validate([
            'id_pengurus' => [
                'label' => 'ID Pengurus',
                'rules' => 'required|is_unique[tb_pengurus.id_pengurus]|min_length[6]|max_length[15]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} telah terdaftar!',
                    'min_length' => '{field} minimal terdiri dari 6 digit!',
                    'max_length' => '{field} maksimal terdiri dari 15 digit!'
                ]
            ],
            'nm_pengurus' => [
                'label' => 'Nama Pengurus',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'role' => [
                'label' => 'Posisi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'created_by' => [
                'label' => 'Ditambahkan Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $data = array(
                'id_pengurus' => $this->request->getPost('id_pengurus'),
                'nm_pengurus' => $this->request->getPost('nm_pengurus'),
                'role' => $this->request->getPost('role'),
                'created_by' => $this->request->getPost('created_by'),
            );
            $this->ModelPengurus->add($data);
            session()->setFlashdata('success', 'Data pengurus berhasil ditambahkan!');
            return redirect()->to('pengurus/master/pengurus');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pengurus/master/pengurus'));
        }
    }

    // Ubah Pengurus
    public function edit_pengurus($id)
    {
        if ($this->validate([
            'id_pengurus' => [
                'label' => 'ID Pengurus',
                'rules' => 'required|min_length[6]|max_length[15]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'min_length' => '{field} minimal terdiri dari 6 digit!',
                    'max_length' => '{field} maksimal terdiri dari 15 digit!'
                ]
            ],
            'nm_pengurus' => [
                'label' => 'Nama Pengurus',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'role' => [
                'label' => 'Posisi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => '{field} tidak boleh lebih dari 1MB!',
                    'is_image' => '{field} harus berupa gambar!',
                    'mime_in' => '{field} harus berupa gambar!'
                ]
            ]
        ])) {
            $foto = $this->request->getFile('foto');
            if ($foto->getError() == 4) {
                $data = array(
                    'id' => $id,
                    'id_pengurus' => $this->request->getPost('id_pengurus'),
                    'nm_pengurus' => $this->request->getPost('nm_pengurus'),
                    'role' => $this->request->getPost('role')
                );
                $this->ModelPengurus->edit($data);
            } else {
                $pengurus = $this->ModelPengurus->detailData($id);
                if ($pengurus['pp_pengurus'] != "" && $pengurus['pp_pengurus'] != "default.png") {
                    unlink('public/assets/profile_pic/' . $pengurus['pp_pengurus']);
                }
                $nm_file = $foto->getRandomName();
                $data = array(
                    'id' => $id,
                    'id_pengurus' => $this->request->getPost('id_pengurus'),
                    'nm_pengurus' => $this->request->getPost('nm_pengurus'),
                    'role' => $this->request->getPost('role'),
                    'foto' => $nm_file
                );
                $foto->move('public/assets/profile_pic', $nm_file);
                $this->ModelPengurus->edit($data);
            }
            session()->setFlashdata('success', 'Data pengurus berhasil diubah!');
            return redirect()->to(base_url('pengurus/master/pengurus'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pengurus/master/pengurus'));
        }
    }

    // Hapus Pengurus
    public function delete_pengurus($id)
    {
        $pengurus = $this->ModelPengurus->detailData($id);
        if ($pengurus['pp_pengurus'] != "" && $pengurus['pp_pengurus'] != "default.png") {
            unlink('public/assets/profile_pic/' . $pengurus['pp_pengurus']);
        }

        $data = [
            'id' => $id
        ];
        $this->ModelPengurus->delete_data($data);
        session()->setFlashdata('success', 'Data pengurus berhasil dihapus!');
        return redirect()->to(base_url('pengurus/master/pengurus'));
    }

    // MASTER DATA AGEN
    // Index Agen
    public function index_agen()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Master Data Agen',
            'isi'   => 'pengurus/master/agen/v_index',
            'agen' => $this->ModelAgen->allData(),
            'kd_agen' => 'AGEN' . str_pad($this->ModelAgen->getMaxId() + 1, 4, '0', STR_PAD_LEFT)
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    // Tambah Agen
    public function add_agen()
    {
        if ($this->validate([
            'kd_agen' => [
                'label' => 'Kode Agen',
                'rules' => 'required|is_unique[tb_agen.kd_agen]|min_length[8]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} telah terdaftar!',
                    'min_length' => '{field} minimal terdiri dari 8 digit!'
                ]
            ],
            'nm_agen' => [
                'label' => 'Nama Agen',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'no_hp' => [
                'label' => 'No HP',
                'rules' => 'required|is_unique[tb_agen.no_hp]|min_length[10]|max_length[13]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} telah terdaftar!',
                    'min_length' => '{field} minimal terdiri dari 10 digit!',
                    'max_length' => '{field} maksimal terdiri dari 13 digit!'
                ]
            ],
            'created_by' => [
                'label' => 'Ditambahkan Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $data = array(
                'kd_agen' => $this->request->getPost('kd_agen'),
                'nm_agen' => $this->request->getPost('nm_agen'),
                'ket' => $this->request->getPost('ket'),
                'alamat' => $this->request->getPost('alamat'),
                'no_hp' => $this->request->getPost('no_hp'),
                'email' => $this->request->getPost('email'),
                'created_by' => $this->request->getPost('created_by')
            );
            $this->ModelAgen->add($data);
            session()->setFlashdata('success', 'Data agen berhasil ditambahkan!');
            return redirect()->to('pengurus/master/agen');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pengurus/master/agen'));
        }
    }

    // Edit Agen
    public function edit_agen($id_agen)
    {
        if ($this->validate([
            'kd_agen' => [
                'label' => 'Kode Agen',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'min_length' => '{field} minimal terdiri dari 8 digit!'
                ]
            ],
            'nm_agen' => [
                'label' => 'Nama Agen',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'no_hp' => [
                'label' => 'No HP',
                'rules' => 'required|min_length[10]|max_length[13]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'min_length' => '{field} minimal terdiri dari 10 digit!',
                    'max_length' => '{field} maksimal terdiri dari 13 digit!'
                ]
            ],
            'edited_by' => [
                'label' => 'Diubah Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $data = array(
                'id_agen' => $id_agen,
                'kd_agen' => $this->request->getPost('kd_agen'),
                'nm_agen' => $this->request->getPost('nm_agen'),
                'ket' => $this->request->getPost('ket'),
                'alamat' => $this->request->getPost('alamat'),
                'no_hp' => $this->request->getPost('no_hp'),
                'email' => $this->request->getPost('email'),
                'edited_by' => $this->request->getPost('edited_by')
            );
            $this->ModelAgen->edit($data);
            session()->setFlashdata('success', 'Data agen berhasil diubah!');
            return redirect()->to(base_url('pengurus/master/agen'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pengurus/master/agen'));
        }
    }

    // Hapus Agen
    public function delete_agen($id_agen)
    {
        $data = [
            'id_agen' => $id_agen
        ];
        $this->ModelAgen->delete_data($data);
        session()->setFlashdata('success', 'Data agen berhasil dihapus!');
        return redirect()->to(base_url('pengurus/master/agen'));
    }

    // MASTER DATA SATUAN BARANG
    // Index Satuan Barang
    public function index_satuan()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Master Data Satuan Barang',
            'isi'   => 'pengurus/master/satuan/v_index',
            'satuan' => $this->ModelSatuan->allData()
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    // Tambah Satuan Barang
    public function add_satuan()
    {
        if ($this->validate([
            'satuan' => [
                'label' => 'Satuan Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $data = array(
                'satuan' => $this->request->getPost('satuan'),
                'ket' => $this->request->getPost('ket')
            );
            $this->ModelSatuan->add($data);
            session()->setFlashdata('success', 'Data satuan berhasil ditambahkan!');
            return redirect()->to('pengurus/master/satuan');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pengurus/master/satuan'));
        }
    }

    // Edit Satuan Barang
    public function edit_satuan($id_satuan)
    {
        if ($this->validate([
            'satuan' => [
                'label' => 'Satuan Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $data = array(
                'id_satuan' => $id_satuan,
                'ket' => $this->request->getPost('ket')
            );
            $this->ModelSatuan->edit($data);
            session()->setFlashdata('success', 'Data satuan berhasil diubah!');
            return redirect()->to(base_url('pengurus/master/satuan'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pengurus/master/satuan'));
        }
    }

    // Hapus Satuan Barang
    public function delete_satuan($id_satuan)
    {
        $data = [
            'id_satuan' => $id_satuan
        ];
        $this->ModelSatuan->delete_data($data);
        session()->setFlashdata('success', 'Data satuan berhasil dihapus!');
        return redirect()->to(base_url('pengurus/master/satuan'));
    }

    // MASTER DATA BARANG
    // Index Barang
    public function index_barang()
    {
        $data = [
            'title' => 'Primer Koperasi Darma Putra Kujang I',
            'sub'   => 'Master Data Barang',
            'isi'   => 'pengurus/master/barang/v_index',
            'barang' => $this->ModelBarang->allData(),
            'agen'  => $this->ModelAgen->allData(),
            'satuan' => $this->ModelSatuan->allData(),
            'kd_barang' => 'BRG' . str_pad($this->ModelBarang->getMaxId() + 1, 5, '0', STR_PAD_LEFT)
        ];
        return view('pengurus/layout/v_wrapper', $data);
    }

    public function add_barang()
    {
        if ($this->validate([
            'id_agen' => [
                'label' => 'Nama Agen',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'kd_barang' => [
                'label' => 'Kode Barang',
                'rules' => 'required|is_unique[tb_barang.kd_barang]|min_length[8]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} telah terdaftar!',
                    'min_length' => '{field} minimal terdiri dari 8 digit!'
                ]
            ],
            'nm_barang' => [
                'label' => 'Nama Barang',
                'rules' => 'required|is_unique[tb_barang.nm_barang]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} telah terdaftar!'
                ]
            ],
            'jenis_barang' => [
                'label' => 'Jenis Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'harga_pokok' => [
                'label' => 'Harga Pokok',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'harga_jual' => [
                'label' => 'Harga Jual',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'stok' => [
                'label' => 'Stok Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'id_satuan' => [
                'label' => 'Satuan Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ], 'foto' => [
                'label' => 'Foto',
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => '{field} tidak boleh lebih dari 1MB!',
                    'is_image' => '{field} harus berupa gambar!',
                    'mime_in' => '{field} harus berupa gambar!'
                ]
            ],
            'created_by' => [
                'label' => 'Ditambahkan Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $foto = $this->request->getFile('foto');
            if ($foto->getError() == 4) {
                $data = array(
                    'id_agen' => $this->request->getPost('id_agen'),
                    'kd_barang' => $this->request->getPost('kd_barang'),
                    'nm_barang' => $this->request->getPost('nm_barang'),
                    'jenis_barang' => $this->request->getPost('jenis_barang'),
                    'harga_pokok' => $this->request->getPost('harga_pokok'),
                    'harga_jual' => $this->request->getPost('harga_jual'),
                    'stok' => $this->request->getPost('stok'),
                    'id_satuan' => $this->request->getPost('id_satuan'),
                    'ket_barang' => $this->request->getPost('ket'),
                    'created_by' => $this->request->getPost('created_by'),
                );
                $this->ModelBarang->add($data);
            } else {
                $nm_file = $foto->getRandomName();
                $data = array(
                    'id_agen' => $this->request->getPost('id_agen'),
                    'kd_barang' => $this->request->getPost('kd_barang'),
                    'nm_barang' => $this->request->getPost('nm_barang'),
                    'jenis_barang' => $this->request->getPost('jenis_barang'),
                    'harga_pokok' => $this->request->getPost('harga_pokok'),
                    'harga_jual' => $this->request->getPost('harga_jual'),
                    'stok' => $this->request->getPost('stok'),
                    'id_satuan' => $this->request->getPost('id_satuan'),
                    'ket_barang' => $this->request->getPost('ket'),
                    'created_by' => $this->request->getPost('created_by'),
                    'image' => $nm_file
                );
                $foto->move('public/assets/images', $nm_file);
                $this->ModelBarang->add($data);
            }
            session()->setFlashdata('success', 'Data barang berhasil ditambahkan!');
            return redirect()->to(base_url('pengurus/master/barang'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pengurus/master/barang'));
        }
    }

    public function edit_barang($id_barang)
    {
        if ($this->validate([
            'id_agen' => [
                'label' => 'Nama Agen',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'kd_barang' => [
                'label' => 'Kode Barang',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'min_length' => '{field} minimal terdiri dari 8 digit!'
                ]
            ],
            'nm_barang' => [
                'label' => 'Nama Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'jenis_barang' => [
                'label' => 'Jenis Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'harga_pokok' => [
                'label' => 'Harga Pokok',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'harga_jual' => [
                'label' => 'Harga Jual',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'stok' => [
                'label' => 'Stok Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'id_satuan' => [
                'label' => 'Satuan Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ], 'foto' => [
                'label' => 'Foto',
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => '{field} tidak boleh lebih dari 1MB!',
                    'is_image' => '{field} harus berupa gambar!',
                    'mime_in' => '{field} harus berupa gambar!'
                ]
            ],
            'edited_by' => [
                'label' => 'Diubah Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $foto = $this->request->getFile('foto');
            if ($foto->getError() == 4) {
                $data = array(
                    'id_barang' => $id_barang,
                    'id_agen' => $this->request->getPost('id_agen'),
                    'kd_barang' => $this->request->getPost('kd_barang'),
                    'nm_barang' => $this->request->getPost('nm_barang'),
                    'jenis_barang' => $this->request->getPost('jenis_barang'),
                    'harga_pokok' => $this->request->getPost('harga_pokok'),
                    'harga_jual' => $this->request->getPost('harga_jual'),
                    'stok' => $this->request->getPost('stok'),
                    'id_satuan' => $this->request->getPost('id_satuan'),
                    'ket_barang' => $this->request->getPost('ket'),
                    'edited_by' => $this->request->getPost('edited_by'),
                );
                $this->ModelBarang->edit($data);
            } else {
                $barang = $this->ModelBarang->detailData($id_barang);
                if ($barang['image'] != "" && $barang['image'] != "no_image.png") {
                    unlink('public/assets/images/' . $barang['image']);
                }
                $nm_file = $foto->getRandomName();
                $data = array(
                    'id_barang' => $id_barang,
                    'id_agen' => $this->request->getPost('id_agen'),
                    'kd_barang' => $this->request->getPost('kd_barang'),
                    'nm_barang' => $this->request->getPost('nm_barang'),
                    'jenis_barang' => $this->request->getPost('jenis_barang'),
                    'harga_pokok' => $this->request->getPost('harga_pokok'),
                    'harga_jual' => $this->request->getPost('harga_jual'),
                    'stok' => $this->request->getPost('stok'),
                    'id_satuan' => $this->request->getPost('id_satuan'),
                    'ket_barang' => $this->request->getPost('ket'),
                    'edited_by' => $this->request->getPost('edited_by'),
                    'image' => $nm_file
                );
                $foto->move('public/assets/images', $nm_file);
                $this->ModelBarang->edit($data);
            }
            session()->setFlashdata('success', 'Data barang berhasil diubah!');
            return redirect()->to(base_url('pengurus/master/barang'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pengurus/master/barang'));
        }
    }

    public function delete_barang($id_barang)
    {
        $barang = $this->ModelBarang->detailData($id_barang);
        if ($barang['image'] != "" && $barang['image'] != "no_image.png") {
            unlink('public/assets/images/' . $barang['image']);
        }

        $data = [
            'id_barang' => $id_barang
        ];
        $this->ModelBarang->delete_data($data);
        session()->setFlashdata('success', 'Data barang berhasil dihapus!');
        return redirect()->to(base_url('pengurus/master/barang'));
    }
}
