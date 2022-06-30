<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelDisposisi extends Model {
    protected $table      = 'disposisi';
    protected $primaryKey = 'id_disposisi';

    protected $allowedFields = ['id_disposisi', 'diteruskan_kpd', 'catatan'];
}