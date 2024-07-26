<?php

namespace App\Controllers;
use myth\auth\Models\UserModel;
use App\Models\Permintaan_Model;
use App\Models\Finance_Data_Model;
use App\Models\Direktur_FeedBack_Model;
use App\Models\Join_table_permintaan_direktur;
use App\Models\Program_Model;


class Manager extends BaseController
{

    protected $UserModel;
    protected $Permintaan_Model;
    protected $Finance_Data_Model;
    protected $Direktur_FeedBack_Model;
    protected $Program_Model;
    protected $Join_table_permintaan_direktur;


    public function __construct()
    {
        $this->usermodel = new UserModel();
        $this->permintaan_model = new Permintaan_Model();
        $this->finance_data = new Finance_Data_Model();
        $this->direktur_feedback = new Direktur_FeedBack_Model();
        $this->join_table = new Join_table_permintaan_direktur() ;
        $this->program = new Program_Model();
        $this->email = \Config\Services::email(); 
    }

    
    public function index()
{
    
    $getdata = $this->finance_data->getdata();
    
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
    return view('Direktur_View/Persetujuan_Direktur',['getdata' => $filter , 'getusermodel'=>$getusermodel]);
}


  
public function viewdata($id_user_permintaan = null)
{
    // Ambil ID dari URL
    $id = $this->request->uri->getSegment(3);
    
    // Ambil data permintaan berdasarkan ID
    $permintaan = $this->permintaan_model->find($id);
    
    // Jika data permintaan ditemukan
    if ($permintaan) {
        // Ambil nik_user dari permintaan
        $nik_user = $permintaan['nik_user'];
        
        // Mengambil semua data usermodel berdasarkan nik_user
        $userData = $this->usermodel->where('nik', $nik_user)->findAll();
        
        // Kirim data ke view untuk ditampilkan
        return view('Direktur_View/viewdata', [
            'permintaan' => $permintaan,
            'userData' => $userData
        ]);
    } else {
        // Jika data permintaan tidak ditemukan, kembalikan ke halaman sebelumnya atau tampilkan pesan kesalahan
        // Misalnya:
        return redirect()->back()->with('error', 'Data permintaan tidak ditemukan');
    }
}


    

public function savedata()
    {
        $nik_direktur = user()->nik;

        // Ambil gambar
        $gambar = $this->request->getFile('bukti_transfer');
        // Inisialisasi nama gambar
        $nama_gambar = '';
        // Jika file sudah diupload, pindahkan ke folder dan ambil nama gambar
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            // Pindahkan ke folder
            $gambar->move('bukti_transfer');
            // Ambil nama gambar
            $nama_gambar = $gambar->getName();
        }

        if ($this->request->getMethod() === 'post') {
            $data = [
                'nik_direktur' => $nik_direktur,
                'id_pemohon' => htmlspecialchars($this->request->getVar('id_pemohon')),
                'respon' => htmlspecialchars($this->request->getVar('respon')),
                'id_user_pemohon' => htmlspecialchars($this->request->getVar('id_user_pemohon')),
                'email_pemohon' => htmlspecialchars($this->request->getVar('email_pemohon')),
                'no_wa' => htmlspecialchars($this->request->getVar('no_wa')),
                'bukti_transfer' => $nama_gambar,
            ];

            // Simpan data ke tabel direktur_feedback
            $savebukti = $this->direktur_feedback->save($data);
        
            if ($savebukti) {
                // Ambil informasi untuk pengiriman email
                $email_pemohon = htmlspecialchars($this->request->getVar('email_pemohon'));
                $no_wa = htmlspecialchars($this->request->getVar('no_wa'));
                $respon_direktur = htmlspecialchars($this->request->getVar('respon'));
                $id_permintaan = htmlspecialchars($this->request->getVar('id_pemohon'));
                $bukti = $nama_gambar;

                // Kirim email
                $email = \Config\Services::email();
                $email->setTo($email_pemohon);
                $email->setFrom('rivaldopakpahanrivaldo@gmail.com', 'Pengajuan');
                $email->setSubject('FeedBack Pengajuan Pembelian Barang');
                $email->setMessage('
            <h4> Pemberitahuan Proses Pengajuan Pembelian Barang </h4> <br>
            <p> Kepada Yth bapak/ibu, dengan email ini saya ingin memberikan pemberitahuan tentang permintaan pengajuan pembelian barang <br> yang telah anda ajukan kepada kami, dengan email ini kami ingin menyampaikan bahwa permintaan anda '.$data['respon'].' <br> demikian pesan yang ingin kami sampaikan, terimakasih </p>
            
            ');
                $email->attach(ROOTPATH . 'public/bukti_transfer/' . $nama_gambar);

                // Kirim email
                if ($email->send()) {
                    
                                
                        // Pesan WhatsApp berhasil dikirim
                        // Tambahkan data ke tabel join
                        $id_direktur = $this->direktur_feedback->getInsertID();
                        $this->join_table($id_permintaan, $id_direktur, $respon_direktur, $bukti, $no_wa);

                        $session = session();
                        $session->setFlashdata("message", 'Data berhasil dikirim');
                        // Redirect ke halaman history_direktur
                        return redirect()->to(base_url('manager/history_manager'));
                    
                } else {
                    // Jika gagal mengirim email, tangani kesalahan di sini
                    return redirect()->back()->withInput()->with('error', 'Gagal mengirim email');
                }
            } else {
                // Jika penyimpanan gagal, tangani kesalahan di sini
                return redirect()->back()->withInput()->with('error', 'Gagal menyimpan permintaan');
            }
        }
    }

