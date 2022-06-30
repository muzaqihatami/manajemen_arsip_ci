<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelAdmin extends Model {
    protected $table      = 'admin';
    protected $primaryKey = 'id_admin';

    protected $allowedFields = ['id_admin', 'nama', 'email', 'password'];
}