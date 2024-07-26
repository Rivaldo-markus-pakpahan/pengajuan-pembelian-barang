<?php $this->extend('Layout/Template'); ?>

<?php $this->section('konten'); ?>
<!-- start -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
        <h3 class="bg-white shadow-sm text-center " style="color:#948f8f;">DATA PENGAJUAN PEMBELIAN BARANG</h3>
          
            <div class="row">

            <?php $no = 1; ?>
            <?php foreach ($getdata as $data) : ?>
            <?php foreach ($getuser as $user) : ?>
            <?php if ($data['nik_user'] == $user->nik && empty($data['aktif'])) : ?>
                <?php 
                    // Cek apakah kolom reject dan alasan sudah diisi
                    if (!empty($data['reject']) && !empty($data['alasan'])) {
                        continue; // Lewati iterasi ini jika reject dan alasan sudah diisi
                    }

                   
                ?>
                <!-- Periksa apakah kolom aktif kosong atau tidak -->
                <div class="col-lg-12 mt-3">
                <button class="rounded-circle btn btn-dark"><?= $no++ ?></button>
                    <div class="card card-body">
                   
                        <h4 class=" text-center">Nama Pemohon : <?= $user->nama_lengkap ?></h4>
                        <h5 class="card-title text-center">Jabatan Pemohon : <?= $user->jabatan ?></h5>
                        <h5 class="card-title text-center">Nik Pemohon : <?= $data['nik_user'] ?></h5>
                        <h5 class="text-center"> <img src="<?=base_url('foto_profil/'.$user->foto_user); ?>" alt=""
                                class="rounded-circle " style="width:128px; height:128px; border:solid green 5px"></h5>
                        <p class="card-text">Tgl Pengajuan : <?= $data['created_at'] ?></p>
                        <p class="card-text">Nama Barang : <?= $data['nama_barang'] ?></p>
                        <p class="card-text">Harga : <?= $data['biaya'] ?></p>
                      
                        
                        <p class="card-text">Catatan: <?= $data['catatan'] ?></p>

                        <div class="d-flex text-aling-between">
                            <a href="<?= base_url('bukti_lampiran/' . $data['lampiran']) ?>" class="btn btn-success mx-2"
                                download>Download Contoh Gambar</a>
                            <a href="<?= base_url('/finance/viewdata/' . $data['id']); ?>"
                                class="btn btn-primary btn-direktur mx-2">Approve</a>
                             
                                <a href="<?= base_url('/finance/reject/' . $data['id']); ?>"
                                class="btn btn-danger mx-2">Reject</a>
                        </div>


                    </div>
                </div>
                  <!-- end row -->
            <?php endif; ?>
            <?php endforeach; ?>
            <?php endforeach; ?>
            </div>
          
        </div> <!-- container-fluid -->
    </div>


</div>

<!-- end main content-->
<?php  $this->endSection();?>
