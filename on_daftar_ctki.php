<?php 
ob_start();
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<div class="container">
		<div class="content">
		<h2>Data Tenaga Kerja &raquo; Daftar CTKI </h2>
			<hr />

<div class="row">			
<div class="col-sm-5">		
<form class="register" method="POST">
			<a href="main.php" data-toggle="tooltip" title="Management Main Page" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-list"></span> Kembali</a>
			<a href="on_daftar_ctki.php" data-toggle="tooltip" title="On Process CTKI" class="btn btn-success" role="button"><span class="glyphicon glyphicon-list"></span> On Process</a>
			<a href="fin_daftar_ctki.php" data-toggle="tooltip" title="Finished CTKI" class="btn btn-info" role="button"><span class="glyphicon glyphicon-list"></span> Flight</a>
			<a href="daftar_ctki.php" data-toggle="tooltip" title="All Data CTKI" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-list"></span> All</a>
</div></div>

<div class=" form-group text-left">
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">	
  <p> <h3>List Data CTKI </h3></p>            
  <table class="table table-hover">
    <thead>
      <tr>
		  <th>No</th>    
		<th>No_CTKI</th>        
        <th>Nama</th>
        <th>Tujuan</th>
        <th>Status</th>
        <th>Modal</th>
        
        
        
             
        </tr>
    </thead>
    <tbody>
      <tr>
					<?php        			
					$sql = mysqli_query($koneksi, "SELECT * FROM ctki WHERE status IS NULL ORDER BY no ASC"); // jika tidak ada filter maka tampilkan semua entri
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Belum Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ // jika terdapat entri maka tampilkan datanya						
						$no = 1;
						//$total= 0; // mewakili data dari nomor 1
						while($row2 = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							$stts=$row2['status'];
							$no_ctki=$row2['voucher'];
							$ambil = mysqli_query($koneksi, "SELECT jumlah FROM pkd WHERE no_ctki = '$no_ctki' AND status = 'paid' ORDER BY no ASC ");
							$total=0;
							while($row3 = mysqli_fetch_assoc($ambil)){ // fetch query yang sesuai ke dalam array
							$number = $row3['jumlah'];
							//$rp = number_format($number);
							$total += $number;
							$rp2 = number_format($total);			
						}
							if($stts == 'fin'){
								$stts='Flight';
								}else{
									$stts='Process';
									}							
							echo '
								<td>'.$no.'</td>
								<td><a href="form_ctki.php?ctki='.$row2['voucher'].'&code='.$row2['code'].'">'.$row2['voucher'].'</input></td></a>
								<td>'.$row2['nama'].'</td>
								<td>'.$row2['tujuan'].'</td>	
								<td>'.$stts.'</td>	
								<td>'.$rp2.'</td>							
								<td>';
								
							echo '
								</td>
								<td>									
								</td>
								</tr>
							';
							$no++; // mewakili data kedua dan seterusnya
							
						}
					}
					?>
    </tbody>
  </table>
</div>
