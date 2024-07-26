<?php

namespace App\Controllers;
use myth\auth\Models\UserModel;
use App\Models\Permintaan_Model;
use App\Models\Finance_Data_Model;
use App\Models\Join_table_permintaan_direktur;
use App\Models\Program_Model;
use App\Models\Direktur_FeedBack_Model;


class Finance extends BaseController
{

    protected $UserModel;
    protected $Permintaan_Model;
    protected $Finance_Data_Model;
    protected $Join_table_permintaan_direktur;
    protected $Program_Model;
    protected $Direktur_FeedBack_Model;


    public function __construct()
    {
        $this->permintaan_model = new Permintaan_Model();   
        $this->usermodel= new UserModel();
     
        $this->finance_data = new Finance_Data_Model();
        $this->join_table = new Join_table_permintaan_direktur() ;
        $this->program = new Program_Model();
        $this->direktur_feedback = new Direktur_FeedBack_Model();
    }

    public function index()
    {
        
        
      $getdata = $this->permintaan_model->orderBy('created_at', 'DESC')->findAll();
 
        $getuser = $this->usermodel->findAll();
      
        $filterdata = array();
        foreach($getdata as $data)
        {
            foreach($getuser as $user){
                if($data['nik_user'] == $user->nik)
                {
                    $filterdata[] = $data;
                    break;
                }
            }
        }
        
        return view('Finance_View/Data_Pengajuan', ['getdata' => $filterdata, 'getuser' => $getuser]);
    }



    public function viewdata($id)
    {
        
        $id = $this->request->uri->getSegment(3);

        $getid = $this->permintaan_model->find($id);
      
      
        return view('Finance_View/Feedback_finance', ['getid'=>$getid]);
    }

    public function reject($id)
    {
        $id = $this->request->uri->getSegment(3);
        $getid = $this->permintaan_model->find($id);
      
      
        return view('Finance_View/Feedback_finance_reject', ['getid'=>$getid]);
    }

    public function save_reject($id)
    {
        if ($this->request->getMethod() === 'post')
        {
            $id = $this->request->getVar('id');
            $data = [
                'reject' => htmlspecialchars($this->request->getVar('reject')),
                'alasan' => htmlspecialchars($this->request->getVar('alasan')),
            ];
            
            // Retrieve the data by ID
            $getid = $this->permintaan_model->find($id);
    
            if (!$getid) {
                // Handle the case when no data is found
                return redirect()->back()->withInput()->with('error', 'Data not found');
            }
    
            // Update the data with the rejection details
            $save_reject = $this->permintaan_model->update($id, $data);
    
            if ($save_reject)
            {
                $session = session();
                $session->setFlashdata("message", 'Data berhasil dikirim');
                return redirect()->to(base_url('/finance'));
            } else {
                // Handle the case when the update fails
                return redirect()->back()->withInput()->with('error', 'Failed to update data');
            }
        }
    }
    
    
    

    

    public function save_data_permintaan()
    {

       $id_finance = user()->id ;
     
        if($this->request->getMethod() === 'post')
        {
            $data = [
                'id_user_permintaan' => htmlspecialchars($this->request->getVar('id_user_permintaan')),
                'nik_user' => htmlspecialchars($this->request->getVar('nik_user')),
                'id_finance' => $id_finance,
                'keterangan' => htmlspecialchars($this->request->getVar('keterangan')),
                'respon_finance' => htmlspecialchars($this->request->getVar('respon_finance')),
            ];  
        
        }

        $save_data = $this->finance_data->save($data);
     
        if($save_data)
        {
            $ambilid = $this->finance_data->getInsertID();
        
        
        
          $save =  $this->simpanid($data['id_user_permintaan']);
        
       
          $session = session();
          $session->setFlashdata("message", 'Data berhasil dikirim');
            return redirect()->to(base_url('/finance/history'));
        }else {
            // Jika penyimpanan gagal, Anda dapat menangani kesalahan di sini
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan permintaan');
        }
    }

