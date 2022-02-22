<?php

namespace App\Controllers;

use App\Models\KomikModel;
use App\Models\MenuModel;

class Komik extends BaseController
{
    protected $komikModel;
    protected $MenuModel;
    public function __construct()
    {
        $this->komikModel = new KomikModel();
        $this->MenuModel = new MenuModel();
    }
    public function index()
    {
        // $komik = $this->komikModel->findAll();
        $all_data = $this->MenuModel->getSubMenu()->getResultArray();
        $sorted = getMenuku($all_data);
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik(),
            'menu' => $all_data,
            'sorted' => $sorted
        ];

        return view('komik/index', $data);
    }
    public function detail($slug)
    {
        $muku = $this->komikModel->getKomik($slug);
        $all_data = $this->MenuModel->getSubMenu()->getResultArray();
        $sorted = getMenuku($all_data);
        $data = [
            'title' => "Detail Komik",
            'komik' => $muku,
            'sorted' => $sorted
        ];
        if ($muku != null) {

            return view('komik/detail', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function create()
    {
        $all_data = $this->MenuModel->getSubMenu()->getResultArray();
        $sorted = getMenuku($all_data);
        $data = [
            'title' => 'Form Tambah Data',
            'validation' =>  \Config\Services::validation(),
            'sorted' => $sorted
        ];
        return view('komik/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul' => 'required|is_unique[komik.judul]',
            'penulis' => 'required',
            'penerbit' => 'required',
            'sampul' => [
                'rules' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]'
            ]
        ])) {
            // $validation =  \Config\Services::validation();
            // // dd($validation);
            // return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
            return redirect()->to('/komik/create')->withInput();
        }
        // dd('berhasil');
        // ambil gambar
        $filesampul = $this->request->getFile('sampul');
        // pindahkan ke folder
        $sampulName = $filesampul->getRandomName();
        $filesampul->move(ROOTPATH . 'public\img', $sampulName);
        // $namasampul = $filesampul->getName();
        // dd($filesampul);
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' =>  $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $sampulName,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        //cari img
        $komik = $this->komikModel->find($id);
        //hapus img
        if ($komik['sampul'] != 'komik1.jpg') {

            unlink(ROOTPATH . 'public\img\\' .  $komik['sampul']);
        }
        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $all_data = $this->MenuModel->getSubMenu()->getResultArray();
        $sorted = getMenuku($all_data);
        $data = [
            'title' => 'Form ubah Data',
            'validation' =>  \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug),
            'sorted' => $sorted
        ];

        return view('komik/edit', $data);
    }

    public function update($id)
    {
        // cek judul

        $komiklama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($komiklama['judul'] = $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        }

        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'judul harus diisi',
                    'is_unique' => 'judul sudah terdaftar'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'penulis harus diisi',
                    'is_unique' => 'penulis sudah terdaftar'
                ]
            ],
            'penerbit' => 'required',
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]'
            ]


        ])) {
            // $validation =  \Config\Services::validation();
            // // dd($validation);
            // return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');
        //cek gambar, apakah sama dengan yang lama

        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move(ROOTPATH . 'public\img', $namaSampul);
            unlink(ROOTPATH . 'public\img\\' . $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' =>  $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul,
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/komik');
    }
}