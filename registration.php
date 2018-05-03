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

// hash the password
		$passwordHash = password_hash($password1, PASSWORD_DEFAULT);

// checking if checkbox was clicked

		if(!isset($_POST['terms']))
		{
			$sucValidation = false;
			$_SESSION['errorTerms'] = "You have to agree to the terms and conditions";
		}

// veryfying the captcha

		$secretKey = "6LeGjVYUAAAAAMWxo1x-SIjnWTkDwgg26E-K9wtx";

		$checkTheKey = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']);

		$answer = json_decode($checkTheKey);

		if($answer->success==false)
		{
			$sucValidation = false;
			$_SESSION['errorCheckbox'] = "Confirm that you are not a robot";
		}
			
// remember inserted data

		$_SESSION['rememberNick']=$nick;		
		$_SESSION['rememberEmail']=$email;		
		$_SESSION['rememberPassword1']=$password1;		
		$_SESSION['rememberPassword2']=$password2;

		if(isset($_POST['terms']))	$_SESSION['rememberTerms']=true;

			require_once "connect.php";

			mysqli_report(MYSQLI_REPORT_STRICT);

			try
			{
				$connection = @new mysqli($host, $db_user, $db_password, $db_name);
				if($connection->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_errno());
				}

			else{	

// checking if email already exists
				$result = $connection->query("SELECT id FROM users WHERE email='$email'");

				if(!$result) throw new Exception($connection->error);

				$numOfEmails = $result->num_rows;

				if($numOfEmails>0)
				{
					$sucValidation = false;
					$_SESSION['errorEmail'] = "Email is already taken";
				}

// checking if nick already exists
				$result = $connection->query("SELECT id FROM users WHERE user='$nick'");

				if(!$result) throw new Exception($connection->error);

				$numOfNicks = $result->num_rows;

				if($numOfNicks>0)
				{
					$sucValidation = false;
					$_SESSION['errorNick'] = "Nick is already taken";
				}

// if validation was succesful: 
				if($sucValidation==true){

					if($connection->query("INSERT into users VALUES (NULL,'$nick','$passwordHash','$email',100,100,100,30)"))
					{
						$_SESSION['registrationSuc']=true;
						header('Location: welcome.php');
					}
					else
					{
						throw new Exception($connection->error);
					}
				}
				
				$connection->close();

			} //try else
			} //try
			catch(Exception $e)
			{
				echo '<span class ="error">Server is inaccessible. Sorry. Please try again later.</span>';
				//echo '<br> Info for developer: '.$e;
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
		
		Nickname: <br> <input type="text" value="<?php 

			if(isset($_SESSION['rememberNick']))
			{
				echo $_SESSION['rememberNick'];
				unset($_SESSION['rememberNick']);
			}

		 ?>" name="nick"> <br>

		<?php

			if(isset($_SESSION['errorNick'])){

				echo '<div class="error">'.$_SESSION['errorNick'].'</div>';
				unset($_SESSION['errorNick']);
			}

		?>

		E-mail: <br> <input type="text"  value="<?php 

			if(isset($_SESSION['rememberEmail']))
			{
				echo $_SESSION['rememberEmail'];
				unset($_SESSION['rememberEmail']);
			}

		 ?>" name="email"> <br>

		<?php

			if(isset($_SESSION['errorEmail'])){

				echo '<div class="error">'.$_SESSION['errorEmail'].'</div>';
				unset($_SESSION['errorEmail']);
			}

		?>

		Password: <br> <input type="Password"  value="<?php 

			if(isset($_SESSION['rememberPassword1']))
			{
				echo $_SESSION['rememberPassword1'];
				unset($_SESSION['rememberPassword1']);
			}

		 ?>" name="password1"> <br>

		<?php

			if(isset($_SESSION['errorPassword'])){

				echo '<div class="error">'.$_SESSION['errorPassword'].'</div>';
				unset($_SESSION['errorPassword']);
			}

		?>

		Repeat Password: <br> <input type="Password" value="<?php 

			if(isset($_SESSION['rememberPassword2']))
			{
				echo $_SESSION['rememberPassword2'];
				unset($_SESSION['rememberPassword2']);
			}

		 ?>" name="password2"> <br>

		<label>
			<input type="checkbox" name="terms" <?php

			if(isset($_SESSION['rememberTerms']))
			{
// set the checkbox
				echo "checked";
				unset($_SESSION['rememberTerms']);
			}

			?>
			> I agree to the <a href="terms.html">terms and conditions</a>
		</label>

		<?php

			if(isset($_SESSION['errorTerms'])){

				echo '<div class="error">'.$_SESSION['errorTerms'].'</div>';
				unset($_SESSION['errorTerms']);
			}

		?>

		<div class="g-recaptcha" data-sitekey="6LeGjVYUAAAAANJ8Is2l6Dw6WJ3A8NExDC-tk0jc"></div>

			<?php

			if(isset($_SESSION['errorCheckbox'])){

				echo '<div class="error">'.$_SESSION['errorCheckbox'].'</div>';
				unset($_SESSION['errorCheckbox']);
			}

		?>

		<br>

		<input type="submit" name="Register">

	</form>

</body>
</html>