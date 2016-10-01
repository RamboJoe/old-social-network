<?php
// Check if session is not registered, redirect back to main page. 
// Put this code in first line of web page. 
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once PHPDB_PATH . '/dbfunctions.php';
session_start();
//isLoggedIn($_SESSION["login"]);

// define variables and set to empty values
$dname = $pass = $repass = $fname = $lname = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   	$dname = sanitizeInput($_POST["user_displayname"]);
   	$pass = sanitizeInput($_POST["user_password"]);
	$repass = sanitizeInput($_POST["user_repassword"]);
	$fname = sanitizeInput($_POST["user_firstname"]);
	$lname = sanitizeInput($_POST["user_lastname"]);
	$email = sanitizeInput($_POST["user_email"]);
}

function sanitizeInput($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

class inputField {
	function inputField() {
		$this->errorMsg = "";
		$this->errorClass = "";
		$this->errorIcon = "";
	}
}

$txt_dname = new inputField();
$txt_pass = new inputField();
$txt_repass = new inputField();
$txt_fname = new inputField();
$txt_lname = new inputField();
$txt_email = new inputField();


//$haveError = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	/* Display name verification */
	if(empty($dname))
	{
		$txt_dname->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
		$txt_dname->errorClass = "has-error has-feedback";
		$txt_dname->errorMsg = "<p style='color:red;'>This field cannot be empty!</p>";
	}
	else 
	{
		if(strlen($dname) < 8 || strlen($dname) > 30)
		{
			$txt_dname->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
			$txt_dname->errorClass = "has-error has-feedback";
			$txt_dname->errorMsg = "<p style='color:red;'>Display name must be 8-30 characters long!</p>";
		}
		else if(!preg_match("/^(\w+)$/",$dname))
		{
			$txt_dname->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
			$txt_dname->errorClass = "has-error has-feedback";
			$txt_dname->errorMsg = "<p style='color:red;'>Must be alphanumeric characters!</p>";
		} 
		else
		{
			if(checkDisplayname($dname))
			{
				$txt_dname->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
				$txt_dname->errorClass = "has-error has-feedback";
				$txt_dname->errorMsg = "<p style='color:red;'>Display name already taken!</p>";
			}
		}
	}
	
	if(empty($pass) && empty($repass))
	{
		$txt_pass->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
		$txt_pass->errorClass = "has-error has-feedback";
		$txt_repass->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
		$txt_repass->errorClass = "has-error has-feedback";
		$txt_repass->errorMsg = "<p style='color:red;'>These fields cannot be empty!</p>";
	}
	else if($pass !== $repass)
	{
		$txt_pass->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
		$txt_pass->errorClass = "has-error has-feedback";
		
		$txt_repass->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
		$txt_repass->errorClass = "has-error has-feedback";
		$txt_repass->errorMsg = "<p style='color:red;'>Password doesn't match re-typed password!</p>";
	}
	else 
	{
		if(strlen($pass) < 8 || strlen($dname) > 30)
		{
			$txt_pass->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
			$txt_pass->errorClass = "has-error has-feedback";

			$txt_repass->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
			$txt_repass->errorClass = "has-error has-feedback";
			$txt_repass->errorMsg = "<p style='color:red;'>Password too short (8 character minimum)!</p>";
		}
	}
	
	/* Name verification */
	if(!preg_match("/^[a-zA-Z]*$/",$fname))
	{
		$txt_fname->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
		$txt_fname->errorClass = "has-error has-feedback";
		$txt_fname->errorMsg = "<p style='color:red;'>Name must be letters!</p>";
	}
	
	if(!preg_match("/^[a-zA-Z ]*$/",$lname))
	{
		$txt_lname->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
		$txt_lname->errorClass = "has-error has-feedback";
		$txt_lname->errorMsg = "<p style='color:red;'>Name must be letters!</p>";
	}
	
	/* Email verification */
	if(empty($email))
	{
		$txt_email->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
		$txt_email->errorClass = "has-error has-feedback";
		$txt_email->errorMsg = "<p style='color:red;'>This field cannot be empty!</p>";
	} 
	else
	{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$txt_email->errorIcon = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";
			$txt_email->errorClass = "has-error has-feedback";
			$txt_email->errorMsg = "<p style='color:red;'>Invalid Email!</p>";
		}
	}
	
	// if no errors add user
	if(empty($txt_dname->errorMsg) && empty($txt_pass->errorMsg) && empty($txt_repass->errorMsg) 
	   && empty($txt_fname->errorMsg) && empty($txt_lname->errorMsg) && empty($txt_email->errorMsg))
	{
		$key = bin2hex(openssl_random_pseudo_bytes(15));
		
		$id = registerUser($dname, encryptData($pass), $email, $key);

		if(!empty($id))
		{
			echo '<div class="alert alert-success">
  				<strong>Success:</strong> User successfully added.
			</div>';
			
			$to       = $email;
			$subject  = 'Rella Corp confirmation email';
			$headers  = 'From: 04151865abeabe@gmail.com' . "\r\n" .
						'MIME-Version: 1.0' . "\r\n" .
						'Content-type: text/html; charset=utf-8';
			$message  = '<h1>Rella</h1> <br>';
			$message  .= '<p>Thank you for joining Rella !</p> <br>';
			$message  .= '<p>Please click the link to complete your registration: <a href="localhost/newLoginTest/public_html/activation.php?id='.$id.'&key='.$key.' ">localhost/newLoginTest/public_html/activation.php?id='.$id.'&key='.$key.'</a></p>';
			
			if(mail($to, $subject, $message, $headers)){
				//echo "Email sent";
				header("location:index.php?action=regSuccess");
			}
			else
			{
				//echo "Email sending failed";
				header("location:index.php?action=errorEmail");
			}
				
		}
	} else {
		$_SESSION['txt_dname'] = $txt_dname;
		$_SESSION['txt_pass'] = $txt_pass;
		$_SESSION['txt_repass'] = $txt_repass;
		$_SESSION['txt_fname'] = $txt_fname;
		$_SESSION['txt_lname'] = $txt_lname;
		$_SESSION['txt_email'] = $txt_email;

		$_SESSION['dname'] = $dname;
		$_SESSION['pass'] = $pass;
		$_SESSION['repass'] = $repass;
		$_SESSION['fname'] = $fname;
		$_SESSION['lname'] = $lname;
		$_SESSION['email'] = $email;
		
		header("location:register.php?action=errorReg");
	}
}

?>
