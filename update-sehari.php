<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
include("dbconn.php");
?>
	<div class="container">
		<div class="content">
		<h2>Data Tenaga Kerja &raquo; Edit Skill Pekerjaan Sehari - hari</h2>
			<hr />
			
			<?php
			$code = $_GET['code']; // assigment nim dengan nilai nim yang akan diedit
			$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); // query untuk memilih entri data dengan nilai nim terpilih
			$row = mysqli_fetch_assoc($sql);
			
			if(isset($_POST['save'])){ // jika tombol 'Simpan' dengan properti name="save" pada baris 162 ditekan
				$code		     	 	 = $row['code'];	
				$masak1		     	 	 = $_POST['masak1'];
				$gosok		     	 = $_POST['gosok'];
				$cuci		     	 = $_POST['cuci'];
				$bersih		     	 = $_POST['bersih'];
				$sayur		     	 = $_POST['sayur'];
				$masak2		     	 = $_POST['masak2'];
				$kecil		     	 = $_POST['kecil'];
				$mobil		     	 = $_POST['mobil'];
				$hewan		     	 = $_POST['hewan'];
				
				$update = mysqli_query($koneksi, "UPDATE mahasiswa SET 
				masak1		= '$masak1', 
				gosok		= '$gosok',
				cuci		= '$cuci',
				bersih		= '$bersih',
				sayur		= '$sayur',
				masak2		= '$masak2',
				kecil		= '$kecil',
				mobil		= '$mobil',
				hewan		= '$hewan'
				
				WHERE code='$code'") or die(mysqli_error()); // query untuk mengupdate nilai entri dalam database
				if($update){ // jika query update berhasil dieksekusi
					header("Location: update-sehari.php?code=".$code."&pesan=sukses"); // tambahkan pesan=sukses pada url
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
		<label class="col-sm-3 control-label">Memasak 3x Sehari</label>    
		<div class="col-sm-2"> 
           <select name="masak1" class="form-control" >
							<option value="<?php echo $row['masak1']; ?>"> <?php echo $row['masak1']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>					
						
		<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Menggosok / Menyetrika</label>    
		<div class="col-sm-2"> 
           <select name="gosok" class="form-control" >
							<option value="<?php echo $row['gosok']; ?>"> <?php echo $row['gosok']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>		
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Cuci Baju</label>    
		<div class="col-sm-2"> 
           <select name="cuci" class="form-control" >
							<option value="<?php echo $row['cuci']; ?>"> <?php echo $row['cuci']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>		
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Bersih - Bersih</label>    
		<div class="col-sm-2"> 
           <select name="bersih" class="form-control" >
							<option value="<?php echo $row['bersih']; ?>"> <?php echo $row['bersih']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>	
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Memberi Sayur</label>    
		<div class="col-sm-2"> 
           <select name="sayur" class="form-control" >
							<option value="<?php echo $row['sayur']; ?>"> <?php echo $row['sayur']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>	
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Masakan Taiwan</label>    
		<div class="col-sm-2"> 
           <select name="masak2" class="form-control" >
							<option value="<?php echo $row['masak2']; ?>"> <?php echo $row['masak2']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>	
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Membuat Makanan Kecil</label>    
		<div class="col-sm-2"> 
           <select name="kecil" class="form-control" >
							<option value="<?php echo $row['kecil']; ?>"> <?php echo $row['kecil']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>	
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Mencuci Mobil</label>    
		<div class="col-sm-2"> 
           <select name="mobil" class="form-control" >
							<option value="<?php echo $row['mobil']; ?>"> <?php echo $row['mobil']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>	
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Memelihara Hewan</label>    
		<div class="col-sm-2"> 
           <select name="hewan" class="form-control" >
							<option value="<?php echo $row['hewan']; ?>"> <?php echo $row['hewan']; ?> </option>
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
