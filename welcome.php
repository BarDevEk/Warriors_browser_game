<?php 
	session_start();

	if (!isset($_SESSION['registrationSuc']))
	{
	header('Location: index.php');
	exit();
	}
	else
	{
		unset($_SESSION['registrationSuc']);
	}

// deleting variables which remembers values when registration was not valid

	if(isset($_SESSION['rememberNick'])) unset($_SESSION['remeberNick']);
	if(isset($_SESSION['rememberEmail'])) unset($_SESSION['remeberEmail']);
	if(isset($_SESSION['rememberPassword1'])) unset($_SESSION['remeberPassword1']);
	if(isset($_SESSION['rememberPassword2'])) unset($_SESSION['remeberPassword2']);
	if(isset($_SESSION['rememberTerms'])) unset($_SESSION['remeberTerms']);

// deleting variables which remembers values when registration was not valid

	if(isset($_SESSION['errorNick'])) unset($_SESSION['errorNick']);
	if(isset($_SESSION['errorEmail'])) unset($_SESSION['errorEmail']);
	if(isset($_SESSION['errorPassword1'])) unset($_SESSION['errorPassword1']);
	if(isset($_SESSION['errorPassword2'])) unset($_SESSION['errorPassword2']);
	if(isset($_SESSION['errorTerms'])) unset($_SESSION['errorTerms']);
	if(isset($_SESSION['errorCheckbox'])) unset($_SESSION['errorCheckbox']);


 ?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title> Warriors - Browser Game </title>
</head>
<body>

	Thank you for registration. You can log in now. Have fun ! <br><br>

	<a href="index.php">LOG IN !</a>
	<br>
	<br>

</body>
</html>