<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("userAuthentication.php");
require_once("mainMenu_fn.php");
$fn=new common_Functions();
$mb=new Mobile_Detect;
$fn_this=new mainMenu(new common_Functions($fn));

$pdoConn=$fn->_myConn();

if($mb->isMobile())
header("Location:mhvMenu_m.php");

$uid=UID;
$update='<span class="label label-success">Update</span>';
$new='<span class="label label-important">New</span>';
$menuPullLeft=array(9,12,13);
displayPageHeader( "Error" );
?>
<link href="asset/css/mhvMenu.css" rel="stylesheet">

<div class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner">
<div class="container-fluid">
<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>
<div class="nav-collapse collapse">
<p class="navbar-text pull-right">
</p>
<ul class="nav">
<?php
foreach($fn_this->firstLevelMenu() as $firstrow){
$topmenuid=$firstrow["id"];
$topmenuname= $firstrow["menuname"];
?>
<?php if($topmenuid==1){?>
<li class="dropdown" > <a  href="#" class="dropdown-toggle" data-toggle="dropdown" > <span class="label label-info"> <?php echo  $fn->_getApplicationUserName($uid) ?></span> <span class="caret"></span></a>

<?php }else{?>
<li class="dropdown" > <a  href="#" class="dropdown-toggle" data-toggle="dropdown" > <?php echo '<font color="#FFFFFF">'.$topmenuname.'</font>' ?> <span class="caret"></span></a>
<?php }?>
<ul class="dropdown-menu">

<?php
foreach($fn_this->secondLevelMenu($topmenuid) as $srow) {
$secondmenuid=$srow["id"];
$secondmenuname= $srow["menuname"];
$hassubmenu= $srow["hassubmenu"];
$secondlevel=1;
$thirdlevel=1;
if($hassubmenu=='No'){ 
$tmsql="SELECT *  FROM tblfilemaster  where mainmenu= '$topmenuid' and  secondmenuid='$secondmenuid' and status='Active' order by mainmenu,secondmenuid,displayorder";
$stmt=$pdoConn->prepare($tmsql);
$stmt->execute();
while ($trow = $stmt->fetch()) {
$fid=$trow["fileid"];
$filename=$trow["filename"];
$note=$trow["note"];
$entrytype=$trow["entrytype"];
}

$cmsql="SELECT count(*) cnt  FROM tblfileaccessrights  where fid= '$fid' and  uid='$uid'";
$stmt_c=$pdoConn->prepare($cmsql);
$stmt_c->execute();
while ($crow = $stmt_c->fetch()) {
$canaccess=$crow["cnt"];
}
?>


<?php 
if($filename=='mhvMenu.php' or $filename=='logout.php'){ 
?>
<li><a class="right" title="" data-placement="right" data-toggle="tooltip" data-original-title='<?php echo $note  ?>' href=<?php echo $filename ?> > <?php echo $secondmenuname  ?></a></li>

<?php 
}else{ 
?>

<?php 
if($canaccess==1){
?>
<li>
<?php
}else{
?>
<li class="hide">
<?php

}
?>
<!--

!-->
<a class="right" title="" data-placement="right" data-toggle="tooltip" data-original-title='<?php echo $note  ?>' href=<?php echo $filename ?> onclick=\"$('#grid-mhv-tabs a:first').tab('show');\" target='mhv_frame'><?php echo $secondmenuname  ?>&nbsp;&nbsp;<?php if($entrytype=='New'){echo $new;} if($entrytype=='Update'){echo $update;}   ?></a></li>
<?php 
}
?>

<?php
}else{

$tmsql="SELECT *  FROM tblfilemaster  where mainmenu= '$topmenuid' and  secondmenuid='$secondmenuid' and status='Active' order by mainmenu,secondmenuid,displayorder";
$stmt=$pdoConn->prepare($tmsql);
$stmt->execute();
while ($trow = $stmt->fetch()) {
$fid=$trow["fileid"];
$filename=$trow["filename"];
$displayname=$trow["displayname"];
$note=$trow["note"];
$entrytype=$trow["entrytype"];
$cmsql="SELECT count(*) cnt  FROM tblfileaccessrights  where  uid='$uid' and fid in(select fileid from tblfilemaster where secondmenuid='$secondmenuid' and status='Active' )";
$stmt_c=$pdoConn->prepare($cmsql);
$stmt_c->execute();
while ($crow = $stmt_c->fetch()) {
$canaccess=$crow["cnt"];
}
}

?>	
<?php 
if($canaccess>=1){
if(in_array($topmenuid,$menuPullLeft)){
?>
<li class="dropdown-submenu pull-left"><a tabindex="-1" href="#"><?php echo $secondmenuname  ?></a>

<ul class="dropdown-menu">
<?php 
}else{
?>
<li class="dropdown-submenu"><a tabindex="-1" href="#"><?php echo $secondmenuname  ?></a>

<ul class="dropdown-menu">
<?php	
}			}else{
?>
<li class="hide"><a tabindex="-1" href="#"><?php echo $secondmenuname  ?></a>
<ul class="hide">
<?php

}
?>
<?php
$tmsql="SELECT *  FROM tblfilemaster  where mainmenu= '$topmenuid' and  secondmenuid='$secondmenuid' and status='Active' order by mainmenu,secondmenuid,displayorder";
$stmt=$pdoConn->prepare($tmsql);
$stmt->execute();
while ($trow = $stmt->fetch()) {
$fid=$trow["fileid"];
$tooltipposition=$trow["tooltipposition"];
$filename=$trow["filename"];
$displayname=$trow["displayname"];
$note=$trow["note"];
$entrytype=$trow["entrytype"];
$popup=$trow["needpopup"];
$cmsql="SELECT count(*) cnt  FROM tblfileaccessrights  where fid= '$fid' and  uid='$uid'";
$stmt_c=$pdoConn->prepare($cmsql);
$stmt_c->execute();
while ($crow = $stmt_c->fetch()) {
$canaccess=$crow["cnt"];
}
?>


<?php 
if($canaccess==1){
?>
<li>
<?php 
}else{
?>
<li class="hide">

<?php

}
?>
<?php
if($popup=='No')
{?>
<a  class="right" title="" data-placement='<?php echo $tooltipposition ?>' data-toggle="tooltip" data-original-title='<?php echo $note  ?>' href=<?php echo $filename ?> onclick=\" $('#grid-mhv-tabs a:first').tab('show');\" target='mhv_frame' ><?php echo $displayname  ?>&nbsp;&nbsp;<?php if($entrytype=='New'){echo $new;} if($entrytype=='Update'){echo $update;}   ?></a></li>
<?php
}else{

switch ($fid) {
case ($fid=='55') :
?>
<li><a class="right" title="" data-placement='<?php echo $tooltipposition ?>' data-toggle="tooltip" data-original-title='<?php echo $note  ?>' href="javascript:window.open( '<?php echo $filename ?>' ,'newwind','width=1050,height=900')"><?php echo $displayname  ?>&nbsp;&nbsp;<?php if($entrytype=='New'){echo $new;} if($entrytype=='Update'){echo $update;}   ?></a></li>
<?php
break;
case ($fid=='64') :
?>
<li><a class="right" title="" data-placement='<?php echo $tooltipposition ?>' data-toggle="tooltip" data-original-title='<?php echo $note  ?>' href="javascript:window.open( '<?php echo $filename ?>' ,'newwind','width=1050,height=900')"><?php echo $displayname  ?>&nbsp;&nbsp;<?php if($entrytype=='New'){echo $new;} if($entrytype=='Update'){echo $update;}   ?></a></li>
<?php
break;
default:
?>
<li><a class="right" title="" data-placement='<?php echo $tooltipposition ?>' data-toggle="tooltip" data-original-title='<?php echo $note  ?>' href="javascript:window.open( '<?php echo $filename ?>' ,'newwind','width=1800,height=650')"><?php echo $displayname  ?>&nbsp;&nbsp;<?php if($entrytype=='New'){echo $new;} if($entrytype=='Update'){echo $update;}   ?></a></li>

<?php
}
}
?>
<?php }?>
</ul>
</li> 
<?php 
}
}?>
</ul>
</li> 
<?php
}
?>
</ul>
</ul>
</ul>
</div>
</div>
</div>
</div>
<br><br>

<div class="container-fluid">
<div class="row-fluid">

</div>				

</div>
<div class="span10">
<div class="row-fluid">
<div class="span12">



<div class="tab-content" id="grid-mhv-tabs-content">

<?php
$e=$_GET["file"];
if (strtolower($e)=="mainMenu.php"){

}else{
?>
<iframe style="overflow:auto" onload="iframeLoaded(this)" name="mhv_frame" frameborder="0"   src=<?php echo $e ?>></iframe>
<?php

}

?>

</div>

</div>
</div>
</div>

<?php


?>	

<script src="../vendor/bootstrap/js/jquery.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="asset/js/mhithelpdesk.js"></script>
<link href="asset/css/mhithelpdesk.css" rel="stylesheet">
<script src="asset/js/internal_mysqlReplicationInfo.js"></script>
<link href="asset/css/internal_mysqlReplicationInfo.css" rel="stylesheet">
<script src="asset/js/mhvMenu.js" type="text/javascript"></script>


