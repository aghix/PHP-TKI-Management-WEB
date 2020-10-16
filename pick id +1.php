<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
			<h2>Data Tenaga Kerja</h2>
			<hr />
			
			<?php

			$result = mysqli_query($koneksi, "SELECT MAX(`code`) AS comment_id FROM `mahasiswa`");

    			while ($row = mysqli_fetch_assoc($result)) {
        	$most_popular = $row['comment_id'];             
            }

    		echo "$most_popular";


?>
