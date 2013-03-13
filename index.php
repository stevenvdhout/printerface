<?php
  require_once('functions.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Upload uw foto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>

    <div class="container">

      <form class="form-upload" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post">
        <h3 class="form-upload-heading">Print uw foto</h3>
        <?php
          // save the image
          if (is_array($_FILES) && isset($_FILES['filefield'])) {
            if (save_file($_FILES)) {
              echo '<p class="lead text-success">Uw foto werd naar de printer verstuurd.<p>';
            }
            else {
              echo '<p class="lead text-error">Er liep iets fout bij het uploaden van uw foto.<p>';
            }
          }
        ?>
        <div class="control-group"><div class="controls">
          <input type="file" id='filefield' name='filefield'>
        </div></div>
        <button class="btn btn-medium btn-success btn-block" type="submit">Upload</button>
      </form>

    </div> <!-- /container -->

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-filestyle.js"></script>
    <script type="text/javascript">
      $('#filefield').filestyle({
        buttonText: 'Foto',
        classButton: 'btn-primary',
        icon: true,
        classIcon: 'icon-picture icon-white',
        classText: 'input-small'
      });
    </script>
  </body>
</html>
