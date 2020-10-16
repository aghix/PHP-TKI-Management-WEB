<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
			<h2>Data Tenaga Kerja &raquo; Edit Kelengkapan Document (Image)</h2>
			
			
			
			      
<?php
			$code = $_GET['code']; // assigment nim dengan nilai nim yang akan diedit
			$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); // query untuk memilih entri data dengan nilai nim terpilih
			$row = mysqli_fetch_assoc($sql);
		

			
if(isset($_POST['save'])){ // jika tombol 'Simpan' dengan properti name="save" pada baris 162 ditekan
				$code		     	 	 = $row['code'];	
				$tgl_up		     	 	 = date('d/m/Y');
				$jenis					 = $_POST['jenis'];
				
				
				
				$update = mysqli_query($koneksi, "UPDATE images SET 
				tki_id		= '$code', 
				image		= '$newname', 
				tgl_up		= '$tgl_up',
				jenis		= '$jenis'
				
				
				
				WHERE jenis='$jenis'") or die(mysqli_error()); // query untuk mengupdate nilai entri dalam database
				if($update){ // jika query update berhasil dieksekusi
					header("Location: update-luar.php?code=".$code."&pesan=sukses"); // tambahkan pesan=sukses pada url
				}else{ // jika query update gagal dieksekusi
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>'; // maka tampilkan 'Data gagal disimpan, silahkan coba lagi.'
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){ // jika terdapat pesan=sukses sebagai bagian dari berhasilnya query update dieksekusi
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan. <a href="profile.php?code='.$code.'"><- Kembali</a></div>'; // maka tampilkan 'Data berhasil disimpan.'
			}
		
	?>		
				
	
<?php //define a maxim size for the uploaded images in Kb 
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
if(isset($_POST['save'])) 
{ 
//reads the name of the file the user submitted for uploading 
$image=$_FILES['image']['name'];
$img_code = $_GET['code'];
$img_type = $_POST['jenis']; 
//if it is not empty 
if ($image) 
{
//get the original name of the file from the clients machine 
$filename = stripslashes($_FILES['image']['name']); 
//get the extension of the file in a lower case format 
$extension = getExtension($filename); 
$extension = strtolower($extension); 
//if it is not a known extension, we will suppose it is an error and will not upload the file, otherwize we will do more tests 
if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
{
//print error message 
echo '<h1>Unknown extension!</h1>'; 
$errors=1; 
} 
else 
{ 
//get the size of the image in bytes 
//$_FILES['image']['tmp_name'] is the temporary filename of the file in which the uploaded file was stored on the server 
$size=filesize($_FILES['image']['tmp_name']); 
//compare the size with the maxim size we defined and print error if bigger 
if ($size > MAX_SIZE*10240) 
{ 
echo '<h1>You have exceeded the size limit!</h1>'; 
$errors=1; 
}
//we will give an unique name, for example the time in unix time format 
$image_name=time().'.'.$extension; 
//the new name will be containing the full path where will be stored (images folder) 
$newname="uploads/".$img_type.$img_code.$image_name; 
//we verify if the image has been uploaded, and print error instead 
$copied = copy($_FILES['image']['tmp_name'], $newname); 
if (!$copied) 
{ 
echo '<h1>Copy unsuccessfull!</h1>'; 
$errors=1; }}}} 
//If no errors registred, print the success message 
if(isset($_POST['Submit']) && !$errors) 
{ 
echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan. <a href="update-image.php?code='.$code.'"><- Kembali</a></div>'; // maka tampilkan 'Data berhasil disimpan.' 
} 
?>

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
	
	
				<div class="form-group"></div>
				<div class="form-group"></div>
				<div class="form-group">
					<label name="tgl_upload" class="col-sm-3 control-label">Tanggal Upload</label>
					<div class="col-sm-2">
						<label class="control-label"> 
						<?php 
							echo "" . date('d/m/Y');
						?>
						</label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ID Tenaga Kerja</label>
					<div class="col-sm-2">
						<label name="code" class="control-label" value="<?php echo $row['code']; ?>"> 
						<?php echo $row['code']; ?>
						</label>
					</div>
				</div>
				
<div class="form-group">
					<label class="col-sm-2 control-label">Jenis Image</label>
					<div class="col-sm-3">
						<select name="jenis" class="form-control" required>
							<option value=""> -Choose- </option>
							<option name="ktp" value="ktp">Kartu Tanda Penduduk / KTP</option>
							<option name="kk" value="kk">Kartu Keluarga / KK</option>
							<option name="sij" value="sij">Surat Izin Keluarga (Cap Lurah)</option>
							<option name="nikah" value="nikah">Surat Nikah</option>
							<option name="ijazah" value="ijazah">Ijazah</option>
						</select>
					</div>
				</div>
<form name="newad" method="post" enctype="multipart/form-data" action="update-image.php"> <table> <tr><td><input type="file" name="image"></td></tr> <tr><td><input name="save" type="submit" value="Upload image"></td></tr> </table> </form>





</form>
		</div> <!-- /.content -->
	</div> <!-- /.container -->		
				
					
<?php 
include("footer.php"); // memanggil file footer.php
?>

</body>
</html>	
