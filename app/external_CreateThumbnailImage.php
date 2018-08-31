<?php
require_once("common.inc_.php" );
$fn=new common_Functions();
$mainDir=RMTUPLOADEDDATA_DIR.'studentImages/';
$thumbnailDir=RMTUPLOADEDDATA_DIR.'studentImages/thumbnail/';
 exit('Serice halted by Mukti');

if (! is_dir($mainDir)) {
exit('Invalid main dir path');
}

if (! is_dir($thumbnailDir)) {
exit('Invalid thumbnail dir path');
}

$files = array();

foreach (scandir($mainDir) as $file) {
$files[] = $file;
echo $mainDir.$file;
if($fn->_getThumbnailImage($mainDir.$file,$thumbnailDir.$file)!='ok'){
//exit("failed to create thumbnail");
}
}

var_dump($files);
?>