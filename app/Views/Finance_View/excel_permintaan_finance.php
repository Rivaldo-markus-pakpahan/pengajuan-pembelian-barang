<?php 

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename= Rekap Pengajuan.xls");



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Excel</title>
</head>

<body>
    <table class="table mt-4 text-center" border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pengajuan</th>
               
                <th>Nik</th>
                <th>Nama Barang</th>
                
                <th>Harga</th>
                <th>Catatan</th>
                <th>Keterangan</th>
          



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
            
                <td><?=$p['nik_user'] ?></td>
                <td><?=$p['nama_barang'] ?></td>
              
                <td><?=$p['biaya'] ?></td>
                <td><?=$p['catatan'] ?></td>
                <td><?=$j['respon'] ?></td>
           





            </tr>
            <?php endif ; ?>
            <?php endforeach ; ?>
            <?php endforeach ; ?>
        </tbody>
    </table>

    
</body>

</html>