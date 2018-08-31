<?php
require_once( "common.inc_.php" );
checkLogin();
session_start();
$_SESSION["member"] = "";
displayPageHeader( "Logged out", true );
error_reporting(0);
include(PHP_JQGRID_CLASS_PATH_OLD."/jqgrid_dist.php");
?>
<?php
logOut();
?>

 <div style="position:absolute;left:550px;top:200px;margin:10px;width:500px;"> 
<ul class="nav nav-pills">
  <li class="active">
  Successfully logged out. <a align="center" href="logout.php">Login again</a>
  </li>
</ul>
</div>	




	</body>
</html>
<?php
function logOut() {
	
	$_SESSION["user_ip"] = "";
	$_SESSION["loggedin"] = "";
	$_SESSION["win_lin"] = "";
	$_SESSION["login_error"] = "";
	$_SESSION["login_fails"] = "";
	$_SESSION["login_lockout"] = "";
	$_SESSION["ftp_host"] = "";
	$_SESSION["ftp_user"] = "";
	$_SESSION["ftp_pass"] = "";
	$_SESSION["ftp_port"] = "";
	$_SESSION["ftp_pasv"] = "";
	$_SESSION["interface"] = "";
	$_SESSION["dir_current"] = "";
	$_SESSION["dir_history"] = "";
	$_SESSION["clipboard_chmod"] = "";
	$_SESSION["clipboard_files"] = "";
	$_SESSION["clipboard_folders"] = "";
	$_SESSION["clipboard_rename"] = "";
	$_SESSION["copy"] = "";
	$_SESSION["errors"] = "";
	$_SESSION["upload_limit"] = "";
	$_SESSION['allowaccess']="";
	$_SESSION['mysessionid']="";
	session_destroy();
	
}
?>