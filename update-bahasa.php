<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
include("dbconn.php");
?>
	<div class="container">
		<div class="content">
		<h2>Data Tenaga Kerja &raquo; Edit Kemampuan Berbahasa Asing</h2>
			<hr />
			
			<?php
			$code = $_GET['code']; // assigment nim dengan nilai nim yang akan diedit
			$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); // query untuk memilih entri data dengan nilai nim terpilih
			$row = mysqli_fetch_assoc($sql);
			
			if(isset($_POST['save'])){ // jika tombol 'Simpan' dengan properti name="save" pada baris 162 ditekan
				$code		     	 	 = $row['code'];	
				$bahasa		     	 	 = $_POST['bahasa'];
				$bahasa2		     	 = $_POST['bahasa2'];
				$bahasa3		     	 = $_POST['bahasa3'];
				$bahasa4		     	 = $_POST['bahasa4'];
				$bahasa5		     	 = $_POST['bahasa5'];
				$nilai		     		 = $_POST['nilai'];
				$nilai2		     		 = $_POST['nilai2'];
				$nilai3		     		 = $_POST['nilai3'];
				$nilai4		     		 = $_POST['nilai4'];
				$nilai5		     		 = $_POST['nilai5'];
				
				$update = mysqli_query($koneksi, "UPDATE mahasiswa SET 
				bahasa		= '$bahasa', 
				bahasa2		= '$bahasa2',
				bahasa3		= '$bahasa3',
				bahasa4		= '$bahasa4',
				bahasa5		= '$bahasa5',
				nilai		= '$nilai',
				nilai2		= '$nilai2',
				nilai3		= '$nilai3',
				nilai4		= '$nilai4',		
				nilai5		= '$nilai5'
				WHERE code='$code'") or die(mysqli_error()); // query untuk mengupdate nilai entri dalam database
				if($update){ // jika query update berhasil dieksekusi
					header("Location: update-bahasa.php?code=".$code."&pesan=sukses"); // tambahkan pesan=sukses pada url
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
		<label class="col-sm-3 control-label">Kemampuan Bahasa Asing</label>    
		<div class="col-sm-2"> 
           <select name="bahasa" class="form-control" >
							<option value="<?php echo $row['bahasa']; ?>"> <?php echo $row['bahasa']; ?> </option>
							<option value=""> </option>
							<option value="English">Inggris</option>
							<option value="Mandarin">Mandarin</option>
							<option value="Cantonesse">Canton</option>	
							<option value="Japanesse">Jepang</option>
							<option value="Hangul">Korea</option>						
			</select>      

		</div>		
		<div class="col-sm-2 ">
			<select name="nilai" class="form-control" >
							<option value="<?php echo $row['nilai']; ?>"> <?php echo $row['nilai']; ?> </option>
							<option value=""> </option>
							<option value="Kurang">Kurang</option>
							<option value="Sedang">Sedang</option>
							<option value="Baik">Baik</option>											
						</select>
		</div>
	</div>					
						
				<div class="form-group" value="bahasa2">     	   
		<label class="col-sm-3 control-label">Pilih Jika Lebih dari 1</label>    
		<div class="col-sm-2"> 
           <select name="bahasa2" class="form-control" >
							<option value="<?php echo $row['bahasa2']; ?>"> <?php echo $row['bahasa2']; ?> </option>
							<option value=""> </option>
							<option value="English">Inggris</option>
							<option value="Mandarin">Mandarin</option>
							<option value="Cantonesse">Canton</option>	
							<option value="Japanesse">Jepang</option>
							<option value="Hangul">Korea</option>						
			</select>      
		</div>		
		<div class="col-sm-2 ">
			<select name="nilai2" class="form-control" >
							<option value="<?php echo $row['nilai2']; ?>"> <?php echo $row['nilai2']; ?> </option>
							<option value=""> </option>
							<option value="Kurang">Kurang</option>
							<option value="Sedang">Sedang</option>
							<option value="Baik">Baik</option>							
						</select>
		</div>
	</div>

				<div class="form-group" value="bahasa3">     	   
		<label class="col-sm-3 control-label"></label>    
		<div class="col-sm-2"> 
           <select name="bahasa3" class="form-control" >
							<option value="<?php echo $row['bahasa3']; ?>"> <?php echo $row['bahasa3']; ?> </option>
							<option value=""> </option>
							<option value="English">Inggris</option>
							<option value="Mandarin">Mandarin</option>
							<option value="Cantonesse">Canton</option>	
							<option value="Japanesse">Jepang</option>
							<option value="Hangul">Korea</option>				
			</select>      
		</div>		
		<div class="col-sm-2 ">
			<select name="nilai3" class="form-control" >
							<option value="<?php echo $row['nilai3']; ?>"> <?php echo $row['nilai3']; ?> </option>
							<option value=""> </option>
							<option value="Kurang">Kurang</option>
							<option value="Sedang">Sedang</option>
							<option value="Baik">Baik</option>							
						</select>
		</div>
	</div>

				<div class="form-group" value="bahasa4">     	   
		<label class="col-sm-3 control-label"></label>    
		<div class="col-sm-2"> 
           <select name="bahasa4" class="form-control" >
							<option value="<?php echo $row['bahasa4']; ?>"> <?php echo $row['bahasa4']; ?> </option>
							<option value=""> </option>
							<option value="English">Inggris</option>
							<option value="Mandarin">Mandarin</option>
							<option value="Cantonesse">Canton</option>	
							<option value="Japanesse">Jepang</option>
							<option value="Hangul">Korea</option>					
			</select>      
		</div>		
		<div class="col-sm-2 ">
			<select name="nilai4" class="form-control" >
							<option value="<?php echo $row['nilai4']; ?>"> <?php echo $row['nilai4']; ?> </option>
							<option value=""> </option>
							<option value="Kurang">Kurang</option>
							<option value="Sedang">Sedang</option>
							<option value="Baik">Baik</option>							
						</select>
		</div>
	</div>

				<div class="form-group" value="bahasa5">     	   
		<label class="col-sm-3 control-label"></label>    
		<div class="col-sm-2"> 
           <select name="bahasa5" class="form-control" >
							<option value="<?php echo $row['bahasa5']; ?>"> <?php echo $row['bahasa5']; ?> </option>
							<option value=""> </option>
							<option value="English">Inggris</option>
							<option value="Mandarin">Mandarin</option>
							<option value="Cantonesse">Canton</option>	
							<option value="Japanesse">Jepang</option>
							<option value="Hangul">Korea</option>						
			</select>      
		</div>		
		<div class="col-sm-2 ">
			<select name="nilai5" class="form-control" >
							<option value="<?php echo $row['nilai5']; ?>"> <?php echo $row['nilai5']; ?> </option>
							<option value=""> </option>
							<option value="Kurang">Kurang</option>
							<option value="Sedang">Sedang</option>
							<option value="Baik">Baik</option>							
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
