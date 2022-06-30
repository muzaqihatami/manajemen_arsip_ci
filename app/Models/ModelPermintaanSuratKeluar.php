<?php

namespace App\Models;
use CodeIgniter\Model;

class ModelPermintaanSuratKeluar extends Model {
    protected $table      = 'permintaan_surat_keluar';
    protected $primaryKey = 'id_permintaan';

    protected $allowedFields = ['id_permintaan', 'pemohon', 'tujuan_surat', 'perihal', 'catatan', 'is_created', 'id_admin', 'is_deleted'];
}