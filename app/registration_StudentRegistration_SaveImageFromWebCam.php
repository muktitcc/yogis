<?php
require_once("common.inc_.php");
if (!isset($_SESSION)) {
session_start();
}
$filename =  time() . '.jpg';
$filepath = TEMP_DIR.'/';
$_SESSION["WEBCAMFILE"]=$filepath.$filename;
move_uploaded_file($_FILES['webcam']['tmp_name'], $filepath.$filename);
echo $filepath.$filename;
?>
