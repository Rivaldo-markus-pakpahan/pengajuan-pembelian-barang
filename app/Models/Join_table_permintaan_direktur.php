<?php

namespace App\Models;

use CodeIgniter\Model;

class  Join_table_permintaan_direktur extends Model
{
    protected $table      = 'join_direktur_permintaan';
    protected $primaryKey = 'id';
  



    protected $allowedFields = ['id_permintaan', 'id_direktur','respon', 'bukti_transfer', 'no_wa'];


    
}