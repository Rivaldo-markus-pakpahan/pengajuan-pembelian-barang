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
                                    <div class="table-responsive">
                                        <?php $session = session();?>
                                        <?php if ($session->has('message')):?>
                                        <div class="alert alert-success"><?= $session->get('message') ?></div>

                                        <?php endif; ?>
                                        <?php $session = session();?>
                                        <?php if ($session->has('errors')):?>
                                        <div class="alert alert-danger"><?= $session->get('errors') ?></div>

                                        <?php endif; ?>


                                        
                                        <a href="<?=base_url('admin/viewtambahdata') ?>" class="btn btn-primary my-4">Tambah Pengguna <i class="mdi mdi-account-multiple-plus mdi-24px"></i></a>
                                        <table id="selection-datatable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIK</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Email</th>
                                                    <th>Whatsapp</th>
                                                    <th>Jabatan</th>
                                                    <th>Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1 ?>
                                                <?php foreach ($getusermodel as $data) :?>

                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?=$data->nik ;?></td>
                                                    <td><?=$data->nama_lengkap ?></td>
                                                    <td><?= $data->email ?></td>
                                                    <td><?= $data->no_wa ?></td>
                                                    <td><?=$data->jabatan ?></td>
                                                    <td>
                                                       
                                                           

                                                            <form action="/admin/deletedata/<?=$data->id ;?>" method="post" class="d-inline">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="_method" value="DELETE" id="delete">
                                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete <i class="mdi mdi-delete"></i></button>

                                                            </form>
                                                     
                                                    </td>

                                                   
                                                </tr>
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


<script>
    const delete = getElementById('delete');

    delete.EventLisntener('click', function () {
        <
        button type = "button"
        class = "btn btn-info btn-sm waves-effect waves-light"
        id = "sa-warning" > Click me < /button>
    })
</script>
<?php  $this->endSection();?>