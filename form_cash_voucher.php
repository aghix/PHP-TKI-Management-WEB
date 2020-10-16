<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<script>
$(function() {
    	$('img').on('click', function() {
			$('.enlargeImageModalSource').attr('src', $(this).attr('src'));
			$('#enlargeImageModal').modal('show');
		});
});
</script>

<?php
$id_cash = $_GET['id_cash']; 
$tgl_trf = date('d/m/Y'); 
//$admins = $userRow['username']; 
//$tgl_now = date('d/m/Y');   
define ("MAX_SIZE","10000"); //This function reads the extension of the file. It is used to determine if the file is an image by checking the extension. 
function getExtension($str) { 
	$i = strrpos($str,"."); 
	if (!$i) { return ""; } 
	$l = strlen($str) - $i; 
	$ext = substr($str,$i+1,$l); 
	return $ext; 
}
//This variable is used as a flag. The value is initialized with 0 (meaning no error found) and it will be changed to 1 if an errro occures. If the error occures the file will not be uploaded. 
$errors=0; //checks if the form has been submitted 
if(isset($_POST['pay_cash'])) { 
//fetch log saldo
$sql = mysqli_query($koneksi, "SELECT * FROM log ORDER BY no DESC LIMIT 1");
$rowsal = mysqli_fetch_assoc($sql);
$saldo_awal = $rowsal['saldo'];	
//fetch log saldo	

//log section
$tot_prof_a = $_POST['tot_prof_a'];
$tot_prof_b = $_POST['tot_prof_b'];
$saldo1 = $saldo_awal-$tot_prof_a; 
$saldo2 = $saldo_awal-$tot_prof_b; 
$sql_log_a = mysqli_query($koneksi, "INSERT INTO log (item,tgl_trf,code,type,nominal,kredit,saldo) VALUES ('$id_cash','$tgl_trf','CASH','Profit A','$tot_prof_a','$tot_prof_a','$saldo1')");
$sql_log_b = mysqli_query($koneksi, "INSERT INTO log (item,tgl_trf,code,type,nominal,kredit,saldo) VALUES ('$id_cash','$tgl_trf','CASH','Profit B','$tot_prof_b','$tot_prof_b','$saldo2')");
//log section

//$user = $userRow['username'];
$paid = 'paid';
$image=$_FILES['image']['name'];
$img_type = 'PAID';
//$conv_string = $_GET['id_cash'];
$bad_symbols = array("/", ".");
$img_code = str_replace($bad_symbols, "", $id_cash);
$sqli = mysqli_query($koneksi, "UPDATE cash SET status='paid', tgl_trf='$tgl_trf' WHERE id_cash='$id_cash'"); 
//if it is not empty 
	if ($image){
//get the original name of the file from the clients machine 
$filename = stripslashes($_FILES['image']['name']); 
//get the extension of the file in a lower case format 
$extension = getExtension($filename); 
$extension = strtolower($extension); 
//if it is not a known extension, we will suppose it is an error and will not upload the file, otherwize we will do more tests 
		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
//print error message 
		echo '<h1>Unknown extension!</h1>'; 
		$errors=1; 
			}else{ 
//get the size of the image in bytes 
//$_FILES['image']['tmp_name'] is the temporary filename of the file in which the uploaded file was stored on the server 
			$size=filesize($_FILES['image']['tmp_name']); 
//compare the size with the maxim size we defined and print error if bigger 
				if ($size > MAX_SIZE*10240) { 
				echo '<h1>You have exceeded the size limit!</h1>'; 
				$errors=1; 
				}
//we will give an unique name, for example the time in unix time format 
					$image_name=time().'.'.$extension; 
//the new name will be containing the full path where will be stored (images folder) 
					$newname="uploads/".$img_type.$img_code.$image_name; 
//we verify if the image has been uploaded, and print error instead 
					$copied = copy($_FILES['image']['tmp_name'], $newname);
					
				if (!$copied) { 

				$errors=1; 
					}
				}
			}
			
			
		$sqli2 = mysqli_query($koneksi, "UPDATE cash SET img_trf='$newname' WHERE id_cash='$id_cash'");		
		if($sqli2){ // jika query update berhasil dieksekusi			
			header("Location: form_cash_voucher.php?id_cash=".$id_cash."&paid=sukses");
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>PAID Berhasil...! Rp. '.$total3.' </div>'; // maka tampilkan 'Data gagal disimpan, silahkan coba lagi.'
					}else{ // jika query update gagal dieksekusi
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>'; // maka tampilkan 'Data gagal disimpan, silahkan coba lagi.'
				}
		
}  			
?>



<div class="container">
		<div class="content">
		<h2>Data Tenaga Kerja &raquo; Cash Bank Detail </h2>
			<hr />
			<form class="register" method="POST">
