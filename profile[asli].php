<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
			<h2>Data Tenaga Kerja &raquo; Biodata</h2>
			<hr />
			
			<?php
			$code = $_GET['code']; // mengambil data nim dari nim yang terpilih
			
			$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); // query memilih entri nim pada database
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			
			if(isset($_GET['aksi']) == 'delete'){ // jika tombol 'Hapus Data' pada baris 87 ditekan
				$delete = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE code='$code'"); // query delete entri dengan nim terpilih
				if($delete){ // jika query delete berhasil dieksekusi
					echo '<div class="alert alert-danger alert-dismissable">><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil dihapus.</div>'; // maka tampilkan 'Data berhasil dihapus.'
				}else{ // jika query delete gagal dieksekusi
				echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal dihapus.</div>'; // maka tampilkan 'Data gagal dihapus.'
				}
			}
			?>
			<!-- bagian ini digunakan untuk menampilkan data mahasiswa -->
			<table class="table table-striped table-condensed">
				<tr>
					<th width="20%"><img src="<?php echo $row['foto']; ?>" alt="Mountain View" style="width:304px;height:400px;"></th>
					<td></td>
				</tr>
				
				<tr>
					<th width="20%">ID :</th>
					<td><?php echo $row['code']; ?></td>
				</tr>

				<tr>
					<th width="20%">Tanggal Daftar </th>
					<td><?php echo $row['tgl_daftar']; ?></td>
				</tr>
	
				<tr>
					<th>Nama Sponsor </th>
					<td><?php echo $row['nm_sponsor']; ?></td>
				</tr>

				<tr>
					<th>PT </th>
					<td><?php echo $row['pt_sponsor']; ?></td>
				</tr>
				
				<tr>
					<th width="20%">Negara Tujuan :</th>
					<td><?php echo $row['tujuan']; ?></td>
				</tr>
				
				<tr>
					<th width="20%">Jenis Pekerjaan :</th>
					<td><?php echo $row['formal']; ?></td>
				</tr>



				

				<tr>
					<th></th>
					<td>---------------------</td>
				</tr>
				<tr>
					<th>Nama Lengkap Tenaga Kerja</th>
					<td><?php echo $row['nama']; ?></td>
				</tr>
				<tr>
					<th>Alamat </th>
					<td><?php echo $row['alamat_rtrw']; ?></td>
				</tr>
				<tr>
					<th> </th>
					<td><?php echo $row['kab_kec']; ?></td>
				</tr>
				<tr>
					<th> </th>
					<td><?php echo $row['prov_pos']; ?></td>
				</tr>

				<tr>
					<th>Jenis Kelamin</th>
					<td><?php echo $row['jenis_kelamin']; ?></td>
				</tr>

				<tr>
					<th>Tempat & Tanggal Lahir</th>
					<td><?php echo $row['tempat_lahir'].', '.$row['tanggal_lahir']; ?></td>
				</tr>
				<tr>
					<th>Umur</th>
					<td><?php echo $row['umur']; ?> Thn</td>
				</tr>
				<tr>
					<th>Agama</th>
					<td><?php echo $row['agama']; ?></td>
				</tr>

				<tr>
					<th>Berat Badan</th>
					<td><?php echo $row['b_badan']; ?> Kg</td>
				</tr>

				<tr>
					<th>Tinggi Badan</th>
					<td><?php echo $row['t_badan']; ?> Cm</td>
				</tr>

				<tr>
					<th>Status</th>
					<td><?php echo $row['status']; ?></td>
				</tr>
				<tr>
					<th>Anak</th>
					<td><?php echo $row['anak']; ?></td>
				</tr>
				<tr>
					<th>Saudara</th>
					<td><?php echo $row['sdr']; ?></td>
				</tr>
				<tr>
					<th>Urutan</th>
					<td><?php echo $row['urutan']; ?></td>
				</tr>

				<tr>
					<th>Bahasa Yang Dikuasai</th>
					<td><?php echo $row['bahasa']; ?> <b>Nilai :</b> <?php echo $row['nilai']; ?></td>
				</tr>

				<tr>
					<th></th>
					<td><?php echo $row['bahasa2']; ?> <b>Nilai :</b> <?php echo $row['nilai2']; ?></td>
				</tr>

				<tr>
					<th></th>
					<td><?php echo $row['bahasa3']; ?> <b>Nilai :</b> <?php echo $row['nilai3']; ?></td>
				</tr>

				<tr>
					<th></th>
					<td><?php echo $row['bahasa4']; ?> <b>Nilai :</b> <?php echo $row['nilai4']; ?></td>
				</tr>

				<tr>
					<th></th>
					<td><?php echo $row['bahasa5']; ?> <b>Nilai :</b> <?php echo $row['nilai5']; ?></td>
				</tr>

				<tr>
					<th>No Telepon</th>
					<td><?php echo $row['no_telepon']; ?></td>
				</tr>
				<tr>
					<th>Email</th>
					<td><?php echo $row['email']; ?></td>
				</tr>
				
				<tr>
					<th></th>
					<td>---------------------</td>
				</tr>
				






				<tr>
					<th></th>
					<td>---------------------</td>
				</tr>
				
				<tr>
					<th></th>
					<td>---------------------</td>
				</tr>
				
				<tr>
					<th>Pengalaman Kerja</th>
					<td>------------ Terlampir Dibawah Ini ------------</td>
				</tr>
				<tr>
					<th>Menjaga / Merawat Orang Sakit:</th>
					<td><b>Re Check Up : </b><?php echo $row['cekup']; ?>    
						<p style="text-indent: 5em;"> </p> <b>Menyuapi/Memandikan : </b><?php echo $row['suap']; ?>
						<p style="text-indent: 5em;"> </p> <b>Sedot Dahak : </b><?php echo $row['sedot']; ?>
						<p style="text-indent: 5em;"> </p> <b>Menyuntik Pasien : </b><?php echo $row['suntik']; ?>
						<p style="text-indent: 5em;"> </p> <b>Memijat/Menemani Pasien : </b><?php echo $row['pijit']; ?>
						<p style="text-indent: 5em;"> </p> <b>Membantu Buang Air Besar/Kecil : </b><?php echo $row['buang']; ?>
					</td>
				</tr>
				<tr>
					<th>Menjaga Bayi / Anak Kecil :</th>
					<td><b>Membantu Setelah Melahirkan : </b><?php echo $row['lahir']; ?>    
						<p style="text-indent: 5em;"> </p> <b>Menyuapi/Memberi Makan : </b><?php echo $row['makan']; ?>
						<p style="text-indent: 5em;"> </p> <b>Mengganti Popok : </b><?php echo $row['popok']; ?>
						<p style="text-indent: 5em;"> </p> <b>Menjaga Anak : </b><?php echo $row['jg_anak']; ?>
						<p style="text-indent: 5em;"> </p> <b>Memandikan Bayi / Anak Kecil : </b><?php echo $row['mandi']; ?>
						<p style="text-indent: 5em;"> </p> <b>Mengajak Bermain Anak : </b><?php echo $row['main']; ?>
					</td>
				</tr>
				<tr>
					<th>Pekerjaan Sehari - hari:</th>
					<td><b>Masak 3x Sehari : </b><?php echo $row['masak1']; ?>    
						<p style="text-indent: 5em;"> </p> <b>Menggosok / Setrika : </b><?php echo $row['gosok']; ?>
						<p style="text-indent: 5em;"> </p> <b>Cuci Baju : </b><?php echo $row['cuci']; ?>
						<p style="text-indent: 5em;"> </p> <b>Bersih - bersih : </b><?php echo $row['bersih']; ?>
						<p style="text-indent: 5em;"> </p> <b>Membeli Sayur : </b><?php echo $row['sayur']; ?>
						<p style="text-indent: 5em;"> </p> <b>Masakan Taiwan : </b><?php echo $row['masak2']; ?>
						<p style="text-indent: 5em;"> </p> <b>Membuat Makanan Kecil : </b><?php echo $row['kecil']; ?>
						<p style="text-indent: 5em;"> </p> <b>Mencuci Mobil : </b><?php echo $row['mobil']; ?>
						<p style="text-indent: 5em;"> </p> <b>Memelihara Hewan : </b><?php echo $row['hewan']; ?>
					</td>
				</tr>
				<tr>
					<th>Menyesuaikan Diri Dengan Kondisi majikan:</th>
					<td>   
						<p style="text-indent: 5em;"> </p> <b>Apakah Takut Anjing : </b><?php echo $row['anjing']; ?>
						<p style="text-indent: 5em;"> </p> <b>Kuat Gendong :  </b><?php echo $row['kuat']; ?> &emsp; Kg
						<p style="text-indent: 5em;"> </p> <b>Apakah Makan Babi : </b><?php echo $row['babi']; ?>
						<p style="text-indent: 5em;"> </p> <b>Bersedia Mandiin Akong : </b><?php echo $row['akong']; ?>
					</td>
				</tr>
				<tr>
					<th>Luar Negeri:</th>
					<td><b>Negara : </b><?php echo $row['negara']; ?>    
						<p style="text-indent: 5em;"> </p> <b>Waktu : </b><?php echo $row['waktu']; ?>
						<p style="text-indent: 5em;"> </p> <b>Pekerjaan :  </b><?php echo $row['kerja']; ?>
						
					</td>
				</tr>
				
				
			</table>
			
			<a href="data.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Kembali</a>
			<a href="edit.php?code=<?php echo $row['code']; ?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Data</a>
	<!--		<a href="profile.php?aksi=delete&code=<?php echo $row['code']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin akan mengahapus data <?php echo $row['nama']; ?>')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Hapus Data</a> -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php 
include("footer.php"); // memanggil file footer.php
?>
