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

   public function executeCountQuery($sql){

    $result = $this->query($sql);
    $rows = $result->fetchArray();  
    return $rows[0];

  }

  public function fetchAllContent($sql){
    $result = $this->query($sql);
    //$rows = $result->fetchArray();  

    while($row=$result->fetchArray()){
      // Do Something with $row
      print_r($row[0]);


    }
  }


}

?>
