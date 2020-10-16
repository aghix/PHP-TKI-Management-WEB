<!-- put this at the top of the page --> 



<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>

<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({
        placement : 'top',
        trigger : 'hover'
    });
});
</script>
<style type="text/css">
	.bs-example{
    	margin: 150px 50px;
    }
    .hovereffect {
width:100%;
height:100%;
float:left;
overflow:hidden;
position:relative;
text-align:center;
cursor:default;
}

.hovereffect .overlay {
width:100%;
height:100%;
position:absolute;
overflow:hidden;
top:0;
left:0;
opacity:0;
background-color:rgba(0,0,0,0);
-webkit-transition:all .4s ease-in-out;
transition:all .4s ease-in-out
}

.hovereffect img {
display:block;
position:relative;
-webkit-transition:all .4s linear;
transition:all .4s linear;
}

.hovereffect h2 {

color:#fff;
text-align:center;
position:relative;
font-size:14px;
background:rgba(0,0,0,0.1);
-webkit-transform:translatey(-100px);
-ms-transform:translatey(-100px);
transform:translatey(-100px);
-webkit-transition:all .2s ease-in-out;
transition:all .2s ease-in-out;
padding:7px;
}

.hovereffect a.info {
text-decoration:none;
display:inline-block;
text-transform:uppercase;
color:#fff;
border:1px solid #fff;
background-color:transparent;
opacity:0;
filter:alpha(opacity=0);
-webkit-transition:all .2s ease-in-out;
transition:all .2s ease-in-out;
margin:5px 0 0;
padding:5px 14px;
}

.hovereffect a.info:hover {
box-shadow:0 0 10px #fff;
}

.hovereffect:hover img {
-ms-transform:scale(1.2);
-webkit-transform:scale(1.2);
transform:scale(1.2);
}

.hovereffect:hover .overlay {
opacity:1;
filter:alpha(opacity=100);
}

.hovereffect:hover h2,.hovereffect:hover a.info {
opacity:1;
filter:alpha(opacity=100);
-ms-transform:translatey(0);
-webkit-transform:translatey(0);
transform:translatey(0);
}

.hovereffect:hover a.info {
-webkit-transition-delay:.2s;
transition-delay:.2s;
}
</style>
	<div class="container">
		<div class="content">
			<h2>Data Tenaga Kerja</h2>
			<hr />
			
			
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">			
<div class="row">
  <div class="col-sm-2">
	  <select name="value1" class="form-control" >		  
							<option value="informal"> Informal </option>
							<option value="formal">Formal</option>
							
														
		</select>	</div>
		
  <div class="col-sm-2">
	  <select name="value2" class="form-control" >		  
							
							<option value="">Negara Tujuan </option>
							<option value="Malaysia">Malaysia</option>
							<option value="Taiwan">Taiwan</option>
							<option value="Brunei">Brunei</option>
							<option value="Hongkong">Hongkong</option>
							<option value="South Korea">Korea Selatan</option>							
							<option value="Japan">Japan</option>
							<option value="Singapore">Singapore</option>	
														
		</select>	</div>
  <div class="col-sm-2">
	  <select name="value3" class="form-control" >		  
							<option value=""> -Provinsi Asal- </option>
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
		</select>	</div>
  <div class="col-sm-2">
	  <select name="value4" class="form-control" >								
							<option value=""> -Agama- </option>
							<option value="Moslem">Moslem</option>
							<option value="Christian">Christian</option>
							<option value="Catholic">Catholic</option>
							<option value="Hindu">Hindu</option>
							<option value="Budha">Budha</option>														
		</select>	</div>
  <div class="col-sm-2">
	  <select name="value5" class="form-control" >		  
							<option value=""> -Umur- </option>
							<option value="YEAR(tanggal_lahir) BETWEEN '1992' AND '1999">18-25</option>
							<option value="YEAR(tanggal_lahir) BETWEEN '1987' AND '1992">25-30</option>
							<option value="YEAR(tanggal_lahir) BETWEEN '1982' AND '1987">30-35</option>
							<option value="YEAR(tanggal_lahir) BETWEEN '1977' AND '1982">35-40</option>
							<option value="YEAR(tanggal_lahir) BETWEEN '1972' AND '1977">40-45</option>
														
		</select>	</div>
		
  <div class="col-sm-2"><button name="filter" type="submit" class="btn btn-primary btn-block">filter</button></div>
  
  
</div>
<?php
		$user = $userRow['lvl'];		
			if($user > '3'){	
			$arr6=$_POST['label'];
	echo '
		<div class="row">
		<div class="col-sm-2">		
		<p><select name="label" class="form-control" >
		  
							
							<option value="new" >New</option>
							<option value="valid" >Stock</option>
														
						</select> </div></div>
		';
}else{
	$arr6='new';
}
?>
<br>
				
				
				
