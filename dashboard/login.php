<?php

session_start();
$message="";


if(count($_POST)>0) {
	$user_name = mysql_real_escape_string($_POST['user_name']);
	$user_password = $_POST['password'];
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("robinsnest",$conn);
	$result = mysql_query("SELECT * FROM users WHERE user_name= '$user_name' and password = '$user_password' ");
	var_dump($result);
	if($result === FALSE) { 
    	die(mysql_error()); // TODO: better error handling
	}
	$row  = mysql_fetch_array($result);
	if(is_array($row)) {
		$_SESSION["user_name"] = $row["user_name"];
	} else {
		$message = "Invalid Username or Password!";
	}
}

if(isset($_SESSION["user_name"])) {
	header("Location:user_dashboard.php");
}
?>