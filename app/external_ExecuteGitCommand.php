<?php
$myMsg = array();
$myFile = "C:\MHV\myBat\gitPull.bat";
exec( $myFile, $myMsg);
echo implode("<br>",$myMsg);
?>