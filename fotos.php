<!DOCTYPE html>
<html>
  <head>
    <title>Uploaded fotos</title>
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
      <div id="carousel" class="carousel slide">
        <ol class="carousel-indicators">
          <li data-target="#carousel" data-slide-to="0" class="active"></li>
          <li data-target="#carousel" data-slide-to="1"></li>
          <li data-target="#carousel" data-slide-to="2"></li>
        </ol>
        <div class='carousel-inner'>
          <?php
            $i = 0;
            foreach(glob('rendered/*.jpg') as $filename){
              $active = '';
              if (!$i) $active = ' active';
              $i++;
              echo "<div class='carousel-image item$active'><img src='$filename' /></div>";
            }
          ?>
        </div>
        <a class="carousel-control left" href="#carousel" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#carousel" data-slide="next">&rsaquo;</a>
      </div>

      <div id="listing">
        <?php
          foreach(glob('rendered/*.jpg') as $filename){
            echo "<div class='image'><img src='$filename' width='150px' /></div>";
          }
        ?>
      </div>

    </div> <!-- /container -->

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $('#carousel').carousel();
    </script>

  </body>
</html>
