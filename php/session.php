<?php
	session_start();

	if (isset($_SESSION['userid'])) {
		$sql = "SELECT * FROM users WHERE userid = '{$_SESSION['userid']}' ";
		$result = mysqli_query($db, $sql);
		$rows = mysqli_num_rows($result);
		$result = mysqli_fetch_assoc($result);

		if ($rows === 1) {
			$_SESSION['username'] = $result['username'];
			$_SESSION['email'] = $result['email'];
			$_SESSION['firstName'] = $result['firstName'];
			$_SESSION['lastName'] = $result['lastName'];
			$_SESSION['company'] = $result['company'];
			$_SESSION['status'] = $result['status'];
		}
	}
?>