<?php 
	$dbhost = "localhost";
	$dbname = "unltdmgmt";
	$dbuser = "root";
	$dbpass = "8359248";

	$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	if ($db->connect_error) {
		die("Connection Failed: " . $db->connect_error);
	}
?>