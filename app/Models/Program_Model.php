<?php

namespace App\Models;

use CodeIgniter\Model;

class Program_Model extends Model
{
    protected $table      = 'tbl_prgram';
    protected $primaryKey = 'id';
  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';



    protected $allowedFields = ['id','nama_program','tahun_program'];


}