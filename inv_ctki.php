<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
<div class="row">
<div class="col-sm-4">			
			<label></label>
							<select class="col-sm-5 form-control" required="required" name="ctki">
								<option value=""> -Pilih TKI- </option>
							<?php
								$query = "SELECT * FROM mahasiswa WHERE label = 'valid' AND ctki > '' AND inv IS NULL ORDER BY ctki ASC";
								$result = mysqli_query($koneksi, $query);
    							while ($row2 = mysqli_fetch_assoc($result)) {
									unset($line);
									$line = $row2['nama'];
									$line2 =  $row2['ctki'];
									//$line3 = $row2['code'];
									$line4 = $row2['tujuan'];
										echo '                  
										<option value="'.$line.','.$line2.'">'.$line.' &emsp; CTKI: '.$line2.'</option>                         
											
										';
									}
							
								?>			
							</select>							
		</div>
		<div class="col-sm-2">
<button name="pilih" type="submit" class="btn btn-primary btn-block">Pilih</button>
</div>	
</div>
</form>
