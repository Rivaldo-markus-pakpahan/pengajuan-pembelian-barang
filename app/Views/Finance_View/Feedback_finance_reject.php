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
                                    <h1 class=" text-center">Kirim Ke Karyawan</h1>
                                    <hr class="mb-5">
                                  
                                    <form method="post" action="<?=base_url('/finance/save_reject/'. $getid['id']) ;?>"
                                        enctype="multipart/form-data" id="form">
                                        <?= csrf_field();?>
                                 
                                            

                                    
                                      
                                      
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Respon :
                                            </label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="reject"
                                                autofocus>
                                                <option value="Tidak Disetujui">Tidak Disetujui</option>
                                               

                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Alasan:</label>
                                            <textarea class="form-control" name="alasan" id="alasan" rows="3"
                                                placeholder="Berikan Alasan Reject ..." required></textarea>
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