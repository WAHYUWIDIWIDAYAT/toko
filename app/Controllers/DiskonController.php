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

    public function getDiscount()
    {
        $diskonModel = new DiskonModel();
        $code_discount = $this->request->getVar('code_discount');
        $diskon = $diskonModel->where('code_discount', $code_discount)->first();
        if (!$diskon) {
            $data = [
                'status' => 400,
                'message' => 'discount not found',
                'data' => null
            ];
            return $this->response->setJSON($data);
        }

        $start_date = $diskon['start_date'];
        $end_date = $diskon['end_date'];
        if ($diskon && $start_date <= date("Y-m-d") && $end_date >= date("Y-m-d")) {
            $data = [
                'status' => 200,
                'message' => 'success',
                'data' => $diskon
            ];
        }
        else if ($diskon && $start_date > date("Y-m-d")) {
            $data = [
                'status' => 401,
                'message' => 'discount has not started',
                'data' => null
            ];
        }
        else if ($diskon && $end_date < date("Y-m-d")) {
            $data = [
                'status' => 404,
                'message' => 'discount has ended',
                'data' => null
            ];
        }
        else {
            $data = [
                'status' => 400,
                'message' => 'discount not found',
                'data' => null
            ];
        }
        return $this->response->setJSON($data);
    }
}
