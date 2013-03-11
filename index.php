<?php
  function save_file($file) {
    if ($file["filefield"]["error"] == 0 && $file['filefield']['type'] == 'image/jpeg') {
      if (move_uploaded_file($file["filefield"]["tmp_name"], "uploads/" . $file["filefield"]["name"])) {//return TRUE;
        $path = "uploads/" . $file["filefield"]["name"];
        $size = getimagesize($path);
        if ($size[0] > $size[1]) {
          print "landscape";
          resize($path, 2480, 1748);
        }
        else {
          print "portrait";
        }





        /*$overlay = imagecreatefrompng('assets/overlay-landscape.png');
        $upload = imagecreatefromjpeg('uploads/' . $file["filefield"]["name"]);

        imagealphablending($overlay, true);
        imagesavealpha($overlay, true);

        imagecopymerge($upload, $overlay, 0, 0, 0, 0, 2480, 1748, 100);

        header('Content-Type: image/png');
        imagepng($upload);

        imagedestroy($upload);
        imagedestroy($overlay);*/
      }

    }
    return FALSE;

  }

  function resize($path, $width, $height) {
    $orig = imagecreatefromstring(file_get_contents($path));
    $dest = ImageCreateTrueColor($width, $height);

    $source_width = imagesx($orig);
    $source_height = imagesy($orig);

    if ((($source_width / $source_height) - ($width / $height)) == 0) {
      $source_x = 0;
      $source_y = 0;
    }
    if (($source_width / $source_height) > ($width / $height)) {
      $source_y = 0;
      $temp_width = ceil($source_height * $width / $height);
      $source_x = ceil(($source_width - $temp_width) / 2);
      $source_width = $temp_width;
    }

    ImageCopyResampled($dest, $orig, 0, 0, $source_x, $source_y, $width, $height, $source_width, $source_height);


    $overlay = imagecreatefrompng('assets/overlay-landscape.png');
    imagealphablending($overlay, true);
    imagecopy($dest, $overlay, 0, 0, 0, 0, $width, $height);

    imagejpeg($dest, 'rendered/pic-' . time() . '.jpg');

    ImageDestroy($dest);
    ImageDestroy($orig);
    ImageDestroy($overlay);

    return $dest;
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
