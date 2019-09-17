<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("common.inc_.php");
session_start();
if ( isset( $_POST["action"] ) and $_POST["action"] == "login" ) {
processForm();
} else {
displayForm( array(), array(), new Member( array() ),array());
}

function displayForm( $errorMessages, $missingFields, $member,$isLogginError) {
$fn=new MCrypt();
displayPageHeader( "", true );

if ( $errorMessages ) {
foreach ( $errorMessages as $errorMessage ) {
echo $errorMessage;
}
} else {
?>

<?php } ?>
<script src="asset/js/external_ResetPassword.js" type="text/javascript"></script>

<form action="login.php" method="post" align="center" style="margin-bottom: 50px;">
<div  id="outPopUp">
<h4 id="mh4" align="right" style="margin-left:0px; top:-500px; background-color:yellow; color:white; text-align:center;">Enter your user name and password to login.</h4>
<div id="ldiv"> 
<input id="minput" type="hidden" name="action" value="login" />
<label id="mlabel" for="username"<?php validateField( "username", $missingFields ) ?>>Username</label>
<input id="minput" type="text" name="username" id="username" value="<?php echo $member->getValueEncoded( "username" ) ?>" />
<label id="mlabel" for="password"<?php if ( $missingFields ) echo ' class="error"' ?>>Password</label>
<input id="minput" type="password" name="password" id="password" value="" />
</div>
<div id="btnalign" style="clear: both;">
<input id="minput" type="submit" name="submitButton" id="submitButton" value="Login" />
<div style="position:absolute;width:150px;top:25px;left:70px"> 
<?php if ($isLogginError and strlen($_POST["username"])>0){?>
<span class="label label-important"><a target="_blank" class="mpopup" data-fancybox-type="iframe" align="center" href="external_ResetPassword.php?userName=<?php echo urlencode($fn->encrypt($_POST["username"]))?>"><font color="white">Reset Password</font></a></span>
</div>	
<?php
}?>
</div>
</div>
</form>
<?php
}

function processForm() {
$fn=new Mobile_Detect;
$requiredFields = array( "username", "password" );
$missingFields = array();
$errorMessages = array();
$isLogginError=array();	
$member = new Member( array( 
"username" => isset( $_POST["username"] ) ? preg_replace( "/[^ \-\_a-zA-Z0-9]/", "", $_POST["username"] ) : "",
"password" => isset( $_POST["password"] ) ? preg_replace( "/[^ \-\_a-zA-Z0-9]/", "", $_POST["password"] ) : "",
) );

foreach ( $requiredFields as $requiredField ) {
if ( !$member->getValue( $requiredField ) ) {
$missingFields[] = $requiredField;
}
}

if ( $missingFields ) {
$errorMessages[] = '<p class="errorgen">There are some missing fields,check the red mark against the field! </p>';
} elseif ( !$loggedInMember = $member->authenticate() ) {
$errorMessages[] = '<p class="merrorgen">&nbsp;</p>';
$isLogginError[]='<p class="errorgen">Invalid user name and password</p>';;
}

if ( $errorMessages ) {
displayForm( $errorMessages, $missingFields, $member,$isLogginError);
} else {
$_SESSION["member"] = $loggedInMember;
session_start();
$old_sessionid = session_id();
session_regenerate_id();
$new_sessionid = session_id();
$_SESSION["mysessionid"] = $new_sessionid;
$url = '';
if(isset($_SESSION['url'])) 
$url = $_SESSION['url']; // holds url for last page visited.
else 
$url = "mainMenu.php"; // default page for 
$url=basename( $url);
if($_SESSION["member"]->getValue( "isdefaultpasswordreset" )=="No"){
header("Location:external_UpdatePassword.php");
exit;
}
if(strtolower($url)==strtolower("mainMenu.php")){
if($fn->isMobile()){
header("Location:mainMenu_m.php");	
}else{
header("Location:mainMenu.php");
}

}else{
	
if($fn->isMobile()){
header("Location:mainMenu_m.php?file=".$url);
}else{	
header("Location:mainMenu.php?file=".$url);
}
}
displayThanks();
}
}

function displayThanks() {

}
?>