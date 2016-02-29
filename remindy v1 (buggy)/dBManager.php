<?php
  include_once 'dB_mysql_adapter.php';


  class DBManager{

  	private $sqlObject;
    public function __construct(){
    	$this->sqlObject = new DbmysqlAdapter(new Dbmysql());
    }

    public function checkDataExists($data){

    }

    public function createTable(){
    	$this->sqlObject->createTable();
    }
  	
  	public function updateData($data){

  	}

  	public function deleteData($data){

  	}

  	public function insertUserRecord($id, $givenName, $email, $phone, $pass){
  		$this->sqlObject->insertUserRecord($id, $givenName, $email,$phone, $pass);
  		
  	}

  	public function getData($query){

  	}



  }
?>
