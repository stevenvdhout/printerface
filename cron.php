<?php
  require_once('functions.php');
  foreach(glob('uploads/*.*') as $path){

    $size = getimagesize($path);
    if ($size['mime'] = 'image/jpeg' || $size['mime'] = 'image/png') {
      if ($size[0] > $size[1]) {
        create_image($path, 2480, 1748, 'assets/overlay-landscape.png');
      }
      else {
        create_image($path, 1748, 2480, 'assets/overlay-portrait.png');
      }
      rename($path, 'processed/pic-' . time() . '.jpg');
    }

  }
