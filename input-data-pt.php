<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
			<h2>Data Tenaga Kerja &raquo; Input Nama PT dan Sponsor</h2>
			<hr />
			
			<?php
			if(isset($_POST['input'])){ // jika tombol 'Simpan' dengan properti name="input" pada baris 164 ditekan
				$nm_pt	     = $_POST['pt_sps'];
				$nm_sps		 = $_POST['nm_sps'];
				
			//	$cek = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY code ASC"); // query untuk memilih entri dengan nim terpilih
				$insert = mysqli_query($koneksi, "INSERT INTO nama_pt (nm_pt) VALUES('$nm_pt')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database	
			if($insert){ // jika query insert berhasil dieksekusi
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Nama PT Berhasil Di Simpan. <a href="data.php"><- Kembali</a></div>'; // maka tampilkan 'Data Mahasiswa Berhasil Di Simpan.'
						}else{ // jika query insert gagal dieksekusi
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Nama PT Gagal Di simpan! <a href="data.php"><- Kembali</a></div>'; // maka tampilkan 'Ups, Data Mahasiswa Gagal Di simpan!'
						}
			$insert2 = mysqli_query($koneksi, "INSERT INTO nama_sps (nm_sps) VALUES('$nm_sps')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database	
			if($insert){ // jika query insert berhasil dieksekusi
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Nama Sponsor Berhasil Di Simpan. <a href="input-data-pt.php"><- Kembali</a></div>'; // maka tampilkan 'Data Mahasiswa Berhasil Di Simpan.'
						}else{ // jika query insert gagal dieksekusi
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Nama Sponsor Gagal Di simpan! <a href="input-data-pt.php"><- Kembali</a></div>'; // maka tampilkan 'Ups, Data Mahasiswa Gagal Di simpan!'
						}
					}
?>

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

				<div class="form-group">
					<label class="col-sm-3 control-label">Input Nama PT</label>
				<div class="col-sm-4">
					<input type="text" name="pt_sps" class="form-control" placeholder="Format : PT. Maju Terus Pantang Mundur" >
				</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Input Nama Sponsor</label>
				<div class="col-sm-4">
					<input type="text" name="nm_sps" class="form-control" placeholder="Format : John Smith" >
				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
				<div class="col-sm-3 control-label form-group">
					<button type="submit" class="btn btn-default" name="input">
					<span class="glyphicon glyphicon-plus"></span> &nbsp; Proceed
					</button> 
					<button type="submit" class="btn btn-default" name="btn-signup">
					<span class="glyphicon glyphicon-remove"></span> &nbsp; Kembali
					</button> 
				</div> 
					</div> 
					
					<div class="form-group"></div>
					<div class="form-group"></div>
					<div class="form-group"></div>
					<div class="form-group"></div>
					<div class="form-group">
					<label class="col-sm-3 control-label">Choose</label>
				<div class="col-sm-4">
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">PT Sponsor</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="pt_sps" <?php if($filter == 'pt_sps'){ echo 'selected'; } ?>>PT Sponsor</option>
						<option value="nm_sps" <?php if($filter == 'nm_sps'){ echo 'selected'; } ?>>Nama Sponsor</option>
                       
					</select>
				</div>
				</div>
					
				
				
				
				<div class="row">
				
					 
					<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
						<th>No</th>
						<th>Nama PT</th>
						
						</tr>
				
				
			
			
					<?php
					if($filter){
						$sql = mysqli_query($koneksi, "SELECT * FROM $filter ORDER BY id ASC"); // query jika filter dipilih						
					}else{
						$sql = mysqli_query($koneksi, "SELECT * FROM nama_pt ORDER BY id ASC"); // jika tidak ada filter maka tampilkan semua entri
					}
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ // jika terdapat entri maka tampilkan datanya
						$no = 1; // mewakili data dari nomor 1
						while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							echo '
							<tr>
								<td>'.$no.'</td>
								<td>'.$row['nm_pt'].'</td>
								
								<td>';
								if($row['fakultas'] == 'MIPA'){
									echo '<span class="label label-success">MIPA</span>';
								}
								else if ($row['fakultas'] == 'Pertanian' ){
									echo '<span class="label label-success">Pertanian</span>';
								}
								else if ($row['fakultas'] == 'Biologi' ){
									echo '<span class="label label-success">Biologi</span>';
								}
								else if ($row['fakultas'] == 'Ekonomi' ){
									echo '<span class="label label-success">Ekonomi</span>';
								}
							echo '
								</td>
								<td>
									
									<a href="edit.php?nim='.$row['nim'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
									<a href="index.php?aksi=delete&nim='.$row['nim'].'" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
								</td>
							</tr>
							';
							$no++; // mewakili data kedua dan seterusnya
						}
					}
					?>
				</table>
			</div> <!-- /.table-responsive -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
			<!-- bagian ini untuk memfilter data berdasarkan fakultas -->
			<form class="form-inline" method="get">
				<div class="form-group">
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">Filter Data Mahasiswa</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="MIPA" <?php if($filter == 'MIPA'){ echo 'selected'; } ?>>MIPA</option>
						<option value="Pertanian" <?php if($filter == 'Pertanian'){ echo 'selected'; } ?>>Pertanian</option>
                        <option value="Biologi" <?php if($filter == 'Biologi'){ echo 'selected'; } ?>>Biologi</option>
						<option value="Ekonomi" <?php if($filter == 'Ekonomi'){ echo 'selected'; } ?>>Ekonomi</option>
					</select>
				</div>
			</form> <!-- end filter -->
