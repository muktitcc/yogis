<?php
class admin_MenuStructure extends DataObject{
	
public function __construct($f,$g){
$this->fn=$f;
$this->g=$g;
}


function getUserGrid($g){
$col = array();
$col["title"] = "ID";
$col["name"] = "id";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = false;
$col["hidden"] = true;
$cols[] = $col;	

$col = array();
$col["title"] = "Login Name";
$col["name"] = "username";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>true, "edit"=>false, "view"=>false);
$cols[] = $col;	

$col = array();
$col["title"] = "Password";
$col["name"] = "password";
$col["edittype"] = "password";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>false, "add"=>true, "edit"=>false, "view"=>false);
$cols[] = $col;	

$col = array();
$col["title"] = "Retype Password";
$col["name"] = "repassword";
$col["edittype"] = "password";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>false, "add"=>true, "edit"=>false, "view"=>false);
$cols[] = $col;	


$col = array();
$col["title"] = "User Name";
$col["name"] = "staffname";
$col["width"] = "200";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>true, "edit"=>true, "view"=>false);
$cols[] = $col;

$col = array();
$col["title"] = "Email";
$col["name"] = "emailid";
$col["width"] = "200";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true,"regex"=>"/^(@|.)$/");
$col["show"] = array("list"=>true, "add"=>true, "edit"=>true, "view"=>false);
$cols[] = $col;	

$col = array();
$col["title"] = "Status"; 
$col["name"] = "status"; 
$col["width"] = "50";
$col["search"] = false;
$col["editable"] = true;
$col["edittype"] = "select";
$str = "Active:Active;Inactive:Inactive";
$col["editoptions"] = array("value"=> $str);  
$col["formatter"] = "select"; 
$col["stype"] = "select"; 
$col["searchoptions"] = array("value" => ':;'.$str); 
$col["show"] = array("list"=>true, "add"=>false, "edit"=>true, "view"=>false);
$cols[] = $col;	

$grid["form"]["position"] = "";
$grid["rowList"] = array();
$grid["pgbuttons"] = true;
$grid["pgtext"] = null;
$grid["viewrecords"] = true;
$grid["scroll"] = false; 
$grid["caption"] = "User Creation"; 
$grid["autowidth"] = true;
$grid["cellEdit"] =false; 
$grid["rowList"] = array(); 
$grid["rownumbers"] = true; 
$grid["rownumWidth"] = 12; 
$grid["searchoptions"] = false;
$grid["rowNum"] = 2000; 
$grid["sortname"] = 'id'; 
$grid["sortorder"] = "desc"; 
$grid["autowidth"] = false; 
$grid["multiselect"] = false; 
$grid["auto_width"] = false;
$grid["shrinkToFit"] = false;
$grid["reloadedit"] = true;
$grid["edit_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'350');
$grid["add_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'350');
$grid["width"] = 600;
$grid["height"] = 400;
$grid["toolbar"] = "top";
$grid["footerrow"] = false;
$g->navgrid["param"]["edit"] = $_SESSION['edit']; 
$g->navgrid["param"]["add"] = $_SESSION['add']; 
$g->navgrid["param"]["del"] = false; 
$g->navgrid["param"]["search"] = false; 
$g->navgrid["param"]["refresh"] = true; 
$g->navgrid["param"]["view"] = false;
$g->navgrid["param"]["edittext"] = "Edit"; 
$g->navgrid["param"]["addtext"] = "Add"; 
$g->navgrid["param"]["refreshtext"] = "Refresh";
$g->set_actions(array(	
"add"=>false, 
"edit"=>false, 
"rowactions"=>false, 
"delete"=>false, 
) 
);

$e["on_insert"] = array("on_insertUser", $this, false);
$e["on_update"] = array("on_updateUser", $this, false);
$g->set_events($e);

$g->set_conditional_css($f_conditions); 
$g->select_command = "select * from yogis.tbluser where status='Active'";
$g->table = "yogis.tbltopmenu";
$g->set_options($grid);
$g->set_columns($cols);
return $g->render("listUser");	
}

function on_insertUser($data){
phpgrid_error("insert");	
	
}

function on_updateUser($data){
phpgrid_error("insert");	
	
}
	
}
?>





