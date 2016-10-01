<?php
ob_start();
// Check if session is not registered, redirect back to main page. 
// Put this code in first line of web page. 

    /*
    print '<pre>';
    var_dump($name);
    print '</pre>';
    */
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once PHPDB_PATH . '/dbfunctions.php';
session_start();
isLoggedIn($_SESSION["login"]);


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

		<section class="container well">
			<div class="well col-sm-5">
				<a href="#" class="btn btn-block" data-toggle="collapse" data-target="#collapseFriends">
					<span class="fa fa-group"></span> Friends
					<span class="badge" id="numFriends"></span>
				</a>
				<div class="collapse in" id='collapseFriends'>

					<table class="table-condensed" width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
						<tr>
							<th>Friend(s)</th>
							<th>Tools</th>
						</tr>
						<?php
						$_SESSION['friCnt'] = 0;
						require_once PHPDB_PATH . '/dbfunctions.php';
						$stmt = getAllFriends($_SESSION['username']);

						$numCount = $stmt->rowCount();
						$results = $stmt->fetchAll();
						for ($i = 0; $i < $numCount; $i++) {
							$currentRecord = $results[$i];
							if (alreadyFriend($currentRecord["FriendB"], $_SESSION['username'])) {
								echo "<tr><td";
							echo ">" . $currentRecord["FriendB"] . "</td>";
							echo '<td><form method="post" action="">
								<button class="btn btn-default" name="chatid" value="'.$currentRecord["FriendB"].'" type="submit"><span class="glyphicon glyphicon-comment"></span></button>
								<button class="btn btn-default" name="remove" value="'.$currentRecord["FriendB"].'" type="submit"><span class="fa fa-user-times"></span></button>
								</form></td></tr>';
								$_SESSION['friCnt']++;
							}
							
						}
						//$_SESSION['friCnt'] = $numCount;
						?>
					</table>
				</div>
				<a href="#" class="btn btn-block" data-toggle="collapse" data-target="#collapseFriReq"><span class="fa fa-envelope"></span> Friend Requests <span class="badge" id="numFriRequests"></span></a>

				<div class="collapse in info" id='collapseFriReq'>

					<table class="table-condensed" width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
						<tr>
							<th>Friend(s)</th>
							<th>Tools</th>
						</tr>
						<?php
					$_SESSION['friReqCnt'] = 0;
					$stmt = getAllFriendRequests($_SESSION['username']);
					
					$numCount = $stmt->rowCount();
					$results = $stmt->fetchAll();
					for ($i = 0; $i < $numCount; $i++) {
						$currentRecord = $results[$i];
						if(!alreadyFriend($_SESSION['username'], $currentRecord["FriendA"])){
							echo "<tr><td";
							echo ">" . $currentRecord["FriendA"] . "</td>";
							echo '<td><form method="post" action="">
								<button class="btn btn-default" name="friendid" value="'.$currentRecord["FriendA"].'" type="submit"><span class="	fa fa-user-plus"></span></button>
									</form></td></tr>';
							$_SESSION['friReqCnt']++;
						}
					}
					?>

					</table>
				</div>
								
				<a href="#" class="btn btn-block" data-toggle="collapse" data-target="#collapseFriAdds"><span class="fa fa-envelope"></span> Friends Added <span class="badge" id="numFriRequests"></span></a>

				<div class="collapse in info" id='collapseFriAdds'>

					<table class="table-condensed" width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
						<tr>
							<th>Friend(s)</th>
							<th>Tools</th>
						</tr>
						<?php
					$_SESSION['friAddCnt'] = 0;
					$stmt = getAllFriends($_SESSION['username']);
					
					$numCount = $stmt->rowCount();
					$results = $stmt->fetchAll();
					for ($i = 0; $i < $numCount; $i++) {
						$currentRecord = $results[$i];
						if(!alreadyFriend($currentRecord["FriendB"], $_SESSION['username'])){
							echo "<tr><td";
							echo ">" . $currentRecord["FriendB"] . "</td>";
							echo '<td><form method="post" action="">
								<button class="btn btn-default" name="friendid" value="'.$currentRecord["FriendB"].'" type="submit"><span class="	fa fa-user-plus"></span></button>
									</form></td></tr>';
							$_SESSION['friAddCnt']++;
						}
					}
					?>

					</table>
				</div>
			</div>
			<div class="well col-sm-7">
				<p>
					Messages
				</p>
			</div>


		</section>
		<section class="container">
			<br>
			<a href="addFriend.php" class="btn btn-info" role="button">Add Friend</a>
		</section>
		
		
		<?php 
			require_once(TEMPLATES_PATH . "/footer.php");
		?>

		<?php 
			if (isset($_POST['chatid'])) {
    			echo '<br />The ' . $_POST['chatid'] . ' submit button was pressed<br />';
				$_SESSION['chatid'] = $_POST['chatid'];
				header("location: ../LoginTest/chat/index.php");
			}
			
			if(isset($_POST['friendid'])){
				$stmt = insertFriend($_SESSION['username'], $_POST['friendid']);
				if ($stmt){
					header("location: login_success.php");
				}
			}
			
			if (isset($_POST['remove'])){
				$stmt = deleteFriend($_SESSION['username'], $_POST['remove']);
				if ($stmt){
					header("location: login_success.php");
				}
			}
		?>

			<script type="text/javascript">
				// Updates the number displayed in friends badge
				var friends = <?php echo $_SESSION['friCnt'];?>;
				document.getElementById("numFriends").innerHTML = friends;
				
				// Updates the number displayed in friend requests badge
				var friRequests = <?php echo $_SESSION['friReqCnt'];?>;
				document.getElementById("numFriRequests").innerHTML = friRequests;
			</script>

	</body>

	</html>