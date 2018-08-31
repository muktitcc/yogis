<?php
require_once("userAuthentication.php");
define("FID",intval($_GET["rowid"]));
$fid = FID;
require_once($_SESSION["thisFile"]."_fn.php");
require_once($_SESSION["thisFile"]."_php.php");
displayPageHeader("Manage Access Rights");
?>
<script src="asset/js/<?php echo $_SESSION["thisFile"]?>.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen" href="asset/css/common_grid_css.css"></link> 

<div>	
<?php echo $out_list ?>
<div style="position:absolute;left:495px;top:-10px;margin:10px;width:10px;"> 
<?php echo $out_list1 ?>
</div>
</div>

<div style="position:absolute;left:800px;top:-10px;margin:10px;width:10px;"> 
<?php echo $out_list2?> 
</div> 


