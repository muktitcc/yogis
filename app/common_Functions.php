<?php
require_once "DataObject.class.php";
class common_Functions extends DataObject{
function __construct(){
    
}

function _myConn(){
	$conn = "";
	$conn= parent::connect();
	return $conn;
}
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

function _getStudentName($id){
$pdoConn = parent::connect();
$mSql="select concat(studentcode,' ',studentname) sname  from yogis.tblstudentregistration where studentcode in($id)";
$stmt = $pdoConn->prepare($mSql);
$stmt->execute();
$row = $stmt->fetch();
return (strlen($row['sname'])>0?$row['sname']:false);
}

function _getStaffEmail($id){
$pdoConn = parent::connect();
$stmt = $pdoConn->prepare("SELECT emailid FROM yogis.tbluser where id in($id)");
$stmt->execute();
$row = $stmt->fetch();
return (strlen($row['emailid'])>0?$row['emailid']:$id);
}


function _getMaxId($tablename,$pkfieldname){
$pdoConn = parent::connect();
$mSql="select max(ifnull(".$pkfieldname.",0))+1 as maxId from ".$tablename."";	
$stmt=$pdoConn->prepare($mSql);	
$stmt->execute();
$row=$stmt->fetch();
return empty($row["maxId"])?1:$row["maxId"];
}

function _sendEmail($fromEmail,$fromName,$to,$subject,$message){
$mail = new PHPMailerOAuth;
activateSMTP($mail);
$mail->setFrom($fromEmail, $fromName);                               
$mail->AddReplyTo($fromEmail, $fromEmail);
$addresses = explode(',', $to);
foreach ($addresses as $address) {
$mail->AddAddress($address);
}
$mail->Subject = $subject;
$mail->Body = $message;
return $mail->send();
}


function _getThumbnailImage($source_image_path, $thumbnail_image_path)
{
list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
switch ($source_image_type) {
case IMAGETYPE_GIF:
$source_gd_image = imagecreatefromgif($source_image_path);
break;
case IMAGETYPE_JPEG:
$source_gd_image = imagecreatefromjpeg($source_image_path);
break;
case IMAGETYPE_PNG:
$source_gd_image = imagecreatefrompng($source_image_path);
break;
}
if ($source_gd_image === false) {
return false;
}
$source_aspect_ratio = $source_image_width / $source_image_height;
$thumbnail_aspect_ratio = THUMBNAIL_IMAGE_MAX_WIDTH / THUMBNAIL_IMAGE_MAX_HEIGHT;
if ($source_image_width <= THUMBNAIL_IMAGE_MAX_WIDTH && $source_image_height <= THUMBNAIL_IMAGE_MAX_HEIGHT) {
$thumbnail_image_width = $source_image_width;
$thumbnail_image_height = $source_image_height;
} elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
$thumbnail_image_width = (int) (THUMBNAIL_IMAGE_MAX_HEIGHT * $source_aspect_ratio);
$thumbnail_image_height = THUMBNAIL_IMAGE_MAX_HEIGHT;
} else {
$thumbnail_image_width = THUMBNAIL_IMAGE_MAX_WIDTH;
$thumbnail_image_height = (int) (THUMBNAIL_IMAGE_MAX_WIDTH / $source_aspect_ratio);
}
$thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);

$img_disp = imagecreatetruecolor(THUMBNAIL_IMAGE_MAX_WIDTH,THUMBNAIL_IMAGE_MAX_WIDTH);
$backcolor = imagecolorallocate($img_disp,0,0,0);
imagefill($img_disp,0,0,$backcolor);

imagecopy($img_disp, $thumbnail_gd_image, (imagesx($img_disp)/2)-(imagesx($thumbnail_gd_image)/2), (imagesy($img_disp)/2)-(imagesy($thumbnail_gd_image)/2), 0, 0, imagesx($thumbnail_gd_image), imagesy($thumbnail_gd_image));
return "mmmm";
imagejpeg($img_disp, $thumbnail_image_path, 90);
imagedestroy($source_gd_image);
imagedestroy($thumbnail_gd_image);
imagedestroy($img_disp);
return "ok";
}

function _getDancePackage($id){
$pdoConn=parent::connect();

$mSql="select * from yogis.tbldancepackage where id=:1";
$stmt=$pdoConn->prepare($mSql);
$stmt->bindParam(":1",$id);
$stmt->execute();
$row=$stmt->fetch();
return $row['package'];

}

function _getDanceCategory($id){
$pdoConn=parent::connect();

$mSql="select group_concat(description,' - ', categoryname) v from yogis.tbldancegroup a,yogis.tbldancecategory b where a.groupid=b.groupid and categoryid in($id)";
$stmt=$pdoConn->prepare($mSql);
$stmt->execute();
$row=$stmt->fetch();
return $row['v'];

}


}
?>