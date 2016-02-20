<?php
  include_once 'user_validator.php';
	header('Content-Type: application/json');
	
	//The API Access Key is found from the API page in google developer.
	//Basically, this is going to be the ID of your android application
	//Everyone will have the same ID for this.  But for registration token, it's going
	//to be different
	
	/* define( 'API_ACCESS_KEY', 'AIzaSyDOrCkb3LW6EptPt8Fzq9gI5KiuTjEf0sQ' );	 */

	if (is_ajax()) {
			  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
				$action = $_POST["action"];
				switch($action) { //Switch case for value of action
				  case "test": 
							test_function();
							/* write_to_phone();		 */
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
       //Do what you need to do with the info. The following are some examples.
		  //if ($return["favorite_beverage"] == ""){
		  //  $return["favorite_beverage"] = "Coke";
		  //}
      //$return["favorite_restaurant"] = "McDonald's";
      //
			$return = json_encode($return);
			echo  $return;
	}
	
	function write_to_phone(){
		// API access key from Google API's Console
			//This I got from GCM Registration Token which is in RegistrationIntentService.java which was logged
			$registrationIds = array( 'fBAC8u_MYkU:APA91bHDlVBSTYBwjd4QWFCSJsfAEOIgebfm8cSVF9lDdr_um5dszFca538sAtvNZuBzAAGJKhSLdRXZeqywKiWE6nwThDoHlTqwj0meO22lQMz5WlrCVFrCncmRqsQdJkz_afvJr3gA' );
			// prep the bundle
			$msg = array
			(
				'message' 	=> 'You have missed many salats.. Please do something',
				'title'		=> 'This is a title. title',
				'subtitle'	=> 'This is a subtitle. subtitle',
				'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
				'vibrate'	=> 1,
				'sound'		=> 4,
				'largeIcon'	=> 'large_icon',
				'smallIcon'	=> 'small_icon'
			);
			$fields = array
			(
				'registration_ids' 	=> $registrationIds,
				'data'			=> $msg
			);
			 
			$headers = array
			(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);
			 
			$ch = curl_init();
			curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
			curl_setopt( $ch,CURLOPT_POST, true );
			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
			$result = curl_exec($ch );
			curl_close( $ch );
			//echo $result;			//if you include this, the echo won't return back to page
		
	}
?>
