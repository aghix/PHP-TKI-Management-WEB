<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database

?>

<!DOCTYPE htm>

    <head>
        <title>Dynamic Form Processing with PHP | Tech Stream</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        
		<script type="text/javascript" src="js/script.js"></script> 
    </head>
    <body>   
		<div class="container">
		<div class="content">
			<h2>Data Tenaga Kerja &raquo; Pengajuan Kebutuhan Dana</h2>
			<hr /> 
        <form action="process.php" class="register" method="POST">
            
            <fieldset class="row2">
				<legend>Input Item PKD</legend>
						   <p>	PKD Number: 				
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
$result = mysqli_query($koneksi, "SELECT MAX(`no`) AS comment_id FROM `pkd`");
    					while ($row = mysqli_fetch_assoc($result)) {
        				$no_pkd = $row['comment_id'] +1;             
            			}
$mnth = date('m');
$year = date('Y');
$tgl = date('Y/m/d');
$code = $_GET['code'];
$sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE code='$code'"); 
$row = mysqli_fetch_assoc($sql);
$ctki = $row['ctki'];
$user = $userRow['lvl'];
$admin = $userRow['username'];		
			
			
				
			echo '
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">			
			<label type="" name="no_pkd" class="" value="'.$no_pkd.'/'.integerToRoman($mnth).'/'.$year.'">'.$no_pkd.'/'.integerToRoman($mnth).'/'.$year.'</label>
			</form>
			';
		
			
			

?>			
			
        </p>
        <p >	
			Tanggal : <label name="tgl"><b><?php echo $tgl ; ?></b></label>
			</p>
			<p>	
			Admin : <label name="user"><b><?php echo $admin ; ?></b>
			</p>
				<p> 
					<input type="button" value="Tambah Item" onClick="addRow('dataTable')" /> 
					<input type="button" value="Hapus Item" onClick="deleteRow('dataTable')"  /> 
					<p>(Menghapus hanya Item yang ditandai)</p>
				</p>
               <table id="dataTable" >
                  <tbody>
                    <tr>
                      <p>
						<td ><input class="form-control" type="checkbox" required="required" name="chk[]"  /></td>
						<td>
							<label ></label>
							<select name="item[]" class="form-control" required>
							<option value=""> -Choose- </option>
							<option value="sps_dp">Sponsor DP</option>
							<option value="sps_lunas">Sponsor Pelunasan</option>
							<option value="medical">Medical</option>
							<option value="id_asuransi">ID & Asuransi</option>
							<option value="pel_blk">Pelatihan BLK</option>							
							<option value="passpor">Passpor</option>
														
						</select>
						 </td>
						<td>
							<label></label>
							<select class="form-control" type="text" required="required" name="BX_NAME[]">
								<option value=""> -Pilih TKI- </option>
							<?php
								$query = "SELECT * FROM mahasiswa WHERE label = 'valid' AND ctki > '' ORDER BY ctki ASC";
								$result = mysqli_query($koneksi, $query);
    							while ($row2 = mysqli_fetch_assoc($result)) {

									unset($line);
									$line = $row2['nama'];
									$line2 =  $row2['ctki'];
									$line3 = $row2['code'];
									$line4 = $row2['tujuan'];
										echo '                  
										<option value="'.$line.'">'.$line.' CTKI: '.$line2.' ID:'.$line3.' Remarks : '.$line4.'</option>                         
										';
									}
							$DBcon->close();
							?>				
							</select>
						 </td>
						 
						<td>
							<label for="BX_amount"></label>
							<input class="form-control" type="text" required="required" class="small"  name="BX_amount[]" placeholder="Input Nominal Amount">
					     </td>
					     
						 </td>
							</p>
                    </tr>
                    </tbody>
                </table>
				<div class="clear"></div>
            </fieldset>
            <div class="clear"></div>
            <div class="clear"></div>
            <br>
            <br>
            <br>
			<input name="add" class="submit" type="submit" value="Confirm &raquo;" />
			
			
			<div class="clear"></div>
        </form>
		
    </body>
	<!-- Start of StatCounter Code for Default Guide -->

</html>





