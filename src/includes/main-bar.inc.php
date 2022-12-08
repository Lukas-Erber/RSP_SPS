<?php
echo '<header>';
echo      '<div class="container">';
echo        '<div class="main-head">';
echo          '<div class="left-side">';
echo            '<img src="./img/sps-logo.png" alt="samurailogo" />';
echo            '<div class="user-info">';
?>
              	<?php include 'includes/user-info.inc.php' ?>
<?php
echo            '</div>';
echo          '</div>';
echo          '<div class="nav-menu">';
echo            '<ul>';
?>
                <?php include 'includes/menu.inc.php'; ?>
<?php
echo            '</ul>';
echo          '</div>';
?>
          		<?php include 'includes/icons.inc.php'; ?>
<?php
echo        '</div>';
echo      '</div>';
echo    '</header>';
?>