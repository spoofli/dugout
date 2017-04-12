<?php

session_start();

/*
*
* Create Download Link
* Jaocb Wyke
* jacob@frozensheep.com
* Modified by Miles Shedden
*
*/

include "setup.php";

$get = $mysqli->query('SELECT * FROM users WHERE playerName = "' . $_SESSION['username'] . '"');
$row = $get->fetch_array();

$rosterName = $row['rosterName'];

$check = $mysqli->query("SELECT * FROM `users` WHERE `rosterName` = '" . $rosterName . "'");
$res = $check->fetch_array();

$check2 = $mysqli->query("SELECT * FROM `downloads` WHERE `id` = '" . $row['playerID'] . "'");
$res2 = $check2->fetch_array();

if($res2) {
	die("no");	
} else {
	//connect to the DB
	$resDB = mysql_connect("localhost", "root", "");
	mysql_select_db("expdug", $resDB);
	
	function createKey(){
		//create a random key
		$strKey = md5(microtime());
		
		//check to make sure this key isnt already in use
		$resCheck = mysql_query("SELECT count(*) FROM downloads WHERE downloadkey = '{$strKey}' LIMIT 1");
		$arrCheck = mysql_fetch_assoc($resCheck);
		if($arrCheck['count(*)']){
			//key already in use
			return createKey();
		}else{
			//key is OK
			return $strKey;
		}
	}
	
	//get a unique download key
	$strKey = createKey();
	
	//insert the download record into the database
	
	mysql_query("INSERT INTO downloads (id, downloadkey, file, expires, type) VALUES ('{$res['playerID']}', '{$strKey}', 'test.php', '".(time()+(60))."', 'bat')") or die(mysql_error());
	
	if($row['rosterPosition'] == "C") {
		$str = substr($row['dataOutput'], 0, 2);
		$randSkill = rand(0, 5);
		
		$mysqli->query("UPDATE users SET dataOutput = REPLACE(dataOutput, '" . $str . "', '" . $str . "' + '" . $randSkill . "') WHERE dataOutput LIKE '%" . $str . "%'");	
		
		require "functions.php";
		
		updateSL("a");
	}

	if($row['rosterPosition'] != "C") {
		$str = substr($row['dataOutput'], 0, 2);
		$randSkill = rand(0, 5);
		
		$mysqli->query("UPDATE users SET dataOutput = REPLACE(dataOutput, '" . $str . "', '" . $str . "' + '" . $randSkill . "') WHERE dataOutput LIKE '%" . $str . "%'");
		
		require "functions.php";
		
		updateSL("a");
	}
}

?>

<html>
	<head>
		<title>Experimental Dugouts</title>
	</head>
    <br><br><br>
	<h1 align="center">Experimental Dugouts</h1>
	<p align="center">Please click the link to begin your training: </p>
    <center>
	<strong><a href="download.php?key=<?=$strKey;?>">Start</a> <br><br>For the record, your key is <?=$strKey;?></strong>
	<br><small align="center">*This link will allow you a one-time access to this level of training.</small>
	</center>    
</html>
<?php
	
?>