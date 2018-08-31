<?php
require_once("userAuthentication.php");
require_once($_SESSION["thisFile"]."_fn.php");
require_once($_SESSION["thisFile"]."_php.php");
displayPageHeader("File Master");
?>
<script src="asset/js/<?php echo $_SESSION["thisFile"]?>.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen" href="asset/css/common_grid_css.css"></link> 

<?php echo $out ?>

