<?php

namespace App\Models;

use CodeIgniter\Model;

class Direktur_FeedBack_Model extends Model
{
    protected $table      = 'direktur_data';
    protected $primaryKey = 'id';
  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';



    protected $allowedFields = ['id_pemohon', 'nik_direktur', 'bukti_transfer', 'respon', 'email_pemohon', 'id_user_pemohon'];


  public function getdata()
  {
    return $this->join('permintaan', 'permintaan.nik_user = direktur.nik_pemohon')
                ->join('finance_to_direktur', 'finance_to_direktur.id_user_permintaan = direktur.nik_pemohon')
               
                ->findAll();
  }

   
    
}