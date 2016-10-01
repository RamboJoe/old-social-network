<?php
// Check if session is not registered, redirect back to main page. 
// Put this code in first line of web page. 
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once PHPDB_PATH . '/dbfunctions.php';
session_start();
?>

	<html>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">	
	<body>
		<?php 
		require_once(TEMPLATES_PATH . "/nav.php");
		?>

		<section class="container">
			<div class="jumbotron">
				<h2>Activation page</h2>
				<p>This page take an id and a key and checks them with the database for their validity.</p>
				<?php 
				//echo $_GET["id"];
				//echo "<br>";
				//echo $_GET["key"];
				
				$id = trim($_GET["id"]);
				$key = trim($_GET["key"]);
				
				
				if (activateUser($id, $key))
				{
					echo "<p>User activated.</p>";
				}
				else
				{
					echo "<p>User NOT activated!</p>";
				}
				
				?>
			</div>
		</section>

		<?php 
		require_once(TEMPLATES_PATH . "/footer.php");
		?>
	</body>
	</html>