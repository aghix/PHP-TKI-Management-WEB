<?php 
ob_start();
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<div class="container">
		<div class="content">
		<h2>Data Tenaga Kerja &raquo; Invoice</h2>
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
$result = mysqli_query($koneksi, "SELECT MAX(`id_inv`) AS comment_id FROM `invoice`");
    					while ($row = mysqli_fetch_assoc($result)) {
        				$no_inv = $row['comment_id'] +1;        				
        				$min1 = '1';
        				$max1 = '9';
        				$min2 = '10';
						$max2 = '99';						
        				if (($min1 <= $no_inv) && ($no_inv <= $max1)){
							$no_inv_asli = '00'.$no_inv.'';
							}
						if(($min2 <= $no_inv) && ($no_inv <= $max2)){
							$no_inv_asli = '0'.$no_inv.'';
							} 
						if($no_inv > 99){
							$no_inv_asli = $no_inv;
							} 							           
            			}
$mnth = date('m');
$rom_mnth = integerToRoman($mnth);
$year = date('Y');
$tgl = date('Y/m/d');
$admin = $userRow['username'];
$code_inv = 'INV';	
$hasil = array ($no_inv_asli,$code_inv, $rom_mnth, $year);	
$hasil = 		implode("/",$hasil);	
			
if(isset($_POST['buat'])){
$tgl_inv = date('d/m/Y');
$user = $userRow['username'];
$new = 'unpaid';
$input = mysqli_query ($koneksi, "INSERT INTO invoice (id_inv,tgl_inv,user,status,id_ctki) VALUES('$hasil','$tgl_inv','$user','$new','unpaid')");
if($input){ // jika query update berhasil dieksekusi
					header("Location: form_inv.php?id_inv=$hasil");			
					}else{ // jika query insert gagal dieksekusi
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Invoice Gagal Di simpan! </div>'; // maka tampilkan 'Ups, Data Mahasiswa Gagal Di simpan!'
						}	
}			
?>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">			
				<div class="row">
					<div class="text-center col-sm-2">
				<a href="main.php"><button name="kembali" type="button" class="btn btn-danger btn-block">Kembali</button></a>
				</div>	
					<div class="text-center col-sm-2">						
				<button name="buat" type="submit" value="<?php echo ''.$no_pkd.'/'.integerToRoman($mnth).'/'.$year.''?>" type="button" class="btn btn-primary btn-block">Buat Invoice Baru</button></a>
				</div>				
				</div>
				</div>			
				</p>				
</form>
<div class=" form-group text-left">
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">	
  <p> <h3>List Data Invoice </h3></p>            
  <table class="table table-hover">
    <thead>
      <tr>
		<th>No</th>
        <th>Invoice</th>
        <th>Tanggal</th>
        <th>User</th>
        <th>Nominal</th>        
        <th>Status</th>
        
        
             
        </tr>
    </thead>
    <tbody>
      <tr>
<?php
        			
					$sql = mysqli_query($koneksi, "SELECT DISTINCT id_inv, tgl_inv, user, nominal, status, item FROM invoice WHERE item IS NULL ORDER BY id_inv DESC"); // jika tidak ada filter maka tampilkan semua entri
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ // jika terdapat entri maka tampilkan datanya
						$no = 1; // mewakili data dari nomor 1
						while($row2 = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							$number = $row2['nominal'];
							$rp = number_format($number);							
							//$rp2 = number_format($total);	
							echo '
								<td>'.$no.'</td>
								<td><a href="form_inv.php?id_inv='.$row2['id_inv'].'">'.$row2['id_inv'].'</td></a>
								<td>'.$row2['tgl_inv'].'</td>
								<td>'.$row2['user'].'</td>
								<td>'.$rp.'</td>								
								<td>'.$row2['status'].'</td>
								
								<td>';
								
							echo '
								</td>
								<td>									
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
