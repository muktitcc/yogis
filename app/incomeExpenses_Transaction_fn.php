<?php
class incomeExpenses_Transaction extends DataObject{
	
public function __construct($f,$g){
$this->fn=$f;
$this->g=$g;
}

function getTransactionGrid($g){
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
$col["title"] = "Trn.Date";
$col["name"] = "trndate";
$col["width"] = "80";
$col["sortable"] = false;
$col["search"] = true; 
$col["editable"] = true;
$col["formatter"] = "date";
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>true, "edit"=>true, "view"=>false);
$cols[] = $col;	

$col = array(); 
$col["title"] = "Year"; 
$col["name"] = "myear"; 
$col["dbname"] = "year(trndate)"; 
$col["width"] = "50"; 
$col["align"] = "left"; 
$col["search"] = true; 
$col["editable"] = false; 
$col["edittype"] = "select"; 
$str = $g->get_dropdown_values("select distinct year(trndate) k, year(trndate) v from yogis.tbltransaction");   
$col["editoptions"] = array("value"=>":;".$str); 
$col["stype"] = "select";
$col["formatter"] = "select"; 
$col["searchoptions"] = array("value"=>":;".$str);
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true,"add"=>false,"edit"=>false);
$cols[] = $col;


$col = array(); 
$col["title"] = "Month"; 
$col["name"] = "mmonth"; 
$col["dbname"] = "month(trndate)"; 
$col["width"] = "50"; 
$col["align"] = "left"; 
$col["search"] = true; 
$col["editable"] = false; 
$col["edittype"] = "select"; 
$str = $g->get_dropdown_values("select distinct monthno k, mname v from yogis.tblmonth");   
$col["editoptions"] = array("value"=>":;".$str); 
$col["stype"] = "select";
$col["formatter"] = "select"; 
$col["searchoptions"] = array("value"=>":;".$str);
$col["show"] = array("list"=>true,"add"=>false,"edit"=>false);
$cols[] = $col;




$col = array(); 
$col["title"] = "Account Type"; 
$col["name"] = "accounttype"; 
$col["width"] = "100"; 
$col["align"] = "left"; 
$col["search"] = true; 
$col["editable"] = true; 
$col["edittype"] = "select"; 
$str = "Fee_Income:Fee_Income;Other_Income:Other_Income;Expenses:Expenses";   
$col["editoptions"] = array("value"=>":;".$str,"onchange" =>array("sql"=>"select studentcode k, concat(studentcode,' ',studentname) v from yogis.tblstudentregistration where status='Active' and accounttype='{accounttype}' union select id k, concat(id,' ',ledger) v from yogis.tblledger where status='Active' and accounttype='{accounttype}'","update_field" => "ledger")); 
$col["stype"] = "select";
$col["formatter"] = "select"; 
$col["searchoptions"] = array("value"=>":;".$str);
$col["editrules"] = array("required"=>true);
$cols[] = $col;


$col = array(); 
$col["title"] = "Ledger"; 
$col["name"] = "ledger"; 
$col["width"] = "270"; 
$col["align"] = "left"; 
$col["search"] = true; 
$col["editable"] = true; 
$col["edittype"] = "select"; 
$str = $g->get_dropdown_values("select studentcode k, concat(studentcode,' ',studentname) v from yogis.tblstudentregistration where status='Active' union select id k, concat(id,' ',ledger) v from yogis.tblledger where status='Active'");   
$col["editoptions"] = array("value"=>":;".$str,"onchange" =>"showHide(value)"); 
$col["stype"] = "select";
$col["formatter"] = "select"; 
$col["editoptions"]["dataInit"] = "function(){ setTimeout(function(){ $('select[name=ledger]').select2({width:'270px', dropdownCssClass: 'ui-widget ui-jqdialog'}); },200); }"; 
$col["searchoptions"] = array("value"=>":;".$str);
$col["searchoptions"]["dataInit"] = "function(){ setTimeout(function(){ $('select[name=ledger]').select2({width:'270px', dropdownCssClass: 'ui-widget ui-jqdialog'}); },200); }"; 
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true,"add"=>true,"edit"=>true);
$cols[] = $col;


$col = array();
$col["title"] = "Amount";
$col["name"] = "amount";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>false, "add"=>true, "edit"=>true, "view"=>false);
	$col["editoptions"]["dataInit"] ='function(element) {
	$(element).keyup(function(){
	var val1 = element.value;
	var num = new Number(val1);
	if(isNaN(num))
	{this.value="";}
	})
	}';
$cols[] = $col;	



$col = array();
$col["title"] = "Credit";
$col["name"] = "credit";
$col["width"] = "100";
$col["sortable"] = false;
$col["align"] = "right";
$col["search"] = false; 
$col["editable"] = false;
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>false, "edit"=>false, "view"=>false);
$cols[] = $col;	


