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
$grid_id = "list"; 

//second level menu
$g1= new jqgrid();

$col1 = array();
$col1["title"] = "id";
$col1["name"] = "id";
$col1["width"] = "100";
$col1["sortable"] = false;
$col1["search"] = false; 
$col1["editable"] = false;
$col1["hidden"] = true;
$cols1[] = $col1;	

$col1 = array();
$col1["title"] = "Main Menu"; 
$col1["name"] = "topmenuid"; 
$col1["sortable"] = false;
$col1["width"] = "150";
$col1["search"] = true;
$col1["editable"] = true;
$col1["edittype"] = "select";
$str = $g1->get_dropdown_values("select  '' as k,'' as v union  select id  as k,  menuname v from yogis.tbltopmenu"); 
$col1["editoptions"] = array("value"=>$str);  
$col1["editoptions"]["dataInit"] = "function(){ setTimeout(function(){ $('select[name=topmenuid]').select2({width:'100%', dropdownCssClass: 'ui-widget ui-jqdialog'}); },200); }"; 
$col1["formatter"] = "select"; 
$col1["stype"] = "select"; 
$col1["searchoptions"] = array("value" => ':;'.$str); 
$col1["show"] = array("list"=>true,"add"=>true,"edit"=>true);
$col1["searchoptions"]["dataInit"] = "function(){ setTimeout(function(){ $('select[name=topmenuid]').select2({width:'100%', dropdownCssClass: 'ui-widget ui-jqdialog'}); },200); }"; 
$cols1[] = $col1;	

$col1 = array();
$col1["title"] = "Second Level Menu";
$col1["name"] = "menuname";
$col1["width"] = "100";
$col1["sortable"] = false;
$col1["search"] = false; 
$col1["editable"] = true;
$col1["editrules"] = array("required"=>true);
$col1["show"] = array("list"=>true,"add"=>true,"edit"=>true);
$col1["editrules"] = array("required"=>true);
$cols1[] = $col1;	

$col1 = array();
$col1["title"] = "Has sub<br>menu?";
$col1["name"] = "hassubmenu";
$col1["width"] = "45";
$col1["sortable"] = false;
$col1["search"] = false; 
$col1["editable"] = true;
$col1["edittype"] = "select";
$col1["editoptions"] = array("value"=>'Yes:Yes;No:No');
$col1["editrules"] = array("required"=>true);
$cols1[] = $col1;	

$col1 = array();
$col1["title"] = "Display<br> Order";
$col1["name"] = "displayorder";
$col1["width"] = "50";
$col1["sortable"] = false;
$col1["search"] = false; 
$col1["editable"] = true;
$col1["show"] = array("list"=>true,"add"=>true,"edit"=>true);
$col1["editrules"] = array("required"=>true);
$cols1[] = $col1;	

$col1 = array();
$col1["title"] = "Note";
$col1["name"] = "note";
$col1["width"] = "200";
$col1["sortable"] = false;
$col1["search"] = false; 
$col1["editable"] = true;
$col1["show"] = array("list"=>true,"add"=>true,"edit"=>true);
$cols1[] = $col1;

$col1 = array();
$col1["title"] = "Active";
$col1["name"] = "isactive";
$col1["width"] = "50";
$col1["sortable"] = false;
$col1["search"] = false; 
$col1["editable"] = true;
$col1["edittype"] = "checkbox";
$col1["editoptions"] = array("value"=>"Yes:No");
$col1["show"] = array("list"=>true,"add"=>true,"edit"=>true);
$cols1[] = $col1;	

$grid1["rowList"] = array();
$grid1["pgbuttons"] = true;
$grid1["pgtext"] = null;
$grid["viewrecords"] = true;
$grid1["caption"] = "Main Menu"; 
$grid1["autowidth"] = true;
$grid1["cellEdit"] =false; 
$grid1["rowList"] = array(); 
$grid1["rownumbers"] = true; 
$grid1["rownumWidth"] = 12; 
$grid1["searchoptions"] = false;
$grid1["rowNum"] = 2000; 
$grid1["sortname"] = 'topmenuid,displayorder'; 
$grid1["sortorder"] = "asc"; 
$grid1["autowidth"] = false; 
$grid1["multiselect"] = false; 
$grid1["auto_width"] = false;
$grid1["shrinkToFit"] = false;
$grid1["reloadedit"] = true;
$grid1["edit_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'350');
$grid1["add_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'350');
$grid1["width"] = 670;
$grid1["height"] = 400;
$grid1["toolbar"] = "top";
$grid1["footerrow"] = false;
$g1->navgrid["param"]["edit"] = true; 
$g1->navgrid["param"]["add"] = true; 
$g1->navgrid["param"]["del"] = false; 
$g1->navgrid["param"]["search"] = false; 
$g1->navgrid["param"]["refresh"] = true; 
$g1->navgrid["param"]["view"] = false; 
$g1->navgrid["param"]["edittext"] = "Edit"; 
$g1->navgrid["param"]["addtext"] = "Add";
$g1->set_actions(array(	
"add"=>false, 
"edit"=>false, 
"rowactions"=>false, 
"delete"=>false, 
) 
);
$g1->set_conditional_css($f1_conditions); 
$e1["js_on_load_complete"] = "grid_onload";
$g1->set_events($e1); 
$e1["js_on_select_row"] = "grid_select";  
$g1->set_events($e1);		   
$e1["js_on_load_complete"] = "do_onload";
$g1->set_events($e1);	
$g1->set_conditional_css($f1_conditions); 
$g1->select_command = "select * from yogis.tblsecondlevelmenu";
$g1->table = "yogis.tblsecondlevelmenu";
$g1->set_options($grid1);
$g1->set_columns($cols1);
$out1 = $g1->render("list1");
$grid_id1 = "list1"; 
?>
