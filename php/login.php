<?php
	require_once('connection.php');
	$username = "";
	if (isset($_COOKIE["username"])) {
		$username = $_COOKIE["username"];
	}
	else if (isset($_POST["username"])) {
		$username = $_POST["username"];
	}

	$remember = isset($_COOKIE["remember"]) ? $_COOKIE["remember"] : "";
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
	<div class="container">
		<div class="row">
			<div id="logintitle" class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6">
				<h3>UNLIMITED MANAGEMENT</h3>
			</div>
			<div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Please sign in below</h3>
					</div>
					<div class="panel-body">
						<form action="login.php" method="post">
							<fieldset>
								<div class="form-group">
									<input type="text" name="username" class="form-control" placeholder="Username or E-mail" value="<?php echo $username; ?>" autofocus>
								</div>
								<div class="form-group">
									<input type="password" name="password" class="form-control" placeholder="Password">
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember" value="<?php echo $remember; ?>" 
											<?php 
												if ($remember === "remember") {
													echo "checked";
												}
											?>>Remember Me
									</label>
								</div>
								<div class="form-group">
									<input id="login" class="form-control btn btn-lg btn-success btn-block" type="submit" name="login" value="Login">
								</div>
								<!-- 
								<div class="form-group pull-right text-danger">
									<a href="#">Forgot password</a>
								</div>
								 -->
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
		if (isset($_POST["login"])) {
			$username = mysqli_real_escape_string($db, $_POST['username']);
			$password = mysqli_real_escape_string($db, $_POST['password']);
			$sql = "SELECT username, password FROM users WHERE username = '$username'";
			$result = mysqli_query($db, $sql);
			$rows = mysqli_num_rows($result);
			$result = mysqli_fetch_assoc($result);
			$wrongCredentials = '
				<div class="container">
					<div class="row">
						<div class="well well-sm col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
							<h4 class="text-danger text-center">Incorrect username or password. Please try again!</h4>
						</div>
					</div>
				</div>';

			if ($rows == 1) {
				$pass = $result['password'];
				if (password_verify($password, $pass)) {
					
					// Set cookie if remember is active
					if (isset($_POST["remember"])) {
						$cookieName = "username";
						$cookieRemember = "remember";
						$expire = time() + (60*60*24*365*10);
						setcookie($cookieName, $username, $expire);
						setcookie($cookieRemember, $cookieRemember, $expire);
					}
					else {
						$cookieName = "username";
						$cookieRemember = "remember";
						$expire = time() - (60*60*24);
						setcookie($cookieName, null, $expire);
						setcookie($cookieRemember, null, $expire);
					}

					// Set session to keep user logged in
					$_SESSION['loginUser'] = $username;
					header("Location: dashboard.php");
				}
				else {
					echo $wrongCredentials;
				}
			}
			else {
				echo $wrongCredentials;
			}
		}
	?>

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