<?php

	require "setup.php";
	$mysqli->query("DELETE FROM downloads WHERE type = 'bat'") or die($mysqli->error);

?>