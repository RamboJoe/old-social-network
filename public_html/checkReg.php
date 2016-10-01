<?php

ob_start();
session_start();

// include all configs and function files
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once PHPDB_PATH . '/dbfunctions.php';
        
if (checkRegister($_POST['myusername'], encryptData($_POST['mypassword']), $_POST['myemail'])) {
	echo "<h1 style='color:green; text-align:center;'>";
	echo "New user added successfully</h1>";
} else {
	echo "<h1 style='color:red; text-align:center;'>";
	echo "New user not added!</h1>";
}
echo "<a href='main_login.php'>Back to login</a>";
           
ob_end_flush();
?>