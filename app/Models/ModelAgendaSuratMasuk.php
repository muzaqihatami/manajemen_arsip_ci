<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelAgendaSuratMasuk extends Model {
    protected $table      = 'agenda_srt_msk';
    protected $primaryKey = 'id_agenda';

    protected $allowedFields = ['id_agenda', 'id_surat', 'no_msk_surat', 'tgl_msk_surat', 'is_deleted'];
}