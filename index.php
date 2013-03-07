<!DOCTYPE html>
<html>
  <head>
    <title>Diabetic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-input {
        max-width: 220px;
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
      .form-input .form-input-heading,
      .form-input .checkbox {
        margin-bottom: 10px;
      }

      .lead { font-size: 15px; margin-bottom: 10px; line-height: 18px; }

      .input-medium-addon { width: 177px; }

    </style>

  </head>
  <body>

    <div class="container">

      <form class="form-input" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post">
        <h3 class="form-input-heading">Suikerwaarde</h3>
        <?php
          //echo '<p class="lead text-success">Uw waarden werden bewaard.<p>';
        ?>
        <input type="number" class="input-block-level" id='suiker' name='suiker' placeholder="Suikerwaarde" />

        <div id="datetimepicker" class="input-prepend date">
          <span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
          <input data-format="dd/MM/yyyy hh:mm:ss" type="text" class='input-medium-addon' placeholder="Tijdstip"></input>
        </div>

        <input type="number" class="input-block-level" id='novorapid' name='novorapid' placeholder="Eenheden Novorapid" />
        <input type="number" class="input-block-level" id='lantus' name='lantus' placeholder="Eenheden Lantus" />
        <textarea class="input-block-level" id='eten' name='eten' placeholder="Wat ga je eten?"></textarea>

        <button class="btn btn-large btn-block btn-primary" type="submit">Opslaan</button>
      </form>

    </div> <!-- /container -->

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
      $(function() {
        $('#datetimepicker').datetimepicker({
          language: 'be-NL',
          maskInput: true,
          pickTime: false,
        });
      });
    </script>

  </body>
</html>
