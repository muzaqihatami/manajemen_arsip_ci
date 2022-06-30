<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelAgendaSuratKeluar extends Model {
    protected $table      = 'agenda_srt_keluar';
    protected $primaryKey = 'id_agenda';

    protected $allowedFields = ['id_agenda', 'id_surat', 'tgl_keluar_surat'];
}