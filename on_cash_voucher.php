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
		<h2>Data Tenaga Kerja &raquo; Ongoing Cash Voucher </h2>
			<hr />
<div class="row">			
<div class="col-sm-2">		
			<a href="cash_voucher.php" data-toggle="tooltip" title="Kembali" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-list"></span> Kembali</a></div>
<div class="col-sm-2">			
			<a href="on_cash_voucher.php" data-toggle="tooltip" title="Ongoing Cash Bank" class="btn btn-success" role="button"><span class="glyphicon glyphicon-list"></span> Ongoing</a></div>
<div class="col-sm-2">			
			<a href="fin_cash_voucher.php" data-toggle="tooltip" title="Finished Cash Bank" class="btn btn-info" role="button"><span class="glyphicon glyphicon-list"></span> Finalized</a></div>
</div>

<div class=" form-group text-left">
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">	
  <p> <h3>List Ongoing Cash Voucher </h3></p>            
  <table class="table table-hover">
    <thead>
      <tr>		
        <th>No</th>
        <th>Cash ID</th>
        <th>Tanggal</th>         
        <th>Profit A</th>
        <th>Profit B</th>
        <th>Status</th>
        
        
        
        
             
        </tr>
    </thead>
    <tbody>
      <tr>
<?php        			
$sql = mysqli_query($koneksi, "SELECT * FROM cash WHERE status = 'new' ORDER BY id_cash DESC"); // jika tidak ada filter maka tampilkan semua entri
if(mysqli_num_rows($sql) == 0){ 
	echo '<tr><td colspan="14">Data Belum Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
}else{ // jika terdapat entri maka tampilkan datanya
	$no = 1;	
	while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
		$status = $row['status'];
			if($status == 'new'){
				$status = 'Unpaid';
			}
		echo '
			<td>'.$no.'</td>
			<td><input name="ctki" type="hidden" value="'.$row['id_cash'].'"><a href="form_cash_voucher.php?id_cash='.$row['id_cash'].'">'.$row['id_cash'].'</input></td></a>
			<td>'.$row['tgl_cash'].'</td>						
			<td>'.$row['profit_a'].'</td>	
			<td>'.$row['profit_b'].'</td>	
			<td>'.$status.'</td>								
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
