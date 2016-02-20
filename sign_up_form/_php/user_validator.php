<?php
  include_once 'dB_mysql_adapter.php';

  class UserValidator{
    
    private $sqlObject;

    public function __construct(){
       $this->sqlObject = new DbmysqlAdapter(new Dbmysql());
    }
   
    public function insertData($first, $last, $id, $email, $pass, $dob, $gender){
       return $this->sqlObject->insertData($first, $last, $id, $email, $pass, $dob, $gender);
    }

    public function checkExist($id_or_email, $pass, $what_is_it){
      return $this->sqlObject->checkExist($id_or_email, $pass, $what_is_it);
    } 

  }
    //$sqlObject->createTable();
  //$sqlObject->insertData(25);
    
 ?>
