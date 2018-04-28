<?php 

// inserting connect.php
	require_once "connect.php";

// setting connection with database
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);

// if connection error occured, show the info
	if($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno."Description: ".$connection->connect_error;
	}
	else{

// variables login and password take values from inputs with attr name
	$login = $_POST['login'];
	$password = $_POST['password'];

	echo "it works";

// closing connection
	$connection->close();

	} //else





 ?>