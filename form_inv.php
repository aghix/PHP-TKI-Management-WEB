<?php 
ob_start();
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

?>
<body>   
		<div class="container">
		<div class="content form-group">
			<h2>Data Tenaga Kerja &raquo; Invoice Form</h2>
			<hr /> 
			<div class="text-center col-sm-2">
		<a href="invoice.php"><button name="kembali" type="submit" value="Invoice" type="button" class="btn btn-danger btn-block">Kembali</button></a>
		</a></div>
		<div class="row"></div>	
		<br>
		
<?php
if(isset($_GET['aksi']) == 'delete'){ // mengkonfirmasi jika 'aksi' bernilai 'delete' merujuk pada baris 97 dibawah
				$del_inv = $_GET['id_inv'];// ambil nilai nim				
				$del_item= $_GET['item'];
				$cek = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no='$id_pkd'"); // query untuk memilih entri dengan nim yang dipilih
				if(mysqli_num_rows($cek) == 0){ // mengecek jika tidak ada entri nim yang dipilih
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Item Sudah ada di PKD lain.</div>'; // maka tampilkan 'Data tidak ditemukan.'
				}else{ // mengecek jika terdapat entri nim yang dipilih
				//$delete = mysqli_query($koneksi, "DELETE FROM pkd WHERE no='$id_pkd'"); // query untuk menghapus
				//$delete2 = mysqli_query($koneksi, "DELETE FROM ctki WHERE voucher='$id_ctki' AND item='$id_item'");
				if($delete){ // jika query delete berhasil dieksekusi				        
				header("Location: testing_pkd.php?no_pkd=".$no_pkd."&pesan=deleted");	
						}else{ // jika query delete gagal dieksekusi
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>'; // maka tampilkan 'Data gagal dihapus.'
					}
				}
			}

?>			
<?php
$id_inv=$_GET['id_inv'];

$sql = mysqli_query($koneksi, "SELECT * FROM invoice WHERE id_inv='$id_inv'");
$row = mysqli_fetch_assoc($sql);
$exp_string = $_POST['ctki'];
list($nama, $no_ctki) = explode(",", $exp_string);
if(isset($_POST['pilih'])){
$sql1= mysqli_query($koneksi, "UPDATE mahasiswa SET inv = 'inv' WHERE ctki='$no_ctki'"); 
$sql2= mysqli_query($koneksi, "UPDATE invoice SET id_ctki = '$no_ctki' WHERE id_inv='$id_inv'"); 
if($sql2){ 			        
	header("Location: form_inv.php?id_inv=".$id_inv."");
	}
}
//fetch log saldo
$sql = mysqli_query($koneksi, "SELECT * FROM log ORDER BY no DESC LIMIT 1");
$rowsal = mysqli_fetch_assoc($sql);
$saldo_awal = $rowsal['saldo'];	
//fetch log saldo	

//fetch total payment
$sqlpr_jml = mysqli_query($koneksi, "SELECT * FROM invoice where id_inv='$id_inv' AND nominal IS NOT NULL ORDER BY no ASC");
			if(mysqli_num_rows($sqlpr_jml) !== 0){
				$row_cnt_jml = mysqli_num_rows($sqlpr_jml);				
				$total_jml=0; 
			while($row_jml = mysqli_fetch_assoc($sqlpr_jml)){
				$num_nominal_jml=$row_jml['nominal']; 
				$total_jml += $num_nominal_jml;					
				}
			}
//fetch total payment
$id_no_ctki = $row['id_ctki'];
if(isset($_POST['fin_inv'])){
$sql4= mysqli_query($koneksi, "UPDATE invoice SET status = 'fin' WHERE id_inv='$id_inv'");
$sql4= mysqli_query($koneksi, "UPDATE ctki SET payment = '$total_jml' WHERE voucher='$id_no_ctki'");
	if($sql4){ 			        
	header("Location: form_inv.php?id_inv=".$id_inv."");
	} 
}
?>
<div class="row">			
<div class="col-sm-4">		
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">		        
            <fieldset class="row2">				
			<p>	Invoice Number: <b><?php echo $id_inv; ?></b>
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
			</p>
			<p >	
			Tanggal : <label name="tgl"><b><?php echo $row['tgl_inv']; ?></b></label>
			</p>
			<p>	
			User : <label name="user"><b><?php echo $row['user']; ?></b>
			</p>
			<p>	
			CTKI : <label name="item"><b><?php echo $row['id_ctki']; ?></b>
			</p>
			<?php
			$sqlpr = mysqli_query($koneksi, "SELECT * FROM invoice where id_inv='$id_inv' AND nominal IS NOT NULL ORDER BY no ASC");
			if(mysqli_num_rows($sqlpr) !== 0){
				$row_cnt = mysqli_num_rows($sqlpr);				
				$total=0; 
			while($row3 = mysqli_fetch_assoc($sqlpr)){
				$num_nominal=$row3['nominal']; 
				$total += $num_nominal;
				$rp2 = number_format($total);	
				}
			}
			?>
			<p>	
			<h3>Total Payment : <input type="hidden" name="total_jml" value="<?php echo $total;?>">Rp <font color="red"><b><?php  echo $rp2; ?>,-</font></b></h3>
			</p>
