<?php

namespace App\Models;

use CodeIgniter\Model;

class VoucherModel extends Model
{
    protected $table            = 'diskon';
    protected $primaryKey = 'id';
    protected $allowedFields = [
		'id','kode_voucher','besar_diskon','aktif','created_by','created_date','tanggal_akhir_berlaku','tanggal_mulai_berlaku'
	];

    protected $returnType = 'App\Entities\Voucher';
    protected $useTimestamps = false;
}
