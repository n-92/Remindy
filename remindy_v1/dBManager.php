<?php
  include_once 'dB_mysql_adapter.php';
  include_once 'dB_mysql.php';
  include_once 'config.php';

  class DBManager{

  	private $sqlObject;
    public function __construct(){
    	$this->sqlObject = new DbmysqlAdapter(new Dbmysql());
    }

    public function checkDataExists($type,$data){
      if ($type == 'id'){
        $return = $this->sqlObject->checkDataExists(TBL_USER,'id',$data);  
        return $return;
      }else if ($type == 'title'){
        $return = $this->sqlObject->checkDataExists(TBL_TASKS,'title',$data);  
        return $return;
      }else if ($type == 'taskid'){
        $return = $this->sqlObject->checkDataExists(TBL_TASKS,'taskid',$data);
        return $return;  
      }

    }

    public function createTable(){
    	$this->sqlObject->createTable();
    }
  	
  	public function updateData($data){

  	}

  	public function insertUserRecord($id, $givenName, $email, $phone, $pass){
  		$this->sqlObject->insertUserRecord($id, $givenName, $email,$phone, $pass);
  	}

    public function insertTaskRecord($id, $title, $datetime_of_reminder, $datetime_of_creation, $description, $start, $status){
      $this->sqlObject->insertTaskRecord($id, $title, $datetime_of_reminder, $datetime_of_creation, $description, $start, $status);                
    }

    public function insertUserTaskRecord($userId, $taskId){
     $this->sqlObject->insertUserTaskRecord($userId, $taskId);
    }


    public function deleteTaskRecord($type,$data){
      if ($type == 'taskid'){
        $return = $this->sqlObject->deleteTaskRecord(TBL_TASKS,'id',$data);  
        return $return;
      }

    }

  	public function getData($query){

  	}



  }
