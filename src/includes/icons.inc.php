<?php
echo '<div class="icons">
        <a href="index.php"  title="Domů"> <i class="fa-solid fa-house"></i></a>';
?>

<?php 
	if (isset($_SESSION["uzivatel_id"])) {
		echo "<a href=\"includes/logout.inc.php\" title='Odhlásit se'><i class=\"fa-solid fa-book-open-reader\"></i></a>";
	} else {
		echo "<a href=\"login.php\"  title='Příhlásit se' ><i class=\"fa-solid fa-book-open-reader\"></i></a>";
	}
?>

<?php echo '</div>';