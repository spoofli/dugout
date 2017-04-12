<?php

$contact = rand(60, 99);
$power = rand(45, 100);
$speed = rand(0, 99);
$field = rand(40, 98);

function updateSL($action)
{
	$action = "";
	
/*	
	if($action == "c") {
		$mysqli->query('UPDATE users SET skills = "' . $skillTotal . '" + "' . $skillContact . '" WHERE `playerName` = "' . $_SESSION['username'] . '"') or die($mysqli->error);
	}	
	
	if($action == "p") {
		$mysqli->query('UPDATE users SET skills = "' . $skillTotal . '" + "' . $skillPower . '" WHERE `playerName` = "' . $_SESSION['username'] . '"') or die($mysqli->error);
	}	
	
	if($action == "s") {
		$mysqli->query('UPDATE users SET skills = "' . $skillTotal . '" + "' . $skillSpeed . '" WHERE `playerName` = "' . $_SESSION['username'] . '"') or die($mysqli->error);
	}	
	
	if($action == "f") {
		$mysqli->query('UPDATE users SET skills = "' . $skillTotal . '" + "' . $skillField . '" WHERE `playerName` = "' . $_SESSION['username'] . '"') or die($mysqli->error);
	}	
*/
	
	if($action == "a") {
		$resu = $mysqli->query('SELECT * FROM users WHERE `playerName` = "' . $_SESSION['username'] . '"');
		$row = $resu->fetch_array();
		if($row['rosterPosition'] == "C") {
			$c = substr($row['dataOutput'], 0, 2);
			$p = substr($row['dataOutput'], -10, 2);
			$s = substr($row['dataOutput'], -7, 2);
			$f = substr($row['dataOutput'], -4, 2);
			
			$skillTotal = $c + $p + $s + $f; 
			$mysqli->query('UPDATE users SET skills = "' . $skillTotal . '" WHERE `playerName` = "' . $_SESSION['username']  . '"') or die($mysqli->error);
		}
		
		if($row['rosterPosition'] != "C") {
			$c = substr($row['dataOutput'], 0, 2);
			$p = substr($row['dataOutput'], -11, 2);
			$s = substr($row['dataOutput'], -8, 2);
			$f = substr($row['dataOutput'], -5, 2);
			
			$skillTotal = $c + $p + $s + $f; 
			$mysqli->query('UPDATE users SET skills = "' . $skillTotal . '" WHERE `playerName` = "' . $_SESSION['username']  . '"') or die($mysqli->error);
		}
	}
}

?>