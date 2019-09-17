<?php
include(PHP_JQGRID_CLASS_PATH_NEW."/jqgrid_dist.php");
$fn_this=new feeStructure_FeeMaster(new common_Functions(),new jqgrid($db_conf));
$g = new jqgrid($db_conf); 
$outFeeStructure = $fn_this->getFeeStructureGrid($g);
?>
