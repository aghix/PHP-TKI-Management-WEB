<?php
require('phpmailer/class.phpmailer.php');
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port     = 587;  
$mail->Username = "notification@cakrawalasejahtera.com";
$mail->Password = "qw1209po2014";
$mail->Host     = "smtp.gmail.com";
$mail->Mailer   = "smtp";

//$mail->Subject = $subject;
$mail->WordWrap   = 80;
//$content = "<b>This is a test email using PHP mailer class.</b>"; 



//if(isset($_POST['add'])){
	//$mail->MsgHTML($content);
	//$mail->IsHTML(true);
//if(!$mail->Send()){ 
//echo "Problem sending email.";
//}else{ 
//echo "email sent.";
//}
//}
?>
					
<!--
		<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">			
					<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Send..!" data-toggle="tooltip" title="Send Mail">
						
					</div>
				</div>
		</form>
-->
