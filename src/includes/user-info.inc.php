<?php
	if (isset($_SESSION["uzivatel_id"])) {
		echo '<p>'.$_SESSION["jmeno"];
        echo " ";
        echo $_SESSION["prijmeni"].'</p>';
        echo "<p>Vaše role je: ";
        echo '<b>'.$_SESSION["role_nazev"].'</b></p>';
    }