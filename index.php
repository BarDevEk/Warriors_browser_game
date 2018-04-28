<?php 
	session_start();

	if
		((isset($_SESSION['loggedIn'])) && ($_SESSION['loggedIn']==true)
		)
	{
	header('Location: game.php');
	exit();
	}

 ?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title> Warriors - Browser Game </title>
</head>
<body>

	“The supreme art of war is to subdue the enemy without fighting.” 
	― Sun Tzu, The Art of War <br><br>

<!-- sending informations from form to login.php -->
	<form action="login.php" method="post">
		
		Login:<br>
		<input type="text" name="login"> <br>
		Password:<br>
		<input type="password" name="password"> <br>
		<input type="submit" name="Login">

	</form>

	<?php 
// show 'error' only if 'error ' exist
		if(isset($_SESSION['error'])){
			echo $_SESSION['error'];
		}
	 ?>

</body>
</html>