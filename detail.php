<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
			<h2>Data Mahasiswa &raquo; Edit Data</h2>
			<hr />
			
			<?php
			$code = $_GET['code']; // assigment nim dengan nilai nim yang akan diedit
			$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); // query untuk memilih entri data dengan nilai nim terpilih
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){ // jika tombol 'Simpan' dengan properti name="save" pada baris 162 ditekan
				$code		     = $_POST['code'];
				$nama		     = $_POST['nama'];
				$jenis_kelamin   = $_POST['jenis_kelamin'];
				$tempat_lahir	 = $_POST['tempat_lahir'];
				$tanggal_lahir	 = $_POST['tanggal_lahir'];
				$alamat_asal     = $_POST['alamat_asal'];
				$alamat_sekarang = $_POST['alamat_sekarang'];
				$no_telepon		 = $_POST['no_telepon'];
				$email  		 = $_POST['email'];
				$dosen_pembimbing = $_POST['dosen_pembimbing'];
				$jurusan	     = $_POST['jurusan'];
				$fakultas	     = $_POST['fakultas'];
				
				$update = mysqli_query($koneksi, "UPDATE mahasiswa SET nama='$nama', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', alamat_asal='$alamat_asal', alamat_sekarang='$alamat_sekarang', no_telepon='$no_telepon', email='$email', dosen_pembimbing='$dosen_pembimbing', jurusan='$jurusan', fakultas='$fakultas' WHERE code='$code'") or die(mysqli_error()); // query untuk mengupdate nilai entri dalam database
				if($update){ // jika query update berhasil dieksekusi
					header("Location: edit.php?code=".$code."&pesan=sukses"); // tambahkan pesan=sukses pada url
				}else{ // jika query update gagal dieksekusi
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>'; // maka tampilkan 'Data gagal disimpan, silahkan coba lagi.'
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){ // jika terdapat pesan=sukses sebagai bagian dari berhasilnya query update dieksekusi
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan. <a href="data.php"><- Kembali</a></div>'; // maka tampilkan 'Data berhasil disimpan.'
			}
			?>
			<!-- bagian ini merupakan bagian form untuk mengupdate data yang akan dimasukkan ke database -->
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">code</label>
					<div class="col-sm-2">
						<input type="text" name="code" value="<?php echo $row ['code']; ?>" class="form-control" placeholder="Code" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama</label>
					<div class="col-sm-4">
						<input type="text" name="nama" value="<?php echo $row ['nama']; ?>" class="form-control" placeholder="Nama" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Jenis Kelamin</label>
					<div class="col-sm-4">
						<input type="text" name="jenis_kelamin" value="<?php echo $row ['jenis_kelamin']; ?>" class="form-control" placeholder="Jenis Kelamin" required>
					</div>
				</div>









				<!-- <div class="form-group">
					<label class="col-sm-3 control-label">Jenis Kelamin</label>
					<div class="col-sm-2">
						<select name="jenis_kelamin" class="form-control" required>
							<option value=""> - Jenis Kelamin - </option>
							<option value="Laki-Laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
				</div> -->
				<div class="form-group">
					<label class="col-sm-3 control-label">Tempat Lahir</label>
					<div class="col-sm-4">
						<input type="text" name="tempat_lahir" value="<?php echo $row ['tempat_lahir']; ?>" class="form-control" placeholder="Tempat Lahir" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal Lahir</label>
					<div class="col-sm-4">
						<input type="text" name="tanggal_lahir" value="<?php echo $row ['tanggal_lahir']; ?>" class="input-group datepicker form-control" date="" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat Asal</label>
					<div class="col-sm-3">
						<textarea name="alamat_asal" class="form-control" placeholder="Alamat Asal"><?php echo $row ['alamat_asal']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat Sekarang</label>
					<div class="col-sm-3">
						<textarea name="alamat_sekarang" class="form-control" placeholder="Alamat Sekarang"><?php echo $row ['alamat_sekarang']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">No Telepon</label>
					<div class="col-sm-3">
						<input type="text" name="no_telepon" value="<?php echo $row ['no_telepon']; ?>" class="form-control" placeholder="No Telepon" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Email</label>
					<div class="col-sm-3">
						<input type="email" name="email" value="<?php echo $row ['email']; ?>" class="form-control" placeholder="Email" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Dosen Pembimbing</label>
					<div class="col-sm-4">
						<input type="text" name="dosen_pembimbing" value="<?php echo $row ['dosen_pembimbing']; ?>" class="form-control" placeholder="Dosen Pembimbing" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Jurusan</label>
					<div class="col-sm-4">
						<input type="text" name="jurusan" value="<?php echo $row ['jurusan']; ?>" class="form-control" placeholder="Jurusan" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Fakultas</label>
					<div class="col-sm-4">
						<input type="text" name="fakultas" value="<?php echo $row ['fakultas']; ?>" class="form-control" placeholder="Fakultas" required>
					</div>
				</div>


		

			<!--	<div class="form-group">
					<label class="col-sm-3 control-label">Jurusan</label>
					<div class="col-sm-2">
						<select name="jurusan" class="form-control" required>
							<option value=""> - Jurusan Terbaru - </option>
							<option value="Matematika">Matematika</option>
							<option value="Kimia">Kimia</option>
							<option value="Fisika">Fisika</option>
							<option value="Biologi">Biologi</option>
                            <option value="Agroteknologi">Agroteknologi</option>
							<option value="Agribisnis">Agribisnis</option>
							<option value="Ilmu & Teknologi Pangan">Ilmu & Teknologi Pangan</option>
							<option value="Teknik Pertanian">Teknik Pertanian</option>
							<option value="Biologi">Biologi</option>							
							<option value="Ekonomi">Ekonomi</option>
							<option value="Bisnis">Bisnis</option>
						</select>
					</div> 
                    <div class="col-sm-3">
                    <b>Jurusan Sekarang :</b> <span class="label label-success"><?php echo $row['jurusan']; ?></span>
				    </div>
				</div> 
				<div class="form-group">
					<label class="col-sm-3 control-label">Fakultas</label>
					<div class="col-sm-2">
						<select name="fakultas" class="form-control" required>
							<option value=""> - Fakultas Terbaru - </option>
							<option value="MIPA">MIPA</option>
							<option value="Pertanian">Pertanian</option>
							<option value="Biologi">Biologi</option>
							<option value="Ekonomi">Ekonomi</option>
						</select>
					</div>
                    <div class="col-sm-3">
                    <b>Fakultas Sekarang :</b> <span class="label label-success"><?php echo $row['fakultas']; ?></span>
				    </div>
				</div>
				<!-- <div class="form-group">
					<label class="col-sm-3 control-label">Username</label>
					<div class="col-sm-2">
						<input type="text" name="username" value="<?php //echo $row['username']; ?>" class="form-control" placeholder="Username">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-2">
						<input type="password" name="pass1" value="<?php //echo $row['password']; ?>" class="form-control" placeholder="Password">
					</div>
				</div> -->
				<div class="form-group"> 
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6"> 
				<!--		<input type="submit" name="save" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data Mahasiswa"> -->
						<a href="data.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Kembali">Kembali</a>
					</div>
				</div>
			</form>
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php 
include("footer.php"); // memanggil file footer.php
?>
