<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
include("dbconn.php");
?>
	<div class="container">
		<div class="content">
		<h2>Data Tenaga Kerja &raquo; Edit Skill Menjaga Bayi / Anak Kecil</h2>
			<hr />
			
			<?php
			$code = $_GET['code']; // assigment nim dengan nilai nim yang akan diedit
			$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); // query untuk memilih entri data dengan nilai nim terpilih
			$row = mysqli_fetch_assoc($sql);
			
			if(isset($_POST['save'])){ // jika tombol 'Simpan' dengan properti name="save" pada baris 162 ditekan
				$code		     	 	 = $row['code'];	
				$lahir		     	 	 = $_POST['lahir'];
				$makan		     	 = $_POST['makan'];
				$popok		     	 = $_POST['popok'];
				$jg_anak		     	 = $_POST['jg_anak'];
				$mandi		     	 = $_POST['mandi'];
				$main		     	 = $_POST['main'];
				
				
				$update = mysqli_query($koneksi, "UPDATE mahasiswa SET 
				lahir		= '$lahir', 
				makan		= '$makan',
				popok		= '$popok',
				jg_anak		= '$jg_anak',
				mandi		= '$mandi',
				main		= '$main'
				
				WHERE code='$code'") or die(mysqli_error()); // query untuk mengupdate nilai entri dalam database
				if($update){ // jika query update berhasil dieksekusi
					header("Location: update-menjaga.php?code=".$code."&pesan=sukses"); // tambahkan pesan=sukses pada url
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
		<label class="col-sm-3 control-label">Membantu Setelah Melahirkan</label>    
		<div class="col-sm-2"> 
           <select name="lahir" class="form-control" >
							<option value="<?php echo $row['lahir']; ?>"> <?php echo $row['lahir']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>					
						
		<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Menyuapi / Memberi Makan</label>    
		<div class="col-sm-2"> 
           <select name="makan" class="form-control" >
							<option value="<?php echo $row['makan']; ?>"> <?php echo $row['makan']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>		
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Mengganti Popok</label>    
		<div class="col-sm-2"> 
           <select name="popok" class="form-control" >
							<option value="<?php echo $row['popok']; ?>"> <?php echo $row['popok']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>		
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Menjaga Anak</label>    
		<div class="col-sm-2"> 
           <select name="jg_anak" class="form-control" >
							<option value="<?php echo $row['jg_anak']; ?>"> <?php echo $row['jg_anak']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>	
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Memandikan Bayi</label>    
		<div class="col-sm-2"> 
           <select name="mandi" class="form-control" >
							<option value="<?php echo $row['mandi']; ?>"> <?php echo $row['mandi']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>	
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Mengajak Bermain Anak</label>    
		<div class="col-sm-2"> 
           <select name="main" class="form-control" >
							<option value="<?php echo $row['main']; ?>"> <?php echo $row['main']; ?> </option>
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
