<?php 
ob_start();
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
include("phpqrcode/qrlib.php"); // memanggil file qrcode generator
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
?>	 
  <style>    
 
	  
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
  </style>
 

  <script>
$(function() {
    	$('img').on('click', function() {
			$('.enlargeImageModalSource').attr('src', $(this).attr('src'));
			$('#enlargeImageModal').modal('show');
		});
});
</script>

<body>
	
/*
	hiding enlarge image
*/
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
	
<div class="container">
		<div class="content">
			<h2>Data Tenaga Kerja &raquo; Biodata Lengkap</h2>	
			<hr />
<?php
$code = $_GET['code'];
	$sql_c = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'");
	$row_c = mysqli_fetch_assoc($sql_c);
	$nama_ctki = $row_c['nama'];
	$tujuan_ctki = $row_c['tujuan'];	
	if(isset($_POST['add_ctki'])){
		$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    //html PNG location prefix
		$PNG_WEB_DIR = 'qrcode/';
		if (!file_exists($PNG_TEMP_DIR))
		mkdir($PNG_TEMP_DIR);	
	$code = $_GET['code'];	
	$user = $userRow['username'];
	$tgl_voucher = date('Y/m/d');
	$new_ctki = $_POST['add_ctki'];
	$bad_symbols = array(",", "/", "-", ".0");
	$qr_ctki = str_replace($bad_symbols, "", $new_ctki);	
	$new_label = 'valid';
	$url_bio = 'http://192.168.3.16/2/profile.php?code='.$code.'';
	$url_ctki = 'http://192.168.3.16/2/form_ctki.php?ctki='.$new_ctki.'&code='.$code.'';
	$errorCorrectionLevel = 'H';
	$matrixPointSize = '8';
	$time_num=time();
	$filename_bio = $PNG_WEB_DIR.''.$time_num.''.$code.'.png';
	$filename_ctki = $PNG_WEB_DIR.''.$time_num.''.$qr_ctki.'.png';
	QRcode::png($url_bio, $filename_bio, $errorCorrectionLevel, $matrixPointSize, 2); 
	QRcode::png($url_ctki, $filename_ctki, $errorCorrectionLevel, $matrixPointSize, 2);	
	
$logopath = 'qrcode/cakra.png';
$QR_bio = imagecreatefrompng($filename_bio);
$logo = imagecreatefromstring(file_get_contents($logopath));
$QR_width = imagesx($QR_bio);
$QR_height = imagesy($QR_bio);
$logo_width = imagesx($logo);
$logo_height = imagesy($logo);
$logo_qr_width = $QR_width/3;
$scale = $logo_width/$logo_qr_width;
$logo_qr_height = $logo_height/$scale;
imagecopyresampled($QR_bio, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
// Save QR code again, but with logo on it
imagepng($QR_bio,$filename_bio);

$QR_ctki = imagecreatefrompng($filename_ctki);
$QR_width = imagesx($QR_ctki);
$QR_height = imagesy($QR_ctki);
imagecopyresampled($QR_ctki, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
// Save QR code again, but with logo on it
imagepng($QR_ctki,$filename_ctki);
	$insert = mysqli_query($koneksi, "INSERT INTO ctki	(voucher,code,tgl_voucher,user,nama,tujuan,qrcode)	VALUES ('$new_ctki','$code','$tgl_voucher','$user','$nama_ctki','$tujuan_ctki','$filename_ctki')");											
	$insert = mysqli_query($koneksi, "UPDATE mahasiswa SET  ctki = '$new_ctki', label = '$new_label', qrcode = '$filename_bio' WHERE code='$code'");	
if($insert){ // jika query insert berhasil dieksekusi
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>CTKI baru sudah ditambahkan. '.$nama_ctki.' Dengan No: '.$new_ctki.'  </div>'; // maka tampilkan 'Data Mahasiswa Berhasil Di Simpan.'
						}
}		
?>		

<?php
			$code = $_GET['code']; // mengambil data nim dari nim yang terpilih
			
			$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); // query memilih entri nim pada database
			if(mysqli_num_rows($sql) == 0){
				
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			
			
			?>
			<!-- bagian ini digunakan untuk menampilkan data tki -->
			

  
<div class="container text-center">    
  <div class="row">
    <div class="col-sm-3 well">
      <div class="well">
        <p></p>
        <img id="myImg" src="<?php echo $row['foto']; ?>" alt="Foto TKI" style="width:200px;height:250px;">
        <p>
			<a href="update_foto.php?code=<?php echo $row['code']; ?>"> <button type="button" class="btn btn-primary btn-lg btn-block">Change</button></a>
		</p>
        <!-- The Modal -->
			<div id="myModal" class="modal">
			<span class="close">&times;</span>
			<img class="modal-content" id="img01">
			<div id="caption"></div>
			</div>
      </div>
      <div class="well"><b>
		  <?php
		  $qrcode = $row['qrcode'];
		  if($qrcode !== NULL){
			  echo '<img id="myImg" src="'.$qrcode.'" alt="QR Code Biodata" style="width:200px;height:200px;">';
			  }
		  ?>
		  
		   <p>	CTKI: 				
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
$result = mysqli_query($koneksi, "SELECT MAX(`no`) AS comment_id FROM `ctki`");
    					while ($row = mysqli_fetch_assoc($result)) {
        				$no_ctki = $row['comment_id'] +1;
        					if($no_ctki < 10){
								$pr_ctki = '0'.$no_ctki.'';
								
									
							}
								else{
									$pr_ctki = ''.$no_ctki.'';
								}             
            			}
$mnth = date('m');
$year = date('Y');
$code = $_GET['code'];
$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); 
$row = mysqli_fetch_assoc($sql);
$ctki = $row['ctki'];
$pt_code = $row['pt_code'];
	$user = $userRow['lvl'];		
			if($user > '3'){
			if(!empty($ctki)){
				
				echo' <a href="form_ctki.php?ctki='.$row['ctki'].'&code='.$row['code'].'">'.$row['ctki'].'</a>';
				
			}else{
				
			
				
			echo '
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
			<button type="submit" name="add_ctki" class="btn btn-primary btn-block" value="'.$pr_ctki.'.'.$pt_code.'/'.integerToRoman($mnth).'/'.$year.'">Process CTKI</button>
			</form>
			';
		}
			
	}		

?>			

<?php
$code = $_GET['code'];
$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); 
$row2 = mysqli_fetch_assoc($sql);
$label = $row2['label'];
if($label != 'valid'){
	echo '				
        </p>
		  <p>					
			'.$label.'
		';
		}else{
	echo '';
			
	}
		?>
				
        </p>
		 <p>No Urut: [ <?php 
			$no_urut = $row['code'];
			$label = $row['label'];
		if($label = 'new'){
		  if($no_urut < 10){
			echo '00'.$no_urut.' ';
				if($no_urut > 10){
					echo '0'.$no_urut.' ';
						}
							}else{
								echo $no_urut;
							}
						}	
		 ?> ]  </p>
		<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <p><input type="hidden" name="nama_ctki" placeholder="<?php echo $row['nama']; ?>" value="<?php echo $row['nama']; ?>"></input><?php echo $row['nama']; ?>  </p>
           
        <p>   
			<?php echo $row['pt_code']; ?> 
		</p>	
        <p>       
			<?php echo $row['tgl_daftar']; ?> 
		</p>
			
		<p>					
			<?php echo $row['pt_sponsor']; ?>
				
        </p>
        <p>					
			Sponsor : <?php echo $row['nm_sponsor']; ?>
				
        </p>
        <p>					
			<?php echo $row['tujuan']; ?>
				
        </p>
        <p>					
			<?php echo $row['formal']; ?>
				
        </p>
        <p>					
			-------
				
        </p>
        <p>					
			<?php echo $row['alamat_rtrw']; ?>
				
        </p>
        <p>					
			<?php echo $row['kab_kec']; ?>
				
        </p>
        <p>					
			<?php echo $row['prov_pos']; ?>
				
        </p>
        <p>					
			-------
				
        </p>
        <p>					
			<?php echo $row['jenis_kelamin']; ?>
				
        </p>
        <p>					
			<?php echo $row['tempat_lahir']; ?> : <?php
			$oridate = $row['tanggal_lahir']; 
			$newdate = date("d-m-Y", strtotime($oridate));
			echo $newdate; ?>
				
        </p>
        <p>					
			<?php			
			$dob=$row['tanggal_lahir'];
			$diff = (date('Y') - date('Y',strtotime($dob)));
			echo $diff; 
			echo " Tahun";
			?>				
		</p>
		<p>					
			<?php echo $row['agama']; ?>
				
        </p>
        <p>					
			<?php echo $row['b_badan']; ?> Kg
				
        </p>
        <p>					
			<?php echo $row['t_badan']; ?> Cm
				
        </p>
        <p>					
			<?php echo $row['pend']; ?>
				
        </p>
        <p>					
			<?php echo $row['status']; ?>
				
        </p>
        <p>					
			Jumlah Anak : <?php echo $row['anak']; ?>
				
        </p>
        <p>					
			Jumlah Saudara : <?php echo $row['sdr']; ?>
				
        </p>
        <p>					
			Anak Ke : <?php echo $row['urutan']; ?>
				
        </p>
        <p>					
			No Telp/HP : <?php echo $row['no_telepon']; ?>
				
        </p>
        <p>					
			Email : <?php echo $row['email']; ?>
				
        </p></b>
        
		<p>
			<a href="update-biodata.php?code=<?php echo $row['code']; ?>"> <button type="button" class="btn btn-primary btn-lg btn-block">Edit</button></a>
		</p>
		<p>
			<a href="data.php"> <button type="button" class="btn btn-secondary btn-lg btn-block">Back</button></a>
		</p>
      </div>
      <div class="alert alert-success fade in">
        
      </div>
      <p>
      
      </p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
    </div>
    <div class="col-sm-7">
    
      <div class="row">
        <div class="col-sm-12">
          <div class="well text-left">
            <div class="panel-body">
              <h3>Kemampuan Berbahasa Asing :</h3>
              <p><?php
					$bhs = $row['bahasa'];
					$nilai = $row['nilai'];
					if (!empty($bhs)) {
					echo '                  
						Bahasa : '.$bhs.' Nilai : '.$nilai.'</p>                         
					';   
					}
				?>
				<p><?php
					$bhs = $row['bahasa2'];
					$nilai = $row['nilai2'];
					if (!empty($bhs)) {
					echo '                  
						Bahasa : '.$bhs.' Nilai : '.$nilai.'</p>                         
					';   
					}
				?>	
				<p><?php
					$bhs = $row['bahasa3'];
					$nilai = $row['nilai3'];
					if (!empty($bhs)) {
					echo '                  
						Bahasa : '.$bhs.' Nilai : '.$nilai.'</p>                         
					';   
					}
				?>	
				<p><?php
					$bhs = $row['bahasa4'];
					$nilai = $row['nilai4'];
					if (!empty($bhs)) {
					echo '                  
						Bahasa : '.$bhs.' Nilai : '.$nilai.'</p>                         
					';   
					}
				?>	
				<p><?php
					$bhs = $row['bahasa5'];
					$nilai = $row['nilai5'];
					if (!empty($bhs)) {
					echo '                  
						Bahasa : '.$bhs.' Nilai : '.$nilai.'</p>                         
					';   
					}
				?>													
               <p>
			<a href="update-bahasa.php?code=<?php echo $row['code']; ?>"> <button type="button" class="btn btn-primary btn-lg btn-block">Edit</button></a>
		</p>
		<p>
			<a href="data.php"> <button type="button" class="btn btn-secondary btn-lg btn-block">Back</button></a>
		</p>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        
        <div class="col-sm-12">
          <div class="well">
			 <h3 class="text-left">Kemampuan Merawat Pasien :</h3>  
            <p class="text-left"><?php
					$print = $row['cekup'];
					if ($print == yes) {
					echo '                  
						Re-Check-UP </p>                       
					';   
					}
				?>           
			<p class="text-left"><?php
					$print = $row['suap'];
					if ($print == yes) {
					echo '                  
						Meyuapi dan Memandikan Pasien </p>                       
					';   
					}
				?>    
			<p class="text-left"><?php
					$print = $row['sedot'];
					if ($print == yes) {
					echo '                  
						Sedot Dahak </p>                       
					';   
					}
				?>  
			<p class="text-left"><?php
					$print = $row['suntik'];
					if ($print == yes) {
					echo '                  
						Menyuntik Pasien </p>                       
					';   
					}
				?> 
			<p class="text-left"><?php
					$print = $row['pijit'];
					if ($print == yes) {
					echo '                  
						Memijat / Menemani Pasien </p>                       
					';   
					}
				?>    
			<p class="text-left"><?php
					$print = $row['buang'];
					if ($print == yes) {
					echo '                  
						Membantu Buang Air Kecil/Besar  </p>                       
					';   
					}
				?>                            
            <p>
			<a href="update-rawat.php?code=<?php echo $row['code']; ?>"> <button type="button" class="btn btn-primary btn-lg btn-block">Edit</button></a>
		</p>
		<p>
			<a href="data.php"> <button type="button" class="btn btn-secondary btn-lg btn-block">Back</button></a>
		</p>
          </div>
        </div>
      </div>
      <div class="row">
        
        <div class="col-sm-12">
          <div class="well">
			<h3 class="text-left">Menjaga Bayi / Anak Kecil :</h3>  
            <p class="text-left"><?php
					$print = $row['lahir'];
					if ($print == yes) {
					echo '                  
						Membantu Setelah Melahirkan  </p>                       
					';   
					}
				?>           
            <p class="text-left"><?php
					$print = $row['makan'];
					if ($print == yes) {
					echo '                  
						Menyuapi / Memberi Makan </p>                       
					';   
					}
				?>   
			<p class="text-left"><?php
					$print = $row['popok'];
					if ($print == yes) {
					echo '                  
						Mengganti Popok </p>                       
					';   
					}
				?> 
			<p class="text-left"><?php
					$print = $row['jg_anak'];
					if ($print == yes) {
					echo '                  
						Menjaga Anak </p>                       
					';   
					}
				?>  	
			<p class="text-left"><?php
					$print = $row['mandi'];
					if ($print == yes) {
					echo '                  
						Memandikan Bayi </p>                       
					';   
					}
				?> 
			<p class="text-left"><?php
					$print = $row['main'];
					if ($print == yes) {
					echo '                  
						Mengajak Bermain Anak </p>                       
					';   
					}
				?>
				  	 
            <p>
			<a href="update-menjaga.php?code=<?php echo $row['code']; ?>"> <button type="button" class="btn btn-primary btn-lg btn-block">Edit</button></a>
		</p>
		<p>
			<a href="data.php"> <button type="button" class="btn btn-secondary btn-lg btn-block">Back</button></a>
		</p>
          </div>
        </div>
      </div>
      <div class="row">
        
        <div class="col-sm-12">
          <div class="well">
			<h3 class="text-left">Pekerjaan Sehari - Hari : </h3>
            <p class="text-left"><?php
					$print = $row['masak1'];
					if ($print == yes) {
					echo '                  
						Memasak 3x Sehari </p>                       
					';   
					}
				?>
			<p class="text-left"><?php
					$print = $row['gosok'];
					if ($print == yes) {
					echo '                  
						Menggosok / Menyetrika </p>                       
					';   
					}
				?>
			<p class="text-left"><?php
					$print = $row['cuci'];
					if ($print == yes) {
					echo '                  
						Mencuci Pakaian </p>                       
					';   
					}
				?>
			<p class="text-left"><?php
					$print = $row['bersih'];
					if ($print == yes) {
					echo '                  
						Bersih - Bersih </p>                       
					';   
					}
				?>	
			<p class="text-left"><?php
					$print = $row['sayur'];
					if ($print == yes) {
					echo '                  
						Membeli Sayuran </p>                       
					';   
					}
				?>	
			<p class="text-left"><?php
					$print = $row['masak2'];
					if ($print == yes) {
					echo '                  
						Memasak Masakan Taiwan </p>                       
					';   
					}
				?>
			<p class="text-left"><?php
					$print = $row['kecil'];
					if ($print == yes) {
					echo '                  
						Membuat Makanan Kecil </p>                       
					';   
					}
				?>
			<p class="text-left"><?php
					$print = $row['mobil'];
					if ($print == yes) {
					echo '                  
						Mencuci Mobil </p>                       
					';   
					}
				?>	
			<p class="text-left"><?php
					$print = $row['hewan'];
					if ($print == yes) {
					echo '                  
						Memelihara Hewan </p>                       
					';   
					}
				?>											
            <p>
			<a href="update-sehari.php?code=<?php echo $row['code']; ?>"> <button type="button" class="btn btn-primary btn-lg btn-block">Edit</button></a>
		</p>
		<p>
			<a href="data.php"> <button type="button" class="btn btn-secondary btn-lg btn-block">Back</button></a>
		</p>
          </div>
        </div>
      </div>
      <div class="row">
        
        <div class="col-sm-12">
          <div class="well">
			<h3 class="text-left">Menyesuaikan Diri dengan Majikan</h3>  
            <p class="text-left"><?php
					$print = $row['anjing'];
					if ($print == yes) {
					echo '                  
						Takut Anjing </p>                       
					';   
					} else {
						echo '                  
						Tidak Takut Anjing </p>                       
					'; 
				}  
				?>	
			<p class="text-left"><?php 
			$print = $row['kuat'];
			if (!empty($print)) {
			echo 'Kuat Gendong '.$print.' Kg </p>'; 
		}
			?>
            <p class="text-left"><?php
					$print = $row['babi'];
					if ($print == yes) {
					echo '                  
						Makan Daging Babi </p>                       
					';   
					} else {
						echo '                  
						Tidak Makan Daging Babi </p>                       
					'; 
				}  
				?>	
            <p class="text-left"><?php
					$print = $row['akong'];
					if ($print == yes) {
					echo '                  
						Bersedia Memandikan Akong </p>                       
					';   
					}
				?>		
            <p>
			<a href="update-majikan.php?code=<?php echo $row['code']; ?>"> <button type="button" class="btn btn-primary btn-lg btn-block">Edit</button></a>
		</p>
		<p>
			<a href="data.php"> <button type="button" class="btn btn-secondary btn-lg btn-block">Back</button></a>
		</p>
          </div>
        </div>
      </div>     
    
    
    <div class="row">
        
        <div class="col-sm-12">
          <div class="well text-left">
			<h3 class="text-left">Pengalaman Kerja Luar Negeri</h3>  
            <p>					
			Negara : <?php echo $row['negara']; ?>
			</p>
            <p>					
			Masa Kerja : <?php echo $row['waktu']; ?>
			</p>
            <p>					
			Job Desk : <?php echo $row['kerja']; ?>
			</p>
			
            <p>
			<a href="update-luar.php?code=<?php echo $row['code']; ?>"> <button type="button" class="btn btn-primary btn-lg btn-block">Edit</button></a>
		</p>
		<p>
			<a href="data.php"> <button type="button" class="btn btn-secondary btn-lg btn-block">Back</button></a>
		</p>
          </div>
        </div>
      </div>     
    </div>
    
    
    
    
       <div class="col-sm-2 well">
      <div class="thumbnail">
        <p>Kelengkapan Dokumen:</p>
       
       
		 
		
      </div>     
       <p>
			<a href="add_img.php?code=<?php 
			
			$code = $_GET['code'];
			echo $row['code']; ?>"> <button type="button" class="btn btn-primary btn-lg btn-block">Edit</button></a>
		</p>
		<p>
			<a href="data.php"> <button type="button" class="btn btn-secondary btn-lg btn-block">Back</button></a>
		</p>
      
      
      
		 <div class="well"> 
        <p>Kartu Tanda Penduduk</p>
        <?php 
			$code = $_GET['code']; // assigment nim dengan nilai nim yang akan diedit
			
			$sql3 = mysqli_query($koneksi,"SELECT * FROM images WHERE tki_id='$code' AND jenis_img='ktp' ORDER BY img_id DESC"); // query untuk memilih entri data dengan nilai nim terpilih
			$row3 = mysqli_fetch_assoc($sql3);
		?>
		<img src="<?php echo $row3['image']; ?>" alt="" style="width:100px;height:50px;">
		<p></p>
		<p><?php echo $row3['tgl_up']; ?></p>
        
      </div>
      <div class="well">
        <p>Kartu Keluarga</p>
        <?php 
			$code = $_GET['code']; // assigment nim dengan nilai nim yang akan diedit
			
			$sql = mysqli_query($koneksi,"SELECT * FROM images WHERE tki_id='$code' AND jenis_img='kk' ORDER BY img_id DESC"); // query untuk memilih entri data dengan nilai nim terpilih
			$row4 = mysqli_fetch_assoc($sql);
		?>
        <img src="<?php echo $row4['image']; ?>" alt="" style="width:100px;height:50px;">
        <p></p>
		<p><?php echo $row4['tgl_up']; ?></p>
      </div>
      <div class="well">
        <p>Surat Izin Keluarga</p>
       <?php 
			$code = $_GET['code']; // assigment nim dengan nilai nim yang akan diedit
			
			$sql = mysqli_query($koneksi,"SELECT * FROM images WHERE tki_id='$code' AND jenis_img='sij' ORDER BY img_id DESC"); // query untuk memilih entri data dengan nilai nim terpilih
			$row7 = mysqli_fetch_assoc($sql);
		?>
        <img src="<?php echo $row7['image']; ?>" alt="" style="width:100px;height:50px;">
        <p></p>
		<p><?php echo $row7['tgl_up']; ?></p>
      </div>
      <div class="well">
        <p>Akta Kelahiran / Surat Kenal Lahir</p>
        <?php 
			$code = $_GET['code']; // assigment nim dengan nilai nim yang akan diedit
			
			$sql = mysqli_query($koneksi,"SELECT * FROM images WHERE tki_id='$code' AND jenis_img='akte' ORDER BY img_id DESC"); // query untuk memilih entri data dengan nilai nim terpilih
			$row5 = mysqli_fetch_assoc($sql);
		?>
        <img src="<?php echo $row5['image']; ?>" alt="" style="width:100px;height:50px;">
        <p></p>
		<p><?php echo $row5['tgl_up']; ?></p>
	</div>
      <div class="well">
        <p>Surat Nikah</p>
        <?php 
			$code = $_GET['code']; // assigment nim dengan nilai nim yang akan diedit
			
			$sql = mysqli_query($koneksi,"SELECT * FROM images WHERE tki_id='$code' AND jenis_img='nikah' ORDER BY img_id DESC"); // query untuk memilih entri data dengan nilai nim terpilih
			$row6 = mysqli_fetch_assoc($sql);
		?>
        <img src="<?php echo $row6['image']; ?>" alt="" style="width:100px;height:50px;">
        <p></p>
		<p><?php echo $row6['tgl_up']; ?></p>
      </div>
      <div class="well">
        <p>Ijazah</p>
        <img src="<?php echo $row['ijazah']; ?>" alt="" style="width:100px;height:50px;">
      </div>
      <p>
			<a href="add_img.php?code=<?php 
			
			$code = $_GET['code'];
			echo $row['code']; ?>"> <button type="button" class="btn btn-primary btn-lg btn-block">Edit</button></a>
		</p>
		<p>
			<a href="data.php"> <button type="button" class="btn btn-secondary btn-lg btn-block">Back</button></a>
		</p>
    </div>
  </div>
</div>

</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php 
include("footer.php"); // memanggil file footer.php
?>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>