    private function simpanid($id_user_permintaan)
    {
        $data = [
            'aktif' => $id_user_permintaan,
            
        ];
        // Cek apakah sudah ada data dengan id_user_permintaan di tabel permintaan_model
        $existing_data = $this->permintaan_model->where('id', $id_user_permintaan)->first();
    
        // Jika sudah ada data, lakukan update; jika tidak, lakukan insert
        if ($existing_data) {
            // Lakukan pembaruan (update)
          
            $this->permintaan_model->update($existing_data['id'], $data);
        } else {
            // Jika tidak ada baris dengan id_permintaan yang diberikan, tambahkan data baru
            $data['id_user_permintaan'] = $id_user_permintaan;
            $this->permintaan_model->insert($data);
        }
    }
  


    public function history()
    {
        $getdata = $this->finance_data->where('id_finance', user()->id)->getdata();
        $getusermodel = $this->usermodel->findAll();
       
        $filter = array();


        foreach($getdata as $data)
        {
            foreach($getusermodel as $user)
            {
                if ($data['nik_user'] ==  $user->nik) 
                {
                    $filter[] = $data;
                    break;
                }
            }
        }

        
        return view('Finance_View/History', ['getdata' => $filter , 'getusermodel'=>$getusermodel]);
    }



public function excel()
{
    $getdata = $this->finance_data->where('id_finance', user()->id)->getdata();
        $getusermodel = $this->usermodel->findAll();
       
        $filter = array();


        foreach($getdata as $data)
        {
            foreach($getusermodel as $user)
            {
                if ($data['nik_user'] ==  $user->nik) 
                {
                    $filter[] = $data;
                    break;
                }
            }
        }

    return view('Finance_View/excel', ['getdata' => $filter , 'getusermodel'=>$getusermodel]);
}


public function excel_permintaan()
{
   
    $getpermintaan = $this->permintaan_model->where('nik_user', user()->nik)->findAll();
    $getjoin = $this->join_table->findAll();
    
    $filter = array();

    foreach($getpermintaan as $minta)
    {
        foreach($getjoin as $join)
        {
            if($minta['id'] == $join['id_permintaan'])
            {
                $filter[] = $minta;
                break;
            }
        }
    }
   
    echo view('Finance_View/excel_permintaan_finance', ['getpermintaan' => $filter, 'getjoin' => $getjoin]);
}







  //tampilan permintaan dan data permintaan //

  public function permintaan_finance()
  {
    // $ambilprogram = $this->program->findAll();
    return view('Finance_View/Finance_Permintaan');
  }



  public function save_data()
    {


        $nik_user = user()->nik ;
   
         // Ambil gambar
         $gambar = $this->request->getFile('lampiran');
        
         // Pindahkan ke folder
         $gambar->move('bukti_lampiran');
         
         // Ambil nama gambar
         $nama_gambar = $gambar->getName();
 
 
         if($this->request->getMethod() === 'post') {
 
         $data = [
             'nik_user' => $nik_user,
             'nama_barang' => htmlspecialchars($this->request->getVar('nama_barang')),  
             'biaya' => htmlspecialchars($this->request->getVar('biaya')),  
             'catatan' => htmlspecialchars($this->request->getVar('catatan')),
             'lampiran' => $nama_gambar
 
         ];
        }
        $save = $this->permintaan_model->save($data);


        if ($save) {
            // Jika penyimpanan berhasil, dapatkan ID permintaan
            $id_permintaan = $this->permintaan_model->getInsertID();
            
            // Kirim data ke tabel direktur
            $saveid = $this->join_table($id_permintaan);
        
            $session = session();
        $session->setFlashdata("message", 'Data berhasil dikirim');
         return redirect()->to(base_url('finance/status_finance'));
            
        } else {
            // Jika penyimpanan gagal, Anda dapat menangani kesalahan di sini
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan permintaan');
        }
  
 }

 private function join_table($saveid)
 {
     $data = [
         'id_permintaan' => $saveid
     ];

     $simpanid_permintaan = $this->join_table->save($data);
     
 }

 

 public function status_finance()
  {
    $getpermintaan = $this->permintaan_model->where('nik_user', user()->nik)->findAll();

    $getjoin = $this->join_table->findAll();
    
    $filter = array();

    foreach($getpermintaan as $minta)
    {
        foreach($getjoin as $join)
        {
            if($minta['id'] == $join['id_permintaan'])
            {
                $filter[] = $minta;
                break;
            }
        }
    }
    return view('Finance_View/Status_PermintaanFinance',['getpermintaan' => $filter, 'getjoin' => $getjoin]);
  }
}