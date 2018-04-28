<?php 

session_start();

if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
{
	header('Location: index.php');
	exit();
}

// inserting connect.php
	require_once "connect.php";

// setting connection with database
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);

// if connection error occured, show the info
	if($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
			}
	else{

// variables login and password take values from inputs from index.php with attr name
	$login = $_POST['login'];
	$password = $_POST['password'];

	$login = htmlentities($login,ENT_QUOTES, "UTF-8");
	$password = htmlentities($password,ENT_QUOTES, "UTF-8");


// if the query execution is valid
	if($result = @$connection->query(
		sprintf("SELECT * FROM users WHERE user='%s' AND pass='%s'",
		mysqli_real_escape_string($connection,$login),
		mysqli_real_escape_string($connection,$password)
	)))
	{

		$numOfUsers = $result->num_rows;
		if($numOfUsers>0){


			$_SESSION['loggedIn']=true;
// fetch data from $result and store it in assoc array
			$row = $result->fetch_assoc();
// create a SESSION variables, which can be used in different php documents
			$_SESSION['id'] = $row['id'];
			$_SESSION['user'] = $row['user'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['attack'] = $row['attack'];
			$_SESSION['defense'] = $row['defense'];
			$_SESSION['health'] = $row['health'];
			$_SESSION['premiumDays'] = $row['premiumDays'];

// When logged in delete 'error'
			unset($_SESSION['error']);
			$result->close();

// forwarding to game.php
			header('Location: game.php');


		} //if numOfUsers>0
		else{

			$_SESSION['error']='<span style="color:red">Invalid login or password.</span> Please try again.';
			header('Location: index.php');

		}

	}

	

// closing connection
	$connection->close();

	} //else





 ?>