    private function join_table($id_permintaan, $id_direktur, $respon, $bukti, $no_wa)
    {
        $data = [
            'id_direktur' => $id_direktur,
            'respon' => $respon,
            'bukti_transfer' => $bukti,
            'no_wa' => $no_wa
        ];

        // Cari baris dengan id_permintaan yang diberikan
        $existing_row = $this->join_table->where('id_permintaan', $id_permintaan)->first();

        if ($existing_row) {
            // Jika sudah ada baris dengan id_permintaan yang diberikan, lakukan update
            $this->join_table->update($existing_row['id'], $data);
        } else {
            // Jika tidak ada baris dengan id_permintaan yang diberikan, tambahkan data baru
            $data['id_permintaan'] = $id_permintaan;
            $this->join_table->insert($data);
        }

        // Update kolom direktur_aktif di tabel permintaan_model
        $this->update_direktur_aktif($id_permintaan, $id_direktur);
    }

    
    private function update_direktur_aktif($id_permintaan, $id_direktur)
    {
        $data = ['direktur_aktif' => $id_direktur];
        $this->permintaan_model->update($id_permintaan, $data);
    }




    
   

    public function history_manager()
    {
       

        $getdirekturdata = $this->direktur_feedback->where('nik_direktur', user()->nik)->orderBy('created_at','DESC')->findAll();
       
        $getpermintaan = $this->permintaan_model->findAll();

        $getfinance = $this->finance_data->findAll();
        $usermodel = $this->usermodel->findAll();
 
        $filter = array();

        foreach($getdirekturdata as $direktur)
        {
            
            foreach($getpermintaan as $permintaan)
            {
                foreach($usermodel as $user)
                {
                if($direktur['id_pemohon'] == $permintaan['id']){

                    $filter[] = $direktur;
                    break;

                    if ($direktur['id_user_pemohon'] == $user->id) {
                        $filter[] = $direktur;
     
                        break;
                     }
                }
            }
               
            }

            
        }
       
    return view('Direktur_View/History',
     ['getdirekturdata' => $filter,
      'getpermintaan' => $getpermintaan,
      'usermodel' => $usermodel
    
    ]);
    }
    



public function excel()
{
    $getdirekturdata = $this->direktur_feedback->where('nik_direktur', user()->nik)->orderBy('created_at','DESC')->findAll();
       
    $getpermintaan = $this->permintaan_model->findAll();

    $getfinance = $this->finance_data->findAll();
    $usermodel = $this->usermodel->findAll();

    $filter = array();

    foreach($getdirekturdata as $direktur)
    {
        
        foreach($getpermintaan as $permintaan)
        {
            foreach($usermodel as $user)
            {
            if($direktur['id_pemohon'] == $permintaan['id']){

                $filter[] = $direktur;
                break;

                if ($direktur['id_user_pemohon'] == $user->id) {
                    $filter[] = $direktur;
 
                    break;
                 }
            }
        }
           
        }

        
    }
   
return view('Direktur_View/excel',
 ['getdirekturdata' => $filter,
  'getpermintaan' => $getpermintaan,
  'usermodel' => $usermodel

]);
}


  //tampilan permintaan dan data permintaan //

  public function permintaan_manager()
  {
    $ambilprogram = $this->program->findAll();
    return view('Direktur_View/direktur_Permintaan',['ambilprogram'=>$ambilprogram]);
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
           $saveid = $this->gabungtable($id_permintaan);

           $session = session();
        $session->setFlashdata("message", 'Data berhasil dikirim');
       return redirect()->to(base_url('manager/manager_status'));
          
      } else {
          // Jika penyimpanan gagal, Anda dapat menangani kesalahan di sini
          return redirect()->back()->withInput()->with('error', 'Gagal menyimpan permintaan');
      }

}

private function gabungtable($saveid)
 {
     $data = [
         'id_permintaan' => $saveid
     ];

     $simpanid_permintaan = $this->join_table->save($data);
     
 }




    public function manager_status()
  {
    $getpermintaan = $this->permintaan_model->where('nik_user', user()->nik)->orderBy('created_at','DESC')->findAll();

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
    return view('Direktur_View/Direktur_status',['getpermintaan' => $filter, 'getjoin' => $getjoin]);
  }
    


}