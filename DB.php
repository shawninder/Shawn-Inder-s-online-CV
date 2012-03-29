<?php

	include("config.php");	// : $host = 'localhost'; $username = 'Pseudonym!'; $password  = '************************';
	
	$dbName = $databaseName_en;
	$failureMessage = "<p>Something is going on with my web host which makes my website temporarily unavailable.<br />Sorry for the bother, please try again later.</p>";

	
	if($_SESSION['lang'] == 'fr')
	{
		$dbName = $databaseName_fr;
		$failureMessage = "<p>Un problème du côté de mon hébergeur web rend mon site temporairement inaccessible.<br />Excusez l'inconvénient, s'il vous plaît réessayez plus tard.</p>";
	}
	
	$DB = mysql_connect($host, $username, $password) or die($failureMessage);
	mysql_select_db($dbName) or die($failureMessage);
	mysql_set_charset('utf8');
?>
