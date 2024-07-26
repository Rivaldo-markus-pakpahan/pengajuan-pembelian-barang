<?php $this->extend('Layout/Template'); ?>

<?php $this->section('konten'); ?>
<!-- start -->


<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="clearfix">

                                <div class="float-right">
                                    <h6 class="m-0 d-print-none"><?= date('d-M-Y') ?></h6>
                                </div>

                            </div>

                            <div class="row justify-content-center">
                                <div class="form col-md-8 mt-5 ">
                                    <h1 class=" text-center">Tambah Pengguna</h1>
                                    <hr class="mb-5">
                                     <?php if(session()->has('errors')) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= implode('<br>', session('errors')) ?>
                                    </div>
                                <?php endif ?>


                                    <form method="post" action="<?= base_url('admin/savetambahdata'); ?>"
                                          enctype="multipart/form-data" id="form">
                                        <?= csrf_field(); ?>
                                        <!-- start------------------------------------------------------------ form -->
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap : </label>
                                            <input type="text" id="nama_lengkap" class="form-control"
                                                   name="nama_lengkap" value="<?=old('nama_lengkap') ?>"
                                                   placeholder="Masukkan Nama Lengkap..." autofocus>
                                        </div>


                                        <div class="form-group">
                                            <label for="username">Username : </label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                   placeholder=" Masukkan Username..." value="<?=old('username') ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="no_wa">Nomor Whatsapp : </label>
                                            <input type="tel" class="form-control" id="no_wa" name="no_wa"
                                                   placeholder=" Masukkan Nomor Whatsapp..." value="<?=old('no_wa') ?>" oninput="formatWhatsAppNumber(this)">
                                        </div>
                                        <div class="form-group">
                                            <label for="nik">NIK : </label>
                                            <input type="number" class="form-control" id="nik" name="nik"
                                                   placeholder=" Masukkan Nik..." value="<?=old('nik') ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email : </label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                   placeholder="Masukkan Email..." value="<?=old('email') ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password : </label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                   placeholder="Masukkan Password..." value="<?=old('password') ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="roles">Level Pengguna :
                                            </label>
                                            <select class="form-control" id="roles" name="roles" value="<?=old('roles') ?>">
                                                <option value="user">User</option>
                                                <option value="finance">Finance</option>
                                                <option value="admin">Admin</option>
                                                <option value="direktur">Manager</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="jabatan">Jabatan : </label>
                                            <input type="text" class="form-control" id="jabatan" name="jabatan"
                                                   placeholder="Masukkan Jabatan..." value="<?=old('jabatan') ?>">
                                        </div>
                                                

                                        <button type="submit" class="btn btn-primary waves-effect waves-light ">Kirim
                                            Sekarang
                                        </button>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


</div>
<!-- end main content-->


<script>
function formatWhatsAppNumber(input) {
    // Mengambil nilai input
    let phoneNumber = input.value.trim();

    // Jika nomor dimulai dengan "08", gantilah dengan "+62"
    if (phoneNumber.startsWith('08')) {
        phoneNumber = '+628' + phoneNumber.slice(2);
    }

    // Mengupdate nilai input dengan nomor WhatsApp yang diformat
    input.value = phoneNumber;
}
</script>
<?php $this->endSection(); ?>
