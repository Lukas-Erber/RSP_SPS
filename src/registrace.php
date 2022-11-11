<?php 
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SPS - přihlašte se</title>

    <link rel="stylesheet" type="text/css" href="css/reg-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container" id="container">
		<div class="form-container log-in-container">
			<form action="includes/registrace.inc.php" method="POST">
                <h1>Registrace</h1>
				<input type="text" name="login" value="<?php if(isset($_SESSION['login'])) { echo $_SESSION['login']; } ?>" placeholder="Login" />
				<input type="password" name="heslo" value="<?php if(isset($_SESSION['heslo'])) { echo $_SESSION['heslo']; } ?>" placeholder="Heslo" />
				<input type="password" name="hesloKontrola" value="<?php if(isset($_SESSION['hesloKontrola'])) { echo $_SESSION['hesloKontrola']; } ?>" placeholder="Zopakujte heslo" />
				<input type="text" name="jmeno" value="<?php if(isset($_SESSION['jmeno'])) { echo $_SESSION['jmeno']; } ?>" placeholder="Jméno" />
				<input type="text" name="prijmeni" value="<?php if(isset($_SESSION['prijmeni'])) { echo $_SESSION['prijmeni']; } ?>" placeholder="Příjmení" />
				<input type="email" name="email" value="<?php if(isset($_SESSION['email'])) { echo $_SESSION['email']; } ?>" placeholder="Email" />

				<?php
               		 if (isset($_GET["error"])) {
	                    if ($_GET["error"] == "emptyinput") {
	                        echo "<p class=\"text-warning\">Musí být vyplněna všechna pole</p>";
	                    } else if ($_GET["error"] == "invalidlogin") {
	                        echo "<p class=\"text-warning\">Login obsahuje nepovolené znaky</p>";
	                    } else if ($_GET["error"] == "loginexists") {
	                        echo "<p class=\"text-warning\">Zadaný login již existuje</p>";
	                    } else if ($_GET["error"] == "pwdmatcherror") {
	                        echo "<p class=\"text-warning\">Zadaná hesla se neshodují</p>";
	                    } else if ($_GET["error"] == "invalidemail") {
	                        echo "<p class=\"text-warning\">Chybně vyplněný email</p>";
	                    } else if ($_GET["error"] == "stmtfailed") {
	                        echo "<p class=\"text-warning\">Něco se pokazilo</p>";
	                    } else if ($_GET["error"] == "none") {
	                    	echo "<p class=\"text-warning\">Registrace proběhla úspěšně!</p>";
	                    }
                	}
            	?>

				<button type="submit" name="submit">Registrovat</button>
				<a href="login.php">Zpět na přihlášení</a>
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
