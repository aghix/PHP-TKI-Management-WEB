<form action="" method="post" enctype="multipart/form-data">
<div class="row"></div>		
<div class="row">
		<div class="col-sm-3">
						<label ></label>
							<select name="item" class="col-sm-3 form-control" required>
							<option value=""> -Pilih Item- </option>
							<option value="sps_dp,Sponsor DP">Sponsor DP</option>
							<option value="sps_lunas,Sponsor Pelunasan">Sponsor Pelunasan</option>
							<option value="medical,Medical">Medical</option>							
							<option value="id_asuransi,ID & Asuransi">ID & Asuransi</option>
							<option value="pel_blk,Pelatihan BLK">Pelatihan BLK</option>							
							<option value="paspor,Paspor">Paspor</option>
							<option value="isc,ISC">ISC</option>	
							<option value="fwcms,FWCMS">FWCMS</option>		
							<option value="visa,VISA">VISA</option>	
							<option value="visa/ipa,VISA/IPA">VISA/IPA(Singapore)</option>	
							<option value="visa/teto,VISA/TETO">VISA/TETO(Taiwan)</option>	
							<option value="fiskal,Fiskal">Fiskal</option>
							<option value="tiket pesawat,Tiket Pesawat">Tiket Pesawat</option>	
							<option value="transportasi,Transportasi">Transportasi Airport</option>	
							<option value="an05,AN05">AN05/Pinjam CAB/PT Lain</option>	
							<option value="makan i,Makan BLK Bulan I">BLK Bulan I</option>
							<option value="makan ii,Makan BLK Bulan II">BLK Bulan II</option>	
							<option value="makan iii,Makan BLK Bulan III">BLK Bulan III</option>								
						</select>
  
		</div>
		
		<div class="col-sm-4">
			
			<label></label>
							<select class="col-sm-5 form-control" required="required" name="BX_NAME">
								<option value=""> -Pilih TKI- </option>
							<?php
								$query = "SELECT * FROM mahasiswa WHERE label = 'valid' AND ctki > '' ORDER BY ctki ASC";
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
		
		<div class="col-sm-3">
			
			<label for="BX_amount"></label>
			<input class="col-sm-2 form-control" type="text" required="required" class="small"  name="BX_amount" placeholder="Nominal Amount">
					   
		</div>
		
		<div class="col-sm-2">
			<label for="catatan"></label>
			<input class="col-sm-2 form-control" type="text" class="small"  name="catatan" placeholder="Remarks">
					   
		</div>

</div>		
				
               
				<div class="clear"></div>
            </fieldset>
            <div class="clear"></div>
            <div class="clear"></div>
            <br>
            <div class="col-sm-2 control-label">
				<p> 
					<button name="save" type="submit" value="Simpan Item PKD" type="button" class="col-sm-3 control-label btn btn-primary btn-block">Tambahkan Item</button></a>
			
				
				</p>
				
				</div>
				<div class="col-sm-2 control-label">
				<p> 
					<a href="pkd_baru.php"><button type="button" class="col-sm-3 control-label btn btn-danger btn-block">Kembali</button></a>
			
				
				</p>
				</div>
			</form>
				
			<p></p><br><br><br> 
