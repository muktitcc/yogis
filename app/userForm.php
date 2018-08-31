<?php
require_once( "common.inc_.php" );
require_once("userAuthentication.php");
displayPageHeader( "", false );
require_once( "config_.php" );

if ( isset( $_POST["action"] ) and $_POST["action"] == "userForm" ) {
  processForm();
} else {
  displayForm( array(), array(), new Member( array() ) );
}

function displayForm( $errorMessages, $missingFields, $member ) {
  displayPageHeader( "Register" );

  if ( $errorMessages ) {
    foreach ( $errorMessages as $errorMessage ) {
      echo $errorMessage;
    }
  } else {
?>
   
<?php } ?>



<div class="buttons" style="width:12em;margin-left:305px;clear: both;">
   <p><h3>User Maintainance</h3></p>
   </div>
    <form action="userForm.php" method="post" style="margin-bottom: 50px;">
      <div style="width: 30em;">
        <input type="hidden" name="action" value="userForm" />
<input type="hidden" name="tblid" id="tblid" value="<?php echo 2 ?>" />
        <label id="mlabel" for="username"<?php validateField( "username", $missingFields ) ?>>User Name *</label>
        <input id="minput" type="text" name="username" id="username" placeholder="Enter user name here,eg: sonam" value="<?php echo $member->getValueEncoded( "username" ) ?>" />

        <label id="mlabel" for="password1"<?php if ( $missingFields ) echo ' class="error"' ?>>Password *</label>
        <input id="minput" type="password" name="password1" id="password1" placeholder="Password" value="" />
        <label id="mlabel" for="password2"<?php if ( $missingFields ) echo ' class="error"' ?>>Retype password *</label>
        <input id="minput" type="password" name="password2" id="password2" placeholder="same password again" value="" />

	 
 
 
<div style="position:absolute;left:-100px;top:230px;margin:10px;width:500px;">		
<div class="buttons" style="width:12em;margin-left:305px;clear: both;">
<button type="submit" name="submitButton" id="="submitButton" value="Send Details" class="positive">
<img src="asset/images/tick.png" alt=""/> Save </button>   
<button type="reset" name="resetButton" id="resetButton" value="Reset Form" class="negative">
<img src="asset/images/cross.png" alt=""/>Cancel </button>  
</div>
</div>		
		
		
		
		

      </div>
    </form>
	
	
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  
</script>

<?php
}

function setSelected1($fieldName,$fieldValue){
if(isset($_POST[$fieldName])){
foreach($_POST["ccemail"] as $ccemail){
if($ccemail==$fieldValue){
echo ' selected="selected"';
}
}
}
}
function processForm() {

  $requiredFields = array( "username", "password",  "staffcode");
  $missingFields = array();
  $errorMessages = array();

  $member = new Member( array( 
    "username" => isset( $_POST["username"] ) ? preg_replace( "/[^ \-\_a-zA-Z0-9]/", "", $_POST["username"] ) : "",
    "password" => ( isset( $_POST["password1"] ) and isset( $_POST["password2"] ) and $_POST["password1"] == $_POST["password2"] ) ? preg_replace( "/[^ \-\_a-zA-Z0-9]/", "", $_POST["password1"] ) : "",
    "emailid" => getemail($_POST["staffcode"]),
    "staffname" => getstaffname($_POST["staffcode"]),
    "staffcode" => isset( $_POST["staffcode"] ) ? preg_replace( "/[^ \'\-a-zA-Z0-9]/", "", $_POST["staffcode"] ) : "",
    "dept" => getdept($_POST["staffcode"]),
	"webuserid" =>$_SESSION["member"]->getValue( "id" ),
	"tblid" => $_POST["tblid"],
     ) );

  foreach ( $requiredFields as $requiredField ) {
  
    if ( !$member->getValue( $requiredField ) ) {
	
      $missingFields[] = $requiredField;
	  
    }
  }

  if ( $missingFields ) {
    $errorMessages[] = '<p class="error">There were some missing fields in the form you submitted. Please complete the fields highlighted below and click Send Details to resend the form.</p>';
  }

  if ( !isset( $_POST["password1"] ) or !isset( $_POST["password2"] ) or !$_POST["password1"] or !$_POST["password2"] or ( $_POST["password1"] != $_POST["password2"] ) ) {
    $errorMessages[] = '<p class="error">Please make sure you enter your password correctly in both password fields.</p>';
  }

  if ( Member::getByUsername( $member->getValue( "username" ) ) ) {
    $errorMessages[] = '<p class="error">Username already exists . Please choose another username.</p>';
  }

 
    if ( Member::getByStaffCode( $member->getValue( "staffcode" ) ) ) {
    $errorMessages[] = '<p class="error">User already exist.</p>';
  }

  if ( $errorMessages ) {
    displayForm( $errorMessages, $missingFields, $member );
  } else {
    $member->insert();
	//$member->update();
	sendMailToUser($_POST["staffcode"]);
    displayThanks();
	
  }
}

function displayThanks() {
 displayPageHeader( "Record Saved!" );
//sendMailToResponce($_POST["staffcode"]);
?>
<div id='main'  "style"left=9px>
   <p>Record Saved Successfully <a href="userForm.php"> Continue</a></p>
</div>
<?php
  //displayPageFooter();
  
}
?>
<?php
function getemail($staffcode)
{
$sql = "SELECT * FROM mhv.tblmhvstaff where staffcode='$staffcode'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

return $row['email'];
}

function getstaffname($staffcode)
{
$sql = "SELECT * FROM mhv.tblmhvstaff where staffcode='$staffcode'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
 $row['email'] ;
return $row['staffname'];
}

function getdept($staffcode)
{
$sql = "SELECT * FROM mhv.tblmhvstaff where staffcode='$staffcode'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
return $row['dept'];
}

function sendMailToUser($staffcode){

$mccemail="";
if(isset($_POST["ccemail"])){
foreach($_POST["ccemail"] as $ccemail){
$mccemail .= $ccemail . ",";
}}

$mccemail= preg_replace( "/,$/", "", $mccemail);


$myid=$_SESSION["member"]->getValue("id");


$sql = "SELECT * FROM mhweb.tbluser where id='$myid'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$sqle = "SELECT * FROM mhv.tblmhvstaff where staffcode='$staffcode'";
$resulte = mysql_query($sqle);
$rowe = mysql_fetch_array($resulte);

if($mccemail!=''){
$to = $rowe['email'] . ',swangchuk@mountainhazelnuts.com,muktitcc@gmail.com' .','.$mccemail ;
}else{
$to = $rowe['email'] . ',swangchuk@mountainhazelnuts.com,muktitcc@gmail.com';
}



$subject = "User Information for Accessing MH web application"; 
 
$message = '
<html>
<head>
<title>MH Web</title>
</head>
<body>
<p>Dear ' . $rowe['staffname'] . '<br> I have created  your user login credientials to access <b>yogis</b>  web application.
<br>Your Default User Name and Password:<b>' . $_POST["username"]  . '</b><br> 
<a href="http://118.103.142.157/yogis">MH::Web Application</a>
<br><font color="red"> This is an autogenerated email, hence DO NOT respond this email! </font><br>
<br>Regards <br> '.$row['staffname'].'</p>
</body>
</html>
';
$mail = new PHPMailerOAuth;
activateSMTP($mail);
$mail->setFrom($row['emailid'], $row['staffname']);                                  
$mail->AddReplyTo($row['emailid'], $row['staffname']);

$addresses = explode(',', $to);
foreach ($addresses as $address) {
$mail->AddAddress($address);
}
$mail->Subject = $subject;
$mail->Body = $message;
$mail->send();
}


?>