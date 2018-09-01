<?php
class admin_MenuStructure extends DataObject{
	
public function __construct($f,$g){
$this->fn=$f;
$this->g=$g;
}

function getRegistrationGrid($g){
$col = array();
$col["title"] = "Student#";
$col["name"] = "studentcode";
$col["width"] = "60";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = false;
$col["hidden"] = false;
$cols[] = $col;	

$col = array();
$col["title"] = "Student Name";
$col["name"] = "studentname";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>true, "edit"=>true, "view"=>false);
$cols[] = $col;	

$col = array();
$col["title"] = "DoB";
$col["name"] = "dateofbirth";
$col["width"] = "70";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["formatter"] = "date";
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>true, "edit"=>true, "view"=>false);
$col["formoptions"] = array("rowpos"=>"1", "colpos"=>"2"); 
$cols[] = $col;	

$col = array();
$col["title"] = "Medical Condition";
$col["name"] = "medicalcondition";
$col["width"] = "200";
$col["edittype"] = "textarea";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["editrules"] = array("required"=>true);
$col["editoptions"] = array("rows"=>4, "cols"=>60);
$col["show"] = array("list"=>false, "add"=>true, "edit"=>true, "view"=>false);
$cols[] = $col;

$col = array();
$col["title"] = "Mother's Name";
$col["name"] = "mothername";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>true, "edit"=>true, "view"=>false);
$cols[] = $col;

$col = array();
$col["title"] = "Father's Name";
$col["name"] = "fathername";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>true, "edit"=>true, "view"=>false);
$col["formoptions"] = array("rowpos"=>"4", "colpos"=>"2"); 
$cols[] = $col;

$col = array();
$col["title"] = "Address";
$col["name"] = "address";
$col["width"] = "200";
$col["edittype"] = "textarea";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["editoptions"] = array("rows"=>4, "cols"=>60);
$col["show"] = array("list"=>false, "add"=>true, "edit"=>true, "view"=>false);
$cols[] = $col;

$col = array();
$col["title"] = "Phone#";
$col["name"] = "phone";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>true, "edit"=>true, "view"=>false);
$cols[] = $col;

$col = array();
$col["title"] = "Emergency Phone#";
$col["name"] = "phoneemergency";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>true, "edit"=>true, "view"=>false);
$col["formoptions"] = array("rowpos"=>"7", "colpos"=>"2"); 
$cols[] = $col;

$col = array();
$col["title"] = "Reg. Date From";
$col["name"] = "regdatefrom";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["formatter"] = "date";
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>true, "edit"=>true, "view"=>false);
$cols[] = $col;	

$col = array();
$col["title"] = "Reg. Date To";
$col["name"] = "regdateto";
$col["width"] = "100";
$col["sortable"] = false;
$col["search"] = false; 
$col["editable"] = true;
$col["formatter"] = "date";
$col["editoptions"] = array("autocomplete"=>"off");
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>true, "edit"=>true, "view"=>false);
$col["formoptions"] = array("rowpos"=>"9", "colpos"=>"2"); 
$cols[] = $col;	



$col = array(); 
$col["title"] = "7777"; 
$col["name"] = "stdfile"; 
$col["width"] = "20"; 
$col["search"] = false; 
$col["editable"] = false; 
$col["on_data_display"] = array("showStdFile",$this);
$col["show"] = array("list"=>true,"edit"=>false,"add"=>false);
$col["editoptions"]["dataInit"] = "function(o){jQuery(o).parent().html(o.value);}"; 
$col["show"] = array("view"=>false);
$col["export"] = false;
$cols[] = $col;	

$col = array(); 
$col["title"] = ""; 
$col["name"] = "medfile"; 
$col["width"] = "20"; 
$col["search"] = false; 
$col["editable"] = false; 
$col["on_data_display"] = array("showMedFile",$this);
$col["show"] = array("list"=>true,"edit"=>false,"add"=>false);
$col["editoptions"]["dataInit"] = "function(o){jQuery(o).parent().html(o.value);}"; 
$col["show"] = array("view"=>false);
$col["export"] = false;
$cols[] = $col;


