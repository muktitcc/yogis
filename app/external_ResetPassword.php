<?php
require_once("common.inc_.php");
require_once("external_ResetPassword_fn.php");
session_start();
$userName=isset($_GET["userName"])?$_GET["userName"]:'X';
$fn_this=new external_ResetPassword(new common_Functions(),new MCrypt());
echo $fn_this->checkUserNameAndEmail($userName);
?>
