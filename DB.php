<?php
	// Define DSN, username and password
	$host = 'localhost';
	$username_site = '39855_site';
	$username_shawn = '39855_shawn';
	$password_site  = '514rep';
	$password_shawn  = '514rep';
	$databaseName = 'shawninder_99k_portfolio';
	$failureMessage = "<p>Something is going on with my web host which makes my website temporarily unavailable.<br />Sorry for the bother, please try again later.</p>";

	
	if($_SESSION['lang'] == 'fr')
	{
		$databaseName = 'shawninder_99k_portfoliofr';
		$failureMessage = "<p>Un problème du côté de mon hébergeur web rend mon site temporairement inaccessible.<br />Excusez l'inconvénient, s'il vous plaît réessayez plus tard.</p>";
	}
	
	$DB = mysql_connect($host, $username_site, $password_site) or die($failureMessage);
	mysql_select_db($databaseName) or die($failureMessage);
	mysql_set_charset('utf8');
?>
