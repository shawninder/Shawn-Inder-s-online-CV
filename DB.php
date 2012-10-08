<?php

	include("config.php");	// : $host = 'localhost'; $username = 'Pseudonym!'; $password  = '************************';
	
	$dbName = $databaseName_en;
	
	if($_SESSION['lang'] == 'fr')
	{
		$dbName = $databaseName_fr;
	}
	
	$DB = mysql_connect($host, $username, $password);
	if ($DB) {
		if(mysql_select_db($dbName)) {
			mysql_set_charset('utf8');
		} else {
			header('Location: serverProblems.php');
		}
	} else {
		header('Location: serverProblems.php');
	}
?>
