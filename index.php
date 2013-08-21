<?php

require 'waffle.php';

// Database and Facebook API connections
facebook_api_connect();
database_connect();

create_new_user();

// Go to login page
if ($fb_user_id == NULL) { 
	require 'welcome.php';
	return;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Test</title>

    <link href="style/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <link href="style/template.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="style/bootstrap/assets/js/html5shiv.js"></script>
      <script src="style/bootstrap/assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <!--<div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
		-->
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active">
				<img src="https://graph.facebook.com/<?php echo $fb_user_id; ?>/picture">
			</li>
			<li><a href="#about"><?php echo $fb_user_profile['name']; ?></a></li>

			<li><a href="logout.php">Logout</a></li>


          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="starter-template">

        <h1>Hello, </h1>
        <p class="lead">
			
			<?php 
			//	foreach($fb_user_friends['data'] as $friend): 
				foreach(retrieve_user_friends() as $friend): 
			?>
			<p>
				<img src="https://graph.facebook.com/<?php echo $friend['id']; ?>/picture">
				<?php echo $friend['name'];?>
			</p>
			<?php endforeach; ?>
		</p>
      </div>

    </div><!-- /.container -->

    <script src="style/bootstrap/assets/js/jquery.js"></script>
    <script src="style/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>


<!--  height="55%" width="55%" -->
