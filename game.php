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
		echo "<strong>Your premium account is acctive till: </strong>".$_SESSION['premiumDays']."</p>";

		$dateTime = new dateTime('2745-08-06 11:37:35');

		echo "Server's date and time: ".$dateTime -> format('Y-m-d H:i:s')."<br>";

		$premiumEnd = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['premiumDays']);

		$timeDif = $dateTime->diff($premiumEnd);

		if($dateTime<$premiumEnd)
			echo "Your premium account is active for ".$timeDif->format('%d days %h hours %i minutes %s seconds yet.');
		else
			echo "Premium is inactive for:  ".$timeDif->format('%y years %m months %d days, %h hours, %i minutes, %s seconds.');



		// echo time()."<br>";

		// echo date('Y-m-d H:i:s')."<br>";

		// $dateTime = new dateTime();

		// echo $dateTime -> format('Y-m-d H:i:s');

		// $dzien = 26;
		// $miesiac = 7;
		// $rok = 1875;

		// if(checkdate($miesiac, $dzien, $rok))



	 ?>

</body>
</html>