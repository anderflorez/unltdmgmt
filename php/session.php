<?php
	session_start();

	if (isset($_SESSION['userid'])) {
		$sql = "SELECT * FROM users WHERE userid = '{$_SESSION['userid']}' ";
		$result = mysqli_query($db, $sql);
		$rows = mysqli_num_rows($result);
		$result = mysqli_fetch_assoc($result);

		if ($rows === 1) {
			$_SESSION['userName'] = $result['firstName'];
			$_SESSION['email'] = $result['email'];
			$_SESSION['firstName'] = $result['firstName'];
			$_SESSION['lastName'] = $result['lastName'];
			$_SESSION['company'] = $result['company'];
			$_SESSION['status'] = $result['status'];
		}
		else {
			echo '
				<div class="container">
					<div class="row">
						<div class="well well-sm col-xs-12">
							<h4 class="text-danger text-center">There has been an error. Unable to load user information</h4>
						</div>
					</div>
				</div>';
		}
	}
	else {
		header("location: login.php");
	}
?>