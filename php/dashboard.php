<?php
	require_once('connection.php');
	require_once('session.php');
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
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">

</head>
<body>

	<!-- Navigation -->
	<nav class="navbar navbar-default navbar-fixed-top role="navigation">
		<!-- Brand and toggle for sidebar -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#sidebar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="dashboard.php">Unlimited Management</a>
		</div>

		<!-- Top Menu Items -->
		<ul class="nav navbar-right top-nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="fa fa-caret-down"></b></a>
				<ul class="dropdown-menu">
					<li>
						<a href="#"><i class="fa fa-fw fa-user"></i> Profile </a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out </a>
					</li>
				</ul>
			</li>
		</ul>

		<!-- Sidebar Menu Items -->
		<div id="sidebar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav sidebar-nav">
				<li class="active">
					<a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a>
				</li>
				<li>
					<a href="#"><i class="fa fa-fw fa-table"></i> Tables </a>
				</li>
			</ul>
		</div>

	</nav>

	<!-- Page Content -->
	<div id="page-wrapper">
	

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