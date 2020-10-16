


<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database

?>
	<div class="container">
		<div class="content">
			<h2>Data Tenaga Kerja &raquo; Pendaftaran Baru</h2>
			<hr />
			
			<?php
			if(isset($_POST['add'])){ // jika tombol 'Simpan' dengan properti name="add" pada baris 164 ditekan

				$code		     = $_POST['code'];
				$pt_code		 = $_POST['pt_code'];
				$tgl_daftar 	 = date('d/m/Y');
				$pt_sponsor	     = $_POST['pt_sponsor'];
				$nm_sponsor		 = $_POST['nm_sponsor'];
				$nama		     = $_POST['nama'];
				$alamat_rtrw     = $_POST['alamat_rtrw'];
				$kab_kec		 = $_POST['kab_kec'];
				$prov_pos		 = $_POST['prov_pos'];
				$jenis_kelamin   = $_POST['jenis_kelamin'];
				$tempat_lahir	 = $_POST['tempat_lahir'];
				$tanggal_lahir	 = $_POST['tanggal_lahir'];
				$umur            = $_POST['umur'];
				$b_badan		 = $_POST['b_badan'];
				$t_badan		 = $_POST['t_badan'];
				$status    	     = $_POST['status'];
				$anak			 = $_POST['anak'];
				$sdr			 = $_POST['sdr'];
				$urutan    	     = $_POST['urutan'];
				$status    	     = $_POST['status'];
				$anak			 = $_POST['anak'];
				$sdr			 = $_POST['sdr'];
				$no_telepon		 = $_POST['no_telepon'];
				$email  		 = $_POST['email'];
				$cekup    	     = $_POST['cekup'];
				$suap			 = $_POST['suap'];
				$sedot			 = $_POST['sedot'];
				$suntik    	     = $_POST['suntik'];
				$pijit			 = $_POST['pijit'];
				$buang			 = $_POST['buang'];
				$lahir    	     = $_POST['lahir'];
				$makan			 = $_POST['makan'];
				$popok			 = $_POST['popok'];
				$jg_anak    	 = $_POST['jg_anak'];
				$mandi			 = $_POST['mandi'];
				$main			 = $_POST['main'];
				$gosok    	     = $_POST['gosok'];
				$cuci			 = $_POST['cuci'];
				$bersih			 = $_POST['bersih'];
				$sayur    	     = $_POST['sayur'];
				$masak			 = $_POST['masak1'];
				$kecil			 = $_POST['kecil'];
				$mobil    	     = $_POST['mobil'];
				$hewan			 = $_POST['hewan'];
				$masak			 = $_POST['masak2'];
				$anjing    	     = $_POST['anjing'];
				$kuat			 = $_POST['kuat'];
				$babi			 = $_POST['babi'];
				$akong    	     = $_POST['akong'];
				$negara			 = $_POST['negara'];
				$waktu			 = $_POST['waktu'];
				$kerja    	     = $_POST['kerja'];
				$formal    	     = $_POST['formal'];
				$agama    	     = $_POST['agama'];
				$bahasa		 	 = $_POST['bahasa'];
				$bahasa2		 = $_POST['bahasa2'];
				$bahasa3    	 = $_POST['bahasa3'];
				$bahasa4		 = $_POST['bahasa4'];
				$bahasa5    	 = $_POST['bahasa5'];
				$nilai			 = $_POST['nilai'];
				$nilai2			 = $_POST['nilai2'];				
				$nilai3			 = $_POST['nilai3'];		
				$nilai4			 = $_POST['nilai4'];		
				$nilai5			 = $_POST['nilai5'];		
				$tujuan    		 = $_POST['tujuan'];
				$pend			 = $_POST['pendidikan'];
				$new			 = 'new';
				$user = $userRow['username'];
				
				//engine upload image
						
				
$image			 = $_FILES['image']['name'];
		
if ($image)
{
//get the original name of the file from the clients machine
$filename = stripslashes($_FILES['image']['name']);
//we will give an unique name, for example the time in unix time format
$image_name=time().'';
//the new name will be containing the full path where will be stored (images folder)
$newname="uploads/".$image_name.$image;
//we verify if the image has been uploaded,
$copied = copy($_FILES['image']['tmp_name'], $newname);
}


$image2			 = $_FILES['image2']['name'];
if ($image2)
{
//get the original name of the file from the clients machine
$filename = stripslashes($_FILES['image2']['name']);
//we will give an unique name, for example the time in unix time format
$image_name=time().'';
//the new name will be containing the full path where will be stored (images folder)
$newname2="uploads/".$image_name.$image2;
//we verify if the image has been uploaded,
$copied = copy($_FILES['image2']['tmp_name'], $newname2);
}


$image3			 = $_FILES['image3']['name'];		
if ($image3)
{
//get the original name of the file from the clients machine
$filename = stripslashes($_FILES['image3']['name']);
//we will give an unique name, for example the time in unix time format
$image_name=time().'';
//the new name will be containing the full path where will be stored (images folder)
$newname3="uploads/".$image_name.$image3;
//we verify if the image has been uploaded,
$copied = copy($_FILES['image3']['tmp_name'], $newname3);
}
//mailer engine line

include("sendmail.php");

						$result = mysqli_query($koneksi, "SELECT MAX(`code`) AS comment_id FROM `mahasiswa`");
    					while ($row = mysqli_fetch_assoc($result)) {
        				$id_baru = $row['comment_id'] +1;             
            			}
            			


$subject = 'Berikut data yang telah berhasil di upload :';

$mail->Subject = "Daftar Baru";
$mail->SetFrom("notification@cakrawalasejahtera.com", "Cakrawala Notification Engine");
$mail->AddReplyTo("no-replay@cakrawalasejahtera.com", "No Replay");
$mail->AddAddress("admintki@cakrawalasejahtera.com");
//$mail->AddCC("btk@cakrawalasejahtera.com", "Bonar T Kalalo");
//$mail->AddCC("fnwooy@cakrawalasejahtera.com", "Fidya N Wooy");
$mail->AddCC("ahmad@cakrawalasejahtera.com", "Ahmad Irwansyah");

$content = "
<b>Data Biodata Baru!!!</b>
<p>
Nama :<b> ".$nama."</b>
</p>
<p>
ID :<b> ".$id_baru."</b>
</p>
<p>
Code PT :<b> ".$pt_code."</b>
</p>
<p>
Tanggal :<b> ".$tgl_daftar."</b>
</p>
<p>
Negara Tujuan : <b>".$tujuan."</b>
</p>
<p>
Pekerjaan : <b>".$formal."</b>
</p>
<p>
Alamat : <b>".$alamat_rtrw."</b>
</p>
<p>
      <b>  ".$kab_kec." ".$prov_pos."</b>
</p>


<p>
Di input Oleh : <b>".$user."</b>
</p>
<p>

</p>


"; 

$mail->MsgHTML($content);
$mail->IsHTML(true);
if(!$mail->Send()) {
echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Email not Sent! </div>'; // maka tampilkan 'Ups, Data Mahasiswa Gagal Di simpan!'
}else{ 
echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Email Sent. </div>'; // maka tampilkan 'Data Mahasiswa Berhasil Di Simpan.'
}



//mailer engine line

				//~ engine insert to database
				
				$cek = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); // query untuk memilih entri dengan nim terpilih
				$insert = mysqli_query($koneksi, "INSERT INTO mahasiswa													
(
code,nama,tgl_daftar,nm_sponsor,pt_sponsor,tujuan,formal,
jenis_kelamin,tempat_lahir,tanggal_lahir,alamat_rtrw,kab_kec,
prov_pos,agama,b_badan,t_badan,status,anak,sdr,
urutan,bahasa,bahasa2,bahasa3,bahasa4,bahasa5,nilai,
nilai2,nilai3,nilai4,nilai5,no_telepon,email,cekup,suap,sedot,suntik,pijit,buang,lahir,
makan,popok,jg_anak,mandi,main,gosok,cuci,bersih,sayur,masak1,kecil,mobil,hewan,
masak2,anjing,kuat,babi,akong,negara,waktu,kerja,foto,label,user_input,pend
) 

VALUES

('$code', '$nama', '$tgl_daftar', '$nm_sponsor',
 '$pt_sponsor', '$tujuan', '$formal','$jenis_kelamin', '$tempat_lahir',
 '$tanggal_lahir', '$alamat_rtrw', '$kab_kec', '$prov_pos',
 '$agama', '$b_badan', '$t_badan', '$status', '$anak', '$sdr',
 '$urutan', '$bahasa', '$bahasa2', '$bahasa3', '$bahasa4', '$bahasa5','$nilai',
 '$nilai2','$nilai3', '$nilai4', '$nilai5', '$no_telepon', '$email','$cekup','$suap','$sedot','$suntik','$pijit',
 '$buang','$lahir','$makan','$popok','$jg_anak','$mandi','$main','$gosok','$cuci','$bersih','$sayur','$masak1','$kecil',
 '$mobil','$hewan','$masak2','$anjing','$kuat','$babi','$akong','$negara','$waktu','$kerja','$newname','$new','$user','$pend'
)") or die(mysqli_error()); // query untuk menambahkan data ke dalam database



						if($insert){ // jika query insert berhasil dieksekusi
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data TKI Berhasil Di Simpan. <a href="data.php"><- Kembali</a></div>'; // maka tampilkan 'Data Mahasiswa Berhasil Di Simpan.'
						}else{ // jika query insert gagal dieksekusi
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data TKI Gagal Di simpan! <a href="data.php"><- Kembali</a></div>'; // maka tampilkan 'Ups, Data Mahasiswa Gagal Di simpan!'
						}
				//	} else{ // mengecek jika password yang diinput tidak sama
				//		echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password Tidak sama!</div>'; // maka tampilkan 'Password Tidak sama!'

				
					
					}
			//	}else{ // mengecek jika nim yang akan ditambahkan sudah ada dalam database
			//		echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>NIM Sudah Ada..! <a href="data.php"><- Kembali</a></div>'; // maka tampilkan 'nim Sudah Ada..!'
			//	}
		//	}
			?>
			<!-- bagian ini merupakan bagian form untuk menginput data yang akan dimasukkan ke database -->
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

				<div class="form-group">
					<label class="col-sm-3 control-label">No</label>
					<div class="col-sm-2">
						<label class="control-label">
					<?php

						$result = mysqli_query($koneksi, "SELECT MAX(`code`) AS comment_id FROM `mahasiswa`");
    					while ($row = mysqli_fetch_assoc($result)) {
        				$id_baru = $row['comment_id'] +1; 
        				if($id_baru < 10){
							echo '00'.$id_baru.' ';
							if($id_baru > 10){
								echo '0'.$id_baru.' ';
								}
									
							}
								else{
									echo $id_baru;
								}
							}     
							

    					


					?>
						</label>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal Daftar</label>
					<div class="col-sm-2">
						<label class="control-label"> 
						<?php 
							echo "" . date('d/m/Y');
						?>
						</label>
					</div>
				</div>
