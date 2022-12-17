<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    public function index()
    {
        //
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->findAll();
        return view('kategori/index',[
            'kategori' => $kategori
        ]);
    }

    public function create()
    {
        $kategoriModel = new KategoriModel();
        $kategoriModel->save([
            'nama' => $this->request->getVar('nama'),
            'created_by' => $this->request->getVar('created_by')
        ]);

        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('/kategori');
    }
}
