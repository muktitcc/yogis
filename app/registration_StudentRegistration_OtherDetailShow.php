<?php
require_once("common.inc_.php");
checkPageAccess();
require_once("registration_StudentRegistration_fn.php");
$fn_this=new admin_MenuStructure(new common_Functions());

$studentcode=$_REQUEST["rowid"];

echo $fn_this->showOtherDetail($studentcode);	

?>
