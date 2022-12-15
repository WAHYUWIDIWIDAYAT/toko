<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\KategoriModel;

class Barang extends BaseController
{
    public function index(){
        $barangModel = new BarangModel();
        $barang = $barangModel->findAll();
        return view('barang/index',[
            'barang' => $barang
        ]);
    }
    
    public function save()
    {
        // dd($this->request->getVar('nama'));
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[barang.nama]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah ada.'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} harus berupa angka.'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} harus berupa angka.'
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu.',
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'is_image' => 'File yang anda pilih bukan gambar.',
                    'mime_in' => 'File yang anda pilih bukan gambar.'
                ]
            ]
        ])) {
            return redirect()->to('/barang/create')->withInput();
        }

        $fileGambar = $this->request->getFile('gambar');
        //check 
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('uploads', $namaGambar);
        $data = [
            'nama' => $this->request->getVar('nama'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'id_kategori' => (int) $this->request->getVar('id_kategori'),
            'gambar' => $namaGambar
        ];

        $barangModel = new BarangModel();
        $barangModel->insert($data);



        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/barang');
    }
    //find kategori
    public function kategori()
    {
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->findAll();
        return view('barang/index', [
            'kategori' => $kategori
        ]);

    }
}
