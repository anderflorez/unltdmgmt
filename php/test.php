<?php
	require_once('connection.php');
	session_start();

	// $pass = password_hash("123456", PASSWORD_DEFAULT);
	// $sql = "INSERT INTO users (username, email, password, firstName, lastName, company, status) VALUES ('user1', 'user1@unlimitedcomapanies.com', '{$pass}', ' ', ' ', 'Unlimited Companies', 'active')";
	// if ($db->query($sql) === TRUE) {
	// 	echo "The user has been created successfully<br>";
	// }
	// else {
	// 	echo "Error creating the user: " . $db->error . "<br>";
	// }

	// $pass = password_hash("123456", PASSWORD_DEFAULT);
	// $sql = "INSERT INTO users (username, email, password, firstName, lastName, company, status) VALUES ('user2', 'user2@unlimitedcomapanies.com', '{$pass}', ' ', ' ', 'Unlimited Companies', 'active')";
	// if ($db->query($sql) === TRUE) {
	// 	echo "The user has been created successfully<br>";
	// }
	// else {
	// 	echo "Error creating the user: " . $db->error . "<br>";
	// }

	// $pass = password_hash("123456", PASSWORD_DEFAULT);
	// $sql = "INSERT INTO users (username, email, password, firstName, lastName, company, status) VALUES ('user3', 'user3@unlimitedcomapanies.com', '{$pass}', ' ', ' ', 'Unlimited Companies', 'active')";
	// if ($db->query($sql) === TRUE) {
	// 	echo "The user has been created successfully<br>";
	// }
	// else {
	// 	echo "Error creating the user: " . $db->error . "<br>";
	// }

	// $pass = password_hash("123456", PASSWORD_DEFAULT);
	// $sql = "INSERT INTO users (username, email, password, firstName, lastName, company, status) VALUES ('user4', 'user4@unlimitedcomapanies.com', '{$pass}', ' ', ' ', 'Unlimited Companies', 'active')";
	// if ($db->query($sql) === TRUE) {
	// 	echo "The user has been created successfully<br>";
	// }
	// else {
	// 	echo "Error creating the user: " . $db->error . "<br>";
	// }

	// $sql = "INSERT INTO roles (roleName) VALUES ('Administrator')";
	// if ($db->query($sql) === TRUE) {
	// 	echo "The role has been created successfully<br>";
	// }
	// else {
	// 	echo "Error creating the role: " . $db->error . "<br>";
	// }

	// $sql = "INSERT INTO roles (roleName) VALUES ('Management')";
	// if ($db->query($sql) === TRUE) {
	// 	echo "The role has been created successfully<br>";
	// }
	// else {
	// 	echo "Error creating the role: " . $db->error . "<br>";
	// }

	// 	$sql = "INSERT INTO roles (roleName) VALUES ('Project Manager')";
	// if ($db->query($sql) === TRUE) {
	// 	echo "The role has been created successfully<br>";
	// }
	// else {
	// 	echo "Error creating the role: " . $db->error . "<br>";
	// }

	// 	$sql = "INSERT INTO roles (roleName) VALUES ('Suerintendent')";
	// if ($db->query($sql) === TRUE) {
	// 	echo "The role has been created successfully<br>";
	// }
	// else {
	// 	echo "Error creating the role: " . $db->error . "<br>";
	// }

	$sql = "SELECT userId FROM users WHERE userName = 'user2'";
	$result = mysqli_query($db, $sql);
	$rows = mysqli_num_rows($result);
	$result = mysqli_fetch_assoc($result);

	if ($rows !== 1) {
		echo "Error retrieving the user administrator";
	}
	else {
		$userId = $result['userId'];
		$sql = "SELECT roleId FROM roles WHERE roleName = 'Administrator'";
		$result = mysqli_query($db, $sql);
		$rows = mysqli_num_rows($result);
		$result = mysqli_fetch_assoc($result);

		if ($rows !== 1) {
			echo "Error retrieving the user administrator";
		}

		else {
			$roleId = $result['roleId'];
			echo "inside if statement after finding all needed info<br>";

			$sql = "INSERT INTO users_roles (userId, roleId) VALUES ('{$userId}', '{$roleId}')";
			if ($db->query($sql) === TRUE) {
				echo "The role has been assigned successfully<br>";
			}
			else {
				echo "Error assigning role: " . $db->error . "<br>";
			}
		}
	}

	include('closeconn.php');
?>