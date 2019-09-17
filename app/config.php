<?php
require_once( "common.inc_.php" );
$conn = mysql_connect(DB_HOST, DB_USERNAME,DB_PASSWORD) or die ("Error connecting to database");
mysql_select_db(DB_NAME,$conn);

?>