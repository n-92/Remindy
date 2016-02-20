<?php
  include_once 'dB_interface.php';
  include_once 'dB_mysql.php';

  class DbmysqlAdapter implements Dbinterface{

    private $dbmysql;

    public function __construct(Dbmysql $db) {
        $this->dbmysql = $db;
    }

    public function createTable(){
      $this->dbmysql->createTable();
    }

    public function insertData($first, $last, $id, $email, $pass, $dob, $gender){
      return $this->dbmysql->insertData($first, $last, $id, $email, $pass, $dob, $gender);
    }
    
    public function checkExist($id_or_email, $pass, $what_is_it){
      return $this->dbmysql->checkExist($id_or_email, $pass, $what_is_it);
    } 
  }
?>