$col = array();
$col["title"] = "Debit";
$col["name"] = "debit";
$col["width"] = "100";
$col["sortable"] = false;
$col["align"] = "right";
$col["search"] = false; 
$col["editable"] = false;
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>false, "edit"=>false, "view"=>false);
$cols[] = $col;	


$col = array();
$col["title"] = "Naration";
$col["name"] = "naration";
$col["width"] = "270";
$col["sortable"] = true;
$col["search"] = false; 
$col["editable"] = true;
$col["edittype"] = "textarea";
$col["editoptions"] = array("rows"=>3, "cols"=>50); 
$col["show"] = array("list"=>true, "add"=>true, "edit"=>true, "view"=>false);
$col["editrules"] = array("required"=>true);
$cols[] = $col;	


$col = array(); 
$col["title"] = "Is full<br>payment"; 
$col["name"] = "isfullpayment"; 
$col["width"] = "100"; 
$col["align"] = "left"; 
$col["search"] = true; 
$col["editable"] = true; 
$col["edittype"] = "select"; 
$str = "Yes:Yes;No:No";   
$col["editoptions"] = array("value"=>":;".$str,"onchange" =>"showHide(value)"); 
$col["stype"] = "select";
$col["formatter"] = "select"; 
$col["searchoptions"] = array("value"=>":;".$str);
$col["show"] = array("list"=>false, "add"=>true, "edit"=>true, "view"=>false);
$cols[] = $col;


$col = array();
$col["title"] = "Next payment<br>date";
$col["name"] = "notificationdate";
$col["width"] = "80";
$col["sortable"] = false;
$col["search"] = true; 
$col["editable"] = true;
$col["formatter"] = "date";
$col["editoptions"] = array("autocomplete"=>"off");
$col["show"] = array("list"=>false, "add"=>true, "edit"=>true, "view"=>false);
$col["editrules"] = array("required"=>true);
$cols[] = $col;


