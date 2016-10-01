<?php
// Check if session is not registered, redirect back to main page. 
// Put this code in first line of web page. 
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once PHPDB_PATH . '/dbfunctions.php';
session_start();
isLoggedIn($_SESSION["login"]);

// define variables and set to empty values
$pwd = $repwd = $currpwd = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   	$pwd = test_input($_POST["pwd"]);
   	$repwd = test_input($_POST["repwd"]);
	$currpwd = test_input($_POST["currpwd"]);
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

// error variables
$errMsg = $errClass = $errIcon ="";


class inputField {
	function inputField() {
		//$this->password = "";
		$this->errorMsg = "";
		$this->errorClass = "";
		$this->errorIcon = "";
	}
}

$textFieldCurrPass = new inputField();
//$textFieldCurrPass->password = $currpwd;

$textFieldNewPass = new inputField();
//$textFieldNewPass->password = $pwd;

$textFieldNewRePass = new inputField();
//$textFieldNewRePass->password = $repwd;


/*
$dom = new DOMDocument();
$dom->loadHTML('password.php');
$ele = $dom->getElementById('currpwd');
$ele->getAttribute('className');
*/
//$ele->class = "has-error has-feedback";

//echo $textFieldNewPass->password;
//echo $textFieldNewPass->errorMsg;
$haveError = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if(empty($currpwd)){
		$textFieldCurrPass->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
		$textFieldCurrPass->errorClass = "has-error has-feedback";
		$textFieldCurrPass->errorMsg = "<p style='color:red;'>This field cannot be empty!</p>";
		
		$haveError = true;
	} else {
		$haveError = false;
	}
	
	if(empty($pwd)){
		$textFieldNewPass->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
		$textFieldNewPass->errorClass = "has-error has-feedback";
		$textFieldNewPass->errorMsg = "<p style='color:red;'>This field cannot be empty!</p>";
		
		$haveError = true;
	} else {
		$haveError = false;
	}

	if(empty($repwd)){
		$textFieldNewRePass->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
		$textFieldNewRePass->errorClass = "has-error has-feedback";
		$textFieldNewRePass->errorMsg = "<p style='color:red;'>This field cannot be empty!</p>";
		
		$haveError = true;
	} else if((!empty($pwd) && !empty($repwd)) && $pwd !== $repwd){
		$textFieldNewPass->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
		$textFieldNewPass->errorClass = "has-error has-feedback";
		$textFieldNewPass->errorMsg = "<p style='color:red;'>New password doesn't match re-typed password!</p>";
		
		$textFieldNewRePass->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
		$textFieldNewRePass->errorClass = "has-error has-feedback";
		$textFieldNewRePass->errorMsg = "<p style='color:red;'>New password doesn't match re-typed password!</p>";
		
		$haveError = true;
	} else {
		$haveError = false;
	}
	
	/*
	if (!$haveError){
		//echo '<div class="alert alert-success">
  		//		<strong>Success:</strong> Password has been changed.
		//	</div>';
		//header("location:changePassword.php");
	}
	*/
}

/*else if(!ctype_alpha($pwd)){
	//$errMsg = "<p style='color:green;'>Passwords match!</p>";
	//$errClass = "has-success has-feedback";
	$errMsg = "<p style='color:red;'>Passwords must be letters!</p>";
	$errClass = "has-error has-feedback";
	$errIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
} else if(empty($pwd) || empty($repwd)){
	$errMsg = "<p style='color:red;'>This field cannot be empty!</p>";
	$errClass = "has-error has-feedback";
	$errIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
} else if($pwd !== $repwd){
	//$errMsg = "<p style='color:green;'>Passwords match!</p>";
	//$errClass = "has-success has-feedback";
	$errMsg = "<p style='color:red;'>Passwords don't match!</p>";
	$errClass = "has-error has-feedback";
	$errIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
}
*/
			
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
		
		<?php
			if ($haveError){
		?>
		<section class="container">
			<header>
				<h1>Settings</h1>
			</header>

			<div class="col-sm-4">
				<br>
				<div class="btn-group-vertical btn-block">
					<a href="password.php" type="button" class="btn btn-primary active" >Password</a>
					<a href="deleteuser.php" type="button" class="btn btn-primary">Delete Account</a>
				</div>
			</div>

			<div class="col-sm-8">
				<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
					<div class="form-group <?php echo $textFieldCurrPass->errorClass; ?>">
						<label for="pwd">*Current Password:</label>
						<input type="password" class="form-control" id="pwd" name="currpwd" value="<?php echo $currpwd; ?>">
						<?php echo $textFieldCurrPass->errorIcon; ?>
						<?php echo $textFieldCurrPass->errorMsg; ?>
					</div>

					<div class="form-group <?php echo $textFieldNewPass->errorClass; ?>">
						<label for="pwd">*Password:</label>
						<input type="password" class="form-control" id="pwd" name="pwd" value="<?php echo $pwd; ?>">
						<?php echo $textFieldNewPass->errorIcon; ?>
						<?php echo $textFieldNewPass->errorMsg; ?>
					</div>

					<div class="form-group <?php echo $textFieldNewRePass->errorClass; ?>">
						<label for="pwd">*Retype Password:</label>
						<input type="password" class="form-control" id="repwd" name="repwd" value="<?php echo $repwd; ?>">
						<?php echo $textFieldNewRePass->errorIcon; ?>
						<?php echo $textFieldNewRePass->errorMsg; ?>
					</div>
					
					<button type="submit" class="btn btn-info">Save</button>
				</form>
			</div>
		</section>
		<?php 
			} else {
		?>
		
		
		<section class="container">
			<header>
				<h1>Settings</h1>
			</header>
			<?php
				require_once PHPDB_PATH . '/dbfunctions.php';
				if(isset($_POST['pwd'])){
					// For Testing
					//echo 'Changed password to: ' . $_POST['pwd'];
					$hash = encryptData($_POST['pwd']);
					echo $hash;
					echo "<br>";
					
					if(password_verify ($_POST['pwd'], $hash)){
						echo 'valid';
					} else {echo 'invalid';}
					
					$stmt = changePassword($_SESSION['username'],encryptData($_POST['pwd']));
					if ($stmt){
						//echo 'success';
						echo '<div class="alert alert-success">
							<strong>Success:</strong> Password has been changed.</div>';
					} else {
						//echo 'failure';
						echo '<div class="alert alert-danger">
							<strong>Failure:</strong> Password has failed to be change.</div>';
					}
				} else {
					echo 'Password was not set.';
				}
				?>
		</section>
		<?php 
			}
		?>
		
		
		<?php 
			require_once(TEMPLATES_PATH . "/footer.php");
		?>

		<!--
		<script type="text/javascript">
			$("#pwd").click(function () {
				alert("Text: " + $("#test").text());
			});
		</script>
	-->

		
		<?php
		// For Testing
		/*
		echo "<h2>Your Input:</h2>";
		echo $pwd;
		echo "<br>";
		echo $repwd;
		*/
		?>


	</body>

	</html>