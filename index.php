<?php
session_start();
require_once 'dbconn.php';

if (isset($_SESSION['userSession'])!="") {
 header("Location: main.php");
 exit;
}

if (isset($_POST['btn-login'])) {
 
 $email = strip_tags($_POST['email']);
 $password = strip_tags($_POST['password']);
 
 $email = $DBcon->real_escape_string($email);
 $password = $DBcon->real_escape_string($password);
 
 $query = $DBcon->query("SELECT user_id, email, password FROM admin WHERE email='$email'");
 $row=$query->fetch_array();
 
 $count = $query->num_rows; // if email/password are correct returns must be 1 row
 
 if (password_verify($password, $row['password']) && $count==1) {
  $_SESSION['userSession'] = $row['user_id'];
  header("Location: main.php");
 } else {
  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
    </div>";
 }
 $DBcon->close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cakrawala Sejahtera</title>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
	
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">	
	
<div class="container">
  <div class="jumbotron">
    <h1>PT. Cakrawala Sejahtera</h1>
    <p>Tenaga Kerja Indonesia Web Apps.</p>
  </div>
<!--
  <p>This is some text.</p>
  <p>This is another text.</p>
-->
</div>

<div class="signin-form">

 <div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Selamat Datang..! Silahkan Login terlebih dahulu</h2><hr />
        
        <?php
  if(isset($msg)){
   echo $msg;
  }
  ?>
  
  <div class="form-group">
					<label class="col-sm-3 control-label">Login</label>
					<div class="col-sm-4">
						<input type="text" name="email" class="form-control" placeholder="Email Address" required>
					</div>
					</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-4">
						<input type="password" name="password" class="form-control" placeholder="Password" required>
						
				
					</div>
					</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-sm-4">
						<button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
					<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
						</button> 
					</div>
					</div>
  </form>   
    

    

</body>
</html>