$col = array(); 
$col["title"] = "Student Image"; 
$col["name"] = "stdfileuplocation";  
$col["width"] = "50"; 
$col["editable"] = true;  
$col["edittype"] = "file"; 
$col["upload_dir"] = TEMP_DIR; 
$col["editrules"] = array("ifexist"=>"override"); // "rename", "override" can also be set 
$col["show"] = array("list"=>false,"edit"=>true,"add"=>true,"view"=>false); 
$col["export"] = false;
$cols[] = $col; 

$col = array(); 
$col["title"] = "Birth Certificate"; 
$col["name"] = "medfileuplocation";  
$col["width"] = "50"; 
$col["editable"] = true;  
$col["edittype"] = "file"; 
$col["upload_dir"] = TEMP_DIR; 
$col["editrules"] = array("ifexist"=>"override"); // "rename", "override" can also be set 
$col["show"] = array("list"=>false,"edit"=>true,"add"=>true,"view"=>false); 
$col["formoptions"] = array("rowpos"=>"11", "colpos"=>"2"); 
$col["export"] = false;
$cols[] = $col;


$col = array(); 
$col["title"] = ""; 
$col["name"] = "stdfileupload"; 
$col["width"] = "50"; 
$col["search"] = false; 
$col["editable"] = true; 
$col["on_data_display"] = array("showStdFile",$this);
$col["show"] = array("list"=>false,"edit"=>true,"add"=>false); // only show in listing & image in edit 
$col["editoptions"]["dataInit"] = "function(o){jQuery(o).parent().html(o.value);}"; 
$col["export"] = false;
$cols[] = $col;

$col = array(); 
$col["title"] = ""; 
$col["name"] = "medfileupload"; 
$col["width"] = "50"; 
$col["search"] = false; 
$col["editable"] = true; 
$col["on_data_display"] = array("showMedFile",$this);
$col["show"] = array("list"=>false,"edit"=>true,"add"=>false); // only show in listing & image in edit 
$col["editoptions"]["dataInit"] = "function(o){jQuery(o).parent().html(o.value);}"; 
$col["export"] = false;
$cols[] = $col;


$col = array();
$col["title"] = "Package"; 
$col["name"] = "package"; 
$col["width"] = "100";
$col["search"] = true;
$col["editable"] = true;
$col["edittype"] = "select";
$str = "1:Monthly;2:Six Months;3:One Year"; 
$col["editoptions"] = array("value"=>':;'.$str);  
$col["editrules"] = array("required"=>true);
$col["show"] = array("list"=>true, "add"=>true, "edit"=>true, "view"=>false);
$cols[] = $col;


$col = array();
$col["title"] = "Dance Category"; 
$col["name"] = "dancecategory"; 
$col["width"] = "100";
$col["search"] = false;
$col["editable"] = true;
$col["edittype"] = "select";
$col["editoptions"] = array('multiple'=>true);  
$str = $g->get_dropdown_values("select categoryid k, concat(description,' - ', categoryname) v from yogis.tbldancegroup a,yogis.tbldancecategory b where a.groupid=b.groupid"); 
$col["editoptions"] = array("value"=>$str,'multiple'=>true,"style"=>"width:100px");  
$col["editoptions"]["dataInit"] = 'function (elem) {
setTimeout(function () {
$(elem).multiselect({
height: "200",
width: "100",
checkAllText: "all",
uncheckAllText: "no",
noneSelectedText: "Any",
open: function () {
var $menu = $(".ui-multiselect-menu:visible");
$menu.width("auto");
return;
}
});
$(elem).multiselect().multiselectfilter();	
}, 50);
}'; 
$col["show"] = array("list"=>true,"view"=>false,"add"=>true,"edit"=>true); 
$col["formoptions"] = array("rowpos"=>"15", "colpos"=>"2");
$col["editrules"] = array("required"=>true);
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
$col["show"] = array("list"=>false, "add"=>false, "edit"=>true, "view"=>false);
$cols[] = $col;	

