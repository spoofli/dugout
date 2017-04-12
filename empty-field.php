<?php

	require "setup.php";
	$mysqli->query("DELETE FROM downloads WHERE type = 'field'") or die($mysqli->error);

?>