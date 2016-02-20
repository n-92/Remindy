<?php
  include_once 'user_validator.php';
	header('Content-Type: application/json');

	if (is_ajax()) {
			  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
				$action = $_POST["action"];
				switch($action) { //Switch case for value of action
				  case "test_login": 
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

      $id_or_email = $return['id_or_email'];
      $pass = $return['input_password'];
      $what_is_it =0;

      $userValidator = new UserValidator();
      
      //1 for email, 0 for id
      if (strpos($id_or_email, '@'))
        $what_is_it = 1;
      else
        $what_is_it = 0;

      $check_exist = $userValidator->checkExist($id_or_email, $pass, $what_is_it);
      
      if($check_exist===1){
        $return['msg'] = 'success';
      }
      else{
        $return['msg'] = 'fail';
      }  
			$return = json_encode($return);
			echo  $return;
	}
	
?>
