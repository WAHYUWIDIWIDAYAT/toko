<?php

namespace App\Models;

use CodeIgniter\Model;

class VoucherModel extends Model
{
    protected $table            = 'voucher';
    protected $primaryKey = 'id';
    protected $allowedFields = [
		'id','kode_voucher','besar_diskon','aktif','created_by','created_date'
	];

    protected $returnType = 'App\Entities\Voucher';
    protected $useTimestamps = false;
}
