<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(realpath("../resources/config.php"));

function isLoggedIn($loggedIn){
	if(!(isset($loggedIn) && $loggedIn!='') ){
		header("location:index.php"); // make this return true for more flexability
	}
}

function getAllFriends($user) {
    
    try {
        $ds = "mysql:dbhost=" . DBHOST
                . ";dbname=" . DBNAME;

        $pdo = new PDO($ds, DBUSER, DBPASS);

        $stmt = $pdo->prepare("SELECT * FROM friends WHERE FriendA = '" . $user . "' ORDER BY RelationshipID");

        $stmt->execute();

        $pdo = null;

        return $stmt;
    } catch (Exception $ex) {
        echo "PDOException: " + $ex->getMessage();
    }
}

function getAllFriendRequests($user) {
    
    try {
        $ds = "mysql:dbhost=" . DBHOST
                . ";dbname=" . DBNAME;

        $pdo = new PDO($ds, DBUSER, DBPASS);

        $stmt = $pdo->prepare("SELECT * FROM friends WHERE FriendB = '" . $user . "' 
		ORDER BY RelationshipID;");

        $stmt->execute();

        $pdo = null;

        return $stmt;
    } catch (Exception $ex) {
        echo "PDOException: " + $ex->getMessage();
    }
}

// checks if friend exists
function friendExists($myfriendname){
	try {
		
		$ds = "mysql:dbhost=" . DBHOST
                . ";dbname=" . DBNAME;

        $pdo = new PDO($ds, DBUSER, DBPASS);

        $stmt = $pdo->prepare("SELECT * FROM members WHERE user_display_name = '" . $myfriendname . "'; ");

        $stmt->execute();
		
		//close connection
        $pdo = null;
        

        $count = $stmt->rowCount();

        if ($count > 0) {
        	return true;
        }
	} catch (PDOException $e) {
    	echo "Error" . $e->getMessage();
	}
	return false;
}

function alreadyFriend($myusername, $myfriendname){
	// check if friend is already added
	// check if user is adding them self
	try {
		$ds = "mysql:dbhost=" . DBHOST
                . ";dbname=" . DBNAME;

        $pdo = new PDO($ds, DBUSER, DBPASS);

		$stmt = $pdo->prepare("SELECT * FROM friends WHERE FriendA = '" . $myusername . "' &&  FriendB = '" . $myfriendname . "'; ");

		$stmt->execute();
		
		//close connection
		$pdo = null;
		

		$count = $stmt->rowCount();

		if ($count > 0) {
			return true;
		}
	} catch (PDOException $e) {
		echo "Error" . $e->getMessage();
	}	
	return false;
}

function insertFriend($myusername, $myfriendname){
	try {
		$ds = "mysql:dbhost=" . DBHOST
                . ";dbname=" . DBNAME;

        $pdo = new PDO($ds, DBUSER, DBPASS);

		$stmt = $pdo->prepare("INSERT INTO friends(FriendA, FriendB) VALUES(?,?)");

		$stmt->bindParam(1, $myusername);
		$stmt->bindParam(2, $myfriendname);

		$stmt->execute();
		//close connection
		$pdo = null;

		$count = $stmt->rowCount();

        if ($count > 0) {
        	return true;
		}
	} catch (PDOException $e) {
		echo "Error" . $e->getMessage();
	}
	return false;
}

function deleteFriend($myusername, $myfriendname){
	try {
		$ds = "mysql:dbhost=" . DBHOST
                . ";dbname=" . DBNAME;

        $pdo = new PDO($ds, DBUSER, DBPASS);

		$stmt = $pdo->prepare("DELETE FROM friends
		WHERE FriendA=? AND FriendB=?;");

		$stmt->bindParam(1, $myusername);
		$stmt->bindParam(2, $myfriendname);

		$stmt->execute();
		//close connection
		$pdo = null;

		$count = $stmt->rowCount();

        if ($count > 0) {
        	return true;
		}
	} catch (PDOException $e) {
		echo "Error" . $e->getMessage();
	}
	return false;
}

/*
function createChatID($myusername, $myfriendname){
	// check if friend is already added
	// check if user is adding them self
	try {
		$ds = "mysql:dbhost=" . DBHOST
                . ";dbname=" . DBNAME;

        $pdo = new PDO($ds, DBUSER, DBPASS);

		$stmt = $pdo->prepare("SELECT * 
								FROM friends 
								WHERE (FriendA = '" . $myusername . "' OR FriendA = '" . $myfriendname . "') 
								AND  (FriendB = '" . $myfriendname . "' OR FriendB = '" . $myusername . "'); ");

		
		$stmt->execute();
		
		//close connection
		$pdo = null;
		

		
		return $stmt;
		
	} catch (PDOException $e) {
		echo "Error" . $e->getMessage();
	}	
}
*/

function changePassword($myusername, $newPassword){
	try {
		$ds = "mysql:dbhost=" . DBHOST
                . ";dbname=" . DBNAME;

        $pdo = new PDO($ds, DBUSER, DBPASS);

		$stmt = $pdo->prepare("UPDATE members
								SET user_pass=?
								WHERE user_display_name=?;");
		$stmt->bindParam(1, $newPassword);
		$stmt->bindParam(2, $myusername);
		

		$stmt->execute();
		//close connection
		$pdo = null;

		$count = $stmt->rowCount();

        if ($count > 0) {
        	return true;
		}
	} catch (PDOException $e) {
		echo "Error" . $e->getMessage();
	}
	return false;
}

function removeAccount($myusername){
	try {
		$ds = "mysql:dbhost=" . DBHOST
                . ";dbname=" . DBNAME;

        $pdo = new PDO($ds, DBUSER, DBPASS);

		$stmt = $pdo->prepare("DELETE FROM members
								WHERE user_display_name=?;
								DELETE FROM friends
								WHERE FriendA=?;");
		$stmt->bindParam(1, $myusername);
		$stmt->bindParam(2, $myusername);

		$stmt->execute();
		//close connection
		$pdo = null;

		$count = $stmt->rowCount();

        if ($count > 0) {
        	return true;
		}
	} catch (PDOException $e) {
		echo "Error" . $e->getMessage();
	}
	return false;
}

function checkLogin($myusername, $mypassword){
	try {
		$ds = "mysql:dbhost=" . DBHOST
			. ";dbname=" . DBNAME;

		$pdo = new PDO($ds, DBUSER, DBPASS);

		$myusername = stripslashes($myusername);
		$mypassword = stripslashes($mypassword);
		$pdo->quote($myusername);
		$pdo->quote($mypassword);

		$stmt = $pdo->prepare("SELECT user_pass FROM members WHERE user_display_name='$myusername' AND active = 'Yes'");
		
		//$stmt->bindParam(1, $myusername);
		//$stmt->bindParam(2, $mypassword);
		
		$stmt->execute();
		
		$count = $stmt->rowCount();
		$hash = $stmt->fetchAll();
		
		//close connection
		$pdo = null;

		if($count > 0){
			if (password_verify ($mypassword, $hash[0]["user_pass"])) {
				return true;
			}
		}
	} catch (PDOException $e) {
		echo "Error" . $e->getMessage();
	}
	return false;
}

// Depricated
function checkRegister($myusername, $mypassword, $myemail){
	try {
		$ds = "mysql:dbhost=" . DBHOST
			. ";dbname=" . DBNAME;

		$pdo = new PDO($ds, DBUSER, DBPASS);

		$stmt = $pdo->prepare("INSERT INTO members(user_display_name, user_pass, user_email) VALUES(?,?,?)");
		
		$stmt->bindParam(1, $myusername);
		$stmt->bindParam(2, $mypassword);
		$stmt->bindParam(3, $myemail);
		
		$stmt->execute();
		
		$count = $stmt->rowCount();
		
		if ($count > 0) {
			return true;
		}
            
		//close connection
		$pdo = null;
		
	} catch (PDOException $e) {
		echo "Error" . $e->getMessage();
	}
	return false;
}


function registerUser($userdisplayname, $userpassword, $useremail, $useractive){
	try {
		$ds = "mysql:dbhost=" . DBHOST
			. ";dbname=" . DBNAME;

		$pdo = new PDO($ds, DBUSER, DBPASS);

		$stmt = $pdo->prepare("INSERT INTO members(user_display_name, user_pass, user_email, active) VALUES(?,?,?,?)");
		
		$stmt->bindParam(1, $userdisplayname);
		$stmt->bindParam(2, $userpassword);
		$stmt->bindParam(3, $useremail);
		$stmt->bindParam(4, $useractive);
		
		$stmt->execute();
		
		$count = $stmt->rowCount();
		
		if ($count > 0) {
			return $pdo->lastInsertId('id');
		}

		//close connection
		$pdo = null;
		
	} catch (PDOException $e) {
		echo "Error" . $e->getMessage();
	}
	return '';
}

function checkDisplayname($displayname){
	try {
		$ds = "mysql:dbhost=" . DBHOST
			. ";dbname=" . DBNAME;

		$pdo = new PDO($ds, DBUSER, DBPASS);

		$stmt = $pdo->prepare("SELECT user_display_name FROM members WHERE user_display_name='$displayname'");
		
		$stmt->execute();
		
		$count = $stmt->rowCount();
		
		if ($count > 0) {
			return true;
		}
		
		//close connection
		$pdo = null;
		
	} catch (PDOException $e) {
		echo "Error" . $e->getMessage();
	}
	return false;
}


function encryptData($userdata){
	return password_hash($userdata, PASSWORD_BCRYPT);
}

function activateUser($userID, $key){
	try {
		$ds = "mysql:dbhost=" . DBHOST
                . ";dbname=" . DBNAME;

        $pdo = new PDO($ds, DBUSER, DBPASS);
		
		$stmt = $pdo->prepare("UPDATE members
								SET active = 'Yes'
								WHERE id = ? AND active = ?;");
		
		$stmt->bindParam(1, $userID);
		$stmt->bindParam(2, $key);
		
		$stmt->execute();
		//close connection
		$pdo = null;

		$count = $stmt->rowCount();
		
        if ($count > 0) {
        	return true;
		}
	} catch (PDOException $e) {
		echo "Error" . $e->getMessage();
	}
	return false;
}
/*
function updateAlbumPrice($albumId, $newPrice) {

    try {
        $ds = "mysql:dbhost=" . DBHOST
                . ";dbname=" . DBNAME;

        $pdo = new PDO($ds, DBUSER, DBPASS);

        $stmt = $pdo->prepare("UPDATE album SET Price = ? WHERE AlbumId = ?");

        $stmt->bindParam(1, $newPrice);
        $stmt->bindParam(2, $albumId);


        $stmt->execute();

        $pdo = null;

        if ($stmt->rowCount() > 0) {
            return true;
        }
    } catch (Exception $ex) {
        echo "PDOException: " + $ex->getMessage();
    }
    return false;
}

function removeAlbum($albumId) {

    try {
        $ds = "mysql:dbhost=" . DBHOST
                . ";dbname=" . DBNAME;

        $pdo = new PDO($ds, DBUSER, DBPASS);

        $stmt = $pdo->prepare("DELETE FROM album WHERE AlbumId = ?");

        $stmt->bindParam(1, $albumId);


        $stmt->execute();

        $pdo = null;

        if ($stmt->rowCount() > 0) {
            return true;
        }
    } catch (Exception $ex) {
        echo "PDOException: " + $ex->getMessage();
    }
    return false;
}

function displayAllAlbums() {
    $stmt = getAllAlbums();

    $numRows = $stmt->rowCount();

    $results = $stmt->fetchAll();

    for ($i = 0; $i < $numRows; $i++) {
        $currentAlbum = $results[$i];
        
        echo "<tr style = 'text-align: center;'>";
        echo "<td>" . $currentAlbum["ArtistName"] . "</td>";
        echo "<td>" . $currentAlbum["AlbumName"] . "</td>";
        echo "<td>" . $currentAlbum["Genre"] . "</td>";
        echo "<td>" . $currentAlbum["Length"] . " min</td>";
        // checks if album is an LP
        if ($currentAlbum["LP"] === '1') {
            echo "<td>" . "Yes" . "</td>";
        } else {
            echo "<td>" . "No" . "</td>";
        }
        echo "<td>$" . $currentAlbum["Price"] . "</td>";
        echo "<td>" . $currentAlbum["Review"] . "</td>";
        echo "</tr>";
    }
}
*/