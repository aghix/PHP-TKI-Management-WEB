<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "phpqrcode/qrlib.php";
$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    //html PNG location prefix
$PNG_WEB_DIR = 'qrcode/';
if (!file_exists($PNG_TEMP_DIR))
  mkdir($PNG_TEMP_DIR);

// create a QR Code with this text and display it
$url = 'http://192.168.3.16/2/form_ctki.php?ctki=01.K%20035/II/2017&code=1';
$errorCorrectionLevel = 'H';
$matrixPointSize = '8';
$filename = $PNG_WEB_DIR.'test.png';
//QRcode::png('Test_PNG', $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
QRcode::png($url, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
//header("Content-type: image/png");
$logopath = 'qrcode/cakra.png';
$QR = imagecreatefrompng($filename);
$logo = imagecreatefromstring(file_get_contents($logopath));
$QR_width = imagesx($QR);
$QR_height = imagesy($QR);
$logo_width = imagesx($logo);
$logo_height = imagesy($logo);
$logo_qr_width = $QR_width/3;
$scale = $logo_width/$logo_qr_width;
$logo_qr_height = $logo_height/$scale;

imagecopyresampled($QR, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

// Save QR code again, but with logo on it
imagepng($QR,$filename);


?>
<img src="qrcode/test.png"/>
