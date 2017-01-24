<?php
	require_once('session.php');
?>

<!-- Navigation -->
<nav class="nav navbar navbar-default navbar-fixed-top role="navigation">
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
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-user"></i> John Doe <b class="fa fa-caret-down"></b></a>
			<ul class="dropdown-menu">
				<li>
					<a href="#"><i class="fa fa-fw fa-user"></i> Profile </a>
				</li>
				<li>
					<a href="#"><i class="fa fa-fw fa-users"></i> User Management </a>
				</li>
				<li>
					<a href="roles.php"><i class="fa fa-fw fa-unlock-alt"></i> Role Management </a>
				</li>
				<li>
					<a href="#"><i class="fa fa-fw fa-bar-chart"></i> App Statistics </a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="logout.php"><i class="fa fa-fw fa-sign-out"></i> Log Out </a>
				</li>
			</ul>
		</li>
	</ul>

	<!-- Sidebar Menu Items -->
	<div id="sidebar" class="collapse navbar-collapse">
		<ul class="nav navbar-nav sidebar-nav">
			<li class="active">
				<a href="dashboard.php">
					<i class="fa fa-fw fa-dashboard"></i>
					<span class="sidebar-item"> Dashboard </span>
					<i class="fa fa-chevron-right sidebar-toggle-sm" id="sidebar-lg"></i>
					<i class="fa fa-chevron-left sidebar-toggle-lg" id="sidebar-sm"></i>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-fw fa-users"></i> 
					<span class="sidebar-item">Company Employees</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-fw fa-calendar-times-o"></i> 
					<span class="sidebar-item">Employee Time Sheet</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-fw fa-building-o"></i> 
					<span class="sidebar-item">Customers</span>
				</a>
			</li>
		</ul>
	</div>
</nav>