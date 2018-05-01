<?php 
	session_start();

// start validation only when data was insert into form, so when submit was clicked
	if (isset($_POST['email'])){

// succesful validation
		$sucValidation = true;

//checking nickname
		$nick = $_POST['nick'];

		if((strlen($nick)<3) || (strlen($nick)>20)){

			$sucValidation = false;
			$_SESSION['errorNick'] = "The lenght of nick must be between 3 and 20 characters";
		}

		if(ctype_alnum($nick)==false){
			$sucValidation = false;
			$_SESSION['errorNick']="Invalid characters. Please try again.";
		}

// checking email
		$email=$_POST['email'];

		$emailSecure = filter_var($email, FILTER_SANITIZE_EMAIL);

		if((filter_var($emailSecure,FILTER_VALIDATE_EMAIL)==false) || ($email != $emailSecure))
		{
			$sucValidation = false;
			$_SESSION['errorEmail'] = "Please insert valid E-mail Adress";
		}

// checking password validation

		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];

		if ((strlen($password1) <8) || (strlen($password1)>20))
		{
			$sucValidation = false;
			$_SESSION['errorPassword'] = "Password length must be between 8 and 20 characters";
		}

		if ($password1 != $password2){

			$sucValidation = false;
			$_SESSION['errorPassword'] = "Inserted passwords are not consistent";
		}

		$passwordHash = password_hash($password1, PASSWORD_DEFAULT);
		echo $passwordHash;
		exit();




// if validation was succesful: 
		if($sucValidation==true){

			echo "succesful validation";
			exit();

		}

	} //if (isset(%_POST['email']

 ?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title> Warriors - Register for FREE </title>
	<link rel="stylesheet" type="text/css" href="reg-styles.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

	<form method="post">
		
		Nickname: <br> <input type="text" name="nick"> <br>

		<?php

			if(isset($_SESSION['errorNick'])){

				echo '<div class="error">'.$_SESSION['errorNick'].'</div>';
				unset($_SESSION['errorNick']);
			}

		?>

		E-mail: <br> <input type="text" name="email"> <br>

		<?php

			if(isset($_SESSION['errorEmail'])){

				echo '<div class="error">'.$_SESSION['errorEmail'].'</div>';
				unset($_SESSION['errorEmail']);
			}

		?>

		Password: <br> <input type="Password" name="password1"> <br>

		<?php

			if(isset($_SESSION['errorPassword'])){

				echo '<div class="error">'.$_SESSION['errorPassword'].'</div>';
				unset($_SESSION['errorPassword']);
			}

		?>

		Repeat Password: <br> <input type="Password" name="password2"> <br>

		<label>
			<input type="checkbox" name="terms"> I agree to the <a href="terms.html">terms and conditions</a>
		</label>

		<div class="g-recaptcha" data-sitekey="6LeGjVYUAAAAANJ8Is2l6Dw6WJ3A8NExDC-tk0jc"></div>

		<br>

		<input type="submit" name="Register">

	</form>

</body>
</html>