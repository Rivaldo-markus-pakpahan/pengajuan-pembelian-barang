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
                                    <h1 class=" text-center">PENGAJUAN PEMBELIAN BARANG</h1>
                                    <hr class="mb-5">

                                    <!-- validation------------------------------------------------------------ form -->


                                    <!-- akhir validation------------------------------------------------------------ form -->
                                    <form method="post" action="<?=base_url('/finance/save_data') ;?>"
                                        enctype="multipart/form-data" id="form">
                                        <?= csrf_field();?>
                                        <!-- start------------------------------------------------------------ form -->



                                     
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang :</label>
                                            <input type="text"
                                                class="form-control"  name="nama_barang"
                                                placeholder="Nama Barang..." required>
                                               

                                        </div>


                                        <div class="form-group">
                                            <label for="lampiran">Upload Contoh Gambar Barang
                                                : </label>
                                            <input type="file" class="dropify" data-max-file-size="1M" id="lampiran"
                                                name="lampiran" required/>
                                               
                                        </div>

                                       

                                        <div class="form-group">
                                            <label for="biaya">Harga :</label>
                                            <input type="text" placeholder="" data-a-sign="Rp. "
                                                class="form-control autonumber" id="biaya" name="biaya"
                                                placeholder="Tanggal keberangkatan..." required>
                                               

                                        </div>
                                        <div class="form-group">
                                            <label for="catatan">Catatan :</label>
                                            <textarea class="form-control" name="catatan" id="catatan" rows="3"
                                                placeholder="Berikan Catatan anda..." required>  </textarea>
                                               
                                        </div>


                                        

                                        <button type="submit" class="btn btn-primary waves-effect waves-light ">Kirim
                                            Sekarang</button>


                                    </form>
                                    <!-- finish ---------------------------------------------------------------form -->
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