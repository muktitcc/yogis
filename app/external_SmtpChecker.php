<?php
require_once( "common.inc_.php" );
$to='muktitcc@gmail.com';
$cc='mchhetri@mountainhazelnuts.com';
//,pcrees@mountainhazelnuts.com,kchophel@mountainhazelnuts.com,swangchuk@mountainhazelnuts.com
$message="Dear All<br> This is an email sent from smtp.gmail.com<br>Regards<br>Mukti";
$subject="MH SMTP Test";
$mail = new PHPMailerOAuth;
activateSMTP($mail);
$mail->setFrom('kwangchuk@mountainhazelnuts.com ', 'Kinley');                                  
$mail->AddReplyTo('kwangchuk@mountainhazelnuts.com ', 'Kinley');
$mail->AddCC($email_1);

$cc = explode(',', $cc);
foreach ($cc as $address){
$mail->AddCC($address);
}

$addresses = explode(',', $to);
foreach ($addresses as $address) {
$mail->AddAddress($address);
}
$mail->Subject = $subject;
$mail->Body = $message;
if(!$mail->send()){
echo "Mail not sent;". $mail->ErrorInfo; 
}else{
echo "Mail Sent";
}
?>
