<?php
require_once("userAuthentication.php");
require_once($_SESSION["thisFile"]."_fn.php");
require_once($_SESSION["thisFile"]."_php.php");
displayPageHeader("User Creation");
?>

<link rel="stylesheet" type="text/css" media="screen" href="asset/css/common_grid_css.css"></link> 

<?php echo $outUserCreation?> 
	  