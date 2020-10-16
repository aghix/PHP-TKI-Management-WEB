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
				$negara		     	 	 = $_POST['negara'];
				$waktu		     	 = $_POST['waktu'];
				$kerja		     	 = $_POST['kerja'];
				
				
				
				$update = mysqli_query($koneksi, "UPDATE mahasiswa SET 
				negara		= '$negara', 
				waktu		= '$waktu',
				kerja		= '$kerja'
				
				
				
				WHERE code='$code'") or die(mysqli_error()); // query untuk mengupdate nilai entri dalam database
				if($update){ // jika query update berhasil dieksekusi
					header("Location: update-luar.php?code=".$code."&pesan=sukses"); // tambahkan pesan=sukses pada url
				}else{ // jika query update gagal dieksekusi
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>'; // maka tampilkan 'Data gagal disimpan, silahkan coba lagi.'
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){ // jika terdapat pesan=sukses sebagai bagian dari berhasilnya query update dieksekusi
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan. <a href="profile.php?code='.$code.'"><- Kembali</a></div>'; // maka tampilkan 'Data berhasil disimpan.'
			}
		
	?>		
	
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">	
	
	<div class="form-group">
					<label class="col-sm-3 control-label">Negara</label>
					<div class="col-sm-3">
						<input type="text" name="negara" class="form-control" placeholder="<?php echo $row['negara']; ?>" value="<?php echo $row['negara']; ?>" >
					</div>
				</div>
	
	<div class="form-group">
					<label class="col-sm-3 control-label">Masa Kerja (tahun - tahun)</label>
					<div class="col-sm-3">
						<input type="text" name="waktu" class="form-control" placeholder="<?php echo $row['waktu']; ?>" value="<?php echo $row['waktu']; ?>" >
					</div>
				</div>
	
	<div class="form-group">
					<label class="col-sm-3 control-label">Job Desk</label>
					<div class="col-sm-3">
						<input type="text" name="kerja" class="form-control" placeholder="<?php echo $row['kerja']; ?>" value="<?php echo $row['kerja']; ?>" >
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