<div class="row">
			<div class="col-sm-2">			
			<a href="cash_voucher.php" data-toggle="tooltip" title="Cash Voucher" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-list"></span> Kembali</a>
			</div>			
			<div class="col-sm-2">			
			<a href="on_cash_voucher.php" data-toggle="tooltip" title="Ongoing Cash Voucher" class="btn btn-success" role="button"><span class="glyphicon glyphicon-list"></span> Ongoing</a>
			</div>	
			<div class="col-sm-2">			
			<a href="fin_cash_voucher.php" data-toggle="tooltip" title="Finalized Cash Voucher" class="btn btn-info" role="button"><span class="glyphicon glyphicon-list"></span> Finalized</a>
			</div>			
			</div><br>
			

			
 </form>
 <div class=" form-group text-left">  
  <p> <h3>Cash Voucher <?php echo $id_cash; ?> Item List  </h3></p>            
  <table class="table table-hover">
    <thead>
      <tr>		
        <th>List CTKI</th>        
        <th>Profit A</th>
        <th>Profit B</th>             
        </tr>
    </thead>
    <tbody>
      <tr>
        					<?php
        			
					$sql = mysqli_query($koneksi, "SELECT * FROM ctki WHERE status = 'flight' AND id_cash = '$id_cash' ORDER BY voucher ASC"); // jika tidak ada filter maka tampilkan semua entri
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ // jika terdapat entri maka tampilkan datanya
						$i = 0;
						$k = 0;
						$no = 1;
						$total= 0; // mewakili data dari nomor 1
						while($row2 = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							$number = $row2['profit_a'];
							$number2 = $row2['profit_b'];							
							$rp = number_format($number);							
							$rp2 = number_format($number2);								
							$total +=$number2; 
							echo '
								<td><input type="hidden" name="ctki['.$i.']" type="hidden" value="'.$row2['voucher'].'"><a href="testing_ctki.php?ctki='.$row2['voucher'].'&code='.$row2['code'].'">'.$row2['voucher'].'</input></td></a>
								<td>'.$rp.'</td>
								<td>'.$rp2.'</td>								
								<td>';
								
							echo '
								</td>
								<td>									
								</td>
								</tr>
							';
							$no++; // mewakili data kedua dan seterusnya
							$i++;
						}
					}
					?>
    </tbody>
  </table>
</div>
<?php
$sql = mysqli_query($koneksi, "SELECT * FROM ctki WHERE id_cash = '$id_cash' ORDER BY voucher ASC");
$total1= 0; // mewakili data dari nomor 1
$total2= 0;
$sub_total= 0;
$payment= 0; 	
	while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
		$number = $row['profit_a'];
		$number2 = $row['profit_b'];		
		$total1 +=$number; 
		$total2 +=$number2; 		
		$rp = number_format($total1);							
		$rp2 = number_format($total2);	
		
}
?>
<form action="" method="post" enctype="multipart/form-data">			
		<div class="row">						
				<div class=" col-sm-4">					
				<h3><input type="hidden" name="tot_prof_a" value="<?php echo $total1;?>"><b>Total Profit A: <font color="red"><?php echo $rp;?> </b></input></h3></font>
				</div>
				<div class=" col-sm-4">					
				<h3><input type="hidden" name="tot_prof_b" value="<?php echo $total2;?>"><b>Total Profit B: <font color="blue"><?php echo $rp2;?> </b></input></h3></font>
				</div>
				</div>
					
<?php
$sql = mysqli_query($koneksi, "SELECT * FROM cash WHERE id_cash='$id_cash'"); // query untuk memilih entri data dengan nilai nim terpilih
$row = mysqli_fetch_assoc($sql);
$lihat = $row['status'];
if($lihat == 'paid'){
	echo '
	<div class="row">
		<div class="col-sm-3">
		<img src="images/paid_stamp.png" alt="PAID" style="width:150px;height:150px;"></img>
		<p>&emsp;&emsp;&emsp;'.$row['tgl_trf'].'</p>
		</div>
		<div class="col-sm-2"><img id="myImg" src="'.$row['img_trf'].'" alt="Bukti Transfer" style="width:100px;height:150px;"></img></div>
	</div><br><br>
	
	';
	
}else{
		
	echo '
			
	<div class="row">			
		<div class="col-sm-3">
		<input name="image" type="file" class="file" required></input>
		</div></div><br>
		
		<div class="row">
		<div class="text-center col-sm-2">
		<button name="pay_cash" type="submit" value="Update" type="button" class="btn btn-primary btn-block">Process</button></a>
		</div></div>
		<div class="col-sm-2">
		
		</div>
	</div><br><br>
	
	
	';
	
}
?>
</form>
<!--
/*
	hiding enlarge image
*/
-->
	<div class="modal fade" id="enlargeImageModal" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <img src="" class="enlargeImageModalSource" style="width: 100%;">
        </div>
      </div>
    </div>
</div>
<!--
/*
	hiding enlarge image
*/
-->

