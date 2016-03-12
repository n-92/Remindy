<?php 
include_once 'registrationManager.php';
header('Content-Type: application/json');

if (is_ajax()) {
	  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
	  	$action = $_POST["action"];
		switch($action) { //Switch case for value of action
			case "register": 
				registerUser();
			break;
		}
	}
}

//Function to check if the request is an AJAX request
function is_ajax() {
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function registerUser(){
	$data = $_POST;

	$id = $data['user_id'];
	$name = $data['actual_user_name'];
	$phone = $data['phone'];
	$email = $data['email'];
	$pass = $data['input_password'];
	$registrer = new RegistrationManager($id, $name, $phone, $email, $pass);
	$insert_result = $registrer->registerUser($id, $name, $phone, $email, $pass);
	if($insert_result){
		$return['registration_status'] = 'success';
	}
	else{
		$return['registration_status'] = 'fail';
	}  
	$return = json_encode($return);
	echo  $return;
}