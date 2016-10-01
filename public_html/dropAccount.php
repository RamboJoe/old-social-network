<?php
    session_start();
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));	
require_once PHPDB_PATH . "/dbfunctions.php";
	$stmt = removeAccount($_SESSION['username']);
	if($stmt){
		echo '<h1>Account Deleted</h1>';
	} else {
		echo '<h1>Account Not Deleted</h1>';
	}

    session_destroy();
?>

<html>
<body>
    
    <br>

    <p>This page </p>
    <a href="main_login.php">Login</a>
    <br>
    <a href="page1.php">Page 1</a>

</body>
</html>