$grid["form"]["position"] = "";
$grid["rowList"] = array();
$grid["pgbuttons"] = true;
$grid["pgtext"] = null;
$grid["viewrecords"] = true;
$grid["scroll"] = false; 
$grid["caption"] = "Student Registration"; 
$grid["autowidth"] = true;
$grid["cellEdit"] =false; 
$grid["rowList"] = array(); 
$grid["rownumbers"] = true; 
$grid["rownumWidth"] = 12; 
$grid["searchoptions"] = false;
$grid["rowNum"] = 2000; 
$grid["sortname"] = 'studentcode'; 
$grid["sortorder"] = "desc"; 
$grid["autowidth"] = false; 
$grid["multiselect"] = false; 
$grid["auto_width"] = false;
$grid["shrinkToFit"] = false;
$grid["reloadedit"] = true;
$grid["edit_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'700');
$grid["add_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'700');
$grid["width"] = 1300;
$grid["height"] = 400;
$grid["toolbar"] = "top";

$grid["add_options"]["afterShowForm"] = 'function (form)  
{
jQuery("#medicalcondition").attr("rows",2);
jQuery("#medicalcondition").attr("cols",96);
jQuery("#medicalcondition").parent().attr("colspan",400);

jQuery("#address").attr("rows",2);
jQuery("#address").attr("cols",96);
jQuery("#address").parent().attr("colspan",400);

}';

$grid["edit_options"]["afterShowForm"] = 'function (form)  
{
jQuery("#medicalcondition").attr("rows",2);
jQuery("#medicalcondition").attr("cols",96);
jQuery("#medicalcondition").parent().attr("colspan",400);

jQuery("#address").attr("rows",2);
jQuery("#address").attr("cols",96);
jQuery("#address").parent().attr("colspan",400);

}';

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

$e["on_insert"] = array("on_insertStudent", $this, false);
$e["on_update"] = array("on_updateStudent", $this, false);
$g->set_events($e);

$g->set_conditional_css($f_conditions); 
$g->select_command = "select * from yogis.tblstudentregistration where status='Active'";
$g->table = "yogis.tbltopmenu";
$g->set_options($grid);
$g->set_columns($cols);
return $g->render("listStudentRegistration");	
}

function on_insertStudent($data){
$pdoConn=parent::connect();

$studentname=$data["params"]["studentname"];
$dateofbirth=$data["params"]["dateofbirth"];
$medicalcondition=$data["params"]["medicalcondition"];
$mothername=$data["params"]["mothername"];
$fathername=$data["params"]["fathername"];
$address=$data["params"]["address"];
$phone=$data["params"]["phone"];
$phoneemergency=$data["params"]["phoneemergency"];
$package=$data["params"]["package"];
$regdatefrom=$data["params"]["regdatefrom"];
$regdateto=$data["params"]["regdateto"];
$dancecategory=$data["params"]["dancecategory"];
$stdfileuplocation=$data["params"]["stdfileuplocation"];
$medfileuplocation=$data["params"]["medfileuplocation"];
$updatedby=$this->fn->_getApplicationUserName(UID);



$maxId=$this->fn->_getMaxId("yogis.tblstudentregistration","studentcode");
$studentcode=($maxId==1)?date('Y').substr('0000'.$maxId,-4):$maxId;




//phpgrid_error($studentcode);
$pdoConn->beginTransaction();
$mSql="insert into yogis.tblstudentregistration(studentcode,studentname,dateofbirth,medicalcondition,mothername,fathername,address,phone,phoneemergency,package,regdatefrom,regdateto,updatedby,updatedon,dancecategory)values(:studentcode,:studentname,:dateofbirth,:medicalcondition,:mothername,:fathername,:address,:phone,:phoneemergency,:package,:regdatefrom,:regdateto,:updatedby,now(),:dancecategory)";
	
try{

$stmt=$pdoConn->prepare($mSql);

$stmt->bindParam(":studentcode",$studentcode);
$stmt->bindParam(":studentname",$studentname);
$stmt->bindParam(":dateofbirth",$dateofbirth);
$stmt->bindParam(":medicalcondition",$medicalcondition);
$stmt->bindParam(":mothername",$mothername);
$stmt->bindParam(":fathername",$fathername);
$stmt->bindParam(":address",$address);
$stmt->bindParam(":phone",$phone);
$stmt->bindParam(":phoneemergency",$phoneemergency);
$stmt->bindParam(":package",$package);
$stmt->bindParam(":regdatefrom",$regdatefrom);
$stmt->bindParam(":regdateto",$regdateto);
$stmt->bindParam(":updatedby",$updatedby);
$stmt->bindParam(":dancecategory",$dancecategory);

$stmt->execute();
$pdoConn->commit();	
}catch(PDOException $e){
$pdoConn->rollBack();
phpgrid_error($e->getMessage());	
}

if($stdfileuplocation) 
{ 
$extStd = pathinfo(realpath($stdfileuplocation), PATHINFO_EXTENSION); 
$newFileStd = 'studentImages/'.$studentcode.'.'.$extStd;
$newfileThumb = 'studentImages/thumbnail/'.$studentcode.'.'.$extStd;

$mData=array("imagelocation"=>$stdfileuplocation,"newFile"=>$newFileStd,"newfileThumb"=>$newfileThumb,"studentcode"=>$studentcode,"requiredfiletype"=>"jpg","imagelocationfield"=>"studentimagelocation","imagefiletypefield"=>"studentimagefiletype");

$this->processStudentAttachmentOnInsert($mData);
}

if($medfileuplocation) 
{ 
$extMed = pathinfo(realpath($medfileuplocation), PATHINFO_EXTENSION); 
$newFileMed = 'birthCertificateImages/'.$studentcode.'.'.$extMed;

$mData=array("imagelocation"=>$medfileuplocation,"newFile"=>$newFileMed,"newfileThumb"=>false,"studentcode"=>$studentcode,"requiredfiletype"=>"pdf","imagelocationfield"=>"birthcertdoclocation","imagefiletypefield"=>"birthcertdocfiletype");

$this->processStudentAttachmentOnInsert($mData);
}

	
}

function on_updateStudent($data){
$pdoConn=parent::connect();
}


function processStudentAttachmentOnInsert($data){
$pdoConn=parent::connect();


if($data['imagelocation']){
$ext = pathinfo(realpath($data['imagelocation']), PATHINFO_EXTENSION); 
if($ext <> $data['requiredfiletype']) 
{
phpgrid_error($data['requiredfiletype']. " attachment could not be processed.");
unlink(realpath($data['imagelocation'])); 
} 
if(file_exists(APPDATA_DIR.$data['newFile']))
{
unlink( realpath(APPDATA_DIR.$data['newFile']));
}


$needThumb="";
if($data['newfileThumb']){
$needThumb=$this->fn->_getThumbnailImage(realpath($data['imagelocation']),APPDATA_DIR.$data['newfileThumb']);
}else{
$needThumb="ok";	
}

if (!copy(realpath($data['imagelocation']), APPDATA_DIR.$data['newFile']) or $needThumb!='ok'){	
phpgrid_error("failed to copy");
}else{
try{
$mSql="update yogis.tblstudentregistration set ". $data['imagelocationfield']."=:1,".$data['imagefiletypefield']."=:2 where studentcode=:3"; 
$stmt=$pdoConn->prepare($mSql);
$stmt->bindParam(":1",$data['newFile']);
$stmt->bindParam(":2",$ext);
$stmt->bindParam(":3",$data['studentcode']);
$stmt->execute();
}catch(PDOException $e){
phpgrid_error($e->getMessage());
}	
header("Cache-Control: no-cache, must-revalidate"); 
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
}
//phpgrid_error($data['imagelocation']);
unlink(realpath($data['imagelocation']));
}	
	
}


function showStdFile($data){
$pdoConn=parent::connect();
$id = $data["studentcode"];
$link='';
$fextension='';
$filelocation ='';
$mfile ='';

$mSql="select * from yogis.tblstudentregistration WHERE studentcode =:studentcode"; 
$stmt=$pdoConn->prepare($mSql);
$stmt->bindParam(":studentcode",$id);
$stmt->execute();
$row = $stmt->fetch(); 
$mfile = $row['studentcode'];
$fextension = $row['studentimagefiletype'];

$filelocation = APPDATA_DIR .'studentImages/'.$mfile.'.'.$fextension;
//phpgrid_error($filelocation);
$thumbfilelocation = APPDATA_DIR .'studentImages/thumbnail/'.$mfile.'.'.$fextension;		
if( $fextension=='jpg' or $fextension=='jpeg'){
$link ="<a class='studentImages'  title='".$this->fn->_getStudentName($mfile)."' href=".escapeshellarg($filelocation)." target='_blank'><img height=20 width=20 src='$thumbfilelocation'></a>";
}else {
$link="<img height=20 width=20 src='asset/images/employeeblankimage.png'>";
}
//phpgrid_error($link);

return $link;
}



}
?>




