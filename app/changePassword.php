<?php
require_once( "common.inc_.php" );
require_once("userAuthentication.php");
displayPageHeader( "", false );
require_once( "config_.php" );

if ( isset( $_POST["action"] ) and $_POST["action"] == "changePassword" ) {
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



<div class="buttons" style="width:20em;margin-left:200px;clear: both;">
   <p><h3>Change password for php interface</h3></p>
   </div>
    <form action="changePassword.php" method="post" style="margin-bottom: 50px;">
      <div style="width: 30em;">
	<?php  
	  $userid=$_SESSION["member"]->getValue("id");
$sql = "SELECT * FROM tbluser  where id='$userid'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
	  ?>
        <input type="hidden" name="action" value="changePassword" />
<input type="hidden" name="id" id="id" value="<?php echo $userid ?>" />


        <label id="mlabel" for="username"<?php validateField( "username", $missingFields ) ?>>User Name *</label>
        <input id="minput" type="text" name="username" id="username" readonly="readonly"  value="<?php echo $row['username'] ?>" />

		<label id="mlabel" for="password0"<?php if ( $missingFields ) echo ' class="error"' ?>>Old password *</label>
        <input id="minput" type="password" name="password0" id="password0" placeholder="Type your old password here." value="" />
		
        <label id="mlabel" for="password1"<?php if ( $missingFields ) echo ' class="error"' ?>>New password *</label>
        <input id="minput" type="password" name="password1" id="password1" placeholder="Type your new password here." value="" />
		
        <label id="mlabel" for="password2"<?php if ( $missingFields ) echo ' class="error"' ?>>Retype new password *</label>
        <input id="minput" type="password" name="password2" id="password2" placeholder="Retype your new password here." value="" />
		
<div class="buttons" style="width:20em;margin-left:215px;clear: both;">
<button type="submit" name="submitButton" id="="submitButton" value="Send Details" class="positive">
<img src="asset/images/tick.png" alt=""/> Change </button>   
<button type="reset" name="resetButton" id="resetButton" value="Reset Form" class="negative">
<img src="asset/images/cross.png" alt=""/>Cancel </button>  
</div>
</div>
    </form>
	
<?php
include 'mhvFooter.php';
}

function processForm() {

  $requiredFields = array("password");
  $missingFields = array();
  $errorMessages = array();

  $member = new Member( array( 
  "id" => isset( $_POST["id"] ) ? preg_replace( "/[^ \-\_a-zA-Z0-9]/", "", $_POST["id"] ) : "",
    "password0" => isset( $_POST["password0"] ) ? preg_replace( "/[^ \-\_a-zA-Z0-9]/", "", $_POST["password0"] ) : "",
    "password" => ( isset( $_POST["password1"] ) and isset( $_POST["password2"] ) and $_POST["password1"] == $_POST["password2"] ) ? preg_replace( "/[^ \-\_a-zA-Z0-9]/", "", $_POST["password1"] ) : "",

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

  if ( Member::getByEmailAddress( $member->getValue( "emailid" ) ) ) {
    $errorMessages[] = '<p class="error">Email Address already exist. Please choose another email address.</p>';
  }

  if ( $errorMessages ) {
    displayForm( $errorMessages, $missingFields, $member );
  } else {
  
  if(checkOldPassword($_POST["password0"],$_POST["username"])==1)
  {
    $member->update();
	//echo "Password Match";
}else
{
$errorMessages[] = '<p class="error">Your old password does not match.</p>';
if ( $errorMessages ) {
    displayForm( $errorMessages, $missingFields, $member );
	}
}		
    displayThanks();
  }
}

function displayThanks() {
 displayPageHeader( "Record Saved!" );
//sendMailToResponce($_POST["staffcode"]);
?>
<div id='main'  "style"left=9px>
<?php
session_start();
$_SESSION["member"] = "";
   ?>
   <p>Password successfully changed. <a href="login.php"> Login again</a></p>
</div>
<?php
  //displayPageFooter();
  
  include 'mhvFooter.php';
  }
?>
<?php
function checkOldPassword($oldpassword,$userName)
{
$sql = "SELECT * FROM yogis.tbluser where (password=password('$oldpassword') or password=md5('$oldpassword')) and username='$userName'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
if($row==TRUE)
{
return 1;
}
else
{
return 0;
}

}

?>