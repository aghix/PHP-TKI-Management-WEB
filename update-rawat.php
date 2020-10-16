<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
include("dbconn.php");
?>
	<div class="container">
		<div class="content">
		<h2>Data Tenaga Kerja &raquo; Edit Skill Merawat Pasien</h2>
			<hr />
			
			<?php
			$code = $_GET['code']; // assigment nim dengan nilai nim yang akan diedit
			$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); // query untuk memilih entri data dengan nilai nim terpilih
			$row = mysqli_fetch_assoc($sql);
			
			if(isset($_POST['save'])){ // jika tombol 'Simpan' dengan properti name="save" pada baris 162 ditekan
				$code		     	 	 = $row['code'];	
				$cekup		     	 	 = $_POST['cekup'];
				$suap		     	 = $_POST['suap'];
				$sedot		     	 = $_POST['sedot'];
				$suntik		     	 = $_POST['suntik'];
				$pijit		     	 = $_POST['pijit'];
				$buang		     	 = $_POST['buang'];
				
				
				$update = mysqli_query($koneksi, "UPDATE mahasiswa SET 
				cekup		= '$cekup', 
				suap		= '$suap',
				sedot		= '$sedot',
				suntik		= '$suntik',
				pijit		= '$pijit',
				buang		= '$buang'
				
				WHERE code='$code'") or die(mysqli_error()); // query untuk mengupdate nilai entri dalam database
				if($update){ // jika query update berhasil dieksekusi
					header("Location: update-rawat.php?code=".$code."&pesan=sukses"); // tambahkan pesan=sukses pada url
				}else{ // jika query update gagal dieksekusi
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>'; // maka tampilkan 'Data gagal disimpan, silahkan coba lagi.'
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){ // jika terdapat pesan=sukses sebagai bagian dari berhasilnya query update dieksekusi
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan. <a href="profile.php?code='.$code.'"><- Kembali</a></div>'; // maka tampilkan 'Data berhasil disimpan.'
			}
		
	?>		
	
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">	
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Re-Check-UP</label>    
		<div class="col-sm-2"> 
           <select name="cekup" class="form-control" >
							<option value="<?php echo $row['cekup']; ?>"> <?php echo $row['cekup']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>					
						
		<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Menyuapi / Memandikan</label>    
		<div class="col-sm-2"> 
           <select name="suap" class="form-control" >
							<option value="<?php echo $row['suap']; ?>"> <?php echo $row['suap']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>		
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Sedot Dahak</label>    
		<div class="col-sm-2"> 
           <select name="sedot" class="form-control" >
							<option value="<?php echo $row['sedot']; ?>"> <?php echo $row['sedot']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>		
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Menyuntik Pasien</label>    
		<div class="col-sm-2"> 
           <select name="suntik" class="form-control" >
							<option value="<?php echo $row['suntik']; ?>"> <?php echo $row['suntik']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>	
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Memijat / Menemani Pasien</label>    
		<div class="col-sm-2"> 
           <select name="pijit" class="form-control" >
							<option value="<?php echo $row['pijit']; ?>"> <?php echo $row['pijit']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>	
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Membantu Buang Air Kecil / Besar</label>    
		<div class="col-sm-2"> 
           <select name="buang" class="form-control" >
							<option value="<?php echo $row['buang']; ?>"> <?php echo $row['buang']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>																

				<div class="form-group"></div>
				<div class="form-group"></div>
	
	<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Update Data TKI">
						<a href="profile.php?code=<?php echo $row['code']; ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">kembali</a>
					</div>
				</div>
	
	
	
	
	
	</form>
		</div> <!-- /.content -->
	</div> <!-- /.container -->		
				
					
<?php 
include("footer.php"); // memanggil file footer.php
?>

</body>
</html>	
