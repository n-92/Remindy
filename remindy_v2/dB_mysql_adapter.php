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


    public function createUserRecordTable(){
      
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
    

    public function createTaskRecordTable(){
      
      $sql =<<<EOF
        CREATE TABLE IF NOT EXISTS tbl_tasks
        (ID TEXT PRIMARY KEY    NOT NULL,
        TITLE           TEXT    NOT NULL,
        DATETIME_OF_REMINDER            TEXT     NOT NULL,
        DATE_TIME_OF_CREATION        TEXT NOT NULL,
        DESCRIPTION         TEXT,
        START TEXT,
        STATUS    TEXT,
        SENT_COUNT INT DEFAULT 0 
        );
EOF;
        $this->dbmysql->executeQuery($sql);
        
    }

    public function deleteTaskRecord($tbl_name,$type,$data){
    
      $sql="";

      if ($tbl_name == TBL_TASKS and $type=='id'){
        $sql =<<<EOF
        DELETE FROM tbl_tasks 
        WHERE ID = '$data';
EOF;

        $this->dbmysql->executeQuery($sql);

        $sql =<<<EOF
        DELETE FROM tbl_user_has_task 
        WHERE TASKID = '$data';
EOF;
        return $this->dbmysql->executeQuery($sql);
    }


      
    }

    public function insertUserRecord($id, $givenName, $phone, $email, $pass){
      
      $sql =<<<EOF
      INSERT INTO tbl_user (ID,NAME,PHONE, EMAIL, PASSWORD)
      VALUES ('$id', '$givenName',  '$phone', '$email','$pass' );
EOF;

      //$this->createUserRecordTable();          
      $this->dbmysql->executeQuery($sql);
     
    }

    public function insertTaskRecord($id, $title, $datetime_of_reminder, $datetime_of_creation, $description, $start, $status){
      
      $sql =<<<EOF
      INSERT INTO tbl_tasks (ID,TITLE,DATETIME_OF_REMINDER,DATE_TIME_OF_CREATION,DESCRIPTION,START,STATUS)
      VALUES ('$id', '$title', '$datetime_of_reminder', '$datetime_of_creation', '$description', '$start','$status');
EOF;
      

      //$this->createTaskRecordTable();          
      $this->dbmysql->executeQuery($sql);
      
    }

    public function insertUserTaskRecord($userId, $taskId){

       $sql =<<<EOF
      INSERT INTO tbl_user_has_task (USERID, TASKID)
      VALUES ('$userId', '$taskId');
EOF;
      
      $this->dbmysql->executeQuery($sql);
    }

      public function checkDataExists($tbl_name, $type,$data){
        
        //$this->createTaskRecordTable();
        $sql = "";
        if ($tbl_name == TBL_USER and strcmp($type,'id')==0)
          $sql =<<<EOF
          SELECT COUNT(*) FROM tbl_user WHERE ID='$data';
EOF;
        if ($tbl_name == TBL_TASKS and strcmp($type,'title')==0)
          $sql =<<<EOF
          SELECT COUNT(*) FROM tbl_tasks WHERE TITLE='$data';
EOF;
        if ($tbl_name == TBL_TASKS) 
          $sql =<<<EOF
          SELECT COUNT(*) FROM tbl_tasks WHERE ID='$data';
EOF;
          
        $result = $this->dbmysql->executeCountQuery($sql);
        
        if ($result>0){
          return True; //the record does not exist
        }
        return False;
        
    }

    public function getAllRecords(){
      
      $sql=<<<EOF
        SELECT t_u.*, t_t.*
        from tbl_user t_u
        inner join tbl_user_has_task t_u_h_t on t_u_h_t.USERID=t_u.ID
        inner join tbl_tasks t_t on t_u_h_t.TASKID=t_t.ID;
EOF;

      $result = $this->dbmysql->fetchAllContent($sql);
      
      return $result;
    }

  }
