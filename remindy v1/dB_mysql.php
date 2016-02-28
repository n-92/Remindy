<?php
  include_once 'config.php';
  
  class Dbmysql extends SQLite3{
      
      public function __construct() {
           $this->open(DB_REMINDY);
      }

      public function executeQuery($sql){
      
	      $ret = $this->exec($sql); 
	      if(!$ret){
	          echo $this->lastErrorMsg();
	      }else {
	          echo "Table created successfully\n";
	      }
	      
    }


  }
   
?>
