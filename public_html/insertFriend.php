<?php
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once PHPDB_PATH . '/dbfunctions.php';
session_start();
isLoggedIn($_SESSION["login"]);


    $myfriendname=$_POST['friendusername'];
    $myfriendname = stripslashes($myfriendname);		
	
    
	$myusername = $_SESSION['username'];
    echo "<p>" . $myusername . "</p>";
	echo "<p>" . $myfriendname . "</p>";
        
	$friendExists = friendExists($myfriendname);
	if ($friendExists) {
		echo "<h2 style='color:green; text-align:center;'>";
		echo "User exists!</h2>";
		
		if	(alreadyFriend($myusername, $myfriendname)) {
			echo "<h2 style='color:red; text-align:center;'>";
			echo "Not added: already friend.</h2>";
			
		} else { // if new friend
			echo "<h2 style='color:green; text-align:center;'>";
			echo "New friend!</h2>";
			
			if (insertFriend($myusername, $myfriendname)) {
                echo "<h1 style='color:green; text-align:center;'>";
                echo "Added: New friend added successfully.</h1>";

            } else {
                echo "<h1 style='color:red; text-align:center;'>";
                echo "Not added: failed to add friend.</h1>";
            }
		}
    } else {
		echo "<h2 style='color:red; text-align:center;'>";
		echo "Not added: User does not exist.</h2>";
	}
	echo "<a href='login_success.php'><-Back Home</a>";
?>