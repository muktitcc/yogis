<?php
require_once("common.inc_.php");
checkPageAccess();
require_once("registration_StudentRegistration_fn.php");
$fn_this=new admin_MenuStructure(new common_Functions());

$studentcode=$_GET["studentcode"];
displayPageHeader("Student Registration");
echo $fn_this->showPopUp($studentcode);	

?>