<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
	$message = NULL;
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$titulek = $_POST['titulek'];
		$obsah = $_POST['obsah'];
		$user = $user_data['user_name'];

		if(!empty($titulek) && !empty($obsah))
		{
			$query = "INSERT INTO clanky (id, user, titulek, obsah, date_clanek) VALUES (NULL, '$user', '$titulek', '$obsah', current_timestamp())";

			if (mysqli_query($con, $query)) {
  			$message = "Článek úspěšně přidán";
			} 
			else {
  			$message = "Error: " . $query . "<br>" . mysqli_error($con);
			}
		}
		else
		{
			$message = "Zadejte platné informace";
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<nav>
        <ul>
            <div class="strana"><a href="https://jaknaweby.eu/" target="_blank"><img src="Logo.png" alt="LOGOOOOO"></a></div>
            <li><a href="index.php">Home</a></li>
            <li><a href="pridat_clanek.php">Přidat článek</a></li>
            <li><a href="logout.php">Odhlásit se</a></li>
        </ul>
    </nav>
	<br>

	<div class="editor">
		<form method="post">
		    <div><label for="title">Titulek</label></div>
			<div><textarea id="text" name="titulek" cols="50" rows="3"></textarea></div>
			<div><label for="obsah">Obsah</label></div>
			<div><textarea class="obsah" name="obsah" cols="150" rows="20" id="text"></textarea></div>

			<input id="button" type="submit" value="Přidat"><?php echo($message)?><br><br>
	</form>
	</div>
	
</body>
</html>