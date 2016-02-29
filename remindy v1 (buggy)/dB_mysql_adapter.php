<?php
  include_once 'dB_interface.php';
  include_once 'dB_mysql.php';
  include_once 'config.php';

  class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open(DB_REMINDY);
      }
   }

  class DbmysqlAdapter implements Dbinterface{

    private $dbmysql;
    private $dbsqlite; 
    private $tbl_user = TBL_USER;

    public function __construct(Dbmysql $db) {
        $this->dbmysql = $db;
        $this->dbsqlite = new MyDB();
    }


    public function createTable(){
      
      $sql =<<<EOF
        CREATE TABLE IF NOT EXISTS tbl_user
        (ID TEXT PRIMARY KEY    NOT NULL,
        NAME           TEXT    NOT NULL,
        EMAIL            TEXT     NOT NULL,
        PHONE        TEXT,
        PASSWORD         TEXT);
EOF;
        $this->dbsqlite->exec($sql);
        
    }
  
    public function checkTableExists(){

      $sql =<<<EOF
      SELECT 1 FROM sqlite_master WHERE name ='tbl_user' and type='table';
EOF;
      try{
        $this->dbsqlite->exec($sql);  
      }catch (Exception $e) {
        // We got an exception == table not found
        return FALSE;
      }
      return TRUE;

    }

    public function insertUserRecord($id, $givenName, $email, $phone, $pass){
      
      $sql =<<<EOF
      INSERT INTO tbl_user (ID,NAME,EMAIL,PHONE,PASSWORD)
      VALUES ('$id', '$givenName', '$email', '$phone', '$pass' );
EOF;
  
      $this->createTable();
      
      $this->dbsqlite->exec($sql);
     
    }

  }
?>
