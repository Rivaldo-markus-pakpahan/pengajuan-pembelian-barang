<?php

namespace App\Controllers;
use App\Models\Permintaan_Model;
use App\Models\Direktur_FeedBack_Model;
use App\Models\Join_table_permintaan_direktur;
use App\Models\Program_Model;
use myth\auth\Models\UserModel;


class User extends BaseController
{

    protected $Permintaan_Model;
    protected $Direktur_FeedBack_Model;
    protected $Join_table_permintaan_direktur;
    protected $Program_Model;



    public function __construct()
    {
        $this->permintaan = new Permintaan_Model() ;
        $this->direktur_feedback = new Direktur_FeedBack_Model();
        $this->join_table = new Join_table_permintaan_direktur() ;
        $this->program = new Program_Model();
     
    }




    public function index()
    {
      
        // $ambilprogram = $this->program->findAll();
       
        return view('User_View/User_Permintaan');
    }

  
  public function save_data()
{


    $nik_user = user()->nik;
   
        // Ambil gambar
        $gambar = $this->request->getFile('lampiran');
        
        // Pindahkan ke folder
        $gambar->move('bukti_lampiran');
        
        // Ambil nama gambar
        $nama_gambar = $gambar->getName();

                   
    if ($this->request->getMethod() === 'post') {
      

      
        $data = [
            'nik_user' => $nik_user,
            'nama_barang' => htmlspecialchars($this->request->getVar('nama_barang')),  
            'biaya' => htmlspecialchars($this->request->getVar('biaya')),  
            'catatan' => htmlspecialchars($this->request->getVar('catatan')),
            'lampiran' => $nama_gambar
        ];

      
      
          
        $save = $this->permintaan->save($data);

        if ($save) {
            
            // Jika penyimpanan berhasil, dapatkan ID permintaan
            $id_permintaan = $this->permintaan->getInsertID();
            
            // Kirim data ke tabel direktur
            $saveid = $this->join_table($id_permintaan);
        
            $session = session();
        $session->setFlashdata("message", 'Data berhasil kirim');
            return redirect()->to(base_url('user/status'));
        } else {
            // Jika penyimpanan gagal, Anda dapat menangani kesalahan di sini
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan permintaan');
        }
    }
}



        private function join_table($saveid)
        {
            $data = [
                'id_permintaan' => $saveid
            ];

            $simpanid_permintaan = $this->join_table->save($data);
        }



    public function status()
    {
        $getpermintaan = $this->permintaan->where('nik_user', user()->nik)->orderBy('created_at','DESC')->findAll();
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
     
        // Mengembalikan data ke view
    return view('User_View/Status_Permintaan', ['getpermintaan' => $filter, 'getjoin' => $getjoin]);
    }


    public function delete($id)
    {
        $delete = $this->permintaan->delete($id);
        if($delete)
        {
            $session = session();
            $session->setFlashdata("message", 'Data berhasil dihapus');
            return redirect()->to(base_url('/user/status'));
        }
    }
    public function edit($id)
    {
        $editdata = $this->permintaan->find($id);
        return view('User_View/User_edit', ['editdata' =>$editdata]);

    }
    public function save_edit($id)
    {
    
            // Ambil gambar
            $gambar = $this->request->getFile('lampiran');
            
            // Pindahkan ke folder
            $gambar->move('bukti_lampiran');
            
            // Ambil nama gambar
            $nama_gambar = $gambar->getName();
    
                       
        if ($this->request->getMethod() === 'post') {
          
    
          
            $data = [
              
                'nama_barang' => htmlspecialchars($this->request->getVar('nama_barang')),  
                'biaya' => htmlspecialchars($this->request->getVar('biaya')),  
                'catatan' => htmlspecialchars($this->request->getVar('catatan')),
                'lampiran' => $nama_gambar
            ];
    
          
          
              
            $save = $this->permintaan->update($id, $data);
    
            if ($save) {
                
                $session = session();
               $session->setFlashdata("message", 'Data berhasil diedit');
                return redirect()->to(base_url('user/status'));
            } else {
                // Jika penyimpanan gagal, Anda dapat menangani kesalahan di sini
                return redirect()->back()->withInput()->with('error', 'Gagal mengedit data');
            }
        }
    }
    






    public function excel()
    {
        $getpermintaan = $this->permintaan->where('nik_user', user()->nik)->findAll();
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
       
        echo view('User_View/excel', ['getpermintaan' => $filter, 'getjoin' => $getjoin]);
    }


    
}
