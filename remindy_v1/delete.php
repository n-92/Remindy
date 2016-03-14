<?php
  session_start();
  header('Content-Type: application/json');
  include_once('taskManager.php');
  

	//Function to check if the request is an AJAX request
	function is_ajax() {
		  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
	
  if (is_ajax()) {
    
    deleteTask();
  }

  function deleteTask(){
    $taskMgr = new TaskManager("","","","","","");
    $incoming = $_POST['e'];

    if ($taskMgr->checkTaskIdExists($incoming)){
      $taskMgr->deleteTaskRecordById($incoming);
    }

  }
  
  
	
 
	
?>
