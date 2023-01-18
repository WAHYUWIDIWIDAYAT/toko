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
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->findAll();
        return view('barang/index',[
            'barang' => $barang,
            'kategori' => $kategori
        ]);
    }
    
    public function save()
    {
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
            session()->setFlashdata('error', 'Data gagal ditambahkan., Semua data harus diisi.');
            return redirect()->to(base_url('barang/create'));
        }

        $fileGambar = $this->request->getFile('gambar');
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }
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

        session()->setFlashdata('success', 'Data berhasil ditambahkan.');
        return redirect()->to('/barang');
    }
 
    public function kategori()
    {
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->findAll();
        return view('barang/index', [
            'kategori' => $kategori
        ]);

    }

    public function getBarang()
    {
        $barangModel = new BarangModel();
        $barang = $barangModel->findAll();
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->findAll();
        return view('barang/show', [
            'barang' => $barang,
            'kategori' => $kategori
        ]);
    }

    public function deleteBarang($id)
    {
        $barangModel = new BarangModel();
        $barangModel->delete($id);
        if ($barangModel->db->affectedRows() > 0) {
            session()->setFlashdata('success', 'Barang berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Barang gagal dihapus.');
        }
        return redirect()->to('/barang');
        
    }
    
    public function editBarang($id)
    {
        $barangModel = new BarangModel();
        $barang = $barangModel->find($id);
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->findAll();
        return view('barang/update', [
            'barang' => $barang,
            'kategori' => $kategori
        ]);
    }

    public function updateBarang($id)
    {
        $barangModel = new BarangModel();
        $barang = $barangModel->find($id);
        $fileGambar = $this->request->getFile('gambar');

        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLama');
        } else {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('uploads', $namaGambar);
            unlink('uploads/' . $this->request->getVar('gambarLama'));
        }
        
        $data = [
            'nama' => $this->request->getVar('nama_barang'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'id_kategori' => (int) $this->request->getVar('kategori'),
            'gambar' => $namaGambar
        ];
        $barangModel->update($id, $data);
        session()->setFlashdata('success', 'Barang berhasil diupdate.');
        return redirect()->to('/barang');
    }

    public function detailBarang($id)
    {
        $barangModel = new BarangModel();
        $barang = $barangModel->find($id);
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->findAll();
        return view('barang/detail', [
            'barang' => $barang,
            'kategori' => $kategori
        ]);
    }

}
