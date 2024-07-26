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
                                    <h6 class="m-0 d-print-none"><?=date('d-M-Y') ?></h6>
                                </div>

                            </div>

                            <div class="row justify-content-center">
                                <div class="form col-md-8 mt-5 ">
                                    <h1 class=" text-center">Bukti Transfer</h1>
                                    <hr class="mb-5">
                                    <form method="post" action="<?=base_url('/manager/savedata') ;?>"
                                        enctype="multipart/form-data" id="form">
                                        <?= csrf_field();?>
                                        
                                        <input type="hidden" value="<?=$permintaan['id'] ?>" name="id_pemohon">
                                  
                                        <?php foreach($userData as $data) :?>
                                            <input type="hidden" value="<?=$data->id ?>" name="id_user_pemohon">
                                        <input type="hidden" value="<?=$data->email?>" name="email_pemohon">
                                        <input type="hidden" value="<?=$data->no_wa?>" name="no_wa">
                                        <?php endforeach ; ?>
                                        <div class="form-group">
                                            <label for="nama_direktur">Nama Manager
                                                :
                                            </label>
                                            <input type="text" class="form-control" id="nama_direktur"
                                                name="nama_direktur" value="<?=user()->nama_lengkap ?>"
                                                placeholder="<?=user()->nama_lengkap ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="nik_direktur">Nik Manager: </label>
                                            <input type="text" class="form-control" id="nik_direktur"
                                                name="nik_direktur"
                                                placeholder="<?=user()->nik ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Respon Manager :
                                            </label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="respon"
                                                autofocus>
                                                <option value="Disetujui">Disetujui</option>
                                                <option value="Tidak Disetujui">Tidak Disetujui</option>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="bukti_transfer">Bukti Transfer
                                                : </label>
                                            <input type="file" class="dropify" data-max-file-size="1M"
                                                name="bukti_transfer" />
                                        </div>

                                        <button type="submit" id="kirim_sekarang"
                                            class="btn btn-primary waves-effect waves-light ">Proses
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
<?php  $this->endSection();?>