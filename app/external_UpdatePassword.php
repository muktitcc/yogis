<?php
require_once("common.inc_.php" );
checkPageAccess();
require_once("external_UpdatePassword_fn.php");
$fn_this=new external_UpdatePassword();
if ( isset( $_POST["action"] ) and $_POST["action"] == "external_UpdatePassword" ) {
  $fn_this->processForm();
} else {
  $fn_this->displayForm( array(), array(), new Member( array() ),array());
}
