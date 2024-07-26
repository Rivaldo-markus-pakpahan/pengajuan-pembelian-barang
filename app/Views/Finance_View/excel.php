<?php 

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename= Rekap Data.xls");



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table id="complex-header-datatable" class="table dt-responsive nowrap text-center" border="1">
    <h1>FORMULIR PENGAJUAN PEMBELIAN BARANG</h1>
    
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal </th>
                <th>Nik Pemohon</th>
                <th>Nama Lengkap Pemohon</th>
                <th>Jabatan Pemohon</th>
               
                <th>Harga</th>

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
                <td><?=$data['created_at'] ?></td>
                <td><?=$data['nik_user'] ?></td>
                <td><?=$user->nama_lengkap ?></td>
                <td><?=$user->jabatan ?></td>
              
                <td><?=$data['biaya'] ?></td>
                <td><?=$data['catatan'] ?></td>
                <td><?=$data['nama_lengkap'] ?></td>

                <td><?=$data['nik'] ?></td>
                <td><?=$data['jabatan'] ?></td>





            </tr>


            <?php endif; ?>
            <?php endforeach; ?>
            <?php endforeach; ?>

        </tbody>
    </table>



</body>

</html>