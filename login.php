<?php 

session_start();

	include("connection.php");
	include("functions.php");
	$message = NULL;

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if(password_verify($password, $user_data['password']))
					{

						$_SESSION['id'] = $user_data['id'];
						header("Location: home.php");
						die;
					}
				}
			}
			
			$message = "wrong username or password!";
		}else
		{
			$message = "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style-login.css">
	<title>Login</title>
</head>
<body>
	<div class="centrovac">
		<div class="login">
			<div class="nadpis">Login</div>
			<form method="post" class="form_login">
				<label for="user_name">Username</label><br>
				<input type="text" name="user_name" class="input"><br><br>
				<label for="password">Password</label><br>
				<input type="password" name="password" class="input"><br>
				<input type="submit" value="Login" class="button"><br>
				<a href="signup.php" class="signup">Click to Signup</a>
			</form>
		</div>
		<?php
		echo('<div class="hlaska">' . $message . '</div>');
		?>
	</div>
	
</body>
</html>