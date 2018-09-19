<?php
class feeStructure_FeeMaster extends DataObject{
	
public function __construct($f,$g){
$this->fn=$f;
$this->g=$g;
}

function getFeeStructureGrid($g){
$col = array();
$col["title"] = "ID#";
$col["name"] = "id";
$col["width"] = "80";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = false;
$col["hidden"] = false;
$cols[] = $col;	

$col = array();
$col["title"] = "Description";
$col["name"] = "description";
$col["width"] = "300";
$col["sortable"] = false;
$col["search"] = true; 
$col["editable"] = true;
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>true, "edit"=>true, "view"=>false);
$cols[] = $col;	

$col = array(); 
$col["title"] = "Package"; 
$col["name"] = "packageid"; 
$col["width"] = "100"; 
$col["align"] = "left"; 
$col["search"] = true; 
$col["editable"] = true; 
$col["edittype"] = "select"; 
$str = $g->get_dropdown_values("select id k, package v from yogis.tbldancepackage");   
$col["editoptions"] = array("value"=>$str); 
$col["stype"] = "select";
$col["formatter"] = "select"; 
$col["searchoptions"] = array("value"=>$str);
$col["editrules"] = array("required"=>true);
$cols[] = $col;

$col = array();
$col["title"] = "Fee Amount";
$col["name"] = "fee";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>true, "edit"=>false, "view"=>false);
$cols[] = $col;	


$col = array(); 
$col["title"] = "Status"; 
$col["name"] = "status"; 
$col["width"] = "100"; 
$col["align"] = "left"; 
$col["search"] = true; 
$col["editable"] = true; 
$col["edittype"] = "select"; 
$str = "Active:Active;Inactive:Inactive";   
$col["editoptions"] = array("value"=>$str); 
$col["stype"] = "select";
$col["formatter"] = "select"; 
$col["searchoptions"] = array("value"=>$str);
$col["show"] = array("list"=>false, "add"=>false, "edit"=>true, "view"=>false);
$cols[] = $col;


$grid["form"]["position"] = "";
$grid["rowList"] = array();
$grid["pgbuttons"] = true;
$grid["pgtext"] = null;
$grid["viewrecords"] = true;
$grid["scroll"] = false; 
$grid["caption"] = "Fee Structure"; 
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
$grid["width"] = 630;
$grid["height"] = 400;
$grid["toolbar"] = "top";

$grid["footerrow"] = false;
$g->navgrid["param"]["edit"] = true;//$_SESSION['edit']; 
$g->navgrid["param"]["add"] = true;//$_SESSION['add']; 
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

$e["on_insert"] = array("on_insertFees", $this, false);
$e["on_update"] = array("on_updateFees", $this, false);
$g->set_events($e);

$g->set_conditional_css($f_conditions); 
$g->select_command = "select * from yogis.tblfeestructure where status='Active'";
$g->table = "yogis.tbltopmenu";
$g->set_options($grid);
$g->set_columns($cols);
return $g->render("listFeeStructure");	
}


function on_insertFees($data){
$pdoConn=parent::connect();

$description=$data['params']['description'];
$packageid=$data['params']['packageid'];
$fee=$data['params']['fee'];


$mSql="insert into yogis.tblfeestructure(description,packageid,fee) values(:description,:packageid,:fee)";
try{
$stmt=$pdoConn->prepare($mSql);	
$stmt->bindParam(":description",$description);
$stmt->bindParam(":packageid",$packageid);	
$stmt->bindParam(":fee",$fee);	
$stmt->execute();	
}catch(PDOException $e){
phpgrid_error($e->getMessage());	
	
}


	
}

function on_updateFees($data){
$pdoConn=parent::connect();

$id=$data['id'];
$description=$data['params']['description'];
$packageid=$data['params']['packageid'];
$status=$data['params']['status'];


$mSql="update yogis.tblfeestructure set description=:description,packageid=:packageid,status=:status where id=:id";
try{
$stmt=$pdoConn->prepare($mSql);	
$stmt->bindParam(":description",$description);
$stmt->bindParam(":packageid",$packageid);
$stmt->bindParam(":status",$status);	
$stmt->bindParam(":id",$id);	
$stmt->execute();	
}catch(PDOException $e){
phpgrid_error($e->getMessage());	
	
}


	
}


}
?>





