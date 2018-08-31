<?php
require_once("common.inc_.php");
require_once("external_ResetPassword_fn.php");
session_start();
$m=isset($_GET["m"])?$_GET["m"]:'X';
$fn_this=new external_ResetPassword(new common_Functions(),new MCrypt());
echo $fn_this->processPasswordReset($m);
?>
