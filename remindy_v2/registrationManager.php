<?php
include_once 'inputValidatorFunctions.php';
include_once 'dBManager.php';

class RegistrationManager {
 
 	//User Credentials
 	private $userId; 
 	private $userGivenName;
 	private $userEmail;
 	private $userPhone;
 	private $userPassword;
 	private $dBManager;

    public function __construct($id, $givenName, $email, $phone, $pass) {
    	$this->userId = $id; 
    	$this->userGivenName = $givenName;
    	$this->userEmail = $email;
    	$this->userPhone = $phone;   
    	$this->userPassword = $pass; 
    	$this->dBManager = new DBManager();
    }
	
	public function checkInputValidity(){
		//This code block will check the syntax of each of the credentials
		//Use functions defined in inputValidatorFunctions.php file
	
	}

	public function checkUserExists($id, $email, $userPhone){

	}

	public function registerUser($id, $givenName, $phone, $email, $pass){

		$this->dBManager->insertUserRecord($id, $givenName, $phone, $email, $pass);
		/*//Call the function from dBManager for registration
		if (!checkUserExists($id, $email, $phone)){
			//Do Registration

		}else{
			//Don't Register since user Already Exisits

		}*/

	}

}