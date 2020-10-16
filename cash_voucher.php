<?php 
ob_start();
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<script type="text/javascript">
$(document).ready(function() {
$("input[type=checkbox]").change(function(){
  recalculate();
});
function recalculate(){
    var sum = 0;    
    $("input[type=checkbox]:checked").each(function(){
      sum += parseInt($(this).attr("rel"));  
      });
  //  alert(sum);
var bilangan = sum;
		
var	reverse = bilangan.toString().split('').reverse().join(''),
	ribuan 	= reverse.match(/\d{1,3}/g);
	ribuan	= ribuan.join('.').split('').reverse().join('');
$('#output').val(ribuan +',-');
}
});

$(document).ready(function() {
$("input[type=checkbox]").change(function(){
  recalculate2();
});
function recalculate2(){
    var sum2 = 0;    
    $("input[type=checkbox]:checked").each(function(){
      sum2 += parseInt($(this).attr("rel2"));  
      });
  //  alert(sum);
var bilangan2 = sum2;
		
var	reverse = bilangan2.toString().split('').reverse().join(''),
	ribuan2 	= reverse.match(/\d{1,3}/g);
	ribuan2	= ribuan2.join('.').split('').reverse().join('');
$('#output2').val(ribuan2 +',-');
}
});
</script>

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
$result2 = mysqli_query($koneksi, "SELECT MAX(`id_cash`) AS comment_id FROM `cash`");
    					while ($row = mysqli_fetch_assoc($result2)) {
        				$id_cash = $row['comment_id'] +1;        				
        				$min1 = '1';
        				$max1 = '9';
        				$min2 = '10';
						$max2 = '99';						
        				if (($min1 <= $id_cash) && ($id_cash <= $max1)){
							$id_cash_asli = '00'.$id_cash.'';
							}
						if(($min2 <= $id_cash) && ($id_cash <= $max2)){
							$id_cash_asli = '0'.$id_cash.'';
							} 
						if($id_cash > 99){
							$id_cash_asli = $id_cash;
							} 							           
            			}
$mnth = date('m');
$rom_mnth = integerToRoman($mnth);
$year = date('Y');
$tgl = date('Y/m/d');
$user = $userRow['lvl'];
$cash = 'CASH';
$admin = $userRow['username'];	
$hasil = array ($id_cash_asli, $cash, $rom_mnth, $year);	
$hasil = 		implode("/",$hasil);

	
?>

<?php

if (isset($_POST['pay_cash'])){
$output = $_POST['output'];
$output2 = $_POST['output2'];
$output3 = $_POST['output3'];
$output4 = $_POST['output4'];
$bad_symbols = array(",", ".", "-");
$jumlah = str_replace($bad_symbols, "", $output);
$jumlah2 = str_replace($bad_symbols, "", $output2);
$jumlah3 = str_replace($bad_symbols, "", $output3);
$jumlah4 = str_replace($bad_symbols, "", $output4);
$new	= 'new';


if (isset($_POST['selected'])){
	$checkbox=$_POST['selected'];
	
if(!empty($_POST['selected'])) {
	$n = 0;	
	 foreach($_POST['selected'] as $selected => $id_ctki) {		 
		$sql = mysqli_query($koneksi, "UPDATE ctki SET id_cash = '$hasil' WHERE voucher='$id_ctki'");        
        $n++; 
			}
		}

	}
$sql3 = mysqli_query($koneksi, "INSERT INTO cash (id_cash, tgl_cash, expense, payment, profit_a, profit_b, status) VALUES ('$hasil', '$tgl', '$jumlah3', '$jumlah4', '$jumlah', '$jumlah2', '$new')");	
if($sql3){
	ob_clean();
	header("Location: form_cash_voucher.php?id_cash=$hasil");
		
	}
}

?>


<div class="container">
		<div class="content">
		<h2>Data Tenaga Kerja &raquo; Buat Cash Voucher </h2>
			<hr />
<div class="row">			
<div class="col-sm-5">		
<form class="register" method="POST">
			<a href="main.php" data-toggle="tooltip" title="Management Main Page" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-list"></span> Kembali</a>
			<a href="on_cash_voucher.php" data-toggle="tooltip" title="Ongoing Cash Bank" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-list"></span> Ongoing</a>
			<a href="fin_cash_voucher.php" data-toggle="tooltip" title="Finished Cash Bank" class="btn btn-info" role="button"><span class="glyphicon glyphicon-list"></span> Finalized</a>
</div></div>

<?php  
$admins = $userRow['username']; 
$tgl_now = date('d/m/Y');     			
$sqlh = mysqli_query($koneksi, "SELECT * FROM ctki WHERE status = 'flight' AND id_cash IS NULL");

if(mysqli_num_rows($sqlh) == 0){
	
	}else{
	$total1h= 0; // mewakili data dari nomor 1
	$total2h= 0;
	$sub_totalh= 0;
	$paymenth= 0; 	
	while($rowh = mysqli_fetch_assoc($sqlh)){ // fetch query yang sesuai ke dalam array
		$numberh = $rowh['profit_a'];
		$number2h = $rowh['profit_b'];			
		$total1h +=$numberh; 
		$total2h +=$number2h; 		
		$rph = number_format($total1h);							
		$rp2h = number_format($total2h);	
		
		
		}
	echo '
				<div class="row">	
				<div class="text-center col-sm-4"></div>	
				<div class="text-center col-sm-4">					
				<h3><b>Total Profit A: <font color="red">'.$rph.' </b></h3></font>
				</div>
				<div class="text-center col-sm-4">					
				<h3><b>Total Profit B: <font color="blue">'.$rp2h.' </b></h3></font>
				</div>
				</div>
	';
}
?>
			
 
 <div class=" form-group text-left">
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">	
  <p> <h3>List Data CTKI </h3></p>            
  <table class="table table-hover">
    <thead>
      <tr>
		<th><input type="checkbox" rel=""></th>
        <th>No_CTKI</th>        
        <th>Profit A</th>
        <th>Profit B</th>
        
        
        
        
             
        </tr>
    </thead>
    <tbody>
      <tr>
					<?php        			
					$sql = mysqli_query($koneksi, "SELECT * FROM ctki WHERE status = 'flight' AND id_cash IS NULL ORDER BY voucher ASC"); // jika tidak ada filter maka tampilkan semua entri
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Belum Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ // jika terdapat entri maka tampilkan datanya
						$i = 0;
						$k = 0;
						$no = 1;
						$total= 0; // mewakili data dari nomor 1
						while($row2 = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							$number = $row2['profit_a'];
							$number2 = $row2['profit_b'];
							$number3 = $row2['sub_total'];
							$number4 = $row2['payment'];
							$rp = number_format($number);							
							$rp2 = number_format($number2);	
							$rp3 = number_format($number3);	
							$rp4 = number_format($number4);	
							$total +=$number2; 
							echo '
								<td><input name="selected[]" type="checkbox" rel="'.$number.'" rel2="'.$number2.'" rel3="'.$number3.'" rel4="'.$number4.'" value="'.$row2['voucher'].'"></input></td>
								<td><input name="ctki['.$i.']" type="hidden" value="'.$row2['voucher'].'"><a href="form_ctki.php?ctki='.$row2['voucher'].'&code='.$row2['code'].'">'.$row2['voucher'].'</input></td></a>
								<td><font color="green">'.$rp.'</font></td>
								<td><font color="blue">'.$rp2.'</font></td>								
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

				<div class="row">					
				<div class="text-center col-sm-6">					
				<h3><b>Total Profit A: <font color="green"><input name="output" type="text" id="output" required></input> </b></h3></font>
				</div></div>
				<div class="row">	
				<div class="text-center col-sm-6">					
				<h3><b>Total Profit B: <font color="blue"><input name="output2" type="text" id="output2" required></input> </b></h3></font>
				</div>
				</div><br>
				
				
	<div class="row"></div>			
		<br>
		
		<div class="row">
		<div class="col-sm-2">
		<button name="pay_cash" type="submit" type="button" class="btn btn-primary btn-block">Process</button></a>
		</div></div>
		<div class="col-sm-2">
		
		</div>
	</div><br><br>
	</form>

