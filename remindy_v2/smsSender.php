<?php

require_once(__DIR__ . '/vendor/autoload.php');
include_once('taskManager.php');


// //$MessageBird = new \MessageBird\Client('live_dwefaWwJ5Aa2tmXCmttf'); // Actual Key
// $MessageBird = new \MessageBird\Client('test_118bpBRclVb4XlAyJa3rDXK4H'); // test key
// // Let's build the message
// $Message = new MessageBird\Objects\Message();
// $Message->originator = "Tester";
// $Message->recipients = array("+6591333107");
// $Message->body = 'This is a test message, sent from MessageBird.com.';
// $Message->scheduledDatetime = '2016-03-15T05:56:00+08:00';
// // Boom! Sent!
// var_dump($MessageBird->messages->create($Message)); 

 $taskMgr = new TaskManager("","","","","","");
 var_dump($taskMgr->getAllTasks());