</div></div></form>
<?php
$probe=$row['id_ctki'];
$probe2=$row['status'];
if($probe == 'unpaid' and $probe2 == 'unpaid'){
	include("inv_ctki.php");
	}
?>

					<?php
						if($probe !== 'unpaid' AND $probe2 == 'unpaid'){
							echo'
							<br>
								<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">	
								<div class="row">
								<div class="col-sm-5 text-left">			
								<table class="table">
								<tr>
								<td><select name="jenis" class="form-control" required>
								<option value="">--Pilih--</option>
								<option value="Book">Book</option>
								<option value="Flight">Flight</option>
								</select></td>
								<td><input name="bayar" type="text" placeholder="Input Nominal" required></input></td>
								<td><button name="input_num" type="submit" class="btn btn-success btn-block">Process</button></td>
								</tr>
								</div></div>
								</form>
							';
						}
					?>	
<?php
$num_item=$_POST['jenis'];
$conv_string=$_POST['bayar'];
$bad_symbols = array(",", ".");
$num_pay = str_replace($bad_symbols, "", $conv_string);
$tgl_trf = date('d/m/Y');
if(isset($_POST['input_num'])){
	$saldo=$saldo_awal+$num_pay;
$sql3= mysqli_query($koneksi, "INSERT INTO invoice (id_inv,nominal,tgl_trf,item)VALUES('$id_inv','$num_pay','$tgl_trf','$num_item')");
$sql_log= mysqli_query($koneksi, "INSERT INTO log (item,nominal,tgl_trf,code,type,debit,saldo)VALUES('$id_inv','$num_pay','$tgl_trf','INV','$num_item','$num_pay','$saldo')");
if ($sql3){ 
	header("Location: form_inv.php?id_inv=".$id_inv.""); 
	}
}
?>	
<div class="row">		
	<div class="col-sm-6 text-left">
  <h2></h2>
  <p> <h3>Daftar Item Invoice</h3></p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th>No</th>
        <th>Item</th>   
        <th>Tanggal</th>            
        <th>Nominal</th>               
        </tr>
    </thead>
    <tbody>
      <tr>
<?php        			
$sqle = mysqli_query($koneksi, "SELECT * FROM invoice where id_inv='$id_inv' AND nominal IS NOT NULL ORDER BY no ASC"); 
	if(mysqli_num_rows($sqle) == 0){ 
		echo '<tr><td colspan="14">Data Belum Ada.</td></tr>'; 
	}else{ 
	$no = 1; 
	while($row2 = mysqli_fetch_assoc($sqle)){ 
	$item=$row2['item'];
	$tanggal_trf=$row2['tgl_trf'];	
	$number = $row2['nominal'];
	$rp = number_format($number);						
							echo '							
								<td>'.$no.'</td>
								<td>'.$item.'</td>
								<td>'.$tanggal_trf.'</td>
								<td>'.$rp.'</td>
								<td>';								
							
							if($stts !=='fin'){
							echo '<a href="daftar_pkd.php?id_inv='.$row2['id_inv'].'&item='.$row2['item'].'&aksi=delete" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus item '.$row2['item'].' Dengan nominal '.$rp.'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
								</td>
								</tr>	
								';
								}else{
								echo '
								</td>
							</tr>
								';
								echo '
								</td>								
								</tr>
							';
								}		
							$no++; // mewakili data kedua dan seterusnya
						}
					}
					?>
</tbody>
</table>
</div></div>
<br>

<?php
if($probe2 == 'unpaid'){
	echo'
	<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">	
	<div class="row">
	<div class="col-sm-2">	
	<button name="fin_inv" type="submit" class="btn btn-primary btn-block">Finalize Invoice</button>
	</div></div>
	</form>		
	';
	}else{
		echo '
		<div class="row">
		<div class="text-center col-sm-2">
		<a href="invoice.php"><button name="kembali" type="submit" value="Invoice" type="button" class="btn btn-danger btn-block">Kembali</button></a>
		</a></div>
		</div>	
		';
	}
?>

						
