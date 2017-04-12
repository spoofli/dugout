<?php

error_reporting(E_ALL);
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
<h2 align="center">Welcome to the gym!</h2>

<?php
	require "setup.php";
	$get = $mysqli->query('SELECT * FROM users WHERE playerName = "' . $_SESSION['username'] . '"');
	$row = $get->fetch_array();

	$rosterName = $row['rosterName'];
	
	$check = $mysqli->query("SELECT * FROM `users` WHERE `rosterName` = '$rosterName'");
	$res = $check->fetch_array();
	
	if($row['rosterPosition'] == "C") {	
		require "functions.php";
		if(substr($row['dataOutput'], 0, 2) >= 70) {
			$randSkill = rand(0, 5);
			
			$attr = array("contact", "power", "speed", "field");
			$randAttribute = array_rand($attr);
		
			switch($attr[$randAttribute]) {
				case "contact":
				$str = substr($row['dataOutput'], 0, 2);
				$randSkill = rand(0, 3);
				$mysqli->query("UPDATE users SET dataOutput = REPLACE(dataOutput, '" . $str . "', '" . $str . "' + '" . $randSkill . "') WHERE dataOutput LIKE '%" . $str . "%'");
				updateSL("c");	
				break;
				
				case "power":
				$str = substr($row['dataOutput'], 3, 2);
				$randSkill = rand(0, 2);
				$mysqli->query("UPDATE users SET dataOutput = REPLACE(dataOutput, '" . $str . "', '" . $str . "' + '" . $randSkill . "') WHERE dataOutput LIKE '%" . $str . "%'");	
				updateSL("p");	
				break;
				
				case "speed":
				$str = substr($row['dataOutput'], 9, 2);
				$randSkill = rand(0, 4);
				$mysqli->query("UPDATE users SET dataOutput = REPLACE(dataOutput, '" . $str . "', '" . $str . "' + '" . $randSkill . "') WHERE dataOutput LIKE '%" . $str . "%'");	
				updateSL("s");	
				break;
				
				case "field":
				$str = substr($row['dataOutput'], -4, 2);
				$randSkill = rand(0, 1);
				$mysqli->query("UPDATE users SET dataOutput = REPLACE(dataOutput, '" . $str . "', '" . $str . "' + '" . $randSkill . "') WHERE dataOutput LIKE '%" . $str . "%'");
				updateSL("f");	
				break;					
			}

			die();
		}
	}
}

?>    