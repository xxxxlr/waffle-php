
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Waffle</title>

    <!-- Bootstrap core CSS -->
    <link href="style/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style/navbar.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="style/bootstrap/assets/js/html5shiv.js"></script>
      <script src="style/bootstrap/assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <div class="jumbotron">
        <h1>Waffle</h1>
        <p>Connecting local database and Facebook API</p>
        <p>
          <a href="<?php echo $facebook->getLoginUrl(); ?>">Log in with Facebook &raquo;</a>
        </p>
      </div>

    </div> <!-- class="btn btn-lg btn-primary" -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="style/bootstrap/assets/js/jquery.js"></script>
    <script src="style/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>

