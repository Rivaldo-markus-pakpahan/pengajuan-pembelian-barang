<?php

namespace App\Controllers;
use Myth\Auth\Authentication\Passwords\PasswordValidator;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;
use App\Models\Permintaan_Model;
use App\Models\Direktur_FeedBack_Model;
use App\Models\Join_table_permintaan_direktur;
use App\Models\Program_Model;

class Admin extends BaseController
{

    protected $UserModel;
    protected $GroupModel;
    protected $Permintaan_Model;
    protected $Direktur_FeedBack_Model;
    protected $Join_table_permintaan_direktur;
    protected $Program_Model;

    public function __construct()
    {
        $this->usermodel = new UserModel();
        $this->request = \Config\Services::request();
        $this->groupmodel = new GroupModel();
        $this->permintaan = new Permintaan_Model() ;
        $this->direktur_feedback = new Direktur_FeedBack_Model();
        $this->join_table = new Join_table_permintaan_direktur() ;
        $this->program = new Program_Model();
    }
    


    public function index()
    {
       

        $getusermodel = $this->usermodel->findAll();

        return view('Admin_View/Master_Data',['getusermodel'=> $getusermodel]);
    }

    
    public function deletedata($id)
    {
        $deletedata = $this->usermodel->delete($id);
      
        if($deletedata)
        {
            $session = session();
            $session->setFlashdata("message", 'Data berhasil dihapus');
            return redirect()->to(base_url('/admin'));
             // If deletion is successful, set a flash message
        
        }
       
    }

    public function edit($id)
{
    // Temukan data pengguna berdasarkan ID
    $editdata = $this->usermodel->find($id);

    // Periksa apakah data ditemukan
    if ($editdata) {
        // Jika data ditemukan, kirim data ke tampilan edit
        return view('Admin_View/Editdata', ['editdata' => $editdata]);
    } else {
        // Jika data tidak ditemukan, tampilkan pesan kesalahan atau lakukan tindakan yang sesuai
        return redirect()->to('/admin')->with('errors', 'Data pengguna tidak ditemukan.');
    }
}

    
public function saveedit($id)
{
    // Pastikan metode yang digunakan adalah POST
    if ($this->request->getMethod() == 'post') {

        // Kumpulkan data yang diperlukan dari formulir
        $data = [
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'username' => $this->request->getVar('username'),
            'no_wa' => $this->request->getVar('no_wa'),
            'nik' => $this->request->getVar('nik'),
            'email' => $this->request->getVar('email'),
            'jabatan' => $this->request->getVar('jabatan'),
        ];
  
        // Lakukan pembaruan data pengguna berdasarkan ID
        $update = $this->usermodel->update($id, $data);
    
        // Periksa apakah pembaruan berhasil
        if ($update) {
            // Jika berhasil, atur pesan sukses dan redirect ke halaman admin
            return redirect()->to('/admin')->with('message', 'Data berhasil diperbarui.');
        } else {
            // Jika gagal, atur pesan error dan redirect kembali ke halaman edit
            return redirect()->to(base_url('/admin'))->with('errors', 'Gagal mengedit Data');
        }
    } else {
        // Jika metode yang digunakan bukan POST, redirect kembali ke halaman edit
        return redirect()->to(base_url('/admin'))->with('errors', 'Gagal mengedit Data');
    }
}
    

    
    
    

    public function viewtambahdata()
    {
        return view('Admin_View/Tambah_Data');
    }

    public function viewprogram()
    {
        $getprogram = $this->program->findAll();
        return view('Admin_View/Data_Program',['getprogram' => $getprogram]);
    }

    public function savetambahdata()
    {
       
        
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username'      => 'required',
                'email'         => 'required' ,
                'password'      => 'required|min_length[8]',
                'roles'         => 'required|in_list[user,finance,admin,direktur]',
                'nama_lengkap'  => 'required',
                'nik'  => 'required',
                'no_wa'  => 'required',
                'jabatan'       => 'required',
            ];
    
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
    
            $data = [
                'username'      => $this->request->getPost('username'),
                'email'         => $this->request->getPost('email'),
                'no_wa'         => $this->request->getPost('no_wa'),
                'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'nama_lengkap'  => $this->request->getPost('nama_lengkap'),
                'jabatan'       => $this->request->getPost('jabatan'),
                'nik'              => $this->request->getPost('nik'),
                'roles'         => $this->request->getPost('roles'),
                'active'        => 1,
                'foto_user'          => "default.jpg"
            ];
    
            $userId = $this->usermodel->insert($data);
            if ($userId) {
                $groupId = $this->groupmodel->where('name', $data['roles'])->first()->id;
               $group = $this->groupmodel->addUserToGroup($userId, $groupId);
    
                return redirect()->to(base_url('/admin'))->with('message', 'Berhasil Ditambahkan');
            } else {
                return redirect()->to(base_url('/admin'))->with('errors', 'Gagal Menambahkan Data');
            }
        } 
    }



    public function tambah_program()
    {
        return view('Admin_View/Tambah_Program');
       
    }
    public function saveprogram()
    {
      
        if($this->request->getMethod() == 'post') 
        {
            $data = [
                'nama_program' => htmlspecialchars($this->request->getVar('nama_program')),
                'tahun_program' => htmlspecialchars($this->request->getVar('tahun_program')),

            ];

            $save = $this->program->insert($data);
            if($save)
            {
                $session = session();
                $session->setFlashdata("message", 'Data berhasil ditambahkan');
                return redirect()->to('/admin/viewprogram');
            }else {
                // Jika penyimpanan gagal, Anda dapat menangani kesalahan di sini
                return redirect()->back()->withInput()->with('error', 'Gagal menyimpan permintaan');
            }
        }
       
    }






    //pengajuan untuk admin //


    public function permintaan_admin()
    {
        $ambilprogram = $this->program->findAll();
       
        return view('Admin_View/Admin_Permintaan',['ambilprogram'=>$ambilprogram]);
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
        $save = $this->permintaan->save($data);


        if ($save) {
            // Jika penyimpanan berhasil, dapatkan ID permintaan
            $id_permintaan = $this->permintaan->getInsertID();
            
            // Kirim data ke tabel direktur
            $saveid = $this->join_table($id_permintaan);
        
            $session = session();
        $session->setFlashdata("message", 'Data berhasil dikirim');
                return redirect()->to(base_url('admin/status_admin'));
            
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



    public function status_admin()
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
     
        // Mengembalikan data ke view
    return view('Admin_View/Status_PermintaanAdmin', ['getpermintaan' => $filter, 'getjoin' => $getjoin]);
    }



    public function exceladmin()
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
       
        echo view('Admin_View/exceladmin', ['getpermintaan' => $filter, 'getjoin' => $getjoin]);
    }
    
   
 }


    
    