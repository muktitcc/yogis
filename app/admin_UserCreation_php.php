<?php
include(PHP_JQGRID_CLASS_PATH_NEW."/jqgrid_dist.php");

$fn_this=new admin_MenuStructure(new common_Functions(),new jqgrid());

$g = new jqgrid(); 

$col = array();
$col["title"] = "id";
$col["name"] = "id";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = false;
$col["hidden"] = true;
$cols[] = $col;	

$col = array();
$col["title"] = "Menu Name";
$col["name"] = "menuname";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true,"add"=>true,"edit"=>true);
$col["editrules"] = array("required"=>true);
$cols[] = $col;	

$col = array();
$col["title"] = "Display<br> Order";
$col["name"] = "displayorder";
$col["width"] = "50";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["show"] = array("list"=>true,"add"=>true,"edit"=>true);
$col["editrules"] = array("required"=>true);
$cols[] = $col;	

$col = array();
$col["title"] = "Note";
$col["name"] = "note";
$col["width"] = "200";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["show"] = array("list"=>true,"add"=>true,"edit"=>true);
$cols[] = $col;	

$grid["rowList"] = array();
$grid["pgbuttons"] = true;
$grid["pgtext"] = null;
$grid["viewrecords"] = true;
$grid["scroll"] = false; 
$grid["caption"] = "Main Menu"; 
$grid["autowidth"] = true;
$grid["cellEdit"] =false; 
$grid["rowList"] = array(); 
$grid["rownumbers"] = true; 
$grid["rownumWidth"] = 12; 
$grid["searchoptions"] = false;
$grid["rowNum"] = 2000; 
$grid["sortname"] = 'displayorder'; 
$grid["sortorder"] = "asc"; 
$grid["autowidth"] = false; 
$grid["multiselect"] = false; 
$grid["auto_width"] = false;
$grid["shrinkToFit"] = false;
$grid["reloadedit"] = true;
$grid["edit_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'350');
$grid["add_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'350');
$grid["width"] = 400;
$grid["height"] = 400;
$grid["toolbar"] = "top";
$grid["footerrow"] = false;
$g->navgrid["param"]["edit"] = true; 
$g->navgrid["param"]["add"] = true; 
$g->navgrid["param"]["del"] = false; 
$g->navgrid["param"]["search"] = false; 
$g->navgrid["param"]["refresh"] = true; 
$g->navgrid["param"]["view"] = false;
$g->navgrid["param"]["edittext"] = "Edit"; 
$g->navgrid["param"]["addtext"] = "Add"; 
$g->set_actions(array(	
"add"=>false, 
"edit"=>false, 
"rowactions"=>false, 
"delete"=>false, 
) 
);
$g->set_conditional_css($f_conditions); 
$g->select_command = "select * from yogis.tbltopmenu";
$g->table = "yogis.tbltopmenu";
$g->set_options($grid);
$g->set_columns($cols);
$out = $g->render("list");
?>
