<?php
class external_UpdatePassword extends DataObject{
function displayForm( $errorMessages, $missingFields, $member,$isLogginError) {
displayPageHeader( "", true );
if ( $errorMessages ) {
foreach ( $errorMessages as $errorMessage ) {
echo $errorMessage;
}
} else {
?>
<?php } ?>
<form action="external_UpdatePassword.php" method="post" align="center" style="margin-bottom: 50px;">
<div  id="outPopUpUpdate">
<h4 id="mh4" align="right" style="margin-left:0px; top:-500px; background-color:green; color:white; text-align:center;">Change Default Password</h4>
<div id="ldiv"> 
<input id="minput" type="hidden" name="action" value="external_UpdatePassword" />
<input id="minput"  type="hidden" name="userid" id="userid" value="<?php echo $_SESSION["member"]->getValue( "id" ) ?>" />
<label id="mlabel" for="username"<?php validateField( "username", $missingFields ) ?>>Username</label>
<input id="minput" type="text" name="username" readonly="readonly" id="username" value="<?php echo $_SESSION["member"]->getValue( "username" ) ?>" />
<label id="mlabel" for="password"<?php if ( $missingFields ) echo ' class="error"' ?>>New Password</label>
<input id="minput" type="text" name="password" class="input" placeholder="Type new password" id="password" value=""  onfocus="this.setAttribute('type', 'password');" onblur="this.removeAttribute('password');" />
<label id="mlabel" for="passwordretype"<?php if ( $missingFields ) echo ' class="error"' ?>>Retype Password</label>
<input id="minput" type="text" name="passwordretype" class="input" placeholder="Retype new password" id="passwordretype" value=""  onfocus="this.setAttribute('type', 'password');" onblur="this.removeAttribute('password');" />

</div>



<div id="btnalign" style="clear: both;">
<input id="minput" type="submit" name="submitButton" id="submitButton" value="Change" />
</div>
</div>
</form>

</body>
</html>
<?php
}

function processForm() {
$requiredFields = array( "username", "password","passwordretype");
$missingFields = array();
$errorMessages = array();
$isLogginError=array();	
$member = new Member( array( 
"username" => isset( $_POST["username"] ) ? preg_replace( "/[^ \-\_a-zA-Z0-9]/", "", $_POST["username"] ) : "",
"password" => isset( $_POST["password"] ) ? preg_replace( "/[^ \-\_a-zA-Z0-9]/", "", $_POST["password"] ) : "",
"passwordretype" => isset( $_POST["passwordretype"] ) ? preg_replace( "/[^ \-\_a-zA-Z0-9]/", "", $_POST["passwordretype"] ) : "",
) );

foreach ( $requiredFields as $requiredField ) {
if ( !$member->getValue( $requiredField ) ) {
$missingFields[] = $requiredField;
}
}
if (!$missingFields){
if (strcmp($_POST["password"],$_POST["passwordretype"])!=0){
$errorMessages[] = '<p class="errorgen">New Password mismatch </p>';
}
}

if (!$missingFields and !$errorMessages){
if($this->checkAndProcessPassword($_POST["userid"],$_POST["password"])=="err"){
$errorMessages[] = '<p class="errorgen">Cannot use default password </p>';	
}
}

if ($missingFields) {
$errorMessages[] = '<p class="errorgen">There are some missing fields,check the red mark against the field! </p>';
} elseif (!$loggedInMember = $member->authenticate()) {
$errorMessages[] = '<p class="errorgen">New Password mismatch</p>';
$isLogginError[]='<p class="errorgen">Invalid user name and password</p>';
}

if ($errorMessages) {
$this->displayForm( $errorMessages, $missingFields, $member,$isLogginError);
} else {
header("Location:mainMenu.php");
}
}

function checkAndProcessPassword($userid,$newpassword){
$pdoConn=parent::connect();
$mSql="select * from yogis.tbluser where password=password(:password) and id=:id";
$stmt=$pdoConn->prepare($mSql);
$stmt->bindParam(":password",$newpassword);
$stmt->bindParam(":id",$userid);
$stmt->execute();
if($stmt->rowCount()>0)
return "err";
$mSql="update yogis.tbluser set password=password(:password),isdefaultpasswordreset='Yes' where id=:id";
$stmt=$pdoConn->prepare($mSql);
$stmt->bindParam(":password",$newpassword);
$stmt->bindParam(":id",$userid);
$stmt->execute();
return "ok";
}

}

?>
