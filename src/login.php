<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SPS - přihlašte se</title>

    <link rel="stylesheet" type="text/css" href="css/login-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container" id="container">
		<div class="form-container log-in-container">
			<form action="includes/login.inc.php" method="POST">
                <h1>Přihlašte se</h1>
                <div class="reg-info-text">nebo se <a href="registrace.php">zaregistrujte</a></div>

				<input type="text" name="login" placeholder="Login" />
				<input type="password" name="heslo" placeholder="Heslo" />
				<a href="index.php">Pokračovat bez přihlášení</a>

				<?php
               		 if (isset($_GET["error"])) {
	                    if ($_GET["error"] == "wronglogin") {
	                        echo "<p class=\"text-warning\">Neplatný login</p>";
	                    }
                	}
            	?>

				<button type="submit" name="submit">Přihlásit se</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-right">
					<h2>Vítejte v Samurai Programming Solution</h2>
					<img src="img/sps-logo.png" alt="SPS Logo">
				</div>
			</div>
		</div>
	</div>
</body>
</html>