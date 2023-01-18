<?php

namespace App\Controllers;
use App\Models\DiskonModel;

class Home extends BaseController
{
    public function index()
    {
        $diskonModel = new DiskonModel();
        $diskon = $diskonModel->findAll();
        return view('home', ['diskon' => $diskon]);
    }
    public function contact()
    {
        return view('contact');
    }
}
