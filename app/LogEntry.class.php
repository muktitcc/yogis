<?php

require_once "DataObject.class.php";

class LogEntry extends DataObject {

  protected $data = array(
    "memberId" => "",
    "pageUrl" => "",
    "numVisits" => "",
    "lastAccess" => ""
  );

  public static function getLogEntries( $memberId ) {
    $conn = parent::connect();
    $sql = "SELECT * FROM " . TBL_ACCESS_LOG . " WHERE memberId = :memberId ORDER BY lastAccess DESC";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":memberId", $memberId, PDO::PARAM_INT );
      $st->execute();
      $logEntries = array();
      foreach ( $st->fetchAll() as $row ) {
        $logEntries[] = new LogEntry( $row );
      }
      parent::disconnect( $conn );
      return $logEntries;
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }

  public function record($pageUrl,$tille) {
	$fcnt=0;
	$mdate=date('Y-m-d H:i:s');
    $conn = parent::connect();
	
	$msql="SELECT count(*) cnt  FROM yogis.tblfilemaster where filename='$pageUrl'";
	$r=mysql_query($msql);
	while ($rowy = mysql_fetch_array($r)) {
	$fcnt=$rowy['cnt'];
	} 
	if($fcnt==0){
	mysql_query("insert into yogis.tblfilemaster(filename,displayname)values('$pageUrl','New')");
	
	$msql="SELECT *   FROM yogis.tblfilemaster where filename='$pageUrl'";
	$r=mysql_query($msql);
	while ($rowy = mysql_fetch_array($r)) {
	$fid=$rowy['fileid'];
	}
	
	mysql_query("insert into yogis.tblfileaccessrights(uid,fid,access)values('1','$fid','Yes')");
	}
	$muid=$_SESSION["member"]->getValue("id");
	$info = pathinfo($pageUrl);
	$msid=$_SESSION["mysessionid"];
	if ($info["extension"] == "php") {
		mysql_query("insert into yogis.tblphpaccesslog(uid,pagename,mdate,sessionid)values('$muid','$pageUrl',now(),'$msid')");
		}
	
	
    $sql = "SELECT * FROM " . TBL_ACCESS_LOG . " WHERE memberId = :memberId AND pageUrl = :pageUrl";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":memberId", $this->data["memberId"], PDO::PARAM_INT );
      $st->bindValue( ":pageUrl", $this->data["pageUrl"], PDO::PARAM_STR );
      $st->execute();

      if ( $st->fetch() ) {
        $sql = "UPDATE " . TBL_ACCESS_LOG . " SET numVisits = numVisits + 1,lastAccess='$mdate' WHERE memberId = :memberId AND pageUrl = :pageUrl";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":memberId", $this->data["memberId"], PDO::PARAM_INT );
        $st->bindValue( ":pageUrl", $this->data["pageUrl"], PDO::PARAM_STR );
        $st->execute();
      } else {
        $sql = "INSERT INTO " . TBL_ACCESS_LOG . " ( memberId, pageUrl, numVisits,lastAccess ) VALUES ( :memberId, :pageUrl, 1,'$mdate')";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":memberId", $this->data["memberId"], PDO::PARAM_INT );
        $st->bindValue( ":pageUrl", $this->data["pageUrl"], PDO::PARAM_STR );
        $st->execute();
		
		
		 
		
		
		
		
      }

      parent::disconnect( $conn );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }

  public static function deleteAllForMember( $memberId ) {
    $conn = parent::connect();
    $sql = "DELETE FROM " . TBL_ACCESS_LOG . " WHERE memberId = :memberId";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":memberId", $memberId, PDO::PARAM_INT );
      $st->execute();
      parent::disconnect( $conn );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }

}

?>
