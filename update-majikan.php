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
				$anjing		     	 	 = $_POST['anjing'];
				$kuat		     	 = $_POST['kuat'];
				$babi		     	 = $_POST['babi'];
				$akong		     	 = $_POST['akong'];
				
				
				$update = mysqli_query($koneksi, "UPDATE mahasiswa SET 
				anjing		= '$anjing', 
				kuat		= '$kuat',
				babi		= '$babi',
				akong		= '$akong'
				
				
				WHERE code='$code'") or die(mysqli_error()); // query untuk mengupdate nilai entri dalam database
				if($update){ // jika query update berhasil dieksekusi
					header("Location: update-majikan.php?code=".$code."&pesan=sukses"); // tambahkan pesan=sukses pada url
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
		<label class="col-sm-3 control-label">Apakah Takut Anjing</label>    
		<div class="col-sm-2"> 
           <select name="anjing" class="form-control" >
							<option value="<?php echo $row['anjing']; ?>"> <?php echo $row['anjing']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>	
	
	<div class="form-group">
					<label class="col-sm-3 control-label">Kuat Gendong brp ... Kg</label>
					<div class="col-sm-2">
						<input type="kuat" name="kuat" class="form-control" <?php echo $row['kuat']; ?> value="<?php echo $row['kuat']; ?>" >
					</div>
				</div>				
						
		<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Apakah Makan Babi</label>    
		<div class="col-sm-2"> 
           <select name="babi" class="form-control" >
							<option value="<?php echo $row['babi']; ?>"> <?php echo $row['babi']; ?> </option>
							<option value=""> </option>
							<option value="yes">yes</option>
							<option value="no">no</option>
													
			</select>      

		</div>		
		
	</div>		
	
	<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Bersedia Memandikan Akong</label>    
		<div class="col-sm-2"> 
           <select name="akong" class="form-control" >
							<option value="<?php echo $row['akong']; ?>"> <?php echo $row['akong']; ?> </option>
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
