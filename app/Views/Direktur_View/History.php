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

                                <!--flashdata ----------------->
                                <?php $session = session();?>
                                <?php if ($session->has('message')):?>
                                <div class="alert alert-success"><?= $session->get('message') ?></div>
                                <?php endif; ?>
                         <!--flashdata ----------------->
                                <a href="<?=base_url('manager/excel') ?>" class="btn btn-success my-3"> <i
                                    class="fas fa-file-excel m-r-5"></i> Excel</a>
                                    <div class="table-responsive">
                                    <table id="datatable" class="table ">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                  
                                                    <th>Nik Pemohon</th>
                                                    <th>Nama Lengkap Pemohon</th>
                                                    <th>Jabatan Pemohon</th>
                                               
                                                   <th>Nama Barang</th>
                                                    <th>Harga</th>
                                                    
                                                    <th>Catatan</th>    
                                                    <th>Contoh Gambar</th>                                                                  
                                                 
                                                
                                                   



                                               
                                                </tr>
                                            </thead>
                                            <tbody>
                                           
                                            <?php $no = 1; ?>

                                            <?php foreach($getdirekturdata as $direktur): ?>
                                             
                                               
                                                <?php foreach($getpermintaan as $permintaan): ?>
                                              
                                     
                                     
                                              <?php foreach($usermodel as $user):?>
                                              
                                           
                                                       
                                            <?php if ($direktur['id_pemohon'] == $permintaan['id'] && $direktur['id_user_pemohon'] == $user->id) : ?>
                                              
                                               
                                            <tr>
                                                <td><?=$no++ ?></td>
                                                <td><?=$permintaan['created_at'] ?></td>
                                          
                                                <td><?=$permintaan['nik_user'] ?></td>
                                                <td><?=$user->nama_lengkap?></td>
                                                <td><?=$user->jabatan?></td>
                                              
                                                <td><?=$permintaan['nama_barang'] ?></td>
                                                    <td><?=$permintaan['biaya'] ?></td>
                                                    <td><?=$permintaan['catatan'] ?></td>
                                                    <td>
                                                       
                                                       <a href="<?=base_url('bukti_lampiran/'.$permintaan['lampiran']) ?>"
                                                           download>
                                                           <button class="btn btn-primary">download</button>
                                                       </a>
                                                      
                                                      
                                                   </td>

                                            </tr>
                                            <?php endif ;?>
                                       
                                          <?php endforeach ?>
                                                <?php endforeach ?>
                                                <?php endforeach ?>
                                            
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