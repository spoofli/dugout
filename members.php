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
<?php
	require "setup.php";
	$res = $mysqli->query('SELECT * FROM users WHERE playerName = "' . $_SESSION['username'] . '"');
	$row = $res->fetch_array();
	if($row['rosterName'] == NULL or "") {	
?>
        
<center>
<p align="center">Welcome, <?php echo $_SESSION['username']; ?>!</p>
<form name="login-form" id="login-form" method="post" action="create.php">
  <fieldset>
  <legend><h2>Please Create Your Player</h2></legend>
  <dl>
	<dt>
	  <label title="fname"><h2>Player's First Name
	  <input tabindex="1" accesskey="u" name="fname" type="text" maxlength="50" id="username" /></h2>
	  </label>
	</dt>
  </dl>
    <dl>
	<dt>
	  <label title="lname"><h2>Player's Last Name
	  <input tabindex="1" accesskey="u" name="lname" type="text" maxlength="50" id="username" /></h2>
	  </label>
	</dt>
  </dl>
  <dl>
	<dt>
	  <label title="pos"><h2>Player's Position
		<select name="pos">
          <option value="C">Catcher</option>
          <option value="1B">First Base</option>
          <option value="2B">Second Base</option>
          <option value="3B">Third Base</option>
          <option value="SS">Shortstop</option> 
          <option value="LF">Left Field</option>
          <option value="CF">Center Field</option>
          <option value="RF">Right Field</option>
		</select>
	  </label>
	</dt>	
    <dt>
	  <label title="team"><h2>Team Association
		<select name="team">
          <option value="Seattle Dogs">Seattle Dogs</option>
          <option value="New York Cats">New York Cats</option>
          <option value="San Diego Armadillos">San Diego Armadillos</option>
          <option value="Cleavland Rocks">Cleavland Rocks</option>
          <option value="Rochester Giraffes">Rochester Giraffes</option> 
          <option value="Florida Goats">Florida Goats</option>
		</select>
	  </label>
	</dt>
  </dl>
  <dl>
	<dt>
	  <label title="Submit">
	  <input tabindex="3" accesskey="l" type="submit" name="cmdmake" value="Create" />
	  </label>
	</dt>
  </dl>
  </fieldset>
</form>
</center>
<?php
	} else {
		
	// NOTE TO SELF :: contact|power|speed|field|position
		
?>

<center>
	<h2 align="center"><?php echo $row['rosterName']; ?>'s Profile Page</h2>
    <?php
		$resu = $mysqli->query('SELECT * FROM downloads');
		$check = $resu->fetch_array();
		if($row['playerID'] != $check['id']) {
	?>
    		To do: <a align="center "href="training.php">Training</a>
    <?php
		} else {
	?>
    	To do: Check back later.
    <?php
		} 
		
		if($row['skills'] >= 76) {
	?>
    
    <?php	
		}
	?>
    <p align="center">This player is on the <?php echo $row['level']; ?> league roster for the <?php echo $row['teamName']; ?>.</p>
    <?php
	
		if($row['rosterPosition'] == "C") {
	
	?>
    	    <p align="center">All ratings are scaled out of 100 total points.</p>
  			<p align="center">Contact: <strong><?php echo substr($row['dataOutput'], 0, 2); ?></strong></p>
    		<p align="center">Power: <strong><?php echo substr($row['dataOutput'], -10, 2); ?></strong></p>
    		<p align="center">Speed: <strong><?php echo substr($row['dataOutput'], -7, 2); ?></strong></p>
    		<p align="center">Fielding: <strong><?php echo substr($row['dataOutput'], -4, 2); ?></strong></p>
    		<p align="center">Position: <strong><?php echo substr($row['dataOutput'], -1, 4); ?></strong></p>

    <?php
	
		} else {
	
	?>   	<p align="center">All ratings are scaled out of 100 total points.</p>
			<p align="center">Contact: <strong><?php echo substr($row['dataOutput'], 0, 2); ?></strong></p>
    	 	<p align="center">Power: <strong><?php echo substr($row['dataOutput'], -11, 2); ?></strong></p>
    	  	<p align="center">Speed: <strong><?php echo substr($row['dataOutput'], -8, 2); ?></strong></p>
   		 	<p align="center">Fielding: <strong><?php echo substr($row['dataOutput'], -5, 2); ?></strong></p>
    		<p align="center">Position: <strong><?php echo substr($row['dataOutput'], -2, 4); ?></strong></p>

</center>

<?php

		}
		
?>

<center>
	<small><strong>*</strong>Each rating is given a smaller numerical value and is used to calculate your SL.</small>
</center>

<?php
		
	}
}

?>
</body>
</html>