<?php
// The interface will have the CRDUAL operation definition
    interface Dbinterface{
      /*This interface will contain all the CRUDL functons*/
        public function createTable();
        public function insertData($first, $last, $id, $email, $pass, $dob, $gender);
        public function checkExist($id_or_email, $pass, $what_is_it); 
    }
?>
