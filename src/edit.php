<?php
	session_start();

require_once 'includes/dbconn.inc.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$id = $_GET['id'];
$result = mysqli_query($conn," SELECT * FROM uzivatel WHERE id='".$id."'");
$row = $result->fetch_row();



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
			<form action="edit_save.php" method="POST">
                <h1>Editace uživatelů</h1>
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
                <h5>ID Role</h5>
				<input type="text" name="id_role" value="<?php echo $row[1]; ?>" placeholder="role" />
                <h5>Jméno</h5>
				<input type="text" name="jmeno" value="<?php echo $row[4]; ?>" placeholder="Jméno" />
                <h5>Příjmení</h5>
				<input type="text" name="prijmeni" value="<?php echo $row[5]; ?>" placeholder="Příjmení" />
                <h5>E-mail</h5>
				<input type="email" name="email" value="<?php echo $row[6]; ?>"" placeholder="Email" />

				<button type="submit" name="submit">editovat</button>
				<a href="administrace.php">Zpět</a>
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
