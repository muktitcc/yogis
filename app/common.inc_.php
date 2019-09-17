<?php
error_reporting(1);
require_once( "config_.php" );
require_once( "config.php" );
require_once( "Member.class.php" );
require_once( "DataObject.class.php" );
require_once( "LogEntry.class.php" );
require_once("MCrypt.php");
require_once( "common.inc_.php" );
require_once("common_Functions.php");
require_once ("../vendor/PHPMailer/PHPMailerAutoload.php");
require_once ("../vendor/PHPMailer/vendor/autoload.php");
require_once ("../vendor/mike42/escpos-php/autoload.php");
require_once "../vendor/libs/Mobile_Detect.php";
date_default_timezone_set('Asia/Thimphu');
function displayPageHeader( $pageTitle, $membersArea = false ) {
$fn=new Mobile_Detect;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>

<meta charset="utf-8">
<title>yogis</title>
 <meta name="viewport" content="width=device-width , initial-scale=1" />
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" type="image/png" href="asset/images/yogis.png" />
 
<link rel="stylesheet" type="text/css" media="screen" href="../vendor/libnew/js/themes/redmond/jquery-ui.custom.css"></link>     
<link rel="stylesheet" type="text/css" media="screen" href="../vendor/libnew/js/jqgrid/css/ui.jqgrid.css"></link>  
<link rel="stylesheet" type="text/css"  href="asset/css/myCustomCss.css"></link>
<link rel="stylesheet" href="../vendor/transmultiselect/docsupport/prism.css">
<link rel="stylesheet" href="../vendor/transmultiselect/chosen.css">
<link rel="stylesheet" href="../vendor/build/css/intlTelInput.css">
<link rel="stylesheet" href="../vendor/sweetalert2/sweetalert2.css">
<link href="../vendor/cloudflare/select2.css" rel="stylesheet"/> 
<link type="text/css" rel="stylesheet" href="//cdn.jsdelivr.net/fancybox/2.1.4/jquery.fancybox.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../vendor/lib/js/jqgrid/css/ui.bootstrap.jqgrid.css" />
<?php
if($fn->isMobile() or $pageTitle=="mhvMenuTest"){
//for small devices	
?>
<link rel="stylesheet" type="text/css" media="screen" href="../vendor/lib/js/jqgrid/css/ui.bootstrap.jqgrid.css" />
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php
}else{
// for normal browser
?>
<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
<?php
}
?>

<script src="../vendor/lib/js/jquery.min.js" type="text/javascript"></script>
<script src="../vendor/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>     
<script src="../vendor/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script> 
<script src="../vendor/lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="../vendor/js/ajaxfileupload.js" type="text/javascript"></script>
<script src="../vendor/hc/js/highstock.js"></script>
<script src="../vendor/hc/js/modules/drilldown.js"></script>
<script src="../vendor/cloudflare/select2.min.js"></script>
<script src="../vendor/transmultiselect/chosen.jquery.js" type="text/javascript"></script>
<script src="../vendor/transmultiselect/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script src="../vendor/sweetalert2/sweetalert2.min.js"></script>
<script src="../vendor/jquery.scannerdetection/jquery.scannerdetection.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/fancybox/2.1.4/jquery.fancybox.js"></script>






  

<style type="text/css">
      th { text-align: left; background-color: #A3C2FF; }
      th, td { padding: 0.4em; }
      tr.alt td { background: #ddd; }
      .error {background: #d33; color: white;left:70px;padding: 0; }
	  .errorgen {position:absolute;top:50px; margin-left:150px; background: #d33; color: white;left:70px;padding: 0; }
	  .errorgcal {position:absolute;top:-70px; margin-left:-300px;width:350px; background: #d33; color: white;left:9px;padding: 0; }
</style>
	




<style type="text/css">

iframe {
position:absolute;
width: 1320px;
left:5px;
top: 44px;
height: 580px;

}

</style>

</head>
<body>
<div id='myimg'>
</div>	
<?php
}

function validateField( $fieldName, $missingFields ) {
  if ( in_array( $fieldName, $missingFields ) ) {
    echo ' class="error"';
  }
}

function setChecked( DataObject $obj, $fieldName, $fieldValue ) {
  if ( $obj->getValue( $fieldName ) == $fieldValue ) {
    echo ' checked="checked"';
  }
}

function setSelected( DataObject $obj, $fieldName, $fieldValue ) {
  if ( $obj->getValue( $fieldName ) == $fieldValue ) {
    echo ' selected="selected"';
  }
}

function checkLogin() {
$fn=new common_Functions();

$pdoConn=$fn->_myConn();

$allowaccess=array();
$allowAdd=false;
$allowEdit=false;
$allowDelete=false;
$thisFile="";
$mUID="";

  if(!isset($_SESSION))
  {
  session_start();
  }
  $_SESSION['url'] = $_SERVER["PHP_SELF"]; 
  if ( !$_SESSION["member"] or !$_SESSION["member"] = Member::getMember( $_SESSION["member"]->getValue( "id" ) ) ) {
	$_SESSION['allowaccess']="";
    $_SESSION["member"] = "";
	$_SESSION["add"]="";
	$_SESSION["edit"]="";
	$_SESSION["del"]="";
    header("Location:login.php");

  } else {
    $logEntry = new LogEntry( array (
      "memberId" => $_SESSION["member"]->getValue( "id" ),
      "pageUrl" => basename( $_SERVER["PHP_SELF"] )
	 
    ) );
    $logEntry->record(basename( $_SERVER["PHP_SELF"] ),$_SERVER['PHP_SELF']);
	$pageUrl=basename( $_SERVER["PHP_SELF"] );
	$thisFile=basename($_SERVER["PHP_SELF"], ".php");
	$msql="SELECT * FROM tblfilemaster where filename='$pageUrl'";
    $stmt=$pdoConn->prepare($msql);
    $stmt->execute();
    $rowy =$stmt->fetch();
	$fid=$rowy['fileid'];


    $uid=$_SESSION["member"]->getValue( "id" );
    $sql = "SELECT uid,madd,medit,mdelete FROM tblfileaccessrights WHERE uid='$uid' and fid='$fid' and access='Yes'"; 
    $stmt=$pdoConn->prepare($sql);
    $stmt->execute();
  
    $row = $stmt->fetch();
    $mUID=$row['uid'];
    $allowaccess[] =$mUID ;
    $allowAdd=($row["madd"]=='Yes'?true:false);
    $allowEdit=($row["medit"]=='Yes'?true:false);
    $allowDelete=($row["mdelete"]=='Yes'?true:false);
	


$defaltAccess=array(1771,1772);
if(in_array($fid,$defaltAccess)){
$allowaccess[] = $uid;	
}


$_SESSION['allowaccess']="";
$_SESSION["add"]="";
$_SESSION["edit"]="";
$_SESSION["del"]="";
$_SESSION["thisFile"]="";
if(session_status()==PHP_SESSION_NONE){
session_start();
}
$_SESSION['allowaccess'] = serialize($allowaccess);
$_SESSION['add']=$allowAdd;
$_SESSION['edit']=$allowEdit;
$_SESSION['del']=$allowDelete;
$_SESSION["thisFile"]=$thisFile;
}
}

function checkPageAccess() {
  session_start();
}
function activateSMTP($mail){
define('mSMTPSERVER','smtp.gmail.com'); 
define('mSMTPPORT', '465'); 
define('mSMTPTLS', 'ssl');
define('mAUTHTYPE', 'XOAUTH2');
define('mSMTPAUTH', true);
define('mAUTHUSEREMAIL', 'mhrelayemail@gmail.com');
define('mAUTHCLIENTID', '372391396835-rse8i7iqem0kl9okf5qv24gh9ujl9v49.apps.googleusercontent.com');
define('mAUTHCLIENTSECRET', 'MTPDXVg_tEx4isNiZBv65IhS');
define('mAUTHREFRESHTOKEN', '1/g0g9HFnBMw8nzVfFTRMpsTi4tWzZaz62g2jKvpErrZA');

$mail->SMTPDebug = 0;                               
$mail->isSMTP(); 
$mail->isHTML(true);
$mail->SMTPAuth=mSMTPAUTH;           
$mail->Host = mSMTPSERVER;
$mail->SMTPSecure = mSMTPTLS;                           
$mail->Port = mSMTPPORT; 
$mail->AuthType = mAUTHTYPE;
$mail->oauthUserEmail = mAUTHUSEREMAIL;
$mail->oauthClientId = mAUTHCLIENTID;
$mail->oauthClientSecret = mAUTHCLIENTSECRET;
$mail->oauthRefreshToken = mAUTHREFRESHTOKEN;

//---------------mchhetri---------------------------
//pema:1/MFrsv1kYpW9UlUunuLPmyjqUs1KjrPoRg0oiJRsxOUc
//mukti:1/NCs_kvg8bKBu0hfMhMZ816B3fSmcwn2viE2qgNpLRc4
//mh:1/LRhyFp5AIP5PX3YOsd_nUoqv3EhJsN9iogmb_aPef9M


//----------------------mhrelayemail@gmail.com-----------
//mhemailrelay:1/g0g9HFnBMw8nzVfFTRMpsTi4tWzZaz62g2jKvpErrZA

}
?>
