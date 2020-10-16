<?php 
ob_start();
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database

?>
<script>
$(function() {
    	$('img').on('click', function() {
			$('.enlargeImageModalSource').attr('src', $(this).attr('src'));
			$('#enlargeImageModal').modal('show');
		});
});
</script>
<style>
	:-moz-placeholder {
		color: red;
    font-weight: bold;
}
::-webkit-input-placeholder {
	color: red;
    font-weight: bold;
}
::-moz-placeholder {
	color: red;
    font-weight: bold;
}
:-ms-input-placeholder {
	color: red;
    font-weight: bold;
}
</style>

    <body>   
		<div class="container">
		<div class="content form-group">
			<h2>Data Tenaga Kerja &raquo; Item Pengajuan Kebutuhan Dana</h2>
			<hr /> 
			<div class="text-center col-sm-2">
		<a href="pkd_baru.php"><button name="kembali" type="submit" value="Upload Image PKD" type="button" class="btn btn-danger btn-block">Kembali</button></a>
		</a></div>
		<div class="row"></div>	
		<br>			
<?php 
$num_pkd2 = $_GET['no_pkd'];       			
$sqla = mysqli_query($koneksi, "SELECT jumlah FROM pkd WHERE no_pkd='$num_pkd2' AND no_ctki > '' ORDER BY no ASC "); // jika tidak ada filter maka tampilkan semua entri
	while($row3 = mysqli_fetch_assoc($sqla)){ // fetch query yang sesuai ke dalam array
		$number3 = $row3['jumlah'];
		$total3 += $number3;			
	}	
?>		

<?php
$sql = mysqli_query($koneksi, "SELECT * FROM log ORDER BY no DESC LIMIT 1");
		$rowsal = mysqli_fetch_assoc($sql);
		$saldo_awal = $rowsal['saldo'];		
$num_pkd = $_GET['no_pkd'];

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
if(isset($_POST['up_paid'])) { 
//reads the name of the file the user submitted for uploading 

$tgl_trf = date('d/m/Y');
$user = $userRow['username'];
$paid = 'paid';
$image=$_FILES['image']['name'];
$img_type = 'bukti_transfer';
$conv_string = $_GET['no_pkd'];
$bad_symbols = array("/", ".");
$img_code = str_replace($bad_symbols, "", $conv_string);
$sqli = mysqli_query($koneksi, "UPDATE pkd SET status='paid', tgl_trf='$tgl_trf' WHERE no_pkd='$num_pkd'"); 
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
		$saldo = $saldo_awal-$total3;
		$item_code	= 'PKD';			
		$sqlip = mysqli_query($koneksi, "INSERT INTO log (nominal, item, code, tgl_trf,type,saldo,kredit) VALUES ('$total3', '$num_pkd', '$item_code', '$tgl_trf', 'PKD', '$saldo', '$total3' )");		
		$sqli2 = mysqli_query($koneksi, "UPDATE pkd SET img_trf='$newname', total='$total3' WHERE no_pkd='$num_pkd' AND no_ctki IS NULL");		
		if($sqli2){ // jika query update berhasil dieksekusi			
			header("Location: daftar_pkd.php?no_pkd=".$num_pkd."&paid=sukses");
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>PAID Berhasil...! Rp. '.$total3.' </div>'; // maka tampilkan 'Data gagal disimpan, silahkan coba lagi.'
					}else{ // jika query update gagal dieksekusi
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>'; // maka tampilkan 'Data gagal disimpan, silahkan coba lagi.'
				}
$nominale = number_format($total3);
include("sendmail.php");  
include("notif_pkd.php");   		
}
?>				
			
<?php
$no_pkd = $_GET['no_pkd'];
$sql = mysqli_query($koneksi, "SELECT no_pkd,tgl_pkd,user FROM pkd WHERE no_pkd='$no_pkd'"); // query untuk memilih entri data dengan nilai nim terpilih
$row = mysqli_fetch_assoc($sql);
?> 
			
