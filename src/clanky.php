<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/header.inc.php'; ?>
  </head>
  <body>
    <?php include 'includes/main-bar.inc.php'; ?>
    <?php include 'includes/posudek-modal.inc.php'; ?>

    <section>
     <div class="container">
        <h1>Samurai Programming Solution Magazine</h1>
        <div class="our-intro">
          <p>
            <b>Samurai Programming Solution</b> je vysokoškolský odborný
            recenzovaný časopis, který slouží pro publikační aktivity
            akademických pracovníků Vysoké školy polytechnické Jihlava i jiných
            vysokých škol, univerzit a výzkumných organizací.
          </p>
        </div>
    </section>

    <section>
      <div class="container">
        <?php require "includes/obsah_autor.inc.php"; ?>
      </div>
    </section>

    <?php include 'includes/footer.inc.php'; ?>

    <script>
      $('.rec').click(function() {     
        var text = $(this).data('text');  
        var hod1 = $(this).data('hod1'); 
        var hod2 = $(this).data('hod2');
        var hod3 = $(this).data('hod3');
        var hod4 = $(this).data('hod4');
        var hod5 = $(this).data('hod5');
        var hod6 = $(this).data('hod6');

        $('#text').val(text);  
        $('#hod1').val(hod1);  
        $('#hod2').val(hod2);
        $('#hod3').val(hod3);
        $('#hod4').val(hod4);
        $('#hod5').val(hod5);
        $('#hod6').val(hod6);
      });
    </script>
  </body>
</html>
