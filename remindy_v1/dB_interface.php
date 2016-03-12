<?php
// The interface will have the CRUDL operation definition
    interface Dbinterface{

        //public function createTable();
        public function insertUserRecord($id, $givenName, $email, $phone, $pass);
        

    }
?>
