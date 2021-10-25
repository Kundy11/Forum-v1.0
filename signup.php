<?php 
session_start();

	include("connection.php");
	include("functions.php");
	$message = NULL;

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = test_input($_POST['user_name']);
		$password = password_hash(test_input($_POST['password']), PASSWORD_DEFAULT);

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
			$query = "insert into users (user_name,password) values ('$user_name','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			$message = "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style-signup.css">
	<title>Signup</title>
</head>
<body>
	<div class="centrovac">
		<div class="signup">
			<div class="nadpis">Signup</div>
			<form method="post">
				<label for="user_name">Username</label>
				<input type="text" name="user_name" class="input"><br><br>
				<label for="password">Password</label>
				<input type="password" name="password" class = input><br>
				<input type="submit" value="Signup" class="button"><br>
				<a href="login.php" class="login">Click to Login</a>
			</form>
		</div>
		<?php
		echo('<div class="hlaska">' . $message . '</div>');
		?>
	</div>
	
</body>
</html>