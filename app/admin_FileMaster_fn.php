<?php
class admin_FileMaster extends DataObject{
	
public function __construct($f,$g){
$this->fn=$f;
$this->g=$g;
}
	
function after_update($data){ 
$pdoConn=parent::connect(); 
$msql="SELECT *  FROM yogis.tblfilemaster where fileid={$data["fileid"]}";
$stmt=$pdoConn->prepare($msql);
$stmt->execute();
while ($rowy = $stmt->fetch()) {
$filename=$rowy['filename'];
} 
$msql="delete from yogis.tblaccesslog where pageUrl='$filename'";
$stmt=$pdoConn->prepare($msql);
$stmt->execute();

}

function show_link($data){

$pdoConn=parent::connect();    
    
$id = $data["fileid"];
$mSql = "select * from yogis.tblfilemaster WHERE fileid = '$id'"; 
$stmt=$pdoConn->prepare($mSql);
$stmt->execute();
while($row = $stmt->fetch()) {
$displayname = $row['displayname'];
$filename = $row['filename'];
$isinternal=$row['isinternal'];
}
if($displayname=='New' or $isinternal=='Yes'){
return $displayname ;
}else{
$link ="<a href=". $filename ." style='text-decoration:none; white-space:none; border:1px solid gray; padding:2px; position:relative; width:25px; color:green'>" .$displayname . "</a>";
return $link;
}
}

}
