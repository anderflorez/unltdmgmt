<?php 
	/*
	PHP code used to create table and admin user directly in phpMyadmin under root
	
	CREATE USER 'unltdmgmt'@'localhost' IDENTIFIED BY '8359248';
	CREATE DATABASE IF NOT EXISTS `unltdmgmt`;
	GRANT ALL PRIVILEGES ON `unltdmgmt`.* TO 'unltdmgmt'@'localhost';
	GRANT ALL PRIVILEGES ON `unltdmgmt\_%`.* TO 'unltdmgmt'@'localhost';
	*/

	// Connect to the database
	$dbhost = "localhost";
	$dbuser = "unltdmgmt";
	$dbpass = "8359248";
	$dbname = "unltdmgmt";

	$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	if ($db->connect_error) {
		die("Connection Failed: " . $db->connect_error);
	}

	// Create a table for users
	$sql = "CREATE TABLE IF NOT EXISTS users(
		userid INT(11) NOT NULL AUTO_INCREMENT,
		username VARCHAR(50) NULL UNIQUE,
		email VARCHAR(60) NOT NULL UNIQUE,
		password VARCHAR(100) NOT NULL,
		firstName VARCHAR(50) NOT NULL,
		lastName VARCHAR(50) NOT NULL,
		company VARCHAR(50) NOT NULL,
		status VARCHAR(50) NOT NULL,
		PRIMARY KEY (userid)
	)";
	if ($db->query($sql) === TRUE) {
		echo "Table users has been created successfully<br>";
	}
	else {
		echo "Error creating table users: " . $db->error . "<br>";
	}

	// Create an initial administrator user
	/* Default credentials: 
		username: administrator
		password: admin
	*/
	$adminpass = password_hash("admin", PASSWORD_DEFAULT);
	$sql = "INSERT INTO users (username, email, password, firstName, lastName, company, status) VALUES ('administrator', ' ', '{$adminpass}', ' ', ' ', 'Unlimited Companies', 'active')";
	if ($db->query($sql) === TRUE) {
		echo "The administrator user has been created successfully<br>";
	}
	else {
		echo "Error creating the administrator user: " . $db->error . "<br>";
	}
?>