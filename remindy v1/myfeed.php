<?php
//--------------------------------------------------------------------------------------------------
// This script reads event data from a JSON file and outputs those events which are within the range
// supplied by the "start" and "end" GET parameters.
//
// An optional "timezone" GET parameter will force all ISO8601 date stings to a given timezone.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------

// Require our Event class and datetime utilities
require 'utils.php';
header('Content-Type: application/json');
// Read and parse our events JSON file into an array of event data arrays.
$json = file_get_contents('results.json');
$input_arrays = json_decode($json,true);

// Accumulate an output array of event data arrays.
$output_arrays = array();
  if (is_iterable($input_arrays))
  foreach ($input_arrays as $array) {
	  // Convert the input array into a useful Event object
	  $event = new Event($array);
    //Add to the output array 
    $output_arrays[] = $event->toArray();
  }
// Send JSON to the client.
echo json_encode($output_arrays);


function is_iterable($var)
{
  return $var !== null 
      && (is_array($var) 
            || $var instanceof Traversable 
            || $var instanceof Iterator 
            || $var instanceof IteratorAggregate
    );
}

?>
