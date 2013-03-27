<?php
/**
 * @todo compare php:imagemagick to gd
 * gd seems to be faster than imagemagick from shell
 */
  function save_file($file) {
    if ($file["filefield"]["error"] == 0 && $file['filefield']['type'] == 'image/jpeg') {
      if (move_uploaded_file($file["filefield"]["tmp_name"], "uploads/" . $file["filefield"]["name"])) {
        /* Do this on cron, to improve upload speed
        $path = "uploads/" . $file["filefield"]["name"];
        $size = getimagesize($path);
        if ($size[0] > $size[1]) {
          create_image($path, 2480, 1748, 'assets/overlay-landscape.png');
        }
        else {
          create_image($path, 1748, 2480, 'assets/overlay-portrait.png');
        }*/
        return TRUE;
      }
    }
    return FALSE;

  }


  function create_image($path, $width, $height, $overlay_path) {
    return create_image_imagemagick_exec($path, $width, $height, $overlay_path);
  }

  /**
   * The gd version to merge the image with the overlay
   */
  function create_image_gd($path, $width, $height, $overlay_path) {

    $orig = imagecreatefromstring(file_get_contents($path));
    $dest = ImageCreateTrueColor($width, $height);

    $source_width = imagesx($orig);
    $source_height = imagesy($orig);

    //if ((($source_width / $source_height) - ($width / $height)) == 0) {
      $source_x = 0;
      $source_y = 0;
    //}
    if (($source_width / $source_height) > ($width / $height)) {
      $source_y = 0;
      $temp_width = ceil($source_height * $width / $height);
      $source_x = ceil(($source_width - $temp_width) / 2);
      $source_width = $temp_width;
    }

    ImageCopyResampled($dest, $orig, 0, 0, $source_x, $source_y, $width, $height, $source_width, $source_height);

    $overlay = imagecreatefrompng($overlay_path);
    imagealphablending($overlay, true);
    imagecopy($dest, $overlay, 0, 0, 0, 0, $width, $height);

    imagejpeg($dest, 'rendered/pic-' . time() . '.jpg');

    ImageDestroy($dest);
    ImageDestroy($orig);
    ImageDestroy($overlay);

    return $dest;
  }

  /**
   * The imagick version to merge the image with the overlay
   */
  function create_image_imagick($path, $width, $height, $overlay_path) {
    $image = new imagick($path);
    //$image->resizeImage($width, $height, imagick::GRAVITY_CENTER, 1);
    $image->cropThumbnailImage($width, $height);
    $image->writeImage("rendered/pic-" . time() . '.jpg');
  }



   /**
   * The imagemagick version to merge the image with the overlay
   */
  function create_image_imagemagick_exec($path, $width, $height, $overlay_path) {
    $time = time();
    exec("/usr/bin/convert $path -resize ".$width."x".$height."^ -gravity center -extent ".$width."x".$height." -page 0+0 ".$overlay_path." -layers coalesce -flatten rendered/pic-".$time.".jpg");
    print "convert $path -resize ".$width."x".$height."^ -gravity center -extent ".$width."x".$height." -page 0+0 ".$overlay_path." -layers coalesce -flatten rendered/pic-".$time.".jpg";
  }

































