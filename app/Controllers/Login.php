<?php

namespace App\Controllers;
use myth\auth\Models\UserModel;
class Login extends BaseController
{

    protected $UserModel;


    public function __construct()
    {
        $this->usermodel = new UserModel();
       
    }
    


    public function index()
    {
        return view('View_All/Profil');
    }


    public function save_editprofil()
{
    if ($this->request->getMethod() == 'post') {
        // Periksa apakah file gambar telah diunggah
        if ($this->request->getFile('foto_user')->isValid() && !$this->request->getFile('foto_user')->hasMoved()) {
            // Ambil gambar
            $gambar = $this->request->getFile('foto_user');

            // Pindahkan ke folder
            $gambar->move('foto_profil');

            // Ambil nama gambar
            $nama_gambar = $gambar->getName();

            // Ambil NIK pengguna
            $id = user()->id;

            // Update data pengguna dengan foto baru
            $data = [
                'foto_user' => $nama_gambar
            ];

            // Perbarui data pengguna
            $savefoto = $this->usermodel->update($id, $data);

            if (is_array($savefoto)) {
                return redirect()->to(base_url('/'));
            } else {
                // Jika penyimpanan gagal, Anda dapat menangani kesalahan di sini
                return redirect()->back()->withInput()->with('error', 'Gagal menyimpan permintaan');
            }
        } else {
            // File gambar tidak diunggah dengan benar
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah gambar');
        }
    } else {
        // Metode permintaan bukan POST
        return redirect()->back()->withInput()->with('error', 'Permintaan tidak valid');
    }
}






public function processChangePassword()
{
    $siswaModel = new UserModel(); // Sesuaikan dengan model yang sesuai

    $rules = [
        'password'         => 'required|min_length[8]',
        'new_password'     => 'required|min_length[8]',
        'confirm_password' => 'required|matches[new_password]',
    ];

    if (! $this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $siswa = $siswaModel->find(user_id()); // Menggunakan user_id() untuk mendapatkan ID siswa yang sedang login

    // Verifikasi password lama
    if (! password_verify($this->request->getPost('password'), $siswa->password_hash)) {
        return redirect()->back()->withInput()->with('error', 'Password lama tidak cocok.');
    }

    // Set password baru
    $newPasswordHash = password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT);
    $siswa->password_hash = $newPasswordHash;

    // Simpan perubahan ke database
    $siswaModel->update($siswa->id, ['password_hash' => $newPasswordHash]);

    return redirect()->to('/')->with('success', 'Password berhasil diubah.');
}




public function getpassword()
{
    return view('View_All/getpassword');
}
}
