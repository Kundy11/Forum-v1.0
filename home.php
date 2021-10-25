<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		if(isset($_POST['var'])) $var=$_POST['var'];
		$query = "delete from clanky where id = '$var'";
		mysqli_query($con, $query);
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
            <li><a href="home.php">Home</a></li>
            <li><a href="pridat_clanek.php">Přidat článek</a></li>
            <li><a href="logout.php">Odhlásit se</a></li>
        </ul>
    </nav>
	<br>

	<div class="pozdrav"><p>Hello, <?php echo $user_data['user_name']; ?></p></div>

	<?php
	$clanky = mysqli_query($con,"select * from clanky order by date_clanek desc");
	foreach($clanky as $c)
	{
		echo('<div class="clanek">
				<div class="hlavnicast">
					<div class="datum">' . htmlspecialchars($c["date_clanek"]) . '</div>
					<div class="nadpis">' . htmlspecialchars($c["titulek"]) . '</div>
					<div class="obsah"><p>' . htmlspecialchars($c["obsah"]) . '</p></div>
				</div>
				<div class="druhacast">
					<div class="autor">' . htmlspecialchars($c["user"]) . '</div>');
					if($c["user"] == $user_data["user_name"]){
						echo('<div class="delete">
								<form method="post">
									<input class="delete" type="submit" name="delete" value="Delete">');
									echo('<input type="hidden" name="var" value="' . htmlspecialchars($c["id"]) . '">'); 
								echo('</form>
							</div>');
					}
				echo('</div></div>');			
	}

	?>
</body>
</html>