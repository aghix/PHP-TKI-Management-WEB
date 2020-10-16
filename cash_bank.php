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
		<h2>Data Tenaga Kerja &raquo; Kas Bank Record</h2>
			<hr />
<div class="row">			
<div class="col-sm-2">		
			<a href="main.php" data-toggle="tooltip" title="Kembali" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-list"></span> Kembali</a></div>
</div>
<div class=" form-group text-left">
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">	
  <p> <h3>List Kas Bank </h3></p>            
  <table class="table table-hover">
    <thead>
      <tr>		
        <th>No</th>
        <th>Keterangan</th>
        <th>Type</th> 
        <th>Tanggal</th>        
        <th>Debit</th>
        <th>Kredit</th>
        <th>Saldo</th>
        <th>Tabungan</th>
        
</tr>
    </thead>
    <tbody>
      <tr>
<?php        			
$sql_list = mysqli_query($koneksi, "SELECT * FROM log ORDER BY no DESC"); // jika tidak ada filter maka tampilkan semua entri
if(mysqli_num_rows($sql_list) == 0){ 
	echo '<tr><td colspan="14">Data Belum Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
}else{ // jika terdapat entri maka tampilkan datanya
	
	while($row = mysqli_fetch_assoc($sql_list)){ // fetch query yang sesuai ke dalam array
		$no=$row['no'];
		$number = $row['debit'];		
		$rp = number_format($number);
		$number2 = $row['kredit'];		
		$rp2 = number_format($number2);	
		$number3 = $row['saldo'];		
		$rp3 = number_format($number3);	
		$number4 = $row['tabungan'];		
		$rp4 = number_format($number4);			
		$url = $row['code'];
		$code_ctki = $row['code_ctki'];
		if($url == 'PKD'){
			$url = 'daftar_pkd.php?no_pkd=';
			}
		if($url == 'INV'){
			$url = 'form_inv.php?id_inv=';
			}
		if($url == 'LABA'){
			$url = 'form_ctki.php?code='.$code_ctki.'&ctki=';
			}
		if($url == 'CASH'){
			$url = 'form_cash_voucher.php?id_cash=';
			}
		echo '
			<td>'.$no.'</td>
			<td><input name="ctki" type="hidden" value="'.$row['item'].'"><a href="'.$url.''.$row['item'].'">'.$row['item'].'</input></td></a>
			<td>'.$row['type'].'</td>
			<td>'.$row['tgl_trf'].'</td>			
			<td><font color="green">'.$rp.'</font></td>	
			<td><font color="red">'.$rp2.'</font></td>	
			<td><font color="blue">'.$rp3.'</font></td>	
			<td>'.$rp4.'</td>									
			<td>';
								
			echo '
			</td>
			<td>									
			</td>
			</tr>
				';
							
		}
	}
					?>
</table>
</form>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">						
<div class="row">			
<div class="col-sm-2">		
			<button name="repair" type="submit" value="" type="button" class="btn btn-primary btn-block">Repair</button></a>
		</div>
</div>
<?php
if(isset($_POST['repair'])) { 
	$sql_off =mysqli_query ($koneksi, "ALTER TABLE `log` DROP COLUMN `no`;");
	$sql_on =mysqli_query ($koneksi, "ALTER TABLE `log` ADD `no` INT(5) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`no`);");
	$sql = mysqli_query($koneksi, "SELECT * FROM log WHERE no >= 2");
	$num = 2;	
	while($row2 = mysqli_fetch_assoc($sql)){	
	$num_debit = $row2['debit'];	
	$num_kredit = $row2['kredit'];
	//$num_tabungan = $row2['tabungan'];
	$num_saldo = $num-1;
	$last_saldo = mysqli_query($koneksi, "SELECT no,saldo FROM log WHERE no = '$num_saldo' ");
	$row_saldo = mysqli_fetch_assoc($last_saldo);
	$num_last_saldo = $row_saldo['saldo'];		
	$new_saldo = $num_last_saldo+$num_debit-$num_kredit;
	$sql_up = mysqli_query($koneksi, "UPDATE log SET saldo = '$new_saldo' WHERE no = '$num' ");
	$num++;
	}
	header("Location: cash_bank.php"); 
}
?>
</form>
