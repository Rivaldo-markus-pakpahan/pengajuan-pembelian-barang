<?php $this->extend('Layout/Template'); ?>

<?php $this->section('konten'); ?>
<!-- start -->


<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">


            <div class="row ">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-body img text-center">
                            <img src="<?=base_url('foto_profil/'.user()->foto_user); ?>" alt="" class="rounded-circle"
                                style="width:128px; height:128px; border:solid green 5px">
                            <button type="button" class="btn btn-warning  waves-effect waves-light " data-toggle="modal"
                                data-target="#exampleModalCenter">
                                <i class="mdi mdi-pencil-plus mdi-24px"></i>
                            </button>


                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Ganti Foto Profil</h5>
                                            <button type="button" class="close waves-effect waves-light"
                                                data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form method="post" action="<?=base_url('/save_editprofil') ;?>"
                                                enctype="multipart/form-data" id="form">
                                                <?= csrf_field();?>
                                                <input type="file" class="dropify"
                                                    data-default-file="assets/images/media/sm-6.jpg" name="foto_user" />
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">Simpan</button>
                                            <button type="button" class="btn btn-secondary waves-effect waves-light"
                                                data-dismiss="modal">Batal</button>

                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- akhir Modal -->
                            <div>

                            </div>



                        </div>
                        <div class="card-body data mt-5 " >
                            <h2 class="my-3">Profil:</h2>
                            <hr style="margin-right:50%;">
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap : </label>
                                <input type="text" class="form-control w-50" id="nama_lengkap"
                                    placeholder="<?=user()->nama_lengkap ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email : </label>
                                <input type="text" class="form-control w-50" id="email"
                                    placeholder="<?=user()->email ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="NIK">NIK: </label>
                                <input type="text" class="form-control w-50" id="NIK" placeholder="<?=user()->nik ?>"
                                    disabled>
                            </div>

                            <div class="form-group">
                                <label for="jabatan">Jabatan : </label>
                                <input type="text" class="form-control w-50" id="jabatan"
                                    placeholder="<?=user()->jabatan ?>" disabled>
                            </div>


                        </div>




                        <div class="card-body data mt-5">
                            <h2 class="my-3">Ganti Password:</h2>
                            <hr style="margin-right:50%;">
                            <form id="uploadForm" action="<?= base_url('/processChangePassword');?>" method="post"
                                enctype="multipart/form-data">
                                <?= csrf_field();?>
                                <!--pesan gagal -->
                                <?php if (session()->has('errors')) : ?>
                                <div class="alert alert-danger w-50">
                                    <ul>
                                        <?php foreach (session('errors') as $error) : ?>
                                        <li><?= esc($error) ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                                <?php elseif (session()->has('success')) : ?>
                                <div class="alert alert-success w-50">
                                    <?= esc(session('success')) ?>
                                </div>
                                <?php endif ?>


                                <div class="form-group">
                                    <label for="password_lama">Password Lama : </label>
                                    <input type="password" class="form-control w-50" id="password_lama" name="password"
                                        placeholder="Masukkan Password Lama...">
                                </div>
                                <div class="form-group">
                                    <label for="password_baru">Password Baru : </label>
                                    <input type="password" class="form-control w-50" id="password_baru"
                                        name="new_password" placeholder="Masukkan Password Baru...">
                                </div>
                                <div class="form-group">
                                    <label for="konfirmasi_password_baru">Konfirmasi Password Baru: </label>
                                    <input type="password" class="form-control w-50" id="konfirmasi_password_baru"
                                        name="confirm_password" placeholder="Konfirmasi Password Baru...">
                                </div>
                                <button class="btn btn-primary">Ubah Password! </button>
                            </form>


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
<?php  $this->endSection();?>