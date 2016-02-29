<?php
include_once 'inputValidatorFunctions.php';
include_once 'dBManager.php';

class LoginManager {
 
 	//User Credentials
 	private $userId; 
 	private $userEmail;
 	private $userPassword;
 	private $dBManager;

    public function __construct($id, $email, $pass) {
    	$this->userId = $id; 
    	$this->userEmail = $email;
    	$this->userPassword = $pass; 
    	$this->dBManager = new DBManager();
    }
	
	public function checkInputValidity(){
		//This code block will check the syntax of each of the credentials
		//Use functions defined in inputValidatorFunctions.php file
	
	}

	public function checkUserExists($id){
		$existance = $this->dBManager->checkDataExists('id',$id);
		return $existance;
	}


}