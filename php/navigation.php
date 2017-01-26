<!-- Navigation -->
<nav class="nav navbar navbar-default navbar-fixed-top role="navigation">
	<!-- Brand and toggle for sidebar -->
	<div class="navbar-header">
		<button type="button" class="sidebar-toggle">
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
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-user"></i> 
				<?php
					if (!empty(trim($_SESSION['firstName']))) {
						echo $_SESSION['firstName'] . " " . $_SESSION['lastName'];
					}
					else if (!empty(trim($_SESSION['userName']))) {
						echo $_SESSION['userName'];
					}
					else {
						echo $_SESSION['email'];
					}
				?>
				<b class="fa fa-caret-down"></b>
			</a>
			<ul class="dropdown-menu">
				<li>
					<a href="#"><i class="fa fa-fw fa-id-card" aria-hidden="true"></i> Profile </a>
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
			<li id="dashboard">
				<a href="dashboard.php">
					<i class="fa fa-fw fa-dashboard" aria-hidden="true"></i>
					<span class="sidebar-item"> Dashboard </span>
					<i class="fa fa-chevron-right sidebar-toggle-sm" id="sidebar-lg" aria-hidden="true"></i>
					<i class="fa fa-chevron-left sidebar-toggle-lg" id="sidebar-sm" aria-hidden="true"></i>
				</a>
			</li>
			<li id="projects">
				<a href="projects.php">
					<i class="fa fa-fw fa-building" aria-hidden="true"></i>
					<span class="sidebar-item">Projects</span>
				</a>
			</li>
			<li id="serviceJobs">
				<a href="serviceJobs.php">
					<i class="fa fa-fw fa-building-o" aria-hidden="true"></i>
					<span class="sidebar-item">Electrical Service Jobs</span>
				</a>
			</li>
			<li id="avJobs">
				<a href="avJobs.php">
					<i class="fa fa-fw fa-building-o" aria-hidden="true"></i>
					<span class="sidebar-item">AV Service Jobs</span>
				</a>
			</li>
			<li id="timeSheets">
				<a id="timeSheets" href="#">
					<i class="fa fa-fw fa-clock-o" aria-hidden="true"></i> 
					<span class="sidebar-item">Employee Time Sheets</span>
				</a>
			</li>
			<li id="employees">
				<a href="employees.php">
					<i class="fa fa-fw fa-users" aria-hidden="true"></i>
					<span class="sidebar-item">Company Employees</span>
				</a>
			</li>
			<li id="evaluations">
				<a href="evaluations.php">
					<i class="fa fa-fw fa-list-alt" aria-hidden="true"></i>
					<span class="sidebar-item">Employee Evaluations</span>
				</a>
			</li>
			<li id="customers">
				<a href="customers">
					<i class="fa fa-fw fa-building-o" aria-hidden="true"></i> 
					<span class="sidebar-item">Customers</span>
				</a>
			</li>
			<li id="vendors">
				<a href="vendors.php">
					<i class="fa fa-fw fa-truck" aria-hidden="true"></i>
					<span class="sidebar-item">Vendors</span>
				</a>
			</li>
			<li id="applications">
				<a href="applications.php">
					<i class="fa fa-fw fa-clipboard" aria-hidden="true"></i>
					<span class="sidebar-item">Job Applications</span>
				</a>
			</li>
			<li id="tests">
				<a href="tests.php">
					<i class="fa fa-fw fa-list-alt" aria-hidden="true"></i>
					<span class="sidebar-item">Application Tests</span>
				</a>
			</li>
			<li id="costCodes">
				<a href="costCodes.php">
					<i class="fa fa-fw fa-th-list" aria-hidden="true"></i>
					<span class="sidebar-item">Cost Codes</span>
				</a>
			</li>
			<li id="materials">
				<a href="#">
					<i class="fa fa-fw fa-archive" aria-hidden="true"></i>
					<span class="sidebar-item">Materials</span>
				</a>
			</li>
			<li id="healthCenters">
				<a href="healthCenters.php">
					<i class="fa fa-fw fa-hospital-o" aria-hidden="true"></i>
					<span class="sidebar-item">Health Centers</span>
				</a>
			</li>
		</ul>
	</div>
</nav>