<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database

?>
<div class="container">
		<div class="content">
		<h2>Data Tenaga Kerja &raquo; Edit Biodata</h2>
			<hr />

<?php


$result = mysqli_query ($koneksi, "SELECT DISTINCT tujuan FROM mahasiswa ORDER BY CODE ASC");
$no =1;
while ($row = mysqli_fetch_assoc ($result)){
$hasil = $row['tujuan'];

echo '

'.$no.' '.$hasil.'<br>
';
$no++;
}

?>