<?php
if(isset($_GET['aksi']) == 'delete'){ // mengkonfirmasi jika 'aksi' bernilai 'delete' merujuk pada baris 97 dibawah
				$id_pkd = $_GET['id_pkd']; // ambil nilai nim
				$id_ctki= $_GET['no_ctki'];
				$id_item= $_GET['item'];
				$cek = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no='$id_pkd'"); // query untuk memilih entri dengan nim yang dipilih
				if(mysqli_num_rows($cek) == 0){ // mengecek jika tidak ada entri nim yang dipilih
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Item Sudah ada di PKD lain.</div>'; // maka tampilkan 'Data tidak ditemukan.'
				}else{ // mengecek jika terdapat entri nim yang dipilih
				$delete = mysqli_query($koneksi, "DELETE FROM pkd WHERE no='$id_pkd'"); // query untuk menghapus
				//$delete2 = mysqli_query($koneksi, "DELETE FROM ctki WHERE voucher='$id_ctki' AND item='$id_item'");
				if($delete){ // jika query delete berhasil dieksekusi				        
				header("Location: testing_pkd.php?no_pkd=".$no_pkd."&pesan=deleted");	
						}else{ // jika query delete gagal dieksekusi
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>'; // maka tampilkan 'Data gagal dihapus.'
					}
				}
			}

?>			

