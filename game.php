<?php 

session_start();

if(!isset($_SESSION['loggedIn'])){
	header('Location: index.php');
	exit();
}

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title> Warriors - Browser Game </title>
</head>
<body>

	<?php 

		echo "<p> Witaj ".$_SESSION['user'].'! <a href="logout.php">Logout</a></p>';

		echo "<p><strong>Attack: </strong>".$_SESSION['attack']." | ";
		echo "<strong>Defense: </strong>".$_SESSION['defense']." | ";
		echo "<strong>Health: </strong>".$_SESSION['health']."</p>";

		echo "<p><strong>Email: </strong>".$_SESSION['email']."<br>";
		echo "<strong>Premium Days: </strong>".$_SESSION['premiumDays']."</p>";



	 ?>

</body>
</html>