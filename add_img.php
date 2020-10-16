<?php 
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



	<div class="container">
		<div class="content">
			<h2>Data Tenaga Kerja &raquo; Edit Kelengkapan Document (Image)</h2>
			
<?php
$code = $_GET['code'];

			if(isset($_GET['aksi']) == 'delete'){ // mengkonfirmasi jika 'aksi' bernilai 'delete' merujuk pada baris 97 dibawah
				$img_id = $_GET['img_id']; // ambil nilai nim
				
				$cek = mysqli_query($koneksi, "SELECT * FROM images WHERE img_id='$img_id'"); // query untuk memilih entri dengan nim yang dipilih
				if(mysqli_num_rows($cek) == 0){ // mengecek jika tidak ada entri nim yang dipilih
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>'; // maka tampilkan 'Data tidak ditemukan.'
				}else{ // mengecek jika terdapat entri nim yang dipilih
					$delete = mysqli_query($koneksi, "DELETE FROM images WHERE img_id='$img_id'"); // query untuk menghapus
					if($delete){ // jika query delete berhasil dieksekusi
					while ($delete = mysql_fetch_array($result)) {
			try
    {
		$cek2 = mysqli_query($koneksi, "SELECT * FROM images WHERE img_id='$img_id'");
        $image3 = $row3['image'];
        $file= 'uploads/'.$image3;
        unlink($file);
    } catch (Exception $e) {

    }
            
        }
			header("Location: testing_add_img.php?code=".$code."&pesan=deleted");	
						}else{ // jika query delete gagal dieksekusi
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>'; // maka tampilkan 'Data gagal dihapus.'
					}
				}
			}
			
			?>			
			
			
			      
<?php
			$code = $_GET['code']; // assigment nim dengan nilai nim yang akan diedit
			$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); // query untuk memilih entri data dengan nilai nim terpilih
			$row = mysqli_fetch_assoc($sql);
		
		

				
		
	 //define a maxim size for the uploaded images in Kb 
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

$errors=1; }}}

$code = $row['code'];	
$tgl_up	= date('d/m/Y');
$jenis	= $_POST['jenis'];
$user = $userRow['username'];				
				
				
				$insert = mysqli_query($koneksi, "INSERT INTO images (  
				tki_id,
				image,
				jenis_img,
				tgl_up,
				user
				) VALUES (
				'$code',
				'$newname',
				'$jenis',
				'$tgl_up',
				'$user'
				
				
				
				
				)") or die(mysqli_error()); // query untuk mengupdate nilai entri dalam database
				if($insert){ // jika query update berhasil dieksekusi
					header("Location: testing_add_img.php?code=".$code."&pesan=sukses"); // tambahkan pesan=sukses pada url
				}else{ // jika query update gagal dieksekusi
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>'; // maka tampilkan 'Data gagal disimpan, silahkan coba lagi.'
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){ // jika terdapat pesan=sukses sebagai bagian dari berhasilnya query update dieksekusi
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Executed..! </div>'; // maka tampilkan 'Data berhasil disimpan.'
			}
				
?>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
<div class="container text-center">    
  <div class="row">
    <div class="col-sm-3 well">
      <div class="well">
        <p></p>
        <img id="myImg" src="<?php echo $row['foto']; ?>" alt="Foto TKI" style="width:200px;height:250px;">
        <!-- The Modal -->
			<div id="myModal" class="modal">
			<span class="close">&times;</span>
			<img class="modal-content" id="img01">
			<div id="caption"></div>
			</div>
		</div>
		</div>

 <div class="col-sm-7">
      <div class="row">
        <div class="col-sm-12">
          <div class="well text-left">
            <div class="panel-body">
              <h3>Kelengkapan Document <?php echo $row['nama']; ?></h3>
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
				
				<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
	
	
				
   
