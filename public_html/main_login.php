
<?php
    session_start();
    session_destroy();
?>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<head>
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>



<body>
	
	<?php 
	require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
	require_once(TEMPLATES_PATH . "/nav.php");
	?>
	
	<section class="container">
<!--
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-6">standard</div>
				<div class="col-sm-6 col-lg-6">standard</div>
			</div>
			<div class="row no-gutter">
				<div class="col-sm-12"><div class="panel-body container" style="width:300px;">
					<form name="form1" role="form" method="post" action="checklogin.php">
						<div class="form-group">
							<label for="email">Username:</label>
							<input type="text" class="form-control" id="myusername" name="myusername">
						</div>
						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" id="mypassword" name="mypassword">
						</div>
						<button type="submit" class="btn btn-default btn-block" name="Submit">Login</button>
					</form>
				</div></div>
		
			</div>
			
			<div class="row no-gutter">
				<div class="col-sm-12"><div class="panel-body container" style="width:300px;">
					<form name="form1" role="form" method="post" action="checklogin.php">
						<div class="form-group">
							<label for="email">Username:</label>
							<input type="text" class="form-control" id="myusername" name="myusername">
						</div>
						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" id="mypassword" name="mypassword">
						</div>
						<button type="submit" class="btn btn-default btn-block" name="Submit">Login</button>
					</form>
				</div></div>
		
			</div>
		</div>
		
		<ul class="nav nav-tabs nav-justified">
		  <li><button class="btn btn-block active" data-toggle="collapse" data-parent="#accordion" href="#collapse1"><h3>Login</h3></button></li>
		  <li><button class="btn btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapse2"><h3>Register</h3></button></li>
		</ul>
		<!--<button class="btn btn-default" data-toggle="collapse" data-parent="#accordion" href="#collapse1">Collapsible Group 1</button>
		<button data-toggle="collapse" data-parent="#accordion" href="#collapse2">Collapsible Group 2</button>-->
		<!--
		<div class="panel-group" id="accordion">
		  <div class="panel">
			<div id="collapse1" class="panel-collapse collapse in">
			  <div class="panel-body container" style="width:300px;">
					<form name="form1" role="form" method="post" action="checklogin.php">
						<div class="form-group">
							<label for="email">Username:</label>
							<input type="text" class="form-control" id="myusername" name="myusername">
						</div>
						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" id="mypassword" name="mypassword">
						</div>
						<button type="submit" class="btn btn-default btn-block" name="Submit">Login</button>
					</form>
				</div>
			</div>
		  </div>
			
		  <div class="panel" >
			<div id="collapse2" class="panel-collapse collapse" >
			  <div class="panel-body container" style="width:300px;">
					f
				</div>
			</div>
		</div>-->

		<div class="jumbotron">
			<h1 style="text-align:center;">Rella<span class="fa fa-umbrella" style="font-size:65px;"></span></h1>

			<div class="panel panel-default">
				<div class="panel-body container" style="width:300px;">
					<?php //if(!(isset($_SESSION["login"]) && $_SESSION["login"]!='')){
							//echo '<div class="alert alert-danger">
			//<strong>Failure:</strong> You have entered in the wrong username or password.</div>';
							//}?>
					<form name="form1" role="form" method="post" action="checklogin.php">
						<div class="form-group">
							
							<input type="text" class="form-control" id="myusername" name="myusername" placeholder="Username...">
						</div>
						<div class="form-group">
							
							<input type="password" class="form-control" id="mypassword" name="mypassword" placeholder="Password...">
						</div>
						<button type="submit" class="btn btn-default btn-block" name="Submit">Login</button>
					</form>
				</div>
			</div>
		</div>


		<!--
		<div class="jumbotron">
			<h1 style="color:#005470;">About</h1>
			<p>This is a basic login system with communication capabilities(<i>chat</i>).</p>

			<div class="row well">
				<div class="col-sm-12"> This app uses php, jquery, javascript, and sql. The app is styled using css and bootstrap. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
			</div>
		</div>
		-->


	</section>

	<footer class="container-fluid text-center">
		<p style="text-align:center; font-size:12px;">
			Copyright <span class="glyphicon glyphicon-copyright-mark"></span> 2016
		</p>
	</footer>




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

	<body>