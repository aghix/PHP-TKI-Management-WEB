<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
			
			
			
			<?php
			$code = $_GET['code']; // mengambil data nim dari nim yang terpilih
			
			$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); // query memilih entri nim pada database
			if(mysqli_num_rows($sql) == 0){
				
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			
			if(isset($_POST['save'])){ // jika tombol 'Simpan' dengan properti name="save" pada baris 162 ditekan
				$code		     = $_POST['code'];
				
				
				$update = mysqli_query($koneksi, "UPDATE mahasiswa SET nama='$nama', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', alamat_asal='$alamat_asal', alamat_sekarang='$alamat_sekarang', no_telepon='$no_telepon', email='$email', dosen_pembimbing='$dosen_pembimbing', jurusan='$jurusan', fakultas='$fakultas' WHERE code='$code'") or die(mysqli_error()); // query untuk mengupdate nilai entri dalam database
				if($update){ // jika query update berhasil dieksekusi
					header("Location: edit.php?code=".$code."&pesan=sukses"); // tambahkan pesan=sukses pada url
				}else{ // jika query update gagal dieksekusi
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>'; // maka tampilkan 'Data gagal disimpan, silahkan coba lagi.'
				}
			}

?>
   <div class="container-fluid bg-3 text-center">    
  <h3 class="margin">Update Kelengkapan Document</h3><br>
  <div class="row">
    <div class="col-sm-4">
      <p>Kartu Tanda Penduduk</p>
      <img src="<?php echo $row['ktp']; ?>" class="img-responsive margin" style="width:500px;height:300px;" alt="">
      <p></p>
      <br>
      <p>Update Kartu Tanda Penduduk
      <input name="image" type="file" class="file" > 
      </p>
      <p class="text-center">
			<a href="update-document.php?code=<?php echo $row['code']; ?>"> </a><button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
					<span class="glyphicon glyphicon-log-in"></span> &nbsp; Update
						</button> 
		</p>
      <br>
      <br>
      <br>
      <br>
    </div>
    <div class="col-sm-4"> 
      <p>Akta Kelahiran / Surat Kenal Lahir</p>
      <img src="<?php echo $row['akta_lahir']; ?>" class="img-responsive margin" style="width:500px;height:300px;" alt="">
	  <p></p>
      <br>
      <p>Update Akta Kelahiran
      <input name="image" type="file" class="file" > 
      </p>
      <p class="text-center">
			<a href="update-document.php?code=<?php echo $row['code']; ?>"> </a><button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
					<span class="glyphicon glyphicon-log-in"></span> &nbsp; Update
						</button> 
		</p>
      <br>
      <br>
      <br>
      <br>
    </div>
    <div class="col-sm-4"> 
      <p>Kartu Keluarga</p>
      <img src="<?php echo $row['kk']; ?>" class="img-responsive margin" style="width:500px;height:300px;" alt="">
	  <p></p>
      <br>
      <p>Update Kartu Keluarga
      <input name="image" type="file" class="file" > 
      </p>
      <p class="text-center">
			<a href="update-document.php?code=<?php echo $row['code']; ?>"> </a><button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
					<span class="glyphicon glyphicon-log-in"></span> &nbsp; Update
						</button> 
		</p>
      <br>
      <br>
      <br>
      <br>
    </div>
  </div>
</div>


<?php 
include("footer.php"); // memanggil file footer.php
?>

</body>
</html>
