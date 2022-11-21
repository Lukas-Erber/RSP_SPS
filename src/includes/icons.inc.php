<?php
echo '<div class="icons">
        <a href="index.php"> <i class="fa-solid fa-house"></i></a>';
?>

<?php 
	if (isset($_SESSION["uzivatel_id"])) {
		echo "<a href=\"includes/logout.inc.php\"><i class=\"fa-solid fa-book-open-reader\"></i></a>";
	} else {
		echo "<a href=\"login.php\"><i class=\"fa-solid fa-book-open-reader\"></i></a>";
	}
?>

<?php echo '</div>';