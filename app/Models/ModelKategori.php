<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelKategori extends Model {
    protected $table      = 'kategori_surat';
    protected $primaryKey = 'id_kategori';

    protected $allowedFields = ['id_kategori', 'kategori', 'inisial','format_no', 'created_at', 'updated_at'];
}