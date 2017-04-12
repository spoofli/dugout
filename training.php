<?php
session_start();
if (!$_SESSION['username'] AND !$_SESSION['id']) {

	header("Location: login.php");

} else {
	require "setup.php";
	$get = $mysqli->query('SELECT * FROM users WHERE playerName = "' . $_SESSION['username'] . '"');
	$row = $get->fetch_array();
	
	$rosterName = $row['rosterName'];
	
	$check = $mysqli->query("SELECT * FROM `users` WHERE `rosterName` = '" . $rosterName . "'");
	$res = $check->fetch_array();
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
<p align="center">If you need help, please take a look at the <a href="help.php">Help Documents</a>.</p>
<p align="center">Your current SL is <strong><?php echo $row['skills']; ?></strong>.*</p>

<?php	
if($row['rosterPosition'] == "C") {
	if(substr($row['dataOutput'], -4, 2) <= 65) {
?>
	<p align="center"><?php echo $row['rosterName']; ?> needs to do some <a href="t-fielding.php">field training</a>.</p>

	<?php
		} else if(substr($row['dataOutput'], 0, 2) <= 70) {
	?>
		<p align="center"><?php echo $row['rosterName']; ?> needs to take <a href="t-batting.php">batting practice</a>.</p>
	<?php
		} else if(substr($row['dataOutput'], -10, 2) <= 80) {
	?>		
		<p align="center"><?php echo $row['rosterName']; ?> should go to the <a href="gym.php">gym</a>.</p>
	<?php
		} else if(substr($row['dataOutput'], -7, 2) <= 98) {
	?>
		<p align="center"><?php echo $row['rosterName']; ?> needs to complete his training with some <a href="t-br.php">baserunning</a>.</p>
	<?php
		}	
	
	} else {
	
		if($row['rosterPosition'] != "C") {
		if(substr($row['dataOutput'], -5, 2) <= 65) {
			
	?>
		<p align="center"><?php echo $row['rosterName']; ?> needs to do some <a href="t-fielding.php">field training</a>.</p>

		<?php
			} else if(substr($row['dataOutput'], 0, 2) <= 70) {
		?>
			<p align="center"><?php echo $row['rosterName']; ?> needs to take <a href="t-batting.php">batting practice</a>.</p>
		<?php
			} else if(substr($row['dataOutput'], -11, 2) <= 80) {
		?>		
			<p align="center"><?php echo $row['rosterName']; ?> should go to the <a href="gym.php">gym</a>.</p>
		<?php
			} else if(substr($row['dataOutput'], -8, 2) <= 98) {
		?>
			<p align="center"><?php echo $row['rosterName']; ?> needs to complete his training with some <a href="t-br.php">baserunning</a>.</p>
		<?php
			}
		}
	}
}




?>
<center>
<small align="center"><strong>*</strong>Each rating is given a smaller numerical value and is used to calculate your Skill Level (or <b>SL</b>). View an example <a href="sl-example.php">here</a>.</small>
</center>