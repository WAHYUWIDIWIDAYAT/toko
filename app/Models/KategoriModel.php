<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Kategori;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id','nama','created_date','created_by','updated_date','updated_by'
    ];

    //declare return use app\Entities\Kategori
    protected $returnType = 'App\Entities\Kategori';
    protected $useTimestamps = false;

}