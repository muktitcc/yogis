<?php
class admin_FileAccessRights extends DataObject{
	
public function __construct($f,$g){
$this->fn=$f;
$this->g=$g;
}

function bulkUpdate($data){
$selected_fid = $data["fileid"];
$muid=$data["params"]["muid"];
if(strlen($muid)==0){
phpgrid_error("User Required");
}
mysql_query("delete from  yogis.tblfileaccessrights where uid='$uid' and fid in($selected_fid)"); 
$marray = explode(',', $selected_fid); 
foreach($marray as $fid) 
{
mysql_query("INSERT INTO yogis.tblfileaccessrights(uid,fid,access)
VALUES ('$muid','$fid','Yes')"); 
}
}

function replicateuser($data){
$sourceuser=$data["params"]["sourceuser"];
$destinationuser=$data["params"]["destinationuser"];
if(strlen($sourceuser)==0 or strlen($destinationuser)==0){
phpgrid_error("Please select source/destination user");
}
mysql_query("delete from  yogis.tblfileaccessrights where uid='$destinationuser' and fid in(select fid from yogis.tblfileaccessrights where uid='$sourceuser')");
mysql_query("insert into yogis.tblfileaccessrights(uid, fid, access, note, medit, madd, mdelete, mview)  select ".$destinationuser.", fid, access, note, medit, madd, mdelete, mview from  yogis.tblfileaccessrights where uid='$sourceuser' and fid not in(select fid from yogis.tblfileaccessrights where uid='$destinationuser')");
}

function on_update($data){ 
$fid= FID;
$pc=$data["params"]["pc"];
$madd=$data["params"]["madd"];
$medit=$data["params"]["medit"];
$mdelete=$data["params"]["mdelete"];
$mview=$data["params"]["pc"];
$selected_uids = $data["id"];
$marray = explode(',', $selected_uids); //split string into array seperated by ', '
foreach($marray as $uid) //loop over values
{
if($pc=='Yes'){
mysql_query("INSERT INTO yogis.tblfileaccessrights(uid,fid,access,madd,medit,mdelete,mview)
VALUES ('$uid ','$fid','$pc','$madd','$medit','$mdelete','$mview')");
}		
}
} 

function on_update2($data){ 
$fid= FID;
$madd=$data["params"]["madd"];
$medit=$data["params"]["medit"];
$mdelete=$data["params"]["mdelete"];
$selected_uids = $data["id"];
$marray = explode(',', $selected_uids); 
foreach($marray as $uid) //loop over values
{
mysql_query("update yogis.tblfileaccessrights set madd='$madd',medit='$medit',mdelete='$mdelete' where fid='$fid' and id='$uid'");
}
} 



}
?> 
