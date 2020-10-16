<?php 
ob_start();
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
?>

<?php

$no_ctki = $_GET['ctki'];
$code = $_GET['code']; 			
$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'");
$row = mysqli_fetch_assoc($sql);
$sql1 = mysqli_query($koneksi, "SELECT * FROM ctki WHERE voucher='$no_ctki'");
$rowc = mysqli_fetch_assoc($sql1);
$probe = $rowc['status'];
$qr_code = $rowc['qrcode'];
?>
<body>   
		<div class="container">
		<div class="content form-group">
			<h2>Data Tenaga Kerja &raquo; Form CTKI</h2>
			<hr /> 
<?php
if (isset($_POST['input'])){
$payment = $_POST['payment'];	
$bad_symbols = array(",", ".", "-");
$nominal = str_replace($bad_symbols, "", $payment);	
$sqlin = mysqli_query($koneksi, "UPDATE ctki SET payment = '$nominal' WHERE voucher='$no_ctki'");
if (!$sqlin){
	echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Payment Gagal Di Input! </div>'; 
		}else{
			header("Location: form_ctki.php?ctki=".$no_ctki."&code=".$code.""); 
			echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Nominal Payment berhasil di Update </div>'; 
	}
}

?>						
			
			<div class="row">
			<div class="text-center col-sm-2">
		<a href="profile.php?code=<?php echo $code ?>"><button name="kembali" type="button" class="btn btn-danger btn-block">Kembali</button></a>
		</a></div></div>
	<br>

	<div class="row">
		<div class="col-sm-6">
			<table class="table table-condensed ">
			<thead>
			<tr>
				<th><b>Voucher CTKI</b></th>
				<th><b><font color="blue"><?php echo $no_ctki;?></font></b></th>
				<th></th>
			</tr>
			</thead>
			</table>
		
			<table class="table ">			
			<tr>
				<td>Nama Lengkap </td>
				<td>: <b> <?php echo $row['nama'];?></b></td>				
			</tr>
			<tr>
				<td>Nama PT </td>
				<td>: <b> <?php echo $row['pt_sponsor'];?></b></td>
			</tr>
			<tr>
				<td>Nama Sponsor </td>
				<td>: <b> <?php echo $row['nm_sponsor'];?></b></td>
			</tr>
			<tr>
				<td>Negara Tujuan </td>
				<td>: <b> <?php echo $row['tujuan'];?></b></td>
			</tr>
			<?php
			$sql01 = mysqli_query($koneksi, "SELECT * FROM invoice where id_ctki='$no_ctki'");
			$row_inv = mysqli_fetch_assoc($sql01);	
			$id_inv = $row_inv['id_inv'];
			$sql_inv = mysqli_query($koneksi, "SELECT * FROM invoice where id_inv='$id_inv' AND nominal IS NOT NULL");
			if(mysqli_num_rows($sql_inv) !== 0){
				//$row_cnt = mysqli_num_rows($sql);				
				$totalz=0; 
			while($row3 = mysqli_fetch_assoc($sql_inv)){
				$num_pay=$row3['nominal']; 
				$totalz += $num_pay;
				$rp_inv = number_format($totalz);	
				}
			}
			?>
			<tr>
				<td><h4>Total Payment Agency </h4></td>
				<td> <h4>:<b><?php echo $rp_inv;?></h4></b></td>
			</tr>
			
			</table>
		</div>
		<div class="col-sm-6">	
		<img id="myImg" src="<?php echo''.$qr_code.''; ?>" alt="QR Code Biodata" style="width:250px;height:250px;">
		</div>
		</div>

	
	<br><br>
	
	
	
	
	
	<div class="row">
		<div class="col-sm-9">
		<table class="table table-condensed ">
			<thead>
			<tr>
				<th><b>No</b></th>
				<th><b>Keterangan</font></b></th>
				<th><b><font color="red">Nominal</font></b></th>
				<th><b><font color="green">Tanggal</font></b></th>
				<th><b><font color="blue">No PKD</font></b></th>
			</tr>
			</thead>
			<tbody>
			
			<tr>
				<th><b>1</b></th>
				<th>Sponsor</th>
				<th><b></b></th>
				<th><b></b></th>
				<th><b></b></th>
			</tr>
			
			<tr>
				<?php
				$sql1a = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'Sponsor DP' AND status = 'paid' ");
				$row1a = mysqli_fetch_assoc($sql1a); 
				$number=$row1a['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b></b></th>
				<th>&emsp; DP</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1a['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1a['no_pkd'];?>"<b><?php echo $row1a['no_pkd'];?></a></th>
			</tr>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'Sponsor Pelunasan' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b></b></th>
				<th>&emsp; Pelunasan</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'Medical' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b>2</b></th>
				<th>Medical</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'Medical II' AND status = 'paid' ");
				if(mysqli_num_rows($sql1b) > 0){				
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				echo '
						<tr>
						<th><b></b></th>
						<th>Medical II</th>
						<th><b>'.$rp.'</b></th>
						<th><b>'.$row1b['tgl_trf'].'</b></th>
						<th><a href="daftar_pkd.php?no_pkd='.$row1b['no_pkd'].'"<b>'.$row1b['no_pkd'].'</a></th>
						</tr>
				';
			}
			?>
			<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'Medical III' AND status = 'paid' ");
				if(mysqli_num_rows($sql1b) > 0){				
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				echo '
						<tr>
						<th><b></b></th>
						<th>Medical II</th>
						<th><b>'.$rp.'</b></th>
						<th><b>'.$row1b['tgl_trf'].'</b></th>
						<th><a href="daftar_pkd.php?no_pkd='.$row1b['no_pkd'].'"<b>'.$row1b['no_pkd'].'</a></th>
						</tr>
				';
			}
			?>
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'ID & Asuransi' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b>3</b></th>
				<th>ID & Asuransi Pra</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'ID & Asuransi II' AND status = 'paid' ");
				if(mysqli_num_rows($sql1b) > 0){				
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				echo '
						<tr>
						<th><b></b></th>
						<th>ID & Asuransi PRA II</th>
						<th><b>'.$rp.'</b></th>
						<th><b>'.$row1b['tgl_trf'].'</b></th>
						<th><a href="daftar_pkd.php?no_pkd='.$row1b['no_pkd'].'"<b>'.$row1b['no_pkd'].'</a></th>
						</tr>
				';
			}
			?>
			<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'ID & Asuransi III' AND status = 'paid' ");
				if(mysqli_num_rows($sql1b) > 0){				
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				echo '
						<tr>
						<th><b></b></th>
						<th>ID & Asuransi PRA II</th>
						<th><b>'.$rp.'</b></th>
						<th><b>'.$row1b['tgl_trf'].'</b></th>
						<th><a href="daftar_pkd.php?no_pkd='.$row1b['no_pkd'].'"<b>'.$row1b['no_pkd'].'</a></th>
						</tr>
				';
			}
			?>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'Pelatihan BLK' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b>4</b></th>
				<th>Pelatihan BLK</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'Passpor' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b>5</b></th>
				<th>Paspor</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'ISC' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b>6</b></th>
				<th>ISC</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'FWCMS' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b>7</b></th>
				<th>FWCMS</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'VISA' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b>8</b></th>
				<th>VISA</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'VISA/IPA' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b>9</b></th>
				<th>VISA/IPA (Singapore)</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'VISA/TETO' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b>10</b></th>
				<th>VISA/TETO (Taiwan)</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'Fiskal' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b>11</b></th>
				<th>Fiskal</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'Tiket Pesawat' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b>12</b></th>
				<th>Tiket Pesawat</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'Transportasi' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b>13</b></th>
				<th>Transportasi </th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			
			<tr>				
				<th><b></b></th>
				<th>/ Handle to Airport</th>
				<th><b></b></th>
				<th><b></b></th>
				<th></th>
			</tr>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'AN05' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b>14</b></th>
				<th>AN05/Pinjam CAB/</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			
			<tr>				
				<th><b></b></th>
				<th>PT Lain</th>
				<th><b></b></th>
				<th><b></b></th>
				<th></th>
			</tr>
			
			<tr>				
				<th><b>15</b></th>
				<th>Uang Makan di BLK</th>
				<th><b></b></th>
				<th><b></b></th>
				<th></th>
			</tr>
			
			<tr>				
				<th><b></b></th>
				<th>@Rp. 25,000,-/Day</th>
				<th><b></b></th>
				<th><b></b></th>
				<th></th>
			</tr>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'Makan BLK Bulan I' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b></b></th>
				<th>&emsp;Bulan I/</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'Makan BLK Bulan II' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b></b></th>
				<th>&emsp;Bulan II/</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			
			<tr>
				<?php
				$sql1b = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_ctki='$no_ctki' AND item = 'Makan BLK Bulan III' AND status = 'paid' ");
				$row1b = mysqli_fetch_assoc($sql1b);  
				$number=$row1b['jumlah']; 
				$rp = number_format($number);
				?>
				<th><b></b></th>
				<th>&emsp;Bulan III/</th>
				<th><b><?php echo $rp;?></b></th>
				<th><b><?php echo $row1b['tgl_trf'];?></b></th>
				<th><a href="daftar_pkd.php?no_pkd=<?php echo $row1b['no_pkd'];?>"<b><?php echo $row1b['no_pkd'];?></a></th>
			</tr>
			
<?php
        			
					$sql = mysqli_query($koneksi, "SELECT jumlah FROM pkd WHERE no_ctki = '$no_ctki' AND status = 'paid' ORDER BY no ASC "); // jika tidak ada filter maka tampilkan semua entri
					
					if(mysqli_num_rows($sql) == 0){ 
						}else{ // jika terdapat entri maka tampilkan datanya
						$row_cnt = mysqli_num_rows($sql);
						$no = 1; // mewakili data dari nomor 1
						$total=0;
						while($row2 = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							$number = $row2['jumlah'];
							//$rp = number_format($number);
							$total += $number;
							$rp2 = number_format($total);			
						}
					}
?>
			
			<tr>				
				<th><b></b></th>
				<th><h3><b>&emsp;Sub. Total</b></h3></th>
				<th><h3><font color="red"><b><?php echo $rp2;?></b></font></h3></th>
				<th></th>
				<th></th>
			</tr>
			<br>
<?php
if($totalz !== NULL){
$grand = $totalz-$total;
$pr_grand = number_format($grand);
}else{
	$pr_grand = '--';
	}
?>			
			<tr>				
				<th><b></b></th>
				<th><b>&emsp;Grand Total</b></th>
				<th><b><?php echo $pr_grand; ?></b></th>
				<th></th>
				<th></th>
			</tr>
<?php
if (isset($_POST['input_laba'])){
	$laba=$_POST['laba'];
	$bad_symbols = array(",", ".", "-");
	$str_laba = str_replace($bad_symbols, "", $laba);
$sql = mysqli_query($koneksi, "UPDATE ctki SET laba = '$str_laba' WHERE voucher='$no_ctki'"); 
if($sql){ 			        
	header("Location: form_ctki.php?ctki=".$no_ctki."&code=".$code."");
		}
	}
$num_laba=$rowc['laba'];
$rp_laba = number_format($num_laba);			
?>	
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">			
			<tr>						
				<th><b></b></th>
				<th><b>&emsp;Laba Ditahan</b></th>
				<?php
						if($probe !=='flight'){
							echo'
								<th><input name="laba" type="text" id="laba" placeholder="'.$rp_laba.'" value="'.$rp_laba.'" required></th>
								<th><button name="input_laba" type="submit" class="btn btn-success btn-block">Input Laba</button></th>
							';
						}else{
							echo'
								<th>'.$rp_laba.'</th>
								<th></th>
							
							';
							}
					?>		
				
				<th></th>
			</tr>
			
			
				
<?php
if (isset($_POST['persen'])){
$percent = $_POST['profit_a'];
$percent2 = 1-$_POST['profit_a'];
$num_prof = $grand-$num_laba;
$profit_a = $num_prof*$percent;
$profit_b = $num_prof*$percent2;
$sql = mysqli_query($koneksi, "UPDATE ctki SET persen = '$percent', profit_a = '$profit_a', profit_b = '$profit_b', sub_total = '$total' WHERE voucher='$no_ctki'"); 
if($sql){ 			        
	header("Location: form_ctki.php?ctki=".$no_ctki."&code=".$code."");
	}
}
$prof_a=$rowc['profit_a'];
$prof_b=$rowc['profit_b'];
$pcnt = $rowc['persen']*100;
$pcnt2=1-$rowc['persen'];
$pcnt2a=$pcnt2*100;
$prof_a1 = number_format($prof_a);
$prof_b1 = number_format($prof_b);
$nett_prof=$grand-$num_laba;
if($nett_prof !== 0){
$nett_prof_num = number_format($nett_prof);
}else{
	$nett_prof_num = '--';
	}
?>			
			<tr>				
				<th><b></b></th>
				<th><h3><b>&emsp;Profit</b></h3></th>
				<th><font color="blue"><h3><b><?php echo $nett_prof_num; ?></b></h3></font></th>
				<th></th>
				<th></th>
			</tr>
				
			<tr>				
				<th><b></b></th>
				<th><b>&emsp;Remarks</b></th>
				<th>: Profit Share A</th>
				<th>
				<?php
						if($probe !=='flight'){
							echo'
								<select name="profit_a" class="form-control" required>
							<option value="'.$rowc['persen'].'</option>"> '.$pcnt.' % </option>
							<option value="0.10">10%</option>
							<option value="0.15">15%</option>
							<option value="0.20">20%</option>
							<option value="0.25">25%</option>
							<option value="0.30">30%</option>
							<option value="0.35">35%</option>
							<option value="0.40">40%</option>
							<option value="0.45">45%</option>
							<option value="0.50">50%</option>
							<option value="0.55">55%</option>
							<option value="0.60">60%</option>
							<option value="0.65">65%</option>	
							<option value="0.70">70%</option>
							<option value="0.75">75%</option>
							<option value="0.80">80%</option>
							<option value="0.90">90%</option>
							<option value="0.95">95%</option>						
							</select>
							';
						}else{
							echo ''.$pcnt.' %';
							}
					?>				
					</th>
				<th><?php echo $prof_a1;?></th>
			</tr>
			
			<tr>				
				<th><b></b></th>
				<th></th>
				<th>: Profit Share B</th>
				<th><?php echo ''.$pcnt2a.' %';?></th>
				<th><?php echo $prof_b1;?></th>
			</tr>
		
			<tr>				
				<th><b></b></th>
				<th></th>
				<th></th>
				<th>
					<?php
						if($probe !=='flight'){
							echo'
								<button name="persen" type="submit" class="btn btn-success btn-block">Kalkulasi</button>
							';
						}
					?>			
				</th>
				<th></th>
			</tr>
			
			</tbody>
		</table>
	</div>		
</div>	
<div class="row">
		<div class="col-sm-2">
			<table class="table borderless">
			<thead>
			<tr>
				<th><a href="profile.php?code=<?php echo $code ?>"><button name="kembali" type="button" class="btn btn-danger btn-block">Kembali</button></a></th>
<?php
if($probe !=='flight'){
echo'
		<form class="register" method="POST">
		<th><button name="final" type="submit" class="btn btn-info btn-block">Finalize</button></a></th>
		</form>

';
}
?>
<?php
//finalize engine
	$sql = mysqli_query($koneksi, "SELECT * FROM log ORDER BY no DESC LIMIT 1");
	$row_saldo = mysqli_fetch_assoc($sql);
	$num_last_saldo = $row_saldo['saldo'];
	$num_saldo = $num_last_saldo-$num_laba;
	$date = $tgl_voucher = date('d/m/Y');
	$sql = mysqli_query($koneksi, "SELECT MAX(no) FROM log WHERE code = 'LABA'");
	$row_laba = mysqli_fetch_assoc($sql);
	$num_tabungan = $row_laba['tab'];
	$tabungan = $num_tabungan+$num_laba;	
if (isset($_POST['final'])){	
	$sql=mysqli_query($koneksi, "INSERT INTO log (tgl_trf,item,nominal,code,type,kredit,tabungan,saldo,code_ctki) VALUES ('$date','$no_ctki','$num_laba','LABA','Laba Ditahan','$num_laba','$tabungan','$num_saldo','$code')");
	$sql=mysqli_query($koneksi, "UPDATE ctki SET status = 'flight' WHERE voucher = '$no_ctki'");
	
	}			
?>
			</tr>
			</thead>
			</table>
		</div>
		</div>		
</form>

			
</div>		
</div>

	
	
	
