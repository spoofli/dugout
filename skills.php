<?php

error_reporting(0);

date_default_timezone_set("America/New_York"); 

session_start();

require "setup.php";

$get = $mysqli->query('SELECT * FROM users WHERE playerName = "' . $_SESSION['username'] . '"') or die($mysqli->error);
$row = $get->fetch_array();

$playerID = $row['playerID'];

$ch = $mysqli->query("SELECT * FROM downloads WHERE id = '" . $playerID . "'") or die($mysqli->error);

$date = '8:00 PM';
$now = date('g:i A');

echo $now;

if($ch->num_rows == 1) {
	if($date == $now) {
		$mysqli->query("DELETE FROM downloads WHERE id = '" . $playerID . "'") or die($mysqli->error);
	}
}
require "functions.php";

updateSL("a");

?>