</form>			
			
<!--

			<?php
			 if(isset($_GET['aksi']) == 'delete'){ // mengkonfirmasi jika 'aksi' bernilai 'delete' merujuk pada baris 97 dibawah
				 $code = $_GET['code']; // ambil nilai code
				 $cek = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); // query untuk memilih entri dengan nim yang dipilih
				 if(mysqli_num_rows($cek) == 0){ // mengecek jika tidak ada entri nim yang dipilih
					 echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>'; // maka tampilkan 'Data tidak ditemukan.'
				 }else{ // mengecek jika terdapat entri nim yang dipilih
					 $delete = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE code='$code'"); // query untuk menghapus
					 if($delete){ // jika query delete berhasil dieksekusi
						 echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>'; // maka tampilkan 'Data berhasil dihapus.'
					 }else{ // jika query delete gagal dieksekusi
						 echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>'; // maka tampilkan 'Data gagal dihapus.'
					 }
				 }
			 }
			?>
-->

			<!-- bagian ini untuk memfilter data berdasarkan fakultas -->
<!--

			<form class="form-inline" method="get">
				<div class="form-group">
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">Filter Data TKI</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="MIPA" <?php if($filter == 'MIPA'){ echo 'selected'; } ?>>MIPA</option>
						<option value="Pertanian" <?php if($filter == 'Pertanian'){ echo 'selected'; } ?>>Pertanian</option>
                        <option value="Biologi" <?php if($filter == 'Biologi'){ echo 'selected'; } ?>>Biologi</option>
						<option value="Ekonomi" <?php if($filter == 'Ekonomi'){ echo 'selected'; } ?>>Ekonomi</option>
					</select>
				</div>
			</form> <!-- end filter -->


			
					<?php
					
					if(isset($_POST['filter'])){
					$arr1=$_POST['value1'];
					$arr2=$_POST['value2'];
					$arr3=$_POST['value3'];
					$arr4=$_POST['value4'];
					$arr5=$_POST['value5'];
					
					$whereArr = " WHERE ";
					if(!empty($arr1)){ 
						$whereArr .= "formal = '$arr1'";
						}
					if(!empty($arr2)){ 
						$whereArr .= " AND tujuan = '$arr2'";
						} 
					if(!empty($arr3)){ 
						$whereArr .= " AND prov_pos = '$arr3'";
						}
					if(!empty($arr4)){ 
						$whereArr .= " AND agama = '$arr4'";
						} 
					if(!empty($arr6)){ 
						$whereArr .= " AND label = '$arr6'";
						} 		
					if(!empty($arr5)){ 
						$whereArr .= " AND $arr5'";
						}					 
						$query = "SELECT * FROM mahasiswa $whereArr ORDER BY code DESC";
						$sql = mysqli_query($koneksi, "$query"); // query jika filter dipilih 
					
					}else{
						$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE label = 'new'  ORDER BY code DESC"); // jika tidak ada filter maka tampilkan semua entri
					}
										
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					
					
					}else{ // jika terdapat entri maka tampilkan datanya
						$no = 1; // mewakili data dari nomor 1
						
						
						while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							$dob=$row['tanggal_lahir'];
							$diff = (date('Y') - date('Y',strtotime($dob)));	
								$gender = $row['jenis_kelamin']	;
						if ($gender == 'Laki-Laki'){
							$sex = 'M';}else{ $sex = 'F'; }		
							echo '
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
							<div class="hovereffect">
							<img class="img-responsive" src="'.$row['foto'].'" alt="Foto TKI" style="width:275px;height:300px;" alt="">
							<div class="overlay">
							<h2>'.$row['nama'].' </h2>
							<h2>'.$diff.'/'.$sex.'/'.$row['status'].'</h2>
							<h2>'.$row['kab_kec'].' - '.$row['prov_pos'].'</h2>
							<h2>'.$row['tujuan'].' '.$row['ctki'].'</h2>
							<h2>'.$row['pt_sponsor'].'</h2>
							
							<a class="info" href="profile.php?code='.$row['code'].'">Lihat Biodata</a>
							</div>
						</div>
						<p class="text-center"><h4 class="text-center">-----</h4></p>
					</div>
							';
							
						
							
							$no++; // mewakili data kedua dan seterusnya
							
						}
					}
					
					?>
				
	</div> <!-- /.container -->
<?php 
include("footer.php"); // memanggil file footer.php
?>
