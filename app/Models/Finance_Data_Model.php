<?php

namespace App\Models;

use CodeIgniter\Model;

class Finance_Data_Model extends Model
{
    protected $table      = 'finance_to_direktur';
    protected $primaryKey = 'id';
  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';



    protected $allowedFields = ['id_user_permintaan','nik_user', 'id_finance', 'respon_finance','keterangan'];


    public function getdata()
    {
      return $this->join('users', 'users.id = finance_to_direktur.id_finance')
               
                  ->join('permintaan', 'permintaan.id = finance_to_direktur.id_user_permintaan')
                 
                 
                  ->findAll();
    }
    



}