<?php 
session_start();
include_once 'loginManager.php';
header('Content-Type: application/json');

if (is_ajax()) {
	  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
	  	$action = $_POST["action"];
		switch($action) { //Switch case for value of action
			case "login": 
				loginUser();

			break;
		}
	}
}

//Function to check if the request is an AJAX request
function is_ajax() {
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function loginUser(){

	$data = $_POST;
	$id = $data['id_or_email'];
	$email = "";//$data['email'];
	$pass = $data['input_password'];
	$loginMan = new LoginManager($id, $email, $pass);
	
	$login_status = $loginMan->checkUserExists($id);
	
	if($login_status){
		$return['login_status'] = 'success';
		$_SESSION["user_name"] = $id;
	}
	else{
		$return['login_status'] = 'fail';
	}  
	
	$return = json_encode($return);
	echo  $return;
}