<?php

require_once "DataObject.class.php";

class Member extends DataObject {

  protected $data = array(
    "id" => "",
    "username" => "",
    "password" => "",
    "staffname" => "",
    "emailid"=>"",
    "dept"=>"",
	"isdefaultpasswordreset"=>"",
	"passwordretype"=>"",
    "staffcode"=>"",
	"ismd5" => ""
  );

  private $_genres = array(
    "male" => "male",
    "female" => "female",
    "1" => "it",
    "2" => "or",
    "3" => "ex",
    "4" => "di",
    "5" => "mo"
  );

  public static function getMembers( $startRow, $numRows, $order ) {
    $conn = parent::connect();
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM yogis.tbluser ORDER BY $order LIMIT :startRow, :numRows";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":startRow", $startRow, PDO::PARAM_INT );
      $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
      $st->execute();
      $members = array();
      foreach ( $st->fetchAll() as $row ) {
        $members[] = new Member( $row );
      }
      $st = $conn->query( "SELECT found_rows() as totalRows" );
      $row = $st->fetch();
      parent::disconnect( $conn );
      return array( $members, $row["totalRows"] );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }
public static function connectDb()
{
 $conn = parent::connect();
 return $conn;
}
  public static function getMember( $id ) {
    $conn = parent::connect();
    $sql = "SELECT * FROM yogis.tbluser WHERE id = :id";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":id", $id, PDO::PARAM_INT );
      $st->execute();
      $row = $st->fetch();
      parent::disconnect( $conn );
      if ( $row ) return new Member( $row );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }

  public static function getByUsername( $username ) {
    $conn = parent::connect();
    $sql = "SELECT * FROM yogis.tbluser WHERE username = :username";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":username", $username, PDO::PARAM_STR );
      $st->execute();
      $row = $st->fetch();
      parent::disconnect( $conn );
      if ( $row ) return new Member( $row );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }

  public static function getByEmailAddress( $emailAddress ) {
    $conn = parent::connect();
    $sql = "SELECT * FROM yogis.tbluser WHERE emailid = :emailid";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":emailid", $emailAddress, PDO::PARAM_STR );
      $st->execute();
      $row = $st->fetch();
      parent::disconnect( $conn );
      if ( $row ) return new Member( $row );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }

  public function getGenderString() {
    return ( $this->data["gender"] == "f" ) ? "Female" : "Male";
  }

  public function getFavoriteGenreString() {
    return ( $this->_genres[$this->data["favoriteGenre"]] );
  }
    public static function getByStaffCode( $staffCode ) {
    $conn = parent::connect();
    $sql = "SELECT * FROM tbluser WHERE staffcode = :stafffode";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":stafffode", $staffCode, PDO::PARAM_STR );
      $st->execute();
      $row = $st->fetch();
      parent::disconnect( $conn );
      if ( $row ) return new Member( $row );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }
  public function getGenres() {
    return $this->_genres;
  }

  public function insert() {
    $conn = parent::connect();
    $sql = "INSERT INTO yogis.tbluser (
              username,
              password,
              staffname,
              emailid,
              dept,
              staffcode
             
            ) VALUES (
              :username,
              md5(:password),
              :staffname,
              :emailid,
              :dept,
              :staffcode
            )";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":username", $this->data["username"], PDO::PARAM_STR );
      $st->bindValue( ":password", $this->data["password"], PDO::PARAM_STR );
      $st->bindValue( ":staffname", $this->data["staffname"], PDO::PARAM_STR );
      $st->bindValue( ":emailid", $this->data["emailid"], PDO::PARAM_STR );
      $st->bindValue( ":dept", $this->data["dept"], PDO::PARAM_STR );
      $st->bindValue( ":staffcode", $this->data["staffcode"], PDO::PARAM_STR );
      $st->execute();
      parent::disconnect( $conn );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }

  public function update() {
    $conn = parent::connect();
    $passwordSql = $this->data["password"] ? "password = md5(:password)" : "";
    $sql = "UPDATE tbluser SET
              $passwordSql
             WHERE id = :id";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":id", $this->data["id"], PDO::PARAM_INT );
      if ( $this->data["password"] ) $st->bindValue( ":password", $this->data["password"], PDO::PARAM_STR );
      $st->execute();
      parent::disconnect( $conn );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }
  
    public function updatemd5($username,$password) {
    $conn = parent::connect();
    $passwordSql = $this->data["password"] ? "password = md5(:password),ismd5='Yes'" : "";
    $sql = "UPDATE tbluser SET
              $passwordSql
             WHERE username = :username";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":username", $username, PDO::PARAM_INT );
      if ( $password ) $st->bindValue( ":password", $password, PDO::PARAM_STR );
      $st->execute();
      parent::disconnect( $conn );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }
  
  public function delete() {
    $conn = parent::connect();
    $sql = "DELETE FROM " . TBL_MEMBERS . " WHERE id = :id";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":id", $this->data["id"], PDO::PARAM_INT );
      $st->execute();
      parent::disconnect( $conn );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }

  public function authenticate() {
    $conn = parent::connect();
	
    $sql = "SELECT * FROM " . TBL_MEMBERS . " WHERE username = :username AND (password = password(:password) or password = md5(:password)) and status not in('C')";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":username", $this->data["username"], PDO::PARAM_STR );
      $st->bindValue( ":password", $this->data["password"], PDO::PARAM_STR );
	  $st->execute();
	  $row = $st->fetch();
	  /// The below three lines is temporary for shifting password to md5
		if($row["ismd5"]=="No"){
		$this->updatemd5($this->data["username"],$this->data["password"]);
		}
	  
	  
	  
	  parent::disconnect( $conn );
      if ( $row ) return new Member( $row );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }
  
  

  

}

?>
