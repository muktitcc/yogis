<?php
require_once("userAuthentication.php");
require_once($_SESSION["thisFile"]."_fn.php");
require_once($_SESSION["thisFile"]."_php.php");
displayPageHeader("Fee Structure");
?>


<script src="../vendor/libnew/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>     
<script src="../vendor/libnew/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script> 
<link rel="stylesheet" href="../vendor/jqgridmultiselect/jquery.multiselect.css"> 
<link rel="stylesheet" href="../vendor/jqgridmultiselect/jquery.multiselect.filter.css"> 
<script src="../vendor/jqgridmultiselect/jquery.multiselect.js"></script> 
<script src="../vendor/jqgridmultiselect/jquery.multiselect.filter.js"></script> 
<script src="../vendor/jqgridmultiselect/jquery.multiselect.min1.js"></script> 
<script src="../vendor/jqgridmultiselect/jquery.multiselect.filter.min1.js"></script> 


<?php echo $outFeeStructure?> 

<script src="asset/js/<?php echo $_SESSION["thisFile"]."_webcam"?>.js" type="text/javascript"></script>		 
<script src="asset/js/<?php echo $_SESSION["thisFile"]?>.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen" href="asset/css/common_grid_css.css"></link> 
