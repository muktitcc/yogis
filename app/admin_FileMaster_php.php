<?php
include(PHP_JQGRID_CLASS_PATH_OLD."/jqgrid_dist.php");

$fn_this=new admin_FileMaster(new common_Functions(),new jqgrid());

$g = new jqgrid(); 

$col = array();
$col["title"] = "fileid";
$col["name"] = "fileid";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = false;
$col["hidden"] = true;
$cols[] = $col;	

$col = array();
$col["title"] = "Display Name";
$col["name"] = "displayname1";
$col["width"] = "200";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = false;
$col["editrules"] = array("required"=>true);
$col["on_data_display"] = array("show_link",$fn_this);
$cols[] = $col;	

$f = array(); 
$f["column"] = "displayname1"; 
$f["op"] = "="; 
$f["value"] = "New"; 
$f["cellcss"] = "'background-color':'#FA5858'"; 
$f_conditions[] = $f; 

$col = array();
$col["title"] = "Display Name";
$col["name"] = "displayname";
$col["width"] = "200";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["show"] = array("list"=>false,"add"=>false,"edit"=>true);
$col["editrules"] = array("required"=>true);
$cols[] = $col;	

$col = array();
$col["title"] = "Main Menu"; 
$col["name"] = "mainmenu"; 
$col["width"] = "150";
$col["search"] = true;
$col["editable"] = true;
$col["edittype"] = "select";
$str = $g->get_dropdown_values("select  '' as k,'' as v union select  'New' as k,'New' as v union select id  as k,  menuname v from yogis.tbltopmenu"); 
$col["editoptions"] = array("value"=>$str, "onchange" => array("sql"=>"select id  as k,  menuname v from tblsecondlevelmenu WHERE topmenuid = '{mainmenu}'","update_field" => "secondmenuid" ) );  
$col["formatter"] = "select"; 
$col["stype"] = "select"; 
$col["searchoptions"] = array("value" => $str); 
$col["editrules"] = array("required"=>true);
$cols[] = $col;	

$col = array();
$col["title"] = "Second Level Menu"; 
$col["name"] = "secondmenuid"; 
$col["width"] = "150";
$col["search"] = true;
$col["editable"] = true;
$col["edittype"] = "select";
$str = $g->get_dropdown_values("select  '' as k,'' as v  union select a.id  as k,  concat(b.menuname,' - ',a.menuname) v from yogis.tblsecondlevelmenu a ,yogis.tbltopmenu b where a.topmenuid=b.id"); 
$col["editoptions"] = array("value"=>$str);  
$col["formatter"] = "select"; 
$col["stype"] = "select";  
$col["searchoptions"] = array("value" => ':;'.$str); 
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true,"add"=>false,"edit"=>true);
$cols[] = $col;	

$col = array();
$col["title"] = "File Name";
$col["name"] = "filename";
$col["width"] = "200";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["hidden"] = false;
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
$col["title"] ="Status";
$col["name"] = "entrytype";
$col["width"] = "60";
$col["sortable"] = false;
$col["search"] = true; 
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] = array("value"=>'Normal:Normal;Update:Update;New:New');
$col["stype"] = "select";
$col["searchoptions"] = array("value"=>'Normal:Normal;Update:Update;New:New');
$col["show"] = array("list"=>true,"add"=>false,"edit"=>true);
$cols[] = $col;	

$f = array(); 
$f["column"] = "entrytype"; 
$f["op"] = "="; 
$f["value"] = "New"; 
$f["cellcss"] = "'background-color':'#58FA58'"; 
$f_conditions[] = $f; 
$f = array(); 
$f["column"] = "entrytype"; 
$f["op"] = "="; 
$f["value"] = "Update"; 
$f["cellcss"] = "'background-color':'#58FA58'"; 
$f_conditions[] = $f; 

$col = array();
$col["title"] = "Note";
$col["name"] = "note";
$col["width"] = "200";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["edittype"]="textarea";
$col["editoptions"] = array("rows"=>3 ,"cols"=>40);
$cols[] = $col;	

$col = array();
$col["title"] = "Status"; 
$col["name"] = "status"; 
$col["width"] = "50";
$col["search"] = true;
$col["editable"] = true;
$col["edittype"] = "select";
$str = "Active:Active;Inactive:Inactive"; 
$col["editoptions"] = array("value"=>$str);  
$col["formatter"] = "select"; 
$col["stype"] = "select"; 
$col["searchoptions"] = array("value" => $str); 
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true,"add"=>false,"edit"=>true);
$cols[] = $col;	

