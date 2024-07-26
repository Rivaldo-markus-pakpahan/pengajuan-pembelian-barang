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
<table id="complex-header-datatable" class="table dt-responsive nowrap" border="1">
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
                                                  

                                            </tr>
                                            <?php endif ;?>
                                       
                                          <?php endforeach ?>
                                                <?php endforeach ?>
                                                <?php endforeach ?>
                                            
                                            </tbody>
                                        </table>
</body>

</html>