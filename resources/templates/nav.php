<?php
// gets page name
$page = preg_split('/(\/)/', $_SERVER['PHP_SELF']);

// changes class to activate which nav link
function activatePage($activePage, $currentPage){
	echo (strcmp($currentPage, $activePage) === 0)? 'active' : '';
}
//print '<pre>';
//var_dump($_SESSION["login"]);
//print '</pre>';

if(!(isset($_SESSION["login"]) && $_SESSION["login"]!='') ){ // Main login page header
        //header("location:main_login.php");
?>
<nav class="navbar navbar-info">
		<div class="container">
			<div class="navbar-default">
				<a class="navbar-brand" href="#"><span class="fa fa-umbrella" style="font-size:28px;"></span></a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="login_success.php">Home</a></li>
				<li><a href="about.php">About</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#" class="btn btn-md" data-toggle="modal" data-target="#loginModal">Login</a>
				</li>
				<li>
					<!--<a href="#" class="btn btn-md" data-toggle="modal" data-target="#registerModal">Register</a>-->
					<a href="register.php">Register</a>
				</li>
			</ul>
		</div>
</nav>
<?php
	} else { // User page header
?>
<nav class="navbar navbar-info">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"><span class="fa fa-umbrella" style="font-size:28px;"></span></a>
		</div>
		<ul class="nav navbar-nav">
			<li class="<?php activatePage("login_success.php", $page[2]); ?>"><a href="login_success.php">Home</a></li>
			<li class="<?php activatePage("page1.php", $page[2]); ?>"><a href="page1.php">Test Page 1</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['username'] ?></a>
			</li>
			<li class="<?php activatePage("password.php", $page[2]); activatePage("deleteuser.php", $page[2]);?>">
				<a href="password.php"><span class="fa fa-cog"></span> settings</a>
			</li>
			<li>
				<a href="index.php?action=logout" class="btn" role="button"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
			</li>
		</ul>
	</div>
</nav>

<?php 
	}
?>


