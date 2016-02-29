<?php
  include_once 'config.php';
  
  class Dbmysql extends SQLite3{
      
      public function __construct() {
           $this->open(DB_REMINDY);
      }

  }   
?>
