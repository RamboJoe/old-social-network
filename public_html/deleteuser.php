<?php
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once PHPDB_PATH . '/dbfunctions.php';
session_start();
isLoggedIn($_SESSION["login"]);
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
			<header>
				<h1>Settings</h1>
			</header>

			<div class="col-sm-4">
				<br>
				<div class="btn-group-vertical btn-block">
					<a href="password.php" type="button" class="btn btn-primary" >Password</a>
					<a href="deleteuser.php" type="button" class="btn btn-primary active">Delete Account</a>
				</div>
			</div>

			<div class="col-sm-8">
				<p>
					This will <strong>permanently</strong> delete your account.
				</p>
				
				<form method="post" action="dropAccount.php">
					<div class="checkbox">
    					<label><input type="checkbox" id="check">I am sure.</label>
  					</div>
					
					<button disabled="true" class="btn btn-danger" id="btnDelete"  type="submit">Delete Account</button>
				</form>
			</div>


		</section>
		
		<script type="text/javascript">
			$('#check').click(function () {
				var checked = this.checked;
				//console.log(checked);
				
				if(checked){
					//$('#btnDelete').attr("class", "btn btn-default");
					$('#btnDelete').attr("disabled", !checked);
					//console.log($('#btnDelete').attr('disabled'));
				} else {
					//$('#btnDelete').attr("class", "btn btn-default disabled");
					$('#btnDelete').attr("disabled", true);
					//console.log($('#btnDelete').attr('class'));
					//console.log($('#btnDelete').attr('disabled'));
				}
			});
		</script>

		<?php 
		require_once(TEMPLATES_PATH . "/footer.php");
		?>


	</body>
</html>