<?php
require_once("common.inc_.php" );
session_start();
checkLogin();
if(!in_array($_SESSION["member"]->getValue( "id" ),unserialize($_SESSION['allowaccess']))){
displayPageHeader( "Error",false);
?>
<div class='alert alert-error' style="position:absolute;left:400px;top:200px;margin:10px;width:300px;">You are not authorized to access this page.</div> 
<?php
exit;
}else{
$fn=new common_Functions();
define("UID",$_SESSION["member"]->getValue( "id" ));
define("USER",$fn->_getApplicationUserName(UID));
}

