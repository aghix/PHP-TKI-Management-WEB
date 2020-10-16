<?php 
ob_start();
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database

?>

<div class="container">
		<div class="content">
		<h2>Data Tenaga Kerja &raquo; List Data PKD</h2>
			<hr />
			
<?php
function integerToRoman($integer)
{
 // Convert the integer into an integer (just to make sure)
 $integer = intval($integer);
 $result = '';
 
 // Create a lookup array that contains all of the Roman numerals.
 $lookup = array(
 'X' => 10,
 'IX' => 9,
 'V' => 5,
 'IV' => 4,
 'I' => 1);
 
 foreach($lookup as $roman => $value){
  // Determine the number of matches
  $matches = intval($integer/$value);
 
  // Add the same number of characters to the string
  $result .= str_repeat($roman,$matches);
 
  // Set the integer to be the remainder of the integer and the value
  $integer = $integer % $value;
 }
 
 // The Roman numeral should be built, return it
 return $result;
}
$result = mysqli_query($koneksi, "SELECT MAX(`no_pkd`) AS comment_id FROM `pkd`");
    					while ($row = mysqli_fetch_assoc($result)) {
        				$no_pkd = $row['comment_id'] +1;        				
        				$min1 = '1';
        				$max1 = '9';
        				$min2 = '10';
						$max2 = '99';						
        				if (($min1 <= $no_pkd) && ($no_pkd <= $max1)){
							$no_pkd_asli = '00'.$no_pkd.'';
							}
						if(($min2 <= $no_pkd) && ($no_pkd <= $max2)){
							$no_pkd_asli = '0'.$no_pkd.'';
							} 
						if($no_pkd > 99){
							$no_pkd_asli = $no_pkd;
							} 							           
            			}
$mnth = date('m');
$rom_mnth = integerToRoman($mnth);
$year = date('Y');
$tgl = date('Y/m/d');
$code = $_GET['code'];
$cs = 'CS';
$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); 
$row = mysqli_fetch_assoc($sql);
$ctki = $row['ctki'];
$user = $userRow['lvl'];
$admin = $userRow['username'];	
$hasil = array ($no_pkd_asli,$cs, $rom_mnth, $year);	
$hasil = 		implode("/",$hasil);	
			
if(isset($_POST['save'])){
$tgl_pkd = date('d/m/Y');
$user = $userRow['username'];
$new = 'new';
$input = mysqli_query ($koneksi, "INSERT INTO pkd (no_pkd, tgl_pkd,user,status) VALUES('$hasil','$tgl_pkd','$user','$new')");
if($input){ // jika query update berhasil dieksekusi
					header("Location: daftar_pkd.php?no_pkd=$hasil");			
					}else{ // jika query insert gagal dieksekusi
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>PKD Gagal Di simpan! </div>'; // maka tampilkan 'Ups, Data Mahasiswa Gagal Di simpan!'
						}	
}			
		
			
			

?>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">			
				
				<div class="row">	
					<div class="col-sm-2">						
				<button name="save" type="submit" onclick="return confirm(\'Konfirmasi Buat PKD Baru\')" value="<?php echo ''.$no_pkd.'/'.integerToRoman($mnth).'/'.$year.''?>" type="button" class="btn btn-primary btn-block">Buat PKD Baru</button></a>
				</div>
				<div class="text-center col-sm-2">
				<a href="main.php"><button name="kembali" type="button" class="btn btn-danger btn-block">Kembali</button></a>
				</div>
				</div>
				</div>
			
				
				
				</p>
				
				
				
				</form>
				
				
  <h2></h2>
	<div class="row">
					<div class="col-sm-3">
						<input type="text" id="datepicker" name="awal" class="input-group  form-control" date="" data-date-format="dd-mm-yyyy" placeholder=" DD-MM-YYYY" value="  -Choose-"required>
					</div>		
					
					<div class="col-sm-3">
						<input type="text" id="datepicker2" name="akhir" class="input-group  form-control" date="" data-date-format="dd-mm-yyyy" placeholder=" DD-MM-YYYY" value="  -Choose-"required>
					</div>
	</div>
				
  <div class=" form-group text-left">
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">	
  <p> <h3>List Data PKD </h3></p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th>No PKD</th>
        <th>Tanggal</th>
        <th>User</th>
        <th>Total</th>
        <th>Status</th>
        
        
             
        </tr>
    </thead>
    <tbody>
      <tr>
        					<?php
        			
					$sql = mysqli_query($koneksi, "SELECT DISTINCT no_pkd, tgl_pkd, user, total, status FROM pkd WHERE no_ctki IS NULL ORDER BY no_pkd DESC"); // jika tidak ada filter maka tampilkan semua entri
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; 
							}else{ 
						$no = 1; 
						while($row2 = mysqli_fetch_assoc($sql)){ 
							$number = $row2['total'];
							$rp = number_format($number);						
							echo '							
								<td><a href="daftar_pkd.php?no_pkd='.$row2['no_pkd'].'">'.$row2['no_pkd'].'</td></a>
								<td>'.$row2['tgl_pkd'].'</td>
								<td>'.$row2['user'].'</td>
								<td>'.$rp.'</td>
								<td>'.$row2['status'].'</td>								
								<td>';								
							echo '
								</td>
								<td>									
									<a href="daftar_pkd.php?no_pkd='.$row2['no_pkd'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								</td>
								</tr>
							';
							$no++; // mewakili data kedua dan seterusnya
						}
					}
					?>
    </tbody>
  </table>
</div>
</form>
</div>
</div>
