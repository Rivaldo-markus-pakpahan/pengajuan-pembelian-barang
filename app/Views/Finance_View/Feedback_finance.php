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
                                    <h1 class=" text-center">Kirim Ke Manager</h1>
                                    <hr class="mb-5">
                                    <form method="post" action="<?=base_url('/finance/save_data_permintaan') ;?>"
                                        enctype="multipart/form-data" id="form">
                                        <?= csrf_field();?>
                                 
                                            

                                        
                                        <input type="hidden" value="<?=$getid['id'] ?>" name="id_user_permintaan">  
                                        <input type="hidden" value="<?=$getid['nik_user'] ?>" name="nik_user">  
                                      
                                        <div class="form-group">
                                            <label for="feedback_finance">Nama Pemeriksa :
                                                
                                            </label>
                                            <input type="text" class="form-control" id="feedback_finance"
                                                placeholder="<?=user()->nama_lengkap ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="nik">Nik Pemeriksa : </label>
                                            <input type="text" class="form-control" id="nik" 
                                              placeholder="<?=user()->nik ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Respon :
                                            </label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="respon_finance"
                                                autofocus>
                                                <option value="Disetujui">Disetujui</option>
                                               

                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan (<i>optional</i>) :</label>
                                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3"
                                                placeholder="Berikan keterangan anda..."></textarea>
                                        </div>
                                        <button type="submit" id="kirim_sekarang"
                                            class="btn btn-primary waves-effect waves-light ">Kirim
                                            Sekarang</button>

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