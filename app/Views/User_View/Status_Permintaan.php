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

                                    <!-- validation------------------------------------------------------------ form -->
                                    <?php $session = session();?>
                                    <?php if ($session->has('message')):?>
                                    <div class="alert alert-success"><?= $session->get('message') ?></div>
                                    <?php endif; ?>

                                    <!-- akhir validation------------------------------------------------------------ form -->
                                    <a href="<?=base_url('user/excel') ?>" class="btn btn-success my-3"><i
                                            class="fas fa-file-excel m-r-5"></i> Excel </a>
                                    <div class="table-responsive">
                                        <table class="table mt-4">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama Barang</th>


                                                    <th>Harga</th>
                                                    <th>Catatan</th>
                                                    <th>Contoh Gambar</th>

                                                    <th>By Manager</th>
                                                    <th>By Finance</th>


                                                    <th>Bukti Transfer</th>
                                                    <th>Aksi</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1 ?>
                                                <?php foreach($getpermintaan as $p):?>

                                                <?php foreach($getjoin as $j):?>

                                                <?php if($p['id'] == $j['id_permintaan']): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?=$p['created_at'] ?></td>
                                                    <td><?=$p['nama_barang'] ?></td>
                                                    <td><?=$p['biaya'] ?></td>
                                                    <td><?=$p['catatan'] ?></td>
                                                    <td>

                                                        <a href="<?=base_url('bukti_lampiran/'.$p['lampiran']) ?>"
                                                            download>
                                                            <button class="btn btn-primary">Download</button>
                                                        </a>


                                                    </td>

                                                    <td>

                                                        <span
                                                            class="badge badge-<?= !empty($j['respon']) ? ($j['respon'] == 'Disetujui' ? 'success' : 'danger') : 'dark'; ?>">
                                                            <?= !empty($j['respon']) ? $j['respon'] : (!empty($p['reject']) ? $p['reject'] : 'Dalam Proses'); ?>
                                                        </span>


                                                    </td>


                                                    <td>

                                                        <span
                                                            class="badge badge-<?= !empty($p['reject']) ? ($p['reject'] == 'Tidak Disetujui' ? 'danger' : 'danger') : 'dark'; ?>">
                                                            <?= !empty($p['reject']) ? $p['reject'] : 'Dalam Proses'; ?>
                                                        </span>

                                                        
                                                    </td>



                                                    <td>
                                                        <?php if(!empty($j['bukti_transfer'])): ?>
                                                        <a href="<?=base_url('bukti_transfer/'.$j['bukti_transfer']) ?>"
                                                            download>
                                                            <button class="btn btn-primary">Bukti Transfer</button>
                                                        </a>

                                                        <?php else: ?>
                                                        <button class="btn btn-danger">Dalam Proses</button>
                                                        <?php endif ?>


                                                    </td>
                                                    <td>
                                                        <form action="/user/delete/<?=$j['id'] ;?>" method="post"
                                                            class="d-inline">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="_method" value="DELETE"
                                                                id="delete">
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete
                                                            </button>

                                                        </form>


                                                        <a href="<?= base_url('user/edit/'. $j['id']); ?>"
                                                            class="btn btn-warning mt-2 mx-2 ">Edit</a>

                                                    </td>





                                                </tr>
                                                <?php endif ; ?>
                                                <?php endforeach ; ?>
                                                <?php endforeach ; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="d-print-none my-4">
                                <div class="text-right">
                                    <a href="javascript:window.print()"
                                        class="btn btn-primary waves-effect waves-light"><i
                                            class="fa fa-print m-r-5"></i> Print</a>

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