<div class="form-group">
					<label class="col-sm-3 control-label">Jenis Image</label>
					<div class="col-sm-5">
						<select name="jenis" class="form-control" required>
							<option value=""> -Choose- </option>
							<option name="ktp" value="ktp">Kartu Tanda Penduduk / KTP</option>
							<option name="kk" value="kk">Kartu Keluarga / KK</option>
							<option name="akta_lahir" value="akte">Akte Kelahiran / Kenal Lahir</option>
							<option name="sij" value="sij">Surat Izin Keluarga (Cap Lurah)</option>
							<option name="nikah" value="nikah">Surat Nikah</option>
							<option name="ijazah" value="ijazah">Ijazah</option>
							<option name="medical" value="medical">Medical</option>
							<option name="suhan" value="suhan">CV/Suhan</option>
							<option name="id_asuransi_pra" value="id_asuransi_pra">ID & Asuransi Pra</option>
							<option name="passpor" value="passpor">Passpor</option>
							<option name="isc" value="isc">ISC</option>
							<option name="fwcms" value="fwcms">FWCMS</option>
							<option name="visa" value="visa">VISA</option>
							<option name="visa_ipa" value="visa_ipa">VISA/IPA (Singapore)</option>
							<option name="visa_teto" value="visa_teto">VISA/TETO (Taiwan)</option>
							<option name="fiskal" value="fiskal">Fiskal</option>
							<option name="daftar_pap" value="daftar_pap">Daftar PAP</option>
							<option name="recom_pap" value="recom_pap">Recom PAP</option>
							<option name="tiket_pesawat" value="tiket_pesawat">Tiket Pesawat</option>
							<option name="kwitansi" value="kwitansi">Kwitansi</option>
							<option name="dll" value="dll">Lain - Lain</option>
							
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" required>Image</label>
					<div class="col-sm-5">
					<form name="newad" method="post" enctype="multipart/form-data" action="update-image.php"> <input type="file" name="image" required>	
					</div>
				</div>											
               <p>
			 <button name="save" type="submit" value="Upload image" type="button" class="btn btn-primary btn-lg btn-block">Upload..!!!</button></a>
		</p>
		<p>
			<a href="profile.php?code=<?php echo $row['code']; ?>"> <button type="button" class="btn btn-secondary btn-lg btn-block">Kembali</button></a>
		</p>
            </div>
          </div>
        </div>
      </div>
	</div>	
	</div>		
</form>		
		



<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
	<div class="form-group text-left">
  <h2></h2>
  <p> <h3>Document Kelengkapan yang sudah tersimpan</h3></p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th>No</th>
        <th>Image</th>
        <th>Img_name</th>
        <th>Tgl Upload</th>
        <th>User</th>
        <th>id</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        					<?php
        			$filter = $row['code'];	
					if($filter){
						
						$sql = mysqli_query($koneksi, "SELECT * FROM images WHERE tki_id='$filter' ORDER BY tgl_up ASC"); // query jika filter dipilih
					}else{
						$sql = mysqli_query($koneksi, "SELECT * FROM images ORDER BY nim ASC"); // jika tidak ada filter maka tampilkan semua entri
					}
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ // jika terdapat entri maka tampilkan datanya
						$no = 1; // mewakili data dari nomor 1
						while($row2 = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							echo '
							
								<td>'.$no.'</td>
								<td><img id="myImg" src="'.$row2['image'].' " alt="image" style="width:30px;height:30px;"></td>
								<td>'.$row2['jenis_img'].'</td>
								<td>'.$row2['tgl_up'].'</td>
								<td>'.$row2['user'].'</td>
								<td>'.$row2['img_id'].'</td>
								<td>';
								
							echo '
								</td>
								<td>
									
									<a href="edit.php?nim='.$row['nim'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
									<a href="testing_add_img.php?code='.$row['code'].'&aksi=delete&img_id='.$row2['img_id'].'&" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus data '.$row2['jenis_img'].' dengan id '.$row2['img_id'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
		</div> <!-- /.content -->
	</div> <!-- /.container -->		
				
					
<?php 
include("footer.php"); // memanggil file footer.php
?>

</body>
</html>	
