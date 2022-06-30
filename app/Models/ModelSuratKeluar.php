<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelSuratKeluar extends Model {
    protected $table      = 'surat_keluar';
    protected $primaryKey = 'id_surat';

    protected $allowedFields = ['id_surat', 'id_admin', 'id_kategori', 'id_sub_kategori', 'no_surat', 'keterangan', 'perihal', 'tujuan_surat', 'tgl_surat', 'file_surat'];
}