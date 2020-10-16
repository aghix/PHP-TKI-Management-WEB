<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>

<div class="container">
		<div class="content">
			<h2>Data Tenaga Kerja &raquo; Pendaftaran Baru</h2>
			<hr />
			<!-- bagian ini merupakan bagian form untuk menginput data yang akan dimasukkan ke database -->
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

				<div class="form-group">
					<label class="col-sm-3 control-label">ID</label>
					<div class="col-sm-2">
						<label class="control-label">
					<?php

					$result = mysqli_query($koneksi, "SELECT MAX(`code`) AS comment_id FROM `mahasiswa`");
    					while ($row = mysqli_fetch_assoc($result)) {
        				$id_baru = $row['comment_id'] +1;             
            			}

    					echo "$id_baru";


					?>
						</label>
<?php 
$user = $userRow['username'];

echo "Welcome $user";
?>
