<?php
ob_start();

// include all configs and function files
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once PHPDB_PATH . '/dbfunctions.php';

?>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/style.css">	

<?php
require_once(TEMPLATES_PATH . "/nav.php");

if(checkLogin($_POST['myusername'], $_POST['mypassword'])){ //check if password matches user name in db
	session_start(); // need this to start session
	
	// register username and login
	$_SESSION['login'] = '1';
	$_SESSION['username'] = $_POST['myusername'];
	
	// redirect to file "login_success.php"
	header("location:login_success.php");
	
} else { // Display error message otherwise
	echo "<h1 style='color:red; text-align:center;'>";
	echo "Wrong Username or Password!</h1>";
	
	echo '<div class="alert alert-danger">
			<strong>Failure:</strong> You have entered in the wrong username or password.</div>';
	
	header("location:index.php?action=error");
}

echo "<a href='main_login.php'>Back to login</a>";

require_once(TEMPLATES_PATH . "/footer.php");

ob_end_flush();
?>