<?php
if(isset($_POST['save'])){
$catatan = $_POST['catatan'];
$tgl_pkd = $row['tgl_pkd'];
$conv_string = $_POST['BX_amount'];
$bad_symbols = array(",", ".");
$jumlah = str_replace($bad_symbols, "", $conv_string);
$user = $row['user'];
$no_ctki = $_POST['BX_NAME'];
$item = $_POST['item'];
$status = 'new';
list($nama, $ctki) = explode(",", $no_ctki);
list($code_item, $nama_item) = explode(",", $item);
if ($nama_item == 'Medical'){
	$cek_med = mysqli_query($koneksi, "SELECT item FROM pkd WHERE nama = '$nama' AND item = 'Medical' AND no_ctki = '$ctki'");
	if (mysqli_num_rows($cek_med) > 0){ 
		$nama_item = 'Medical II';
		}
	}
if ($nama_item == 'Medical II'){
	$cek_med = mysqli_query($koneksi, "SELECT item FROM pkd WHERE nama = '$nama' AND item = 'Medical II' AND no_ctki = '$ctki'");
	if (mysqli_num_rows($cek_med) > 0){ 
		$nama_item = 'Medical III';
		}
	}
if ($nama_item == 'ID & Asuransi'){
	$cek_id = mysqli_query($koneksi, "SELECT item FROM pkd WHERE nama = '$nama' AND item = 'ID & Asuransi' AND no_ctki = '$ctki'");
	if (mysqli_num_rows($cek_id) > 0){ 
		$nama_item = 'ID & Asuransi II';
		}
	}
if ($nama_item == 'ID & Asuransi II'){
	$cek_id = mysqli_query($koneksi, "SELECT item FROM pkd WHERE nama = '$nama' AND item = 'ID & Asuransi II' AND no_ctki = '$ctki'");
	if (mysqli_num_rows($cek_id) > 0){ 
		$nama_item = 'ID & Asuransi III';
		}
	}
$cek = mysqli_query($koneksi, "SELECT item FROM pkd WHERE nama = '$nama' AND item = '$nama_item' AND no_ctki = '$ctki'");
if(mysqli_num_rows($cek) > 0){ 
echo '<br><tr><td colspan="14"><b>Item Sudah Ada.. Silahkan Pilih Item Lain..!</b></td></tr>'; // jika sudah ada entri di database maka tampilkan 'Data sudah Ada.'
	}else{
		
		$input = mysqli_query ($koneksi, "INSERT INTO pkd 
		(tgl_pkd,no_pkd,nama,no_ctki,item,jumlah,user,catatan,status) 
		VALUES
		('$tgl_pkd','$no_pkd','$nama','$ctki','$nama_item','$jumlah','$user','$catatan','$status')");		
	}
}
?>		
<?php        			
					$sql = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_pkd='$no_pkd' AND no_ctki > '' ORDER BY no ASC ");
					if(mysqli_num_rows($sql) == 0){ 
						}else{ // jika terdapat entri maka tampilkan datanya
						$row_cnt = mysqli_num_rows($sql);
						$no = 1; // mewakili data dari nomor 1
						$total=0;
						while($row2 = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							$number = $row2['jumlah'];
							$rp = number_format($number);
							$total += $number;
							$rp2 = number_format($total);			
						}
					}
?>
<div class="col-sm-3">		
        <form class="register" method="POST">
            
            <fieldset class="row2">
				
						   <p>	PKD Number: <b><?php echo $row['no_pkd']; ?></b>				
			

	
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        </p>
        <p >	
			Tanggal : <label name="tgl"><b><?php echo $row['tgl_pkd']; ?></b></label>
			</p>
			<p>	
			User : <label name="user"><b><?php echo $row['user']; ?></b>
			</p>
			<p>	
			Total Item : <label name="item"><font color="blue"><b><?php echo $row_cnt; ?></b></font>
			</p>
			<p>	
			Total Nominal : <input type="hidden" name="total_jml" value="<?php  echo $rp2; ?>">Rp <font color="red"><b><?php  echo $rp2; ?>,-</font></b>
			</p>
</div></form>
			
<?php
$sql3 = mysqli_query($koneksi, "SELECT tgl_trf,img_trf,status FROM pkd WHERE no_pkd='$no_pkd'"); // query untuk memilih entri data dengan nilai nim terpilih
$row3 = mysqli_fetch_assoc($sql3);
$lihat = $row3['status'];
if($lihat == 'paid'){
	
	echo '
	<div class="row">
		<div class="text-center col-sm-3">
		<img src="images/paid_stamp.png" alt="PAID" style="width:150px;height:150px;"></img>
		<p>'.$row3['tgl_trf'].'</p>
		</div>
		<div class="text-center col-sm-2"><img id="myImg" src="'.$row3['img_trf'].'" alt="Bukti Transfer" style="width:100px;height:150px;"></img></div>
	</div><br><br>
	
	';
	
}
?>

<?php
$user_edit=$userRow['username'];
if($user_edit == 'Editor'){
	include("pkd_up_tgl.php");
	}
?>			

  									
<?php
$no_pkd4 = $_GET['no_pkd'];
$sql4 = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_pkd = '$no_pkd4'"); // query untuk memilih entri data dengan nilai nim terpilih
$row4 = mysqli_fetch_assoc($sql4);
$show2 = $row4['status'];
$sh_image = $row4['img_trf'];

if($show2 !== 'paid'){
	include("form_pkd.php"); 
	echo '
	<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
	<div class="row">			
		<div class="col-sm-3">
		<input name="image" type="file" class="file" required> 
		</div>
		<div class="text-center col-sm-2">
		<button name="up_paid" type="submit" value="Upload Image PKD" type="button" class="btn btn-primary btn-block">PAID</button></a>
		</div>
		<div class="col-sm-2">
		
		</div>
	</div><br><br>
	</form>
	';
}
?>		


			
         
         <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <div class="row">		
	<div class=" text-left">
  <h2></h2>
  <p> <h3>Daftar Item PKD<?php// echo $saldo_awal;?></h3></p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th>No</th>
        <th>Item</th>
        <th>Nama</th>
        <th>Nominal</th>  
        <th>Remarks</th>
             
        </tr>
    </thead>
    <tbody>
      <tr>
        			<?php
        			
					$sql = mysqli_query($koneksi, "SELECT * FROM pkd WHERE no_pkd='$no_pkd' AND no_ctki > '' ORDER BY no ASC ");
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ // jika terdapat entri maka tampilkan datanya
						$no = 1; // mewakili data dari nomor 1
						$total=0;
						while($row2 = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							$number = $row2['jumlah'];
							$rp = number_format($number);
							$total += $number;
							$rp2 = number_format($total);
							$stts = $row2['status'];							
							echo '
							
								<td>'.$no.'</td>
								<td><b>'.$row2['item'].'</b></td>
								<td><b>'.$row2['nama'].'</b></td>								
								<td><input  type="text" required="required" name="edit_jumlah" placeholder="Rp '.$rp.',-"></input></td>
								</td>
								<td>
								
								<input class="form-control" type="text" required="required" name="remarks" placeholder="'.$row2['catatan'].'"></input></td>
								
								<td>';
								
							echo '
								</td>
								<td>
								';
						if($stts !=='paid'){
							echo '<a href="daftar_pkd.php?no_pkd='.$row2['no_pkd'].'&no_ctki='.$row2['no_ctki'].'&item='.$row2['item'].'&aksi=delete&id_pkd='.$row2['no'].'" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus item '.$row2['item'].' untuk  '.$row2['nama'].' nominal '.$rp.'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
								</td>
								</tr>	
								';
								}else{
								echo '
								</td>
							</tr>
								';
								}		
							
							$no++; // mewakili data kedua dan seterusnya
						}
						
					}
					?>
    </tbody>
  </table>
</div>

<div class="text-center col-sm-2">
		<a href="pkd_baru.php"><button name="kembali" type="button" class="btn btn-danger btn-block">Kembali</button></a>
		</a></div>
		<div class="row"></div>	
		<br>			
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


    </body>
	<!-- Start of StatCounter Code for Default Guide -->

</html>





