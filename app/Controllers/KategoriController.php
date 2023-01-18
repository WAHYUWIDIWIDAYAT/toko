<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    public function index()
    {
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->findAll();
        return view('kategori/index',[
            'kategori' => $kategori
        ]);
    }

    public function create()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[kategori.nama]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah ada.'
                ]
            ]
        ])) {
            session()->setFlashdata('error', 'Data gagal ditambahkan, Semua data harus diisi.');
            return redirect()->to('/kategori');
        }
        $kategoriModel = new KategoriModel();
        $kategoriModel->save([
            'nama' => $this->request->getVar('nama'),
            'created_by' => $this->request->getVar('created_by')
        ]);

        session()->setFlashdata('success', 'Data berhasil ditambahkan.');
        return redirect()->to('/kategori');
    }
}
