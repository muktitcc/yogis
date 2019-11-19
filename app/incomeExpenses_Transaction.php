<?php
require_once("userAuthentication.php");
require_once($_SESSION["thisFile"]."_fn.php");
//require_once($_SESSION["thisFile"]."_php.php");
displayPageHeader("Trnsaction");
?>


<script src="../vendor/libnew/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>     
<script src="../vendor/libnew/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script> 



<?php echo $outTransaction?> 

 
<script src="asset/js/<?php echo $_SESSION["thisFile"]?>.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen" href="asset/css/common_grid_css.css"></link> 
