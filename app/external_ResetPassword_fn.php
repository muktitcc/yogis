<?php
class external_ResetPassword extends DataObject{
public function __construct($f,$m){
$this->fn=$f;
$this->mc=$m;
	
}
function checkUserNameAndEmail($userName){
		
$pdoConn=parent::connect();
$userName=$this->mc->decrypt($userName);	
$mSql="select * from yogis.tbluser where username=:username and status not in('C')";
$stmt=$pdoConn->prepare($mSql);
$stmt->bindParam(":username",$userName);
$stmt->execute();
if($stmt->rowCount()>0){

if ($this->checkRequestValidity($userName,1)==1){
return "You have already reset your password.This service will avilable only after 24 hours from the previous successful reset.Please check your email and follow the instruction.";	
}

if (self::checkRequestValidity($userName,2)==1){
return  "You have not processed the earlier reset.Please check your email and follow the instruction.";	
}
$row=$stmt->fetch();
if($row["emailid"]){
$tmpEmail=explode(",",$row["emailid"]);
$myEmail=$tmpEmail[0];
$userId=$row["id"];
$username=$row["username"];
$email=$row["emailid"];
$mySessionId=$userName.session_id();	
$mySessionIdEncrypted=$this->mc->encrypt($mySessionId);
if(self::sendEmail($myEmail,$mySessionIdEncrypted,$userId)=="ok"){
$mSql_inner="insert into yogis.tbluser_resetpassword(userid,username,email,requesteddate,midentification) values('$userId','$username','$email',now(),'$mySessionIdEncrypted')";
try{
$stmt_inner=$pdoConn->prepare($mSql_inner);
$stmt_inner->execute();
return "Your request has been processed Please check your email(".$email.")";
}catch(PDOException $p){
return $p->getMessage();
}
}else{
return "Your request could not be processed at this time.This could be due to SMTP error.";	
}	
}else{
return "Email address not found for the user <b>$userName</b>";	
}
}else{
return "User <b>$userName</b> not found in our record.";
}
}

function sendEmail($myEmail,$mySessionIdEncrypted,$staffcode){
$pdoConn=parent::connect();
$authCode=urlencode($mySessionIdEncrypted);
$to=$myEmail;
$staffName=$this->fn->_getUserName($staffcode);
$subject = "Password Reset";
$message         = '
<html>
<head>
<title>Password Reset</title>
</head>
<body>
<p>Dear '.$staffName.',<br>You have requested the password reset.Please <a href="http://rmt.mountainhazelnuts.com/yogis/external_ResetPassword_authenticate.php?m=' . $authCode . ' ">follow the link</a> to confirm password reset. <br><br><b><u>Note:</u>This link is valid for 24 hours only.</b></p>
</body>
</html>
';	
$mail = new PHPMailerOAuth;
activateSMTP($mail);
$mail->setFrom("noreply@mountainhazelnuts.com", "Password Reset Service");                                 
$mail->AddReplyTo("noreply@mountainhazelnuts.com", "Password Reset Service");
$addresses = explode(',', $to);
foreach ($addresses as $address) {
$mail->AddAddress($address);
}
$mail->Subject = $subject;
$mail->Body = $message;
if(!$mail->send()){
return "er"; 
}else{
return "ok";

}
}

function checkRequestValidity($userName,$v){
$pdoConn=parent::connect();
switch($v){
case ($v=='1'):
$mSql="select * from yogis.tbluser_resetpassword where isprocessed='Yes' and username='$userName' and TIMESTAMPDIFF(HOUR, requesteddate, now())<=24";
$stmt=$pdoConn->prepare($mSql);
$stmt->execute();
return $stmt->rowCount()>0?1:0;
break;

case ($v=='2'):
$mSql="select * from yogis.tbluser_resetpassword where isprocessed='No' and  username='$userName'and TIMESTAMPDIFF(HOUR, requesteddate, now())<=24";
$stmt=$pdoConn->prepare($mSql);
$stmt->execute();
return $stmt->rowCount()>0?1:0;
break;
}

}

function processPasswordReset($m){
$pdoConn=parent::connect();
if(self::checkAuthValidity($m)==1){
$mSql="select * from yogis.tbluser_resetpassword where midentification='$m'";
$stmt=$pdoConn->prepare($mSql);	
$stmt->execute();
$row=$stmt->fetch();
$userid=$row["userid"];
$email=$row["email"];
$newPassword=$this->fn->_getRandomString(8);
if(self::sendEmailWithPassword($email,$newPassword,$userid)=="ok"){
$mSql="update yogis.tbluser set password=password(:password) where id='$userid'";
$stmt=$pdoConn->prepare($mSql);
$stmt->bindParam(":password",$newPassword);
$stmt->execute();

$mSql="update yogis.tbluser_resetpassword set isprocessed='Yes' where midentification='$m'";
$stmt=$pdoConn->prepare($mSql);
$stmt->execute();
//return $newPassword;
return '" <div style="position:absolute;left:550px;top:200px;margin:10px;width:500px;"><ul class="nav nav-pills"><li class="active">Your new password is <b>'.$newPassword.'</b> <a align="center" href="logout.php">Login</a></li></ul></div>';
 
}else{
return "Could not process your new password at this time.";
}
}else{
return "Looks like this link is either expired and could not be processed at this time.";
}	
}

function checkAuthValidity($m){
$pdoConn=parent::connect();

$mSql="select * from yogis.tbluser_resetpassword where isprocessed='No' and midentification='$m' and TIMESTAMPDIFF(HOUR, requesteddate, now())<=24";
$stmt=$pdoConn->prepare($mSql);
$stmt->execute();
return $stmt->rowCount()>0?1:0;
}
function sendEmailWithPassword($myEmail,$myPassword,$staffcode){
$pdoConn=parent::connect();
$authCode=urlencode($mySessionIdEncrypted);
$to=$myEmail;
$staffName=$this->fn->_getUserName($staffcode);
$subject = "Password Reset";
$message         = '
<html>
<head>
<title>Password Reset</title>
</head>
<body>
<p>Dear '.$staffName.',<br>Your new password is <b>'.$myPassword.'</b></p>
</body>
</html>
';	
$mail = new PHPMailerOAuth;
activateSMTP($mail);
$mail->setFrom("noreply@yogis.com", "Password Reset Service");                                 
$mail->AddReplyTo("noreply@yogis.com", "Password Reset Service");
$addresses = explode(',', $to);
foreach ($addresses as $address) {
$mail->AddAddress($address);
}
$mail->Subject = $subject;
$mail->Body = $message;
if(!$mail->send()){
return "er"; 
}else{
return "ok";

}
}
}
?>