$col = array();
$col["title"] = "Is internal<br> file?";
$col["name"] = "isinternal";
$col["width"] = "120";
$col["sortable"] = false; 
$col["search"] = false; 
$col["editable"] = true; 
$col["edittype"] = "checkbox";
$col["hidden"] = true;
$col["editoptions"] = array("value"=>"Yes:No");
$col["show"] = array("list"=>false,"add"=>false,"edit"=>true);
$cols[] = $col;

$col = array();
$col["title"] = "Add";
$col["name"] = "madd";
$col["width"] = "40";
$col["sortable"] = false; 
$col["search"] = false; 
$col["editable"] = true; 
$col["edittype"] = "checkbox";
$col["hidden"] = true;
$col["editoptions"] = array("value"=>"Yes:No");
$col["show"] = array("list"=>true,"add"=>false,"edit"=>true);
$cols[] = $col;

$f = array(); 
$f["column"] = "madd"; 
$f["op"] = "="; 
$f["value"] = "Yes"; 
$f["cellcss"] = "'background-color':'#58FA58'"; 
$f_conditions[] = $f; 

$col = array();
$col["title"] = "Edit";
$col["name"] = "medit";
$col["width"] = "40";
$col["sortable"] = false; 
$col["search"] = false; 
$col["editable"] = true; 
$col["edittype"] = "checkbox";
$col["hidden"] = true;
$col["editoptions"] = array("value"=>"Yes:No");
$col["show"] = array("list"=>true,"add"=>false,"edit"=>true);
$cols[] = $col;
$f = array(); 
$f["column"] = "medit"; 
$f["op"] = "="; 
$f["value"] = "Yes"; 
$f["cellcss"] = "'background-color':'#58FA58'"; 
$f_conditions[] = $f; 

$grid["rowList"] = array();
$grid["pgbuttons"] = true;
$grid["pgtext"] = null;
$grid["viewrecords"] = true;
$grid["scroll"] = false; 
$grid["caption"] = "Master file maintenance"; 
$grid["autowidth"] = true;
$grid["cellEdit"] =false; 
$grid["rowList"] = array(); 
$grid["rownumbers"] = true; 
$grid["rownumWidth"] = 12; 
$grid["searchoptions"] = false;
$grid["rowNum"] = 2000; 
$grid["sortname"] = 'mainmenu'; 
$grid["sortorder"] = "asc"; 
$grid["autowidth"] = false; 
$grid["multiselect"] = false; 
$grid["auto_width"] = false;
$grid["shrinkToFit"] = false;
$grid["reloadedit"] = true;
$e["on_after_update"] = array("after_update", $fn_this, false);
$grid["edit_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'380');
$grid["width"] = 1220;
$grid["height"] = 400;
$grid["toolbar"] = "top";
$grid["footerrow"] = false;

$g->navgrid["param"]["edit"] = true; 
$g->navgrid["param"]["add"] = false; 
$g->navgrid["param"]["del"] = false; 
$g->navgrid["param"]["search"] = false; 
$g->navgrid["param"]["refresh"] = true; 
$g->navgrid["param"]["view"] = false; 
$g->navgrid["param"]["edittext"] = "Edit"; 
$g->set_actions(array(	
"add"=>false, 
"edit"=>false, 
"rowactions"=>false, 
"delete"=>false, 
) 
);
$g->set_group_header( array(
"useColSpanStyle"=>true,
"groupHeaders"=>array(
array(
"startColumnName"=>'madd', 
"numberOfColumns"=>2, 
"titleText"=>'Form Action'
),
)
)
);

$g->set_conditional_css($f_conditions); 
$e["js_on_load_complete"] = "grid_onload";
$g->set_events($e); 
$e["js_on_select_row"] = "grid_select";  
$g->set_events($e);		   
$e["js_on_load_complete"] = "do_onload";
$g->set_events($e);	
$g->set_conditional_css($f_conditions); 
if(UID==1){
$g->select_command = "select *,displayname as displayname1,secondmenuid as secondmenuid1 from yogis.tblfilemaster";
}else{
$g->select_command = "select *,displayname as displayname1,secondmenuid as secondmenuid1 from yogis.tblfilemaster where displayname not in('New')";	
}
$g->table = "tblfilemaster";
$g->set_options($grid);
$g->set_columns($cols);
$out = $g->render("list");
?>
