<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
include("dbconn.php");


?>

	<div class="container">
		<div class="content">
		<h2>Data Tenaga Kerja &raquo; Edit Biodata</h2>
			<hr />
			
			<?php
			$code = $_GET['code']; // assigment nim dengan nilai nim yang akan diedit
			$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); // query untuk memilih entri data dengan nilai nim terpilih
			$row = mysqli_fetch_assoc($sql);
			
			
			if(isset($_POST['save'])){ // jika tombol 'Simpan' dengan properti name="save" pada baris 162 ditekan
				$code		     = $row['code'];	
				$nm_sponsor		     = $_POST['nm_sponsor'];
				$pt_sponsor		     = $_POST['pt_sponsor'];
				$tgl_daftar		     = $_POST['tgl_daftar'];
				$tujuan			     = $_POST['tujuan'];
				$formal			     = $_POST['formal'];
				$nama			     = $_POST['nama'];
				$alamat_rtrw	     = $_POST['alamat_rtrw'];
				$kab_kec		     = $_POST['kab_kec'];
				$prov_pos		     = $_POST['prov_pos'];
				$jenis_kelamin	     = $_POST['jenis_kelamin'];
				$tempat_lahir	     = $_POST['tempat_lahir'];
				$tanggal_lahir    	 = $_POST['tanggal_lahir'];				
				$agama			     = $_POST['agama'];
				$b_badan		     = $_POST['b_badan'];
				$t_badan		     = $_POST['t_badan'];
				$status			     = $_POST['status'];
				$anak			     = $_POST['anak'];
				$sdr			     = $_POST['sdr'];
				$urutan			     = $_POST['urutan'];
				$no_telepon		     = $_POST['no_telepon'];
				$email			     = $_POST['email'];
				$pt_code			 = $_POST['pt_code'];
				$ctki				 = $_POST['ctki'];
				$pend				 = $_POST['pendidikan'];
				
				$update = mysqli_query($koneksi, "UPDATE mahasiswa SET 
				nm_sponsor	= '$nm_sponsor', 
				pt_sponsor	= '$pt_sponsor',
				tujuan		= '$tujuan',
				tgl_daftar	= '$tgl_daftar',
				formal		= '$formal',
				nama		= '$nama',
				alamat_rtrw	= '$alamat_rtrw',
				kab_kec		= '$kab_kec',
				prov_pos	= '$prov_pos',
				jenis_kelamin= '$jenis_kelamin',
				tempat_lahir= '$tempat_lahir',
				tanggal_lahir= '$tanggal_lahir',
				agama		= '$agama',
				b_badan		= '$b_badan',
				t_badan		= '$t_badan',
				status		= '$status',
				anak		= '$anak',
				sdr			= '$sdr',
				urutan		= '$urutan',
				no_telepon	= '$no_telepon',				
				email		= '$email',
				pt_code		= '$pt_code',
				ctki		= '$ctki',
				pend		= '$pend'
				
				WHERE code='$code'") or die(mysqli_error()); // query untuk mengupdate nilai entri dalam database
				if($update){ // jika query update berhasil dieksekusi
					header("Location: update-biodata.php?code=".$code."&pesan=sukses"); // tambahkan pesan=sukses pada url
				}else{ // jika query update gagal dieksekusi
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>'; // maka tampilkan 'Data gagal disimpan, silahkan coba lagi.'
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){ // jika terdapat pesan=sukses sebagai bagian dari berhasilnya query update dieksekusi
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan. <a href="profile.php?code='.$code.'"><- Kembali</a></div>'; // maka tampilkan 'Data berhasil disimpan.'
			}
		
	?>		
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
	
<!--
	<div class="form-group">
					<label class="col-sm-3 control-label">CTKI</label>
					<div class="col-sm-3">
						<input type="text" name="ctki" class=" form-control" placeholder="<?php //echo $row['ctki']; ?>" value="<?php //echo $row['ctki']; ?>" >
					
						</input>
					</div>
				</div>
-->

	<div class="form-group">
					<label class="col-sm-3 control-label">ID</label>
					<div class="col-sm-2">
						<label class="control-label" >
					<?php echo $row['code']; ?>
						</label>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal Daftar</label>
					<div class="col-sm-3">
						<input type="text" name="tgl_daftar" class="form-control" placeholder="<?php echo $row['tgl_daftar']; ?>" value="<?php echo $row['tgl_daftar']; ?>" > 
				
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Code Biodata</label>
					<div class="col-sm-3">
						<input type="text" name="pt_code" class="form-control" placeholder="<?php echo $row['pt_code']; ?>" value="<?php echo $row['pt_code']; ?>">
					</div>
					</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama PT</label>
					<div class="col-sm-3">
						<select name="pt_sponsor" class="form-control" >
							<option value="<?php echo $row['pt_sponsor']; ?>"> <?php echo $row['pt_sponsor']; ?> </option>
							
								<?php
								include("dbconn.php");
								$result = $DBcon->query("SELECT * FROM nama_pt ORDER BY id ASC");
    							while ($baris = $result->fetch_assoc()) {

									unset($name);
									$name = $baris['nm_pt']; 
										echo '                  
										<option value="'.$name.'">'.$name.'</option>                         
										';
									}
							$DBcon->close();
							?>						
						</select>
					</div>
				</div>
				
					
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Sponsor</label>
					<div class="col-sm-3">
						<select name="nm_sponsor" class="form-control" >
							<option value="<?php echo $row['nm_sponsor']; ?>"> <?php echo $row['nm_sponsor']; ?> </option>
							<?php
								include("dbconn.php");
								$result = $DBcon->query("SELECT * FROM nama_sps ORDER BY id ASC");
    							while ($baris = $result->fetch_assoc()) {

									unset($name);
									$name = $baris['nm_sps']; 
										echo '                  
										<option value="'.$name.'">'.$name.'</option>                         
										';
									}
							$DBcon->close();
							?>										
						</select>
					</div>
				</div>	
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Negara Tujuan</label>
					<div class="col-sm-3">
						<select name="tujuan" class="form-control" >
							<option value="<?php echo $row['tujuan']; ?>"> <?php echo $row['tujuan']; ?> </option>
							<option value="Malaysia">Malaysia</option>
							<option value="Taiwan">Taiwan</option>
							<option value="Brunei">Brunei</option>
							<option value="Hongkong">Hongkong</option>
							<option value="South Korea">Korea Selatan</option>							
							<option value="Japan">Japan</option>
							<option value="Singapore">Singapore</option>							
						</select>
					</div>
				</div>	
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Pekerjaan</label>
					<div class="col-sm-3">
						<select name="formal" class="form-control" >
							<option value="<?php echo $row['formal']; ?>"> <?php echo $row['formal']; ?> </option>
							<option value="Formal">Formal</option>
							<option value="Informal">Informal</option>							
						</select>
					</div>
				</div>
				
				<div class="form-group"></div>
				<div class="form-group"></div>


				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Lengkap Tenaga Kerja</label>
					<div class="col-sm-3">
						<input type="text" name="nama" class="form-control" placeholder="<?php echo $row['nama']; ?>" value="<?php echo $row['nama']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat</label>
					<div class="col-sm-3">
						<input type="text" name="alamat_rtrw" class="form-control" placeholder="<?php echo $row['alamat_rtrw']; ?>" value="<?php echo $row['alamat_rtrw']; ?>">
					</div>
					</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Kec/Kab</label>
					<div class="col-sm-3">
						<input type="text" name="kab_kec" class="form-control" placeholder="<?php echo $row['kab_kec']; ?>" value="<?php echo $row['kab_kec']; ?>" >
					</div>
					</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Provinsi/Kodepos</label>
					<div class="col-sm-3">
						<select name="prov_pos" class="form-control" >		  
							<option value="<?php echo $row['prov_pos']; ?>"> <?php echo $row['prov_pos']; ?> </option>
							<option value="Jawa Barat">Jawa Barat</option>
							<option value="Jawa Tengah">Jawa Tengah</option>
							<option value="Jawa Timur">Jawa Timur</option>
							<option value="DKI Jakarta">DKI Jakarta</option>
							<option value="Banten">Banten</option>
							<option value="Yogyakarta">DI Yogyakarta</option>
							<option value="Nusa Tenggara Timur">Nusa Tenggara Barat</option>
							<option value="Nusa Tenggara Barat">Nusa Tenggara Timur</option>
							<option value="Kalimantan Timur">Kalimatan Timur</option>
							<option value="Kalimantan Barat">Kalimantan Barat</option>								
		</select>	
		</div>
					</div>
					
					
					<div class="form-group"></div>
					<div class="form-group"></div>
				

				<div class="form-group">
					<label class="col-sm-3 control-label">Jenis Kelamin</label>
					<div class="col-sm-3">
						<select name="jenis_kelamin" class="form-control" >
							<option value="<?php echo $row['jenis_kelamin']; ?>"> <?php echo $row['jenis_kelamin']; ?> </option>
							<option value="Laki-Laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tempat Lahir</label>
					<div class="col-sm-3">
						<input id= type="text" name="tempat_lahir" class="form-control" placeholder="<?php echo $row['tempat_lahir']; ?>" value="<?php echo $row['tempat_lahir']; ?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal Lahir</label>
					<div class="col-sm-3">
						<input type="text" id="datepicker" name="tanggal_lahir" class="input-group form-control" date="" data-date-format="dd-mm-yyyy" placeholder="
						<?php echo $row['tanggal_lahir']; ?>" value="<?php echo $row['tanggal_lahir']; ?>">
						
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Agama</label>
					<div class="col-sm-3">
						<select name="agama" class="form-control" >
							<option value="<?php echo $row['agama']; ?>"> <?php echo $row['agama']; ?> </option>
							<option value="Moslem">Moslem</option>
							<option value="Christian">Christian</option>
							<option value="Catholic">Catholic</option>
							<option value="Hindu">Hindu</option>
							<option value="Budha">Budha</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Berat Badan</label>
					<div class="col-sm-3">
						<input type="text" name="b_badan" class="form-control" placeholder="<?php echo $row['b_badan']; ?>" value="<?php echo $row['b_badan']; ?>" > 
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Tinggi Badan</label>
					<div class="col-sm-3">
						<input type="text" name="t_badan" class="form-control" placeholder="<?php echo $row['t_badan']; ?>" value="<?php echo $row['t_badan']; ?>" > 
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Pendidikan Terakhir</label>
					<div class="col-sm-3">
						<select name="pendidikan" class="form-control" required>
							<option value="<?php echo $row['pend']; ?>"> <?php echo $row['pend']; ?> </option>
							<option value="Elementary School">Sekolah Dasar</option>
							<option value="Junior High School">Sekolah Menengah Pertama</option>
							<option value="Senior High School">Sekolah Menengah Atas</option>	
							<option value="Coledge University">Sarjana</option>							
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Status</label>
					<div class="col-sm-3">
						<select name="status" class="form-control" >
							<option value="<?php echo $row['status']; ?>"> <?php echo $row['status']; ?> </option>
							<option value="kawin">Kawin</option>
							<option value="single">Single</option>
							<option value="cerai">Cerai</option>							
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Jumlah Anak</label>
					<div class="col-sm-3">
						<input type="text" name="anak" class="form-control" placeholder="<?php echo $row['anak']; ?>" value="<?php echo $row['anak']; ?>" > 
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Jumlah Saudara</label>
					<div class="col-sm-3">
						<input type="text" name="sdr" class="form-control" placeholder="<?php echo $row['sdr']; ?>" value="<?php echo $row['sdr']; ?>" > 
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Anak Ke</label>
					<div class="col-sm-3">
						<input type="text" name="urutan" class="form-control" placeholder="<?php echo $row['urutan']; ?>" value="<?php echo $row['urutan']; ?>" > 
					</div>
				</div>
				
				<div class="form-group"></div>
				<div class="form-group"></div>
				
				
				<div class="form-group">
					<label class="col-sm-3 control-label">No Telepon</label>
					<div class="col-sm-3">
						<input type="text" name="no_telepon" class="form-control" placeholder="<?php echo $row['no_telepon']; ?>" value="<?php echo $row['no_telepon']; ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Email</label>
					<div class="col-sm-3">
						<input type="email" name="email" class="form-control" placeholder="<?php echo $row['email']; ?>" value="<?php echo $row['email']; ?>" >
					</div>
				</div>
				
				
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
