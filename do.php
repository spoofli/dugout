<?php
session_start();


require "db_connect.inc.php";

error_reporting(0);

if (!isset($_SESSION['username']))
{
	// user is not logged in.
	if (isset($_POST['cmdlogin']))
	{
		// retrieve the username and password sent from login form
		// First we remove all HTML-tags and PHP-tags, then we create a md5-hash
		// This step will make sure the script is not vurnable to sql injections.
		$u = $_POST['username'];
		$p = md5($_POST['password']);
		//Now let us look for the user in the database.
		$query = "SELECT * FROM `users` WHERE `playerName` = '" . $u . "' AND `playerPassword` = '" . $p . "'";
		$result = mysql_query($query) or die(mysql_error());
		// If the database returns a 0 as result we know the login information is incorrect.
		// If the database returns a 1 as result we know  the login was correct and we proceed.
		// If the database returns a result > 1 there are multple users
		// with the same username and password, so the login will fail.
		if (mysql_num_rows($result) != 1)
		{
			// invalid login information
			echo "Wrong username or password!";
			//show the loginform again.
			include "index.php";
		} else {
			// Login was successfull
			$row = mysql_fetch_array($result);
			// Save the user ID for use later
			  // Save the username for use later
			$_SESSION['username'] = $u;
			$_SESSION['id'] = $row['playerID'];
			  // Now we show the userbox
			header("Location: members.php");
		}
	} else {
		 // User is not logged in and has not pressed the login button
		 // so we show him the loginform
		include "index.php";
	}
 
} else {
	 // The user is already loggedin, so we show the userbox.
	header("Location: index.php");
}
?>
