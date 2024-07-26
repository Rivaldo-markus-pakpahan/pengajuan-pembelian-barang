<?php

namespace App\Models;

use CodeIgniter\Model;

class Permintaan_Model extends Model
{
    protected $table      = 'permintaan';
    protected $primaryKey = 'id';
  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';



    protected $allowedFields = ['nik_user','nama_barang','biaya','catatan','lampiran', 'aktif', 'direktur_aktif','reject', 'alasan'];


}