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
    $pdoConn=parent::connect();
    
	$fcnt=0;
	$mdate=date('Y-m-d H:i:s');
    $conn = parent::connect();
	
	$msql="SELECT count(*) cnt  FROM tblfilemaster where filename='$pageUrl'";
    $stmt=$pdoConn->prepare($msql);
    $stmt->execute();
 	$rowy = $stmt->fetch();
	$fcnt=$rowy['cnt'];
	 
	if($fcnt==0){
	$mSql="insert into tblfilemaster(filename,displayname)values('$pageUrl','New')";
	$stmt=$pdoConn->prepare($mSql);
    $stmt->execute();
    
	$mSql="SELECT *   FROM tblfilemaster where filename='$pageUrl'";
    $stmt=$pdoConn->prepare($mSql);
    $stmt->execute();
	$rowy = $stmt->fetch();
	$fid=$rowy['fileid'];

	$mSql="insert into tblfileaccessrights(uid,fid,access)values('1','$fid','Yes')";
    $stmt=$pdoConn->prepare($mSql);
    $stmt->execute();
    
    
	}
	$muid=$_SESSION["member"]->getValue("id");
	$info = pathinfo($pageUrl);
	$msid=$_SESSION["mysessionid"];
	if ($info["extension"] == "php") {
		$mSql="insert into tblphpaccesslog(uid,pagename,mdate,sessionid)values('$muid','$pageUrl',now(),'$msid') on duplicate key update id=id";
         $stmt=$pdoConn->prepare($mSql);
         $stmt->execute();
        
        
        
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
