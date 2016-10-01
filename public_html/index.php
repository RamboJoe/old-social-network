
<?php
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once PHPDB_PATH . '/dbfunctions.php';
require_once PHP_PATH . "/classes/inputField.php";// change this to just /inputField.php

// This logs out user
session_start();
$_SESSION["login"] = false;
session_destroy();
?>


<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<?php

// Visual error message objects
if(isset($_SESSION['txt_dname'])){
	$txt_dname = $_SESSION['txt_dname'];
	$txt_pass = $_SESSION['txt_pass'];
	$txt_repass = $_SESSION['txt_repass'];
	$txt_fname = $_SESSION['txt_fname'];
	$txt_lname = $_SESSION['txt_lname'];
	$txt_email = $_SESSION['txt_email'];

	$dname = $_SESSION['dname'];
	$pass = $_SESSION['pass'];
	$repass = $_SESSION['repass'];
	$fname = $_SESSION['fname'];
	$lname = $_SESSION['lname'];
	$email = $_SESSION['email'];
} else {
	$txt_dname = $txt_pass = $txt_repass = $txt_fname = $txt_lname = $txt_email = new inputField();
	$dname = $pass = $repass = $fname = $lname = $email = "";
}
?>

<body>
	<?php
	require_once(TEMPLATES_PATH . "/nav.php");
	?>
	<?php
	if(isset($_GET['action'])){
		/*
		if($_GET['action']=='error'){
			echo '<div class="alert alert-danger">
			<strong>Error:</strong> Wrong username or password. Perhaps you have not activated your account.
			</div>';
		} else if ($_GET['action']=='errorEmail'){
			echo '<div class="alert alert-danger">
			<strong>Error:</strong> Email failed to send.
			</div>';
		} else if ($_GET['action']=='regSuccess'){
			echo '<div class="alert alert-success">
  			<strong>Success:</strong> Your account has been added. A comfirmation email has been sent so you can complete the registration.
			</div>';
		} else if ($_GET['action']=='regSuccess'){
			echo '<div class="alert alert-success">
  			<strong>Success:</strong> Your account has been added. A comfirmation email has been sent so you can complete the registration.
			</div>';
		}
		*/
		
		switch($_GET['action']){
			case 'error':
				echo '<div class="alert alert-danger">
					<strong>Error:</strong> Wrong username or password. Perhaps you have not activated your account.
					</div>';
				break;
			case 'errorEmail':
				echo '<div class="alert alert-danger">
					<strong>Error:</strong> Email failed to send.
					</div>';
				break;
			case 'regSuccess':
				echo '<div class="alert alert-success">
					<strong>Success:</strong> Your account has been added. A comfirmation email has been sent so you can complete the registration.
					</div>';
				break;
			case 'logout':
				echo '<div class="alert alert-info">
					<strong>Logout:</strong> You logged out. Come by again.
					</div>';
				break;
			default:
		}
	}
	?>
	
	<section class="container">
		<div class="jumbotron">
			<h1 style="text-align:center;">Rella<span class="fa fa-umbrella" style="font-size:65px;"></span></h1>

			<div class="panel panel-default">
				<div class="panel-body container" style="width:300px;">
					<form name="form1" role="form" method="post" action="checklogin.php">
						<div class="form-group">
							
							<input type="text" class="form-control" id="myusername" name="myusername" placeholder="Username..." autocomplete="off">
						</div>
						<div class="form-group">
							
							<input type="password" class="form-control" id="mypassword" name="mypassword" placeholder="Password..." autocomplete="off">
						</div>
						<button type="submit" class="btn btn-default btn-block" name="Submit">Login</button>
					</form>
				</div>
			</div>
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
					<form class="form-horizontal" name="form1" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
						
						<div class="well">
							<div class="form-group <?php echo $txt_dname->errorClass; ?>">
								<label class="control-label col-sm-3" for="name">*Display Name:</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="user_displayname" name="user_displayname" value="<?php echo $dname; ?>">
									<?php echo $txt_dname->errorIcon; ?>
									<?php echo $txt_dname->errorMsg; ?>
								</div>
								<p>(Must be: (a-Z)and/or(#),(8 chars long, not > 30),() )</p>
							</div>
						</div>
						
						<div class="well">
							<div class="form-group <?php echo $txt_pass->errorClass; ?>">
								<label class="control-label col-sm-3" for="pwd">*Password:</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="user_password" name="user_password" value="<?php echo $pass; ?>">
									<?php echo $txt_pass->errorIcon; ?>
									<?php echo $txt_pass->errorMsg; ?>
								</div>
							</div>

							<div class="form-group <?php echo $txt_repass->errorClass; ?>">
								<label class="control-label col-sm-3" for="pwd">*Re-Type Password:</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="user_repassword" name="user_repassword" value="<?php echo $repass; ?>">
									<?php echo $txt_repass->errorIcon; ?>
									<?php echo $txt_repass->errorMsg; ?>
								</div>
							</div>
						</div>
						
						<div class="well">
							<div class="form-group <?php echo $txt_fname->errorClass; ?>">
								<label class="control-label col-sm-3" for="name">First Name:</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="user_firstname" name="user_firstname" value="<?php echo $fname; ?>">
									<?php echo $txt_fname->errorIcon; ?>
									<?php echo $txt_fname->errorMsg; ?>
								</div>
							</div>

							<div class="form-group <?php echo $txt_lname->errorClass; ?>">
								<label class="control-label col-sm-3" for="name">Last Name:</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="user_lastname" name="user_lastname" value="<?php echo $lname; ?>">
									<?php echo $txt_lname->errorIcon; ?>
									<?php echo $txt_lname->errorMsg; ?>
								</div>
							</div>
						</div>
						
						<div class="well">
							<div class="form-group <?php echo $txt_email->errorClass; ?>">
								<label class="control-label col-sm-3" for="email">*Email:</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="user_email" name="user_email" value="<?php echo $email; ?>">
									<?php echo $txt_email->errorIcon; ?>
									<?php echo $txt_email->errorMsg; ?>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-default" name="submit">Register</button>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<body>