<?php
function config(){
	$servername="localhost";
	$username="root";
	$password="";
	$database="db_name";//change this
	
	$conn = mysqli_connect($servername,$username,$password,$database);
	
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}
	return $conn;
}
?>
