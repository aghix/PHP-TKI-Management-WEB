<?php
session_start();
include_once 'dbconn.php';

if (!isset($_SESSION['userSession'])) {
 header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM admin WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$DBcon->close();

?>


<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Data TKI</title>
	<link rel="shortcut icon" href="img/logo_ilmututorial_32x32.jpg" type="image/x-icon" />
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<!-- JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/tooltip.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
    <link href="style.css" rel="stylesheet">
	<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
	</script>
	<script>
$(document).ready(function () {
    var date = new Date();
    var currentMonth = date.getMonth();
    var currentDate = date.getDate();
    var currentYear = date.getFullYear();

    $('#datepicker').datepicker({
        minDate: new Date(currentYear, currentMonth, currentDate),
        dateFormat: 'dd-mm-yy'
    });
});
	</script>
	<script>
$(document).ready(function () {
    var date = new Date();
    var currentMonth = date.getMonth();
    var currentDate = date.getDate();
    var currentYear = date.getFullYear();

    $('#datepicker2').datepicker({
        minDate: new Date(currentYear, currentMonth, currentDate),
        dateFormat: 'dd-mm-yy'
    });
});
	</script>
	<style>
		.borderless td, .borderless th {
    border: none;
}
</style>

	<!--
	Project      : Data Mahasiswa v1.0
	Description	 : CRUD (Create, read, Update, Delete) PHP, MySQLi dan Bootstrap
	Author		 : Firman Dwi Jayanto
	Author URI   : http://www.facebook.com/firmandije 
	Website		 : http://www.ilmututorial.com
	Email	 	 : firmandije[at]gmail.com, firman@firmandije.com
	-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body>
	<!-- Start navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand visible-xs-block visible-sm-block" href="ttp://cakrawalasejahtera.com" target="_blank">Cakrawala Sejahtera</a>
		  <a class="navbar-brand hidden-xs hidden-sm" href="http://cakrawalasejahtera.com" target="_blank">Cakrawala Sejahtera</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav">
			<li class=""><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			<li><a href="data.php" data-toggle="tooltip" data-placement="bottom" title=""><span class="glyphicon glyphicon-list"></span> Manajemen Data</a></li>
			
			<li><a href="tambah.php" data-toggle="tooltip" data-placement="bottom" title="" ><span class="glyphicon glyphicon-plus"> Biodata Baru</a></li>
			<li class=""><a href="logout.php?logout"><span class="glyphicon glyphicon-ban-circle"></span> logout</a></li>
			<li><a href="" data-toggle="tooltip" data-placement="bottom" title="" ><span class="glyphicon glyphicon-user"> <?php echo $userRow['username']; ?></a></li>
		  </ul>
			
			
			
		</div>
	  </div>
	</nav>
	<!-- End navbar -->
