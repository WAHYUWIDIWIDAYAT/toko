<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class VoucherController extends BaseController
{
    public function index()
    {
        //
    }
    public function voucher(){
		$voucherModel = new \App\Models\VoucherModel();
        $kode_voucher = $this->request->getVar('voucher');
		$voucher = $voucherModel->find($kode_voucher);
		return view('shop/product',[
            'voucher' => $voucher,
        ]);
	}
}
