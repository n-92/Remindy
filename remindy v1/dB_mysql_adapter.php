<?php
  include_once 'dB_interface.php';
  include_once 'dB_mysql.php';
  include_once 'config.php';

  class DbmysqlAdapter implements Dbinterface{

    private $dbmysql;
    private $tbl_user = TBL_USER;

    public function __construct(Dbmysql $db) {
        $this->dbmysql = $db;
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
        $this->dbmysql->executeQuery($sql);
        
    }
  

    public function insertUserRecord($id, $givenName, $email, $phone, $pass){
      
      $sql =<<<EOF
      INSERT INTO tbl_user (ID,NAME,EMAIL,PHONE,PASSWORD)
      VALUES ('$id', '$givenName', '$email', '$phone', '$pass' );
EOF;

      $this->createTable();          
      $this->dbmysql->executeQuery($sql);
     
    }

    public function checkDataExists($tbl_name, $data){
        
        $sql = "";
        if ($tbl_name == TBL_USER){
          $sql =<<<EOF
          SELECT COUNT(*) FROM tbl_user WHERE ID='$data';
EOF;
          
        }

        $result = $this->dbmysql->executeCountQuery($sql);
        
        if ($result>0){
          return True; //the record does not exist
        }
        return False;
        
    }

  }
?>