<!--
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Sponsor</label>
					<div class="col-sm-2">
						<select name="nm_sponsor" class="form-control" required>
							<option value=""> -Choose- </option>
							<?php
								include("dbconn.php");
								$result = $DBcon->query("SELECT * FROM nama_sps ORDER BY id ASC");
    							while ($row = $result->fetch_assoc()) {

									unset($name);
									$name = $row['nm_sps']; 
										echo '                  
										<option value="'.$name.'">'.$name.'</option>                         
										';
									}
							$DBcon->close();
							?>										
						</select>
					</div>
				</div>
-->
<!--

				<div class="form-group">
					<label class="col-sm-3 control-label">PT</label>
					<div class="col-sm-2">
						<select name="pt_sponsor" class="form-control" required>
							<option value=""> -Choose- </option>
							
								<?php
								include("dbconn.php");
								$result = $DBcon->query("SELECT * FROM nama_pt ORDER BY id ASC");
    							while ($row = $result->fetch_assoc()) {

									unset($name);
									$name = $row['nm_pt']; 
										echo '                  
										<option value="'.$name.'">'.$name.'</option>                         
										';
									}
							$DBcon->close();
							?>						
						</select>
					</div>
				</div>
				
-->
				<div class="form-group">
					<label class="col-sm-3 control-label">Code Biodata / PT Sponsor</label>
					<div class="col-sm-4">
						<input type="text" name="pt_code" class="form-control" placeholder="Code PT Sponsor" required>
					</div>
					</div>
					
				<div class="form-group">
					<label class="col-sm-3 control-label">Negara Tujuan</label>
					<div class="col-sm-2">
						<select name="tujuan" class="form-control" required>
							<option value=""> -Choose- </option>
							<option value="Malaysia">Malaysia</option>
							<option value="Taiwan">Taiwan</option>
							<option value="Brunei">Brunei</option>
							<option value="Hongkong">Hongkong</option>
							<option value="South Korea">Korea Selatan</option>							
							<option value="Japan">Japan</option>
							<option value="Singapore">Singapore</option>							
						</select>
					</div>
				</div>	
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Pekerjaan</label>
					<div class="col-sm-2">
						<select name="formal" class="form-control" required>
							<option value=""> -Choose- </option>
							<option value="Formal">Formal</option>
							<option value="Informal">Informal</option>							
						</select>
					</div>
				</div>
				
				<div class="form-group"></div>
				<div class="form-group"></div>


				<div class="form-group">
					<label class="col-sm-3 control-label">Nama Lengkap Tenaga Kerja</label>
					<div class="col-sm-4">
						<input type="text" name="nama" class="form-control" placeholder="Nama" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat</label>
					<div class="col-sm-4">
						<input type="text" name="alamat_rtrw" class="form-control" placeholder="Jl.Contoh RT02/RW03" required>
					</div>
					</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Kec/Kab</label>
					<div class="col-sm-4">
						<input type="text" name="kab_kec" class="form-control" placeholder="e.g Cikini Menteng" required>
					</div>
					</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Provinsi</label>
					<div class="col-sm-2">
						<select name="prov_pos" class="form-control" >		  
							<option value=""> -Provinsi- </option>
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
								</select>
					</div>
					</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Jenis Kelamin</label>
					<div class="col-sm-2">
						<select name="jenis_kelamin" class="form-control" required>
							<option value=""> -Pilih- </option>
							<option value="Laki-Laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tempat Lahir</label>
					<div class="col-sm-4">
						<input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tanggal Lahir</label>
					<div class="col-sm-3">
						<input type="text" id="datepicker" name="tanggal_lahir" class="input-group  form-control" date="" data-date-format="dd-mm-yyyy" placeholder=" DD-MM-YYYY" value="  -Choose-"required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Agama</label>
					<div class="col-sm-2">
						<select name="agama" class="form-control" required>
							<option value=""> -Choose- </option>
							<option value="Moslem">Moslem</option>
							<option value="Christian">Christian</option>
							<option value="Catholic">Catholic</option>
							<option value="Hindu">Hindu</option>
							<option value="Budha">Budha</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Berat Badan</label>
					<div class="col-sm-3">
						<input type="text" name="b_badan" class="form-control" placeholder="e.g 60" required> 
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Tinggi Badan</label>
					<div class="col-sm-3">
						<input type="text" name="t_badan" class="form-control" placeholder="e.g 160" required> 
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Pendidikan Terakhir</label>
					<div class="col-sm-2">
						<select name="pendidikan" class="form-control" required>
							<option value=""> -Pilih- </option>
							<option value="Elementary School">Sekolah Dasar</option>
							<option value="Junior High School">Sekolah Menengah Pertama</option>
							<option value="Senior High School">Sekolah Menengah Atas</option>	
							<option value="Coledge University">Sarjana</option>							
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Status</label>
					<div class="col-sm-2">
						<select name="status" class="form-control" required>
							<option value=""> -Pilih- </option>
							<option value="kawin">Kawin</option>
							<option value="single">Single</option>
							<option value="cerai">Cerai</option>							
						</select>
					</div>
				</div>				
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Jumlah Anak</label>
					<div class="col-sm-3">
						<input type="text" name="anak" class="form-control" placeholder="Masukan 0 Jika tdk ada" > 
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Jumlah Saudara</label>
					<div class="col-sm-3">
						<input type="text" name="sdr" class="form-control" placeholder="Masukan 0 Jika tdk ada" required> 
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Anak Ke</label>
					<div class="col-sm-3">
						<input type="text" name="urutan" class="form-control" placeholder="Anak ke brp?" required> 
					</div>
				</div>
				
				<div class="form-group"></div>
				<div class="form-group"></div>
				
				
				<div class="form-group"></div>
				<div class="form-group"></div>

				<div class="form-group" value="bahasa">     	   
		<label class="col-sm-3 control-label">Kemampuan Bahasa Asing</label>    
		<div class="col-sm-2"> 
           <select name="bahasa" class="form-control" >
							<option value=""> -Pilih- </option>
							<option value="English">Inggris</option>
							<option value="Mandarin">Mandarin</option>
							<option value="Cantonesse">Canton</option>	
							<option value="Japanesse">Jepang</option>
							<option value="Hangul">Korea</option>						
			</select>      

		</div>		
		<div class="col-sm-2 ">
			<select name="nilai" class="form-control" >
							<option value=""> -Nilai- </option>
							<option value="Kurang">Kurang</option>
							<option value="Sedang">Sedang</option>
							<option value="Baik">Baik</option>											
						</select>
		</div>
	</div>					
						
				<div class="form-group" value="bahasa2">     	   
		<label class="col-sm-3 control-label">Pilih Jika Lebih dari 1</label>    
		<div class="col-sm-2"> 
           <select name="bahasa2" class="form-control" >
							<option value=""> -Pilih- </option>
							<option value="English">Inggris</option>
							<option value="Mandarin">Mandarin</option>
							<option value="Cantonesse">Canton</option>	
							<option value="Japanesse">Jepang</option>
							<option value="Hangul">Korea</option>						
			</select>      
		</div>		
		<div class="col-sm-2 ">
			<select name="nilai2" class="form-control" >
							<option value=""> -Nilai- </option>
							<option value="Kurang">Kurang</option>
							<option value="Sedang">Sedang</option>
							<option value="Baik">Baik</option>							
						</select>
		</div>
	</div>

				<div class="form-group" value="bahasa3">     	   
		<label class="col-sm-3 control-label"></label>    
		<div class="col-sm-2"> 
           <select name="bahasa3" class="form-control" >
							<option value=""> -Pilih- </option>
							<option value="English">Inggris</option>
							<option value="Mandarin">Mandarin</option>
							<option value="Cantonesse">Canton</option>	
							<option value="Japanesse">Jepang</option>
							<option value="Hangul">Korea</option>				
			</select>      
		</div>		
		<div class="col-sm-2 ">
			<select name="nilai3" class="form-control" >
							<option value=""> -Nilai- </option>
							<option value="Kurang">Kurang</option>
							<option value="Sedang">Sedang</option>
							<option value="Baik">Baik</option>							
						</select>
		</div>
	</div>

				<div class="form-group" value="bahasa4">     	   
		<label class="col-sm-3 control-label"></label>    
		<div class="col-sm-2"> 
           <select name="bahasa4" class="form-control" >
							<option value=""> -Pilih- </option>
							<option value="English">Inggris</option>
							<option value="Mandarin">Mandarin</option>
							<option value="Cantonesse">Canton</option>	
							<option value="Japanesse">Jepang</option>
							<option value="Hangul">Korea</option>					
			</select>      
		</div>		
		<div class="col-sm-2 ">
			<select name="nilai4" class="form-control" >
							<option value=""> -Nilai- </option>
							<option value="Kurang">Kurang</option>
							<option value="Sedang">Sedang</option>
							<option value="Baik">Baik</option>							
						</select>
		</div>
	</div>

				<div class="form-group" value="bahasa5">     	   
		<label class="col-sm-3 control-label"></label>    
		<div class="col-sm-2"> 
           <select name="bahasa5" class="form-control" >
							<option value=""> -Pilih- </option>
							<option value="English">Inggris</option>
							<option value="Mandarin">Mandarin</option>
							<option value="Cantonesse">Canton</option>	
							<option value="Japanesse">Jepang</option>
							<option value="Hangul">Korea</option>						
			</select>      
		</div>		
		<div class="col-sm-2 ">
			<select name="nilai5" class="form-control" >
							<option value=""> -Nilai- </option>
							<option value="Kurang">Kurang</option>
							<option value="Sedang">Sedang</option>
							<option value="Baik">Baik</option>							
						</select>
		</div>
	</div>
				

				<div class="form-group"></div>
				<div class="form-group"></div>
				
				
				<div class="form-group"></div>
				<div class="form-group"></div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">No Telepon</label>
					<div class="col-sm-3">
						<input type="text" name="no_telepon" class="form-control" placeholder="No Telepon" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Email</label>
					<div class="col-sm-3">
						<input type="email" name="email" class="form-control" placeholder="Email" >
					</div>
				</div>
				
				<div class="form-group"></div>
				<div class="form-group"></div>
				
				
				<div class="form-group"></div>
				<div class="form-group"></div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Skills/Kemampuan</label>
					<div >
					<label class="control-label">Merawat Orang Sakit</label>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Re-CheckUp</label>
					<div class="col-sm-2">
						<input type="radio" name="cekup" value="yes">Yes
					<p> <input type="radio" name="cekup" value="no">No
					</p>

					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Menyuapi/Memandikan</label>

				<div class="col-sm-2">
						<input type="radio" name="suap" value="yes">Yes
					<p>
						<input type="radio" name="suap" value="no">No
					</p>

				</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Sedot Dahak</label>

				<div class="col-sm-2">
						<input type="radio" name="sedot" value="yes">Yes
					<p>
						<input type="radio" name="sedot" value="no">No
					</p>

				</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Menyuntik Pasien</label>

				<div class="col-sm-2">
						<input type="radio" name="suntik" value="yes">Yes
					<p>
						<input type="radio" name="suntik" value="no">No
					</p>

				</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Memijat/Menemani Pasien</label>

				<div class="col-sm-2">
						<input type="radio" name="pijit" value="yes">Yes
					<p>
						<input type="radio" name="pijit" value="no">No
					</p>

				</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Membantu Buang Air Kecil/Besar</label>

				<div class="col-sm-2">
						<input type="radio" name="buang" value="yes">Yes
					<p>
						<input type="radio" name="buang" value="no">No
					</p>

				</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Skills/Kemampuan</label>
					<div >
					<label class="control-label">Menjaga Bayi / Anak Kecil</label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Membantu Setelah Melahirkan</label>

				<div class="col-sm-2">
						<input type="radio" name="lahir" value="yes">Yes
					<p>
						<input type="radio" name="lahir" value="no">No
					</p>

				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Menyuapi / Memberi Makan</label>

				<div class="col-sm-2">
						<input type="radio" name="makan" value="yes">Yes
					<p>
						<input type="radio" name="makan" value="no">No
					</p>

				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Mengganti Popok</label>

				<div class="col-sm-2">
						<input type="radio" name="popok" value="yes">Yes
					<p>
						<input type="radio" name="popok" value="no">No
					</p>

				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Menjaga Anak</label>

				<div class="col-sm-2">
						<input type="radio" name="jg_anak" value="yes">Yes
					<p>
						<input type="radio" name="jg_anak" value="no">No
					</p>

				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Memandikan Bayi</label>

				<div class="col-sm-2">
						<input type="radio" name="mandi" value="yes">Yes
					<p>
						<input type="radio" name="mandi" value="no">No
					</p>

				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Mengajak Bermain Anak</label>

				<div class="col-sm-2">
						<input type="radio" name="main" value="yes">Yes
					<p>
						<input type="radio" name="main" value="no">No
					</p>

				</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Skills/Kemampuan</label>
					<div >
					<label class="control-label">Pekerjaan Sehari - hari</label>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Memasak 3x Sehari</label>

				<div class="col-sm-2">
						<input type="radio" name="masak1" value="yes">Yes
					<p>
						<input type="radio" name="masak1" value="no">No
					</p>

				</div>
				</div>


				<div class="form-group">
					<label class="col-sm-3 control-label">Menggosok / Setrika</label>

				<div class="col-sm-2">
						<input type="radio" name="gosok" value="yes">Yes
					<p>
						<input type="radio" name="gosok" value="no">No
					</p>

				</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Cuci Baju</label>

				<div class="col-sm-2">
						<input type="radio" name="cuci" value="yes">Yes
					<p>
						<input type="radio" name="cuci" value="no">No
					</p>

				</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Bersih - bersih</label>

				<div class="col-sm-2">
						<input type="radio" name="bersih" value="yes">Yes
					<p>
						<input type="radio" name="bersih" value="no">No
					</p>

				</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Membeli Sayur</label>

				<div class="col-sm-2">
						<input type="radio" name="sayur" value="yes">Yes
					<p>
						<input type="radio" name="sayur" value="no">No
					</p>

				</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Masakan Taiwan</label>

				<div class="col-sm-2">
						<input type="radio" name="masak2" value="yes">Yes
					<p>
						<input type="radio" name="masak2" value="no">No
					</p>

				</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Membuat Makanan Kecil</label>

				<div class="col-sm-2">
						<input type="radio" name="kecil" value="yes">Yes
					<p>
						<input type="radio" name="kecil" value="no">No
					</p>

				</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Mencuci Mobil</label>
				<div class="col-sm-2">
						<input type="radio" name="mobil" value="yes">Yes
					<p>
						<input type="radio" name="mobil" value="no">No
					</p>

				</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Memelihara Hewan</label>
				<div class="col-sm-2">
						<input type="radio" name="hewan" value="yes">Yes
					<p>
						<input type="radio" name="hewan" value="no">No
					</p>

				</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Menyesuaikan Diri Dengan Kondisi Majikan</label>
					<div >
					<label class="control-label"></label>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Apakah Takut Anjing</label>
				<div class="col-sm-2">
						<input type="radio" name="anjing" value="yes">Yes
					<p>
						<input type="radio" name="anjing" value="no">No
					</p>

				</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Kuat Gendong brp ... Kg</label>
					<div class="col-sm-3">
						<input type="kuat" name="kuat" class="form-control" placeholder="e.g 30" >
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Apakah Makan Babi</label>
				<div class="col-sm-2">
						<input type="radio" name="babi" value="yes">Yes
					<p>
						<input type="radio" name="babi" value="no">No
					</p>

				</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Bersedia Memandikan Akong</label>
				<div class="col-sm-2">
						<input type="radio" name="akong" value="yes">Yes
					<p>
						<input type="radio" name="akong" value="no">No
					</p>

				</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Pengalaman Kerja</label>
					<div >
					<label class="control-label">Luar Negeri</label>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Negara</label>
					<div class="col-sm-3">
						<input type="negara" name="negara" class="form-control" placeholder="e.g Malaysia" >
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Masa Kerja (Tahun)</label>
					<div class="col-sm-3">
						<input type="kerja" name="waktu" class="form-control" placeholder="e.g 2007-2010" >
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Job Description</label>
					<div class="col-sm-3">
						<input type="kerja" name="kerja" class="form-control" placeholder="e.g Restoran" >
					</div>
				</div>
				
				<div class="form-group"></div>
				<div class="form-group"></div>
				
			<div class="form-group">
				<label for="file" class="control-label col-sm-3" required>Pas Foto Tenaga Kerja</label>				
			<div class="col-sm-4">
				<input name="image" type="file" class="file" required> 
				</div>
				</div>
			
			
				
				
				
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data Tenaga Kerja">
						<a href="index.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>




		



    	
					
				

<?php 
include("footer.php"); // memanggil file footer.php
?>
