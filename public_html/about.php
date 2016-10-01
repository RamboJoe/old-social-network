<?php
	require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
?>

<html>
		<head>
			<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
			<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
			<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

			<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
		
			<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		</head>
	<body>
		<?php 
			require_once(TEMPLATES_PATH . "/nav.php");
		?>
		
		<section class="container">
			<div class="jumbotron">
				<h1>About</h1>
				<p>This is a basic login system with communication capabilities(<i>chat</i>).</p>
				<p>This app uses php, jquery, javascript, and sql. The app is styled using css and bootstrap. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
		</section>
		
		<?php 
			require_once(TEMPLATES_PATH . "/footer.php");
		?>
		
		
		<!-- Modal -->
		<div class="modal fade" id="loginModal" role="dialog">
			<div class="modal-dialog">
				
				<!-- Modal content-->
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Login</h4>
					</div>
					<div class="modal-body">

						<form name="form1" role="form" method="post" action="checklogin.php">
							<div class="form-group">
								<label for="email">Username:</label>
								<input type="text" class="form-control" id="myusername" name="myusername">
							</div>
							<div class="form-group">
								<label for="pwd">Password:</label>
								<input type="password" class="form-control" id="mypassword" name="mypassword">
							</div>
							<button type="submit" class="btn btn-default" name="Submit">Login</button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="registerModal" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Register</h4>
					</div>
					<div class="modal-body">
						<form name="form1" role="form" method="post" action="checkReg.php">
							<div class="form-group">
								<label for="name">Username:</label>
								<input type="text" class="form-control" id="myusername" name="myusername">
							</div>
							<div class="form-group">
								<label for="pwd">Password:</label>
								<input type="password" class="form-control" id="mypassword" name="mypassword">
							</div>
							<div class="form-group">
								<label for="email">Email:</label>
								<input type="text" class="form-control" id="myemail" name="myemail">
							</div>
							<button type="submit" class="btn btn-default" name="Submit">Register</button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>