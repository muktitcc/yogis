<?php
class mainMenu extends DataObject{
	
public function __construct($f){

$this->fn=$f;	
	
}

function firstLevelMenu(){
$pdoConn=parent::connect();
$mSql="SELECT *  FROM yogis.tbltopmenu  order by displayorder";
$stmt=$pdoConn->prepare($mSql);
$stmt->execute();
return $stmt;
}


function secondLevelMenu($topmenuid){
$pdoConn=parent::connect();
$mSql="SELECT *  FROM yogis.tblsecondlevelmenu  where topmenuid= :topmenuid and isactive='Yes' order by topmenuid,displayorder";
$stmt=$pdoConn->prepare($mSql);
$stmt->bindParam(":topmenuid",$topmenuid);
$stmt->execute();
return $stmt;
}

function getFileDetail($topmenuid){
$pdoConn=parent::connect();
$mSql="SELECT *  FROM yogis.tblsecondlevelmenu  where topmenuid= :topmenuid and isactive='Yes' order by topmenuid,displayorder";
$stmt=$pdoConn->prepare($mSql);
$stmt->bindParam(":topmenuid",$topmenuid);
$stmt->execute();
return $stmt;
}
	
	
}



?>