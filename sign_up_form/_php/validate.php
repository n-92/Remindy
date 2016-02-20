<?php
  include_once 'user_validator.php';
	header('Content-Type: application/json');

	if (is_ajax()) {
			  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
				$action = $_POST["action"];
				switch($action) { //Switch case for value of action
				  case "test": 
							test_function();
						break;
				}
		  }
	}

	//Function to check if the request is an AJAX request
	function is_ajax() {
		  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
	
	function test_function(){
      $return = $_POST;

      $first = $return['name_first'];
      $last = $return['name_last'];
      $id = $return['input'];
      $email = $return['email'];
      $pass = $return['pass_first_try'];
      $dob = $return['date'];
      $gender = $return['radio'];
      $userValidator = new UserValidator();
      $insert_result = $userValidator->insertData($first, $last, $id, $email, $pass, $dob, $gender);

      if($insert_result){
        $return['msg'] = 'success';
      }
      else{
        $return['msg'] = 'fail';
      }  
			$return = json_encode($return);
			echo  $return;
	}
	
?>
