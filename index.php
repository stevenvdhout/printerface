<?php
  function save_file($file) {
    if ($file["filefield"]["error"] == 0 && $file['filefield']['type'] == 'image/jpeg') {
      if (move_uploaded_file($file["filefield"]["tmp_name"], "uploads/" . $file["filefield"]["name"])) return TRUE;
    }
    return FALSE;

  }
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
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-upload {
        max-width: 175px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-upload .form-upload-heading,
      .form-upload .checkbox {
        margin-bottom: 10px;
      }

      .lead { font-size: 15px; margin-bottom: 10px; line-height: 18px; }

    </style>

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
