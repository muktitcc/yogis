<?php
include(PHP_JQGRID_CLASS_PATH_NEW."/jqgrid_dist.php");
$fn_this=new admin_MenuStructure(new common_Functions(),new jqgrid());
$g = new jqgrid(); 
$outUserCreation = $fn_this->getUserGrid($g);
?>
