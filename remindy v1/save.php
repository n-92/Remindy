<?php
  header('Content-Type: application/json');

	//Function to check if the request is an AJAX request
	function is_ajax() {
		  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
	
  if (is_ajax()) {
    test_function();
  }

	function test_function(){
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
      //print ($jde->title. "---" .$jde->start. "---" .$jde->id);
      //print(PHP_EOL);
      $store_data[] = array('title'=>$jde->title, 'start'=>$jde->start, 'id'=>$jde->id);
      //$store_data[] = array('title'=>$jde["title"], 'start'=>$jde["start"], 'id'=>$jde["id"]);
    }
    //$events['events'] = $store_data;

    $fp = fopen('results.json', 'w');
    fwrite($fp, json_encode($store_data));
    fclose($fp);

    $return['msg'] = 'success';
    echo json_encode($return); 
  }
	
?>
