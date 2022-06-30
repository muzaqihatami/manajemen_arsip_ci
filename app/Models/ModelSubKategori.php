<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelSubKategori extends Model {
    protected $table      = 'sub_kategori_surat';
    protected $primaryKey = 'id_sub_kategori';

    protected $allowedFields = ['id_sub_kategori', 'id_kategori', 'sub_kategori', 'format_file', 'created_at', 'updated_at'];
}