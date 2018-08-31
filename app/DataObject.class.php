<?php
require_once( "common.inc_.php" );
abstract class DataObject {
protected $data = array();
  public function __construct( $data ) {
    foreach ( $data as $key => $value ) {
      if ( array_key_exists( $key, $this->data ) ) $this->data[$key] = $value;
    }
  }
  public function getValue($field) {
    if ( array_key_exists( $field, $this->data ) ) {
      return $this->data[$field];
    } else {
      die( "Field not found" );
    }
  }
  public function getValueEncoded( $field ) {
    return htmlspecialchars( $this->getValue( $field ) );
  }
  protected static function connect() {
    try {
      $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
      $conn->setAttribute( PDO::ATTR_PERSISTENT, true );
      $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      $conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
    } catch ( PDOException $e ) {
      die( "Connection failed: " . $e->getMessage() );
    }

    return $conn;
  }
  
    protected static function connectRemote() {
    try {
      $connRemote = new PDO( rDB_DSN, DB_USERNAME, DB_PASSWORD );
      $connRemote->setAttribute( PDO::ATTR_PERSISTENT, true );
      $connRemote->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      $connRemote->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
    } catch ( PDOException $e ) {
      die( "Connection failed: " . $e->getMessage() );
    }

    return $connRemote;
  }

  protected static function disconnect( $conn ) {
    $conn = "";
  }
}

?>
