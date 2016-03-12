<?php
include_once 'inputValidatorFunctions.php';
include_once 'dBManager.php';

class TaskManager {
 
 	//User Credentials
 	private $taskId; 
 	private $taskTitle;
 	private $dateTimeOfReminder;
 	private $dateTimeOfCreation;
 	private $taskDescription;
 	private $taskStatus; 
 	private $dBManager;

    public function __construct($id, $title, $datetime_of_reminder, $datetime_of_creation, $description,$status) {
    	$this->taskId = $id; 
    	$this->taskTitle = $title;
    	$this->dateTimeOfReminder = $datetime_of_reminder;
    	$this->dateTimeOfCreation = $datetime_of_creation;   
    	$this->taskDescription = $description; 
    	$this->taskStatus = $status; 
    	$this->dBManager = new DBManager();
    }
	

	public function insertTaskRecord($id, $title, $datetime_of_reminder, $datetime_of_creation, $description, $start, $status){
		$this->dBManager->insertTaskRecord($id, $title, $datetime_of_reminder, $datetime_of_creation, $description, $start, $status);
	}

    public function insertUserTaskRecord($userId, $taskId){
     $this->dBManager->insertUserTaskRecord($userId, $taskId);
    }


	public function checkTaskExists($title){
		$existance = $this->dBManager->checkDataExists('title',$title);
		return $existance;
	}

}