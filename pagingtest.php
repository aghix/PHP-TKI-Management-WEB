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
background-color:rgba(0,0,0,0.5);
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
font-size:17px;
background:rgba(0,0,0,0.6);
-webkit-transform:translatey(-100px);
-ms-transform:translatey(-100px);
transform:translatey(-100px);
-webkit-transition:all .2s ease-in-out;
transition:all .2s ease-in-out;
padding:5px;
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
padding:7px 14px;
}

.hovereffect a.info:hover {
box-shadow:0 0 5px #fff;
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
					if($filter){
						$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE fakultas='$filter' ORDER BY code ASC"); // query jika filter dipilih
					}else{
						$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY code ASC"); // jika tidak ada filter maka tampilkan semua entri
					}
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ // jika terdapat entri maka tampilkan datanya
						$no = 1; // mewakili data dari nomor 1
						while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							echo '
							<div class="text-center col-lg-3 col-md-4 col-sm-6 col-xs-12">
							<div class="hovereffect">
							<img class="text-center img-responsive" src="'.$row['foto'].'" alt="Mountain View" style="width:275px;height:300px;" alt="">
							<div class="overlay">
							<h2>'.$row['nama'].'</h2>
							<h2>'.$row['kab_kec'].'</h2>
							<h2>'.$row['prov_pos'].'</h2>
							<h2>'.$row['nm_sponsor'].'</h2>
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
