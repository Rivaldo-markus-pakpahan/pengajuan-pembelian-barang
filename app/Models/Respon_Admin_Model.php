<?php

namespace App\Models;

use CodeIgniter\Model;

class Respon_Admin_Model extends Model
{
    protected $table      = 'respon_admin';
    protected $primaryKey = 'id';
  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';



    protected $allowedFields = ['id_admin', 'respon_admin', 'catatan_admin'];


    
}