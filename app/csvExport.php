<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=MH-".date('ymdHis').".xls");
header("Pragma: no-cache");
$buffer = str_replace("'", "", $_POST['csvBuffer']);
try{
echo $buffer;
}catch(Exception $e){

}
?>