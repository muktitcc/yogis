<?php
include(PHP_JQGRID_CLASS_PATH_NEW."/jqgrid_dist.php");
$fn_this=new feeStructure_FeeMaster(new common_Functions(),new jqgrid());
$g = new jqgrid(); 
$outFeeStructure = $fn_this->getFeeStructureGrid($g);
?>