$grid["form"]["position"] = "";
$grid["rowList"] = array();
$grid["pgbuttons"] = true;
$grid["pgtext"] = null;
$grid["viewrecords"] = true;
$grid["scroll"] = false; 
$grid["caption"] = "Transaction"; 
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
$grid["footerrow"] = true;
$grid["edit_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'450');
$grid["add_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'450');
$grid["width"] = 1190;
$grid["height"] = 400;
$grid["toolbar"] = "top";


$grid["add_options"]["afterShowForm"] = 'function (form)  
{
$("#tr_isfullpayment").hide();
$("#tr_notificationdate").hide();

jQuery("input[name=notificationdate].FormElement").val("0000-00-00"); 
}';

$grid["edit_options"]["afterShowForm"] = 'function (form)  
{
//("#tr_isfullpayment").hide();
//$("#tr_notificationdate").hide();


var grid = $("#listTransaction"); 
var rowid = grid.getGridParam("selrow"); 
var data = grid.getRowData(rowid);

if(data.debit>0){
jQuery("input[name=amount].FormElement").val(data.debit);     
}else{
jQuery("input[name=amount].FormElement").val(data.credit);    
}
 


showHideOnEdit(data.accounttype,data.isfullpayment);


}';


$g->navgrid["param"]["edit"] = false;//$_SESSION['edit']; 
$g->navgrid["param"]["add"] = true;//$_SESSION['add']; 
$g->navgrid["param"]["del"] = true; 
$g->navgrid["param"]["search"] = false; 
$g->navgrid["param"]["refresh"] = true; 
$g->navgrid["param"]["view"] = false;
$g->navgrid["param"]["deltext"] = "Delete"; 
$g->navgrid["param"]["addtext"] = "Add"; 
$g->navgrid["param"]["refreshtext"] = "Refresh";
$g->set_actions(array(	
"add"=>false, 
"edit"=>false, 
"rowactions"=>false, 
"delete"=>false,
"search"=>"advanced", 
) 
);

$e["on_insert"] = array("on_insertTransaction", $this, false);
$e["on_delete"] = array("on_deleteTransaction", $this, false);
$g->set_events($e);


$e["js_on_load_complete"] = "do_onload"; 
$g->set_events($e);

$g->set_conditional_css($f_conditions); 
$g->select_command = "select *,month(trndate) mmonth,year(trndate) myear, isnotified isfullpayment from yogis.tbltransaction where status='Active'";
$g->table = "yogis.tbltransaction";
$g->set_options($grid);
$g->set_columns($cols);
return $g->render("listTransaction");	
}


function on_deleteTransaction($data){
$pdoConn=parent::connect();

$id=$data['id'];
$updatedby=$this->fn->_getApplicationUserName(UID);

$mSql="update yogis.tbltransaction set status='Inactive',updatedby=:updatedby,updateddate=now() where id=:id";
$stmt=$pdoConn->prepare($mSql);
$stmt->bindParam(":id",$id);
$stmt->bindParam(":updatedby",$updatedby);
$stmt->execute();

$mSql="update yogis.tblfeetransaction set status='Inactive' where trnid=:trnid";
$stmt=$pdoConn->prepare($mSql);
$stmt->bindParam(":trnid",$id);
$stmt->execute();






    
    
}

function on_insertTransaction($data){
$pdoConn=parent::connect();


$trndate=$data['params']['trndate'];
$accounttype=$data['params']['accounttype'];
$ledger=$data['params']['ledger'];
$amount=$data['params']['amount'];
$naration=$data['params']['naration'];
$isfullpayment=empty($data['params']['isfullpayment'])?"Na":$data['params']['isfullpayment'];
$notificationdate=empty($data['params']['notificationdate'])?"0000-00-00":$data['params']['notificationdate'];




$isnotified="No";


$package="";
$dancecategory="";

$debit=0;
$credit=0;

$updatedby=$this->fn->_getApplicationUserName(UID);

$today= date("Y-m-d");


if(strlen($isfullpayment)==0){
phpgrid_error("Please select payment mode.");
    
}


if(strcmp($isfullpayment,"No")==0){
if(empty($notificationdate)){
phpgrid_error("Please enter valid date.");
}

if($notificationdate===NULL){
phpgrid_error("Please enter valid date.");
}



if($notificationdate<$today ){
phpgrid_error("Please select future date.");   
}
    
    
}else{
$isnotified="Na";   
}


switch($accounttype){
    
    case($accounttype=='Fee_Income'):
    $package=$this->getMasterData($ledger,"package");
    $dancecategory=$this->getMasterData($ledger,"dancecategory");
    $credit=$amount;
    break;
    
    case($accounttype=='Other_Income'):
    $credit=$amount;
    break;
    
    case($accounttype=='Expenses'):
    $debit=$amount;
    break;
    
    
    
}







$pdoConn->beginTransaction();

$maxId=$this->fn->_getMaxId("yogis.tbltransaction","id");

$mSql="insert into yogis.tbltransaction(id,trndate, accounttype, ledger, debit, credit, naration, updatedby, updateddate, status,isnotified) values(:id,:trndate, :accounttype, :ledger, :debit, :credit, :naration, :updatedby, now(), 'Active',:isnotified)";
try{
$stmt=$pdoConn->prepare($mSql);	
$stmt->bindParam(":id",$maxId);
$stmt->bindParam(":trndate",$trndate);
$stmt->bindParam(":accounttype",$accounttype);	
$stmt->bindParam(":ledger",$ledger);
$stmt->bindParam(":debit",$debit);
$stmt->bindParam(":credit",$credit);
$stmt->bindParam(":naration",$naration);
$stmt->bindParam(":updatedby",$updatedby);	
$stmt->bindParam(":isnotified",$isnotified);	
$stmt->execute();	
}catch(PDOException $e){
$pdoConn->rollBack();
phpgrid_error($e->getMessage());	
}


if(strcmp($accounttype,'Fee_Income')==0){

$mSql="insert into yogis.tblfeetransaction(studentid, paymentdate,  amount, notificationdate, isnotified, note, trnid, package, dancecategory) values(:studentid, :paymentdate, :amount, :notificationdate, :isnotified, :note, :trnid, :package, :dancecategory)";
try{
$stmt=$pdoConn->prepare($mSql);	
$stmt->bindParam(":studentid",$ledger);
$stmt->bindParam(":paymentdate",$trndate);
$stmt->bindParam(":amount",$amount);
$stmt->bindParam(":notificationdate",$notificationdate);
$stmt->bindParam(":isnotified",$isnotified);
$stmt->bindParam(":note",$naration);
$stmt->bindParam(":trnid",$maxId);
$stmt->bindParam(":package",$package);
$stmt->bindParam(":dancecategory",$dancecategory);
$stmt->execute();	
}catch(PDOException $e){
$pdoConn->rollBack();
phpgrid_error($e->getMessage());	
	
}


$mSql="update yogis.tblfeetransaction set isnotified='Na' where studentid=:studentid and notificationdate<:notificationdate";
try{
$stmt=$pdoConn->prepare($mSql);	
$stmt->bindParam(":studentid",$ledger);
$stmt->bindParam(":notificationdate",$notificationdate);
$stmt->execute();	
}catch(PDOException $e){
$pdoConn->rollBack();
phpgrid_error($e->getMessage());	
	
}



}


$pdoConn->commit();	
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




function getMasterData($studentcode,$field){

$pdoConn=parent::connect();    
    
$mSql="select ".$field." from yogis.tblstudentregistration where studentcode=:studentcode";
try{
$stmt=$pdoConn->prepare($mSql); 
$stmt->bindParam(":studentcode",$studentcode);
$stmt->execute();
    //phpgrid_error("fff");
if($stmt->rowCount()>0){
$row=$stmt->fetch();
return $row[$field];

    
}else{
return "";   
}
}catch(PDOException $e){
phpgrid_error($e->getMessage());    
    
}

 
}


}
?>





