<?php
include(PHP_JQGRID_CLASS_PATH_NEW."/jqgrid_dist.php");
$fn_this=new incomeExpenses_Transaction(new common_Functions(),new jqgrid($db_conf));
$g = new jqgrid($db_conf); 
$outTransaction = $fn_this->getTransactionGrid($g);
?>
