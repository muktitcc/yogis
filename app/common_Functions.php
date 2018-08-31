<?php
require_once "DataObject.class.php";
class common_Functions extends DataObject{

function _getApplicationUserName($id)
{
$pdoConn=parent::connect();	
$stmt=$pdoConn->prepare("SELECT * from yogis.tbluser where id=:id");
$stmt->bindParam(":id",$id);
$stmt->execute();
$row=$stmt->fetch();
return (strlen($row['username'])>0?$row['username']:$id);	
}

function _getUserName($id){
$pdoConn = parent::connect();
$mSql="select staffname  from yogis.tbluser where id in($id)";
$stmt = $pdoConn->prepare($mSql);
$stmt->execute();
$row = $stmt->fetch();
return (strlen($row['staffname'])>0?$row['staffname']:false);
}


}
?>