<?php

namespace App\Models;

use CodeIgniter\Model;

class DiskonModel extends Model
{
    protected $table            = 'discount';
    protected $allowedFields    = ['id','code_discount','discount','start_date','end_date'];
}
