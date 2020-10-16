<!-- put this at the top of the page --> 


<?php 
ob_start();
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
	<!-- Start container -->
	<div class="container">
		<div class="content">
			<div class="jumbotron">
				<h1>PT. Cakrawala Sejahtera</h1>
				<p>Aplikasi data Tenaga Kerja Indonesia Alpha Ver:2017</p>
<div class="row">
		<div class="col-sm-2">
				<a href="data.php" data-toggle="tooltip" title="Management Data" class="btn btn-primary btn-block" role="button"><span class="glyphicon glyphicon-list"></span> Management Data</a>
		</div>	
		<div class="col-sm-2">		
				<a href="tambah.php" data-toggle="tooltip" title="Tambah Biodata Baru TKI" class="btn btn-primary btn-block" role="button"><span class="glyphicon glyphicon-list"></span> Biodata Baru</a>
		</div>	
		<div class="col-sm-2">			
				<a href="pkd_baru.php" data-toggle="tooltip" title="PKD Management" class="btn btn-primary btn-block" role="button"><span class="glyphicon glyphicon-list"></span> Daftar PKD</a>
		</div></div>
		
<div class="row"><br>		
		<div class="col-sm-2">				
				<a href="invoice.php" data-toggle="tooltip" title="Invoice Management" class="btn btn-primary btn-block" role="button"><span class="glyphicon glyphicon-list"></span> Invoice</a>
		</div>
		<div class="col-sm-2">				
				<a href="cash_voucher.php" data-toggle="tooltip" title="Cash Voucher Management" class="btn btn-primary btn-block" role="button"><span class="glyphicon glyphicon-list"></span> Cash Voucher</a>
		</div>		
		<div class="col-sm-2">					
				<a href="cash_bank.php" data-toggle="tooltip" title="Cash Bank Record" class="btn btn-primary btn-block" role="button"><span class="glyphicon glyphicon-list"></span> Cash Bank</a>
</div></div>

<div class="row"><br>		
		<div class="col-sm-2">				
				<a href="daftar_ctki.php" data-toggle="tooltip" title="Invoice Management" class="btn btn-primary btn-block" role="button"><span class="glyphicon glyphicon-list"></span> Daftar CTKI</a>
		</div></div>
						
			</div> <!-- /.jumbotron -->
		</div> <!-- /.content -->
	</div>
	<!-- End container -->
<?php 
include("footer.php"); // memanggil file footer.php
?>
<!-- put this code at the bottom of the page -->

