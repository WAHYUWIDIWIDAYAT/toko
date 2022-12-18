<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiskonModel;

class DiskonController extends BaseController
{
    public function index()
    {
        //
    }

    //function where user input code discount and get discount value
    public function getDiscount()
    {
        $diskonModel = new DiskonModel();
        $code_discount = $this->request->getVar('code_discount');
        $diskon = $diskonModel->where('code_discount', $code_discount)->first();
        if ($diskon) {
            $data = [
                'status' => 200,
                'message' => 'success',
                'data' => $diskon
            ];
        } else {
            $data = [
                'status' => 404,
                'message' => 'code discount not found',
                'data' => null
            ];
        }
        return $this->response->setJSON($data);
    }
}
