<?php

error_reporting(0);
session_start();
if (!$_SESSION['username'] AND !$_SESSION['id']) {

	require "functions.php";
	header("Location: login.php");

} else {
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Experimental Dugouts</title>
</head>
<body>
<br>
<br>
<br>
<h1 align="center">Experimental Dugouts</h1>
<h2 align="center">Welcome to Player Training!</h2>

<?php
	require "setup.php";
	$get = $mysqli->query('SELECT * FROM users WHERE playerName = "' . $_SESSION['username'] . '"');
	$row = $get->fetch_array();
	
	$rosterName = $row['rosterName'];
	
	$check = $mysqli->query("SELECT * FROM `users` WHERE `rosterName` = '" . $rosterName . "'");
	$res = $check->fetch_array();
	
	if($row['rosterPosition'] == "C") {		
		if(substr($row['dataOutput'], 0, 2) <= 55) {
			if(!isset($_POST['initft'])) {
?>
        		<p align="center"><a name="initft" href="initbt.php">Start batting practice</a></p>         
<?php
			}
		}
	}
			if($row['rosterPosition'] != "C") {
				if(substr($row['dataOutput'], 0, 2) <= 55) {		
?>
			<p align="center"><a name="initbt" href="initbt.php">Start batting practice</a></p>
<?php
		}
	}
}
?>