<?php
include(PHP_JQGRID_CLASS_PATH_NEW."/jqgrid_dist.php");

$fn_this=new admin_FileAccessRights(new common_Functions(),new jqgrid($db_conf));

$g = new jqgrid($db_conf); 

$col = array();
$col["title"] = "id";
$col["name"] = "fileid";
$col["width"] = "50";
$col["sortable"] = true;
$col["search"] = false; 
$col["editable"] = false;
$col["hidden"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "Display Name";
$col["name"] = "displayname";
$col["width"] = "280";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = false;
$col["editrules"] = array("required"=>true);
$cols[] = $col;	

$f = array(); 
$f["column"] = "displayname"; 
$f["css"] = "'color':'black', 'font-weight':'bold'";
$f_conditions[] = $f; 

$col = array();
$col["title"] = "Main Menu"; 
$col["name"] = "mainmenu"; 
$col["width"] = "150";
$col["search"] = true;
$col["editable"] = false;
$col["edittype"] = "select";
$str = $g->get_dropdown_values("select  '' as k,'' as v union select  'New' as k,'New' as v union select id  as k,  menuname v from yogis.tbltopmenu"); 
$col["editoptions"] = array("value"=>$str);  
$col["editoptions"]["dataInit"] = "function(){ setTimeout(function(){ $('select[name=mainmenu]').select2({width:'100%', dropdownCssClass: 'ui-widget ui-jqdialog'}); },200); }"; 
$col["formatter"] = "select"; 
$col["stype"] = "select"; 
$col["searchoptions"] = array("value" => ':;'.$str); 
$col["searchoptions"]["dataInit"] = "function(){ setTimeout(function(){ $('select[name=mainmenu]').select2({width:'100%', dropdownCssClass: 'ui-widget ui-jqdialog'}); },200); }"; 
$col["editrules"] = array("required"=>true);
$cols[] = $col;	

$col = array();
$col["title"] = "madd";
$col["name"] = "madd";
$col["width"] = "50";
$col["sortable"] = true;
$col["search"] = false; 
$col["editable"] = false;
$col["hidden"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "medit";
$col["name"] = "medit";
$col["width"] = "50";
$col["sortable"] = true;
$col["search"] = false; 
$col["editable"] = false;
$col["hidden"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "User"; 
$col["name"] = "muid"; 
$col["width"] = "140";
$col["search"] = false;
$col["editable"] = true;
$col["edittype"] = "select";
$str = $g->get_dropdown_values("select id  as k,  staffname v from yogis.tbluser"); 
$col["editoptions"] = array("value"=> ':;'.$str); 
$col["editoptions"]["dataInit"] = "function(){ setTimeout(function(){ $('select[name=muid]').select2({width:'200px', dropdownCssClass: 'ui-widget ui-jqdialog'}); },200); }";  
$col["formatter"] = "select"; 
$col["stype"] = "select"; 
$col["searchoptions"] = array("value" => ':;'.$str); 
$col["searchoptions"]["dataInit"] = "function(){ setTimeout(function(){ $('select[name=muid]').select2({width:'200px', dropdownCssClass: 'ui-widget ui-jqdialog'}); },200); }"; 
$col["show"] = array("list"=>false, "add"=>false, "edit"=>true, "view"=>false);
$col["export"] = false;
$cols[] = $col;

$grid["rowList"] = array();
$grid["pgbuttons"] = true;
$grid["pgtext"] = null;
$grid["viewrecords"] = true;
$grid["scroll"] = false;  
$grid["caption"] = "Available forms list."; 
$grid["detail_grid_id"] = "list2,list1"; 
$grid["subgridparams"] = "displayname"; 
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
$grid["multiselect"] = true;
$grid["multiboxonly"] = true;   
$grid["auto_width"] = false;
$grid["shrinkToFit"] = false;
$grid["reloadedit"] = true;
$grid["edit_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'350');
$grid["width"] = 500;
$grid["height"] =430;		
$grid["toolbar"]="top";						
$grid["footerrow"] = false;
if(in_array($_SESSION["member"]->getValue( "id" ),array(1))){ 
$g->navgrid["param"]["add"] = false; 
}else{
$g->navgrid["param"]["add"] = false; 	
}
$g->navgrid["param"]["edit"] = false; 
$g->navgrid["param"]["del"] = false; 
$g->navgrid["param"]["search"] = false; 
$g->navgrid["param"]["refresh"] = true; 
$g->navgrid["param"]["view"] = false; 
$g->navgrid["param"]["addtext"] = "Add"; 
if(in_array($_SESSION["member"]->getValue( "id" ),array(1))){ 
$g->set_actions(array(	
"add"=>false, 
"edit"=>true,
"bulkedit"=>true,						
"rowactions"=>false, 
"delete"=>false, 
"showhidecolumns"=>false
) 
);
}else{
$g->set_actions(array(	
"add"=>false, 
"edit"=>false, 
"rowactions"=>false, 
"delete"=>false, 
"showhidecolumns"=>false
) 
);	
}			

$g->set_group_header( array(
"useColSpanStyle"=>true,
"groupHeaders"=>array(
array(
"startColumnName"=>'madd', 
"numberOfColumns"=>2, 
"titleText"=>'update required?'
),
)
)
);

$e["on_update"] = array("bulkUpdate", $fn_this, false); 
$g->set_events($e);

$e["js_on_load_complete"] = "grid_onload";
$g->set_events($e);
$g->set_conditional_css($f_conditions); 
$g->set_events($e);			
$g->set_conditional_css($f_conditions); 
$uid=$_SESSION["member"]->getValue( "id" );
$g->select_command = "select * from yogis.tblfilemaster where  isinternal<>'Yes' and displayname<>'New'";
$g->set_options($grid);
$g->set_columns($cols);
$out_list = $g->render("list");

//Select Staff

$g1 = new jqgrid($db_conf); 

$col1 = array();
$col1["title"] = "id";
$col1["name"] = "id";
$col1["width"] = "50";
$col1["sortable"] = true;
$col1["search"] = false; 
$col1["editable"] = false;
$col1["hidden"] = true;
$cols1[] = $col1;	

$col1["title"] = "User";
$col1["name"] = "staffname";
$col1["width"] = "240";
$col1["sortable"] = false;
$col1["search"] = false; 
$col1["editable"] = false;
$col1["editoptions"] = array("size"=>200);
$col1["hidden"] = false;
$cols1[] = $col1;

$col1 = array();
$col1["title"] = "Allow access(View)?";
$col1["name"] = "pc";
$col1["width"] = "70";
$col1["sortable"] = false; 
$col1["search"] = false; 
$col1["editable"] = true; 
$col1["edittype"] = "checkbox";
$col1["editoptions"] = array("value"=>"Yes:No");
$col1["hidden"] = true; 
$col1["editrules"] = array("edithidden"=>true);
$cols1[] = $col1;

$col1 = array();
$col1["title"] = "Add";
$col1["name"] = "madd";
$col1["width"] = "70";
$col1["sortable"] = false; 
$col1["search"] = false; 
$col1["editable"] = true; 
$col1["edittype"] = "checkbox";
$col1["editoptions"] = array("value"=>"Yes:No");
$col1["hidden"] = true; 
$col1["editrules"] = array("edithidden"=>true);
$cols1[] = $col1;

$col1 = array();
$col1["title"] = "Edit";
$col1["name"] = "medit";
$col1["width"] = "70";
$col1["sortable"] = false; 
$col1["search"] = false; 
$col1["editable"] = true; 
$col1["edittype"] = "checkbox";
$col1["editoptions"] = array("value"=>"Yes:No");
$col1["hidden"] = true; 
$col1["editrules"] = array("edithidden"=>true);
$cols1[] = $col1;
/*
$col1 = array();
$col1["title"] = "Delete";
$col1["name"] = "mdelete";
$col1["width"] = "70";
$col1["sortable"] = false; 
$col1["search"] = false; 
$col1["editable"] = true; 
$col1["edittype"] = "checkbox";
$col1["editoptions"] = array("value"=>"Yes:No");
$col1["hidden"] = true; 
$col1["editrules"] = array("edithidden"=>true);
$cols1[] = $col1;*/

$grid1["rowList"] = array();
$grid1["pgbuttons"] = false;
$grid1["pgtext"] = null;
$grid1["viewrecords"] = true;
$grid1["scroll"] = false; 
$grid1["caption"] = "Unassigned user selection"; 
$grid1["autowidth"] = true;
$grid1["cellEdit"] =false; 
$grid1["rowList"] = array(); 
$grid1["rownumbers"] = true; 
$grid1["rownumWidth"] = 12; 
$grid1["searchoptions"] = false;
$grid1["rowNum"] = 2000; 
$grid1["sortname"] = 'id'; 
$grid1["sortorder"] = "asc"; 
$grid1["autowidth"] = false; 
$grid1["multiselect"] = true; 
$grid1["auto_width"] = false;
$grid1["shrinkToFit"] = false;
$grid1["reloadedit"] = true;
$grid1["afterSaveCell"] = "function() { jQuery(this).trigger('reloadGrid'); }";
$grid1["edit_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'200');
$grid1["width"] = 300;
$grid1["height"] =430;
$grid1["toolbar"] ="top";
$grid1["edit_options"]["beforeInitData"] = "function(formid){ var selr = jQuery('#list').jqGrid('getGridParam','selrow'); if (!selr) { alert('Please select the form first!'); return false; } }"; 
$e1["on_update"] = array("on_update", $fn_this, false); 
$g1->navgrid["param"]["edit"] = false; 
$g1->navgrid["param"]["add"] = false; 
$g1->navgrid["param"]["del"] = false; 
$g1->navgrid["param"]["search"] = false; 
$g1->navgrid["param"]["refresh"] = true; 
$g1->navgrid["param"]["view"] = false; 
//$g1->navgrid["param"]["refreshtext"] = "Refresh"; 
$g1->set_actions(array(	
"edit"=>false, 
"add"=>false,
"bulkedit"=>true,						
"rowactions"=>false, 
"delete"=>false, 
) 
);
if($fid==0){
$g1->select_command = "SELECT * from yogis.tbluser where id ='XX'"; 
}else{
$g1->select_command = "SELECT * from yogis.tbluser where id not in(select uid from yogis.tblfileaccessrights where fid='$fid' and access='Yes')"; 
}
$g1->set_events($e1);
$g1->set_options($grid1); 
$g1->set_columns($cols1); 
$out_list1 = $g1->render("list1");

//assigned users

$g2 = new jqgrid($db_conf); 

$col2 = array();
$col2["title"] = "id";
$col2["name"] = "id";
$col2["width"] = "50";
$col2["sortable"] = true;
$col2["search"] = false; 
$col2["editable"] = false;
$col2["hidden"] = true;
$cols2[] = $col2;	

$col2 = array();
$col2["title"] = "User";
$col2["name"] = "uid";
$col2["width"] = "220";
$col2["sortable"] = false; 
$col2["search"] = true; 
$col2["editable"] = false; 
$col2["align"] = "left"; 
$col2["edittype"] = "select";
$str = $g2->get_dropdown_values("select id as k, staffname as v from yogis.tbluser"); 
$col2["editoptions"] = array("value"=>$str); 
$col2["stype"] = "select"; 
$col2["searchoptions"] = array("value"=> ":;".$str); 
$col2["formatter"] = "select";
$col2["searchoptions"]["dataInit"] = "function(){ setTimeout(function(){ $('select[name=uid]').select2({width:'100%', dropdownCssClass: 'ui-widget ui-jqdialog'}); },200); }"; 
$cols2[] = $col2;

$col2 = array();
$col2["title"] = "Add";
$col2["name"] = "madd";
$col2["width"] = "40";
$col2["sortable"] = false; 
$col2["search"] = false; 
$col2["editable"] = true; 
$col2["edittype"] = "checkbox";
$str="Yes:Yes;No:No";
$col2["editoptions"] = array("value"=>$str);
$col2["searchoptions"] = array("value"=> $str); 
$col2["formatter"] = "select";
$col2["editrules"] = array("edithidden"=>true);
$cols2[] = $col2;

$col2 = array();
$col2["title"] = "Edit";
$col2["name"] = "medit";
$col2["width"] = "40";
$col2["sortable"] = false; 
$col2["search"] = false; 
$col2["editable"] = true; 
$col2["edittype"] = "checkbox";
$str="Yes:Yes;No:No";
$col2["editoptions"] = array("value"=>$str);
$col2["searchoptions"] = array("value"=> $str); 
$col2["formatter"] = "select";
$col2["editrules"] = array("edithidden"=>true);
$cols2[] = $col2;
/*
$col2 = array();
$col2["title"] = "Delete";
$col2["name"] = "mdelete";
$col2["width"] = "70";
$col2["sortable"] = false; 
$col2["search"] = false; 
$col2["editable"] = true; 
$col2["edittype"] = "checkbox";
$col2["editoptions"] = array("value"=>"Yes:No");
$col2["hidden"] = true; 
$col2["editrules"] = array("edithidden"=>true);
$cols2[] = $col2;*/
/*
session_start();
if (!empty($_POST["displayname"]))
$_SESSION["displayname"] = $_POST['displayname'];
$fid=$_REQUEST['displayname'];
*/
$grid2["rowList"] = array();
$grid2["pgbuttons"] = false;
$grid2["pgtext"] = null;
$grid2["viewrecords"] = false;
$grid2["scroll"] = false; 
$grid2["viewrecords"] = false; 
$grid2["caption"] = "Manage access rights"; 
$grid2["autowidth"] = true;
$grid2["cellEdit"] =false; 
$grid2["rowList"] = array(); 
$grid2["rownumbers"] = true; 
$grid2["rownumWidth"] = 12; 
$grid2["searchoptions"] = false;
$grid2["rowNum"] = 2000; 
$grid2["sortname"] = 'uid'; 
$grid2["sortorder"] = "asc"; 
$grid2["autowidth"] = false; 
$grid2["multiselect"] = true; 
$grid2["auto_width"] = false;
$grid2["shrinkToFit"] = false;
$grid2["reloadedit"] = true;

$grid2["afterSaveCell"] = "function() { jQuery(this).trigger('reloadGrid'); }";
$grid2["width"] =380;
$grid2["height"] =430;
$grid2["toolbar"] ="top";
$e2["on_update"] = array("on_update2", $fn_this, false); 
$g2->navgrid["param"]["edit"] = false; 
$g2->navgrid["param"]["add"] = false; 
$g2->navgrid["param"]["del"] = true; 
$g2->navgrid["param"]["search"] = false; 
$g2->navgrid["param"]["refresh"] = true; 
$g2->navgrid["param"]["view"] = false; 
$g2->set_actions(array(	
"edit"=>false, 
"add"=>false,
"bulkedit"=>true,						
"rowactions"=>false, 
"delete"=>false, 
) 
);
if($fid==0){
$g2->select_command = "SELECT * from yogis.tblfileaccessrights where fid ='XX'"; 
}else{
$g2->select_command = "SELECT * from yogis.tblfileaccessrights where fid='$fid'"; 
}
$g2->table = "tblfileaccessrights";
$g2->set_events($e2);
$g2->set_options($grid2); 
$g2->set_columns($cols2); 
$out_list2 = $g2->render("list2");
?> 
