<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {   
        $voucherModel = new \App\Models\VoucherModel();
        $voucher = $voucherModel->where('aktif',1)->findAll();
		return view('home',[
			'voucher' => $voucher,
		]);
    }
}