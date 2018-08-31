<?php
require_once("userAuthentication.php");
require_once($_SESSION["thisFile"]."_fn.php");
require_once($_SESSION["thisFile"]."_php.php");
displayPageHeader("Menu Structure");
?>

<link rel="stylesheet" type="text/css" media="screen" href="asset/css/common_grid_css.css"></link> 

<?php echo $out?> 
<div style="position:absolute;left:400px;top:-10px;margin:10px;width:10px;"> 
<?php echo $out1?> 
</div>
	  