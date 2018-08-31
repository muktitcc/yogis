<?php
class admin_FileMaster extends DataObject{
	
public function __construct($f,$g){
$this->fn=$f;
$this->g=$g;
}
	
function after_update($data){ 
$msql="SELECT *  FROM yogis.tblfilemaster where fileid={$data["fileid"]}";
$r=mysql_query($msql);
while ($rowy = mysql_fetch_array($r)) {
$filename=$rowy['filename'];
} 
mysql_query("delete from yogis.tblaccesslog where pageUrl='$filename'");
}

function show_link($data){
$id = $data["fileid"];
$result = mysql_query("select * from yogis.tblfilemaster WHERE fileid = '$id'") or die(mysql_error()); 
while($row = mysql_fetch_array( $result )) {
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
