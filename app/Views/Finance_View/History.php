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



                            <!-- end row -->

                            <div class="row">
                           
                                <div class="col-md-12 mt-5">
                                     <!--flashdata --------------------------------------->
                            <?php $session = session();?>
                                <?php if ($session->has('message')):?>
                                <div class="alert alert-success"><?= $session->get('message') ?></div>
                                <?php endif; ?>
     <!--flashdata --------------------------------------->
                                <a href="<?=base_url('finance/excel') ?>" class="btn btn-success my-3"> <i
                                    class="fas fa-file-excel m-r-5"></i> Excel</a>
                                    <div class="table-responsive">
                                   
                                         <table id="datatable" class="table ">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    
                                                  
                                                    <th>Nik Pemohon</th>
                                                    <th>Nama Lengkap Pemohon</th> 
                                                    <th>Jabatan Pemohon</th> 
                                                   <th>Nama Barang</th>
                                                    <th>Harga</th>
                                                    <th>Contoh Gambar</th>
                                                    <th>Catatan</th>                                                                      
                                                    <th>Nik Pemeriksa</th>
                                                   
                                                    <th>Nama Lengkap Pemeriksa</th>
                                                    <th>Jabatan Pemeriksa</th>
                                                  
                                                   



                                               
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1 ; ?>
                                                <?php foreach ($getdata as $data) : ?>
                                                
                                                <?php foreach ($getusermodel as $user) : ?>
                                                  
                                                <?php if( $data['nik_user'] == $user->nik): ?>

                                                <tr>
                                                    <td><?= $no++ ;?></td>
                                                  
                                                    <td><?=$data['nik_user'] ?></td>
                                                    <td><?=$user->nama_lengkap ?></td>
                                                    <td><?=$user->jabatan ?></td>
                                                    <td><?=$data['nama_barang'] ?></td>
                                                    <td><?=$data['biaya'] ?></td>
                                                    <td>
                                                       
                                                       <a href="<?=base_url('bukti_lampiran/'.$data['lampiran']) ?>"
                                                           download>
                                                           <button class="btn btn-primary">Download</button>
                                                       </a>
                                                      
                                                      
                                                   </td>
                                                    <td><?=$data['catatan'] ?></td>
                                                    <td><?=$data['nik'] ?></td>
                                                    <td><?=$data['nama_lengkap'] ?></td>
                                                  
                                                  
                                                    <td><?=$data['jabatan'] ?></td>
                                                 
                                                    

                                                   

                                                </tr>


                                                        <?php endif; ?>
                                                <?php endforeach; ?>
                                                <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                           
                        </div>
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>


</div>
<!-- end main content-->
<?php  $this->endSection();?>