<?php
	// Define DSN, username and password
	$host = 'localhost';
	$username_site = '39855_site';
	$username_shawn = '39855_shawn';
	$password_site  = '514rep';
	$password_shawn  = '514rep';
	 
	$DB = mysql_connect($host, $username_site, $password_site) or die(mysql_error());
	mysql_select_db("shawninder_99k_portfolio") or die(mysql_error());
	mysql_set_charset("utf8");
?>
