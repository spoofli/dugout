<?php

include "setup.php";

error_reporting(0);
session_start();
if (!$_SESSION['username'] AND !$_SESSION['id']) {

	require "functions.php";
	header("Location: login.php");

} else {

	$res = $mysqli->query('SELECT * FROM users WHERE playerName = "' . $_SESSION['username'] . '"');
	$row = $res->fetch_array();
	if($row['teamName'] == NULL or "") {
	
		echo '<meta http-equiv="refresh" content="0; URL=members.php" />';
		
		$rosterName = addslashes($_POST['fname']) . " " . addslashes($_POST['lname']);
		$rosterPosition = addslashes($_POST['pos']);
		$teamName = addslashes($_POST['team']);
		$level = "minor";
		# Ratings
		
		require "skills.php";
		
		// NOTE TO SELF :: contact|power|speed|field|position
		
		$data = $contact . "|" . $power . "|" . $speed . "|" . $field . "|" . $rosterPosition;
	
		require "setup.php";
		$mysqli->query('UPDATE users SET rosterName = "' . $rosterName . '" WHERE `playerName` = "' . $_SESSION['username']  . '"') or die($mysqli->error);
		$mysqli->query('UPDATE users SET teamName = "' . $teamName . '" WHERE `playerName` = "' . $_SESSION['username']  . '"') or die($mysqli->error);
		$mysqli->query('UPDATE users SET rosterPosition = "' . $rosterPosition . '" WHERE `playerName` = "' . $_SESSION['username']  . '"') or die($mysqli->error);
		$mysqli->query('UPDATE users SET level = "' . $level . '" WHERE `playerName` = "' . $_SESSION['username']  . '"') or die($mysqli->error);		
		$mysqli->query('UPDATE users SET dataOutput = "' . $data . '" WHERE `playerName` = "' . $_SESSION['username']  . '"') or die($mysqli->error);
		//$mysqli->query('UPDATE users SET skills = "' . $skillTotal . '" WHERE `playerName` = "' . $_SESSION['username']  . '"') or die($mysqli->error);


	} else {
		echo ("Stop it!");
	}
}

?>