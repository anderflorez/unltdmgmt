<?php
	require_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
	<meta name="description" content="Unlimited Management">
	<meta name="author" content="Anderson Florez">

	<title>Unlimited Management</title>

	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">

</head>
<body>
	<div>
		<?php
			print_r($_COOKIE);
		?>
	</div>

	<!-- JQuery -->
	<script type="text/javascript" src="../js/jquery-3.1.1.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script type="text/javascript" src="../js/bootstrap.js"></script>

	<!-- Custom Javascript -->
	<script type="text/javascript" src="../js/dashboard.js"></script>

</body>
</html>

<?php
	// Close connection
	include('closeconn.php');
?>