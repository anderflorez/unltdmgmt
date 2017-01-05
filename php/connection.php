<?php 
	$dbhost = "localhost";
	$dbuser = "unltdmgmt";
	$dbpass = "8359248";
	$dbname = "unltdmgmt";

	$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	if ($db->connect_error) {
		die("Connection Failed: " . $db->connect_error);
	}
?>