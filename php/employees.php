<?php
	require_once('connection.php');
	require_once('functions.php');
	session_start();
	checkSession($db);
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

	<!-- Font awesome -->
	<link rel="stylesheet" type="text/css" href="../font-awesome-4.7.0/css/font-awesome.css">

	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="../css/unltdmgmt.css">

</head>
<body>
	<?php include('navigation.php'); ?>

	<!-- Page Content -->
	<div class="page-wrapper">
		<header>
			<h1 class="page-header">Company Employees</h1>
		</header>
	</div>

	<!-- JQuery -->
	<script type="text/javascript" src="../js/jquery-3.1.1.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script type="text/javascript" src="../js/bootstrap.js"></script>

	<!-- Custom Javascript -->
	<script type="text/javascript" src="../js/unltdmgmt.js"></script>

</body>
</html>

<?php
	// Close connection
	include('closeconn.php');
?>