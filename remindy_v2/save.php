<?php
  session_start();
  header('Content-Type: application/json');
  include_once('taskManager.php');
  

	//Function to check if the request is an AJAX request
	function is_ajax() {
		  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
	
  if (is_ajax()) {
    populate_json();
    insertTaskRecord();
  }

  function insertTaskRecord(){
    $taskMgr = new TaskManager("","","","","","");
    $incoming = $_POST['e'];
    $json_decoded_event = json_decode($incoming);  
    
    foreach ($json_decoded_event as $jde){
        
      if (!($taskMgr->checkTaskTitleExists($jde->title))){
        $taskMgr->insertTaskRecord($jde->id,$jde->title, $jde->dateTimeOfReminder , $jde->dateTimeOfCreation, $jde->description, $jde->start,$jde->reminder_status); 
        $taskMgr->insertUserTaskRecord( $_SESSION["user_name"], $jde->id); 
      }
    }
  }
  
  
	
  function populate_json(){
      //print($_POST['e']);
    $incoming = $_POST['e'];
    $json_decoded_event = json_decode($incoming);

   /*
    * These are some of the ways that you can access the data
       print ($json_decoded[0]->title);
       print($json_decoded[0]->id);
       print($json_decoded[0]->start);
    */
    $store_data= [];
    foreach ($json_decoded_event as $jde){
      $store_data[] = array('title'=>$jde->title, 'start'=>$jde->start, 'id'=>$jde->id, 'description'=>$jde->description);
      
    }
    //$events['events'] = $store_data;

    $fp = fopen('user_json/'.$_SESSION["user_name"].'.json', 'w');
    fwrite($fp, json_encode($store_data));
    fclose($fp);

    $return['msg'] = 'success';
    echo json_encode($return); 
  }
	
?>
