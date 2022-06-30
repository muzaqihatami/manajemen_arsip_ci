<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelSuratMasuk extends Model {
    protected $table      = 'surat_masuk';
    protected $primaryKey = 'id_surat';

    protected $allowedFields = ['id_admin', 'id_surat', 'tgl_surat', 'no_surat', 'pengirim', 'perihal', 'tujuan', 'file', 'id_disposisi' ,'is_deleted'];
}