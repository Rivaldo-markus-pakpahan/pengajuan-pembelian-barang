<?php $this->extend('Layout/Template'); ?>

<?php $this->section('konten'); ?>
<!-- start -->


<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
        <h3 class="bg-white shadow-lg text-center " style="color:#948f8f;">DATA PENGAJUAN PEMBELIAN BARANG</h3>
            <?php $no = 1; ?>


            <?php foreach ($getdata as $data) : ?>

            <?php foreach ($getusermodel as $user) : ?>

            <?php if( $data['nik_user'] == $user->nik): ?>
            <?php if (empty($data['direktur_aktif'])) : ?>
            <!-- Periksa apakah kolom aktif kosong atau tidak -->
            <div class="row">

                <div class="col-lg-12 mt-3">
                    <button class="rounded-circle btn btn-dark"><?= $no++ ?></button>
                    <div class="card card-body">

                        <h4 class=" text-center">Nama Pemohon : <?= $user->nama_lengkap ?></h4>
                        <h5 class="card-title text-center">Jabatan Pemohon : <?= $user->jabatan ?></h5>
                        <h5 class="card-title text-center">Nik Pemohon : <?= $data['nik_user'] ?></h5>
                        <h5 class="text-center"> <img src="<?=base_url('foto_profil/'.$user->foto_user); ?>" alt=""
                                class="rounded-circle " style="width:128px; height:128px; border:solid green 5px"></h5>
                        <h4 class="w-50" style=" border-bottom: solid;">Pemohon pembelian barang</h4>
                        <p class="card-text">Tgl Pengajuan : <?= $data['created_at'] ?></p>
                        <p class="card-text">Nama Barang : <?= $data['nama_barang'] ?></p>
                        <p class="card-text">Harga : <?= $data['biaya'] ?></p>
                       
                        <p class="card-text">Catatan: <?= $data['catatan'] ?></p>
                        <h4 class="w-50" style=" border-bottom: solid;">Pemeriksa</h4>
                        <p class="card-text">Nama Lengkap Pemeriksa : <?=$data['nama_lengkap'] ?></p>
                        <p class="card-text">Jabatan Pemeriksa :<?=$data['jabatan'] ?></p>
                         <p class="card-text  text-<?= !empty($data['respon_finance']) ? ($data['respon_finance'] == 'Disetujui' ? 'success' : 'danger') : 'dark'; ?>">Respon Pemeriksa :<?=$data['respon_finance'] ?></p>
                        <p class="card-text">Keterangan Pemeriksa :<?=$data['keterangan'] ?></p>

                        <div class="d-flex text-aling-between">
                        <a href="<?=base_url('bukti_lampiran/'.$data['lampiran']) ?>" class="btn btn-success mx-2" download>Download Contoh Gambar</a>
                        <a href="<?= base_url('/manager/viewdata/'.$data['id']); ?>"
                                                            class="btn btn-primary mx-2">Kirim Bukti</a>



                        </div>


                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php endif; ?>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php endforeach; ?>
        </div> <!-- container-fluid -->
    </div>


</div>
<?php  $this->endSection();?>