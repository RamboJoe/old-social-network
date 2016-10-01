
<?php
	require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
    // Check if session is not registered, redirect back to main page. 
    // Put this code in first line of web page. 
    session_start();

    if(!(isset($_SESSION["login"]) && $_SESSION["login"]!='') ){
        header("location:main_login.php");
    }
    /*
    print '<pre>';
    var_dump($name);
    print '</pre>';
    */
/*
function friendAddedView() {
	
}
*/
?>

<html>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<body>
    <h1>Add Friend</h1>
    Welcome <?php echo $_SESSION['username'] ?>
    <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
        <form name="form1" method="post" action="insertFriend.php">
            <td>
                <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                    <tr>
                        <td colspan="3"><strong>Add Friend</strong></td>
                    </tr>
					
                    <tr>
                        <td width="78">Username</td>
                        <td width="6">:</td>
                        <td width="294"><input name="friendusername" type="text" id="friendusername"></td>
                    </tr>
					
                    <tr>
						<td>Friends:</td>
					</tr>
						<?php
						require_once PHPDB_PATH . '/dbfunctions.php';
						$stmt = getAllFriends($_SESSION['username']);

						$numCount = $stmt->rowCount();
						$results = $stmt->fetchAll();
						for ($i = 0; $i < $numCount; $i++) {
							$currentRecord = $results[$i];
							echo "<tr><td></td><td";
							echo ">" . $currentRecord["FriendB"] . "</td></tr>";
						}
						?>
					
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="Submit" value="Add"></td>
                    </tr>
                </table>
            </td>
        </form>
    </tr>
</table>
</body>
</html>