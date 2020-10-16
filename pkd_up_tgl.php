<?php
$sql = mysqli_query($koneksi, "SELECT no_pkd,tgl_pkd,tgl_trf FROM pkd WHERE no_pkd='$no_pkd'"); // query untuk memilih entri data dengan nilai nim terpilih
$row_tgl = mysqli_fetch_assoc($sql);
if(isset($_POST['update'])){
	$tgl_pkd_up=$_POST['up_tgl1'];
	$tgl_trf_up=$_POST['up_tgl2'];
$sql = mysqli_query($koneksi, "UPDATE pkd SET tgl_pkd = '$tgl_pkd_up', tgl_trf = '$tgl_trf_up' WHERE no_pkd='$no_pkd'"); 	
if($sql){
	header("Location: daftar_pkd.php?no_pkd=".$no_pkd."");	
	
	}
}
?> 
<form class="register" method="POST">
<div class="row">
<div class="text-left col-sm-3">
<table class="table ">
<tr>
	<td>
		Tanggal PKD
	</td>
</tr>				
<tr>
<td><input name="up_tgl1" type="text" placeholder="<?php echo $row_tgl['tgl_pkd']; ?>" value="<?php echo $row_tgl['tgl_pkd']; ?>" ></td>

</tr>
</table>
</div></div>	
<div class="row">
<div class="text-left col-sm-3">
<table class="table ">	
	<tr>
	<td>
		Tanggal Transfer
	</td>
</tr>				
<tr>
<td><input name="up_tgl2" type="text" placeholder="<?php echo $row_tgl['tgl_trf']; ?>" value="<?php echo $row_tgl['tgl_trf']; ?>" ></td>
<td><button name="update" type="submit" class="btn btn-success btn-block">Update</button></td>
</tr>
</table>
</div></div></form>

