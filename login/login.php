<?php

require '../config/config.php';

// If no user is logged in, do the usual things. Otherwise, redirect user out of this page.
if( !isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {

	// Check if user has entered in username/password
	if ( isset($_POST['username']) && isset($_POST['password']) ) {
		// User did not enter username/password, it's blank
		if ( empty($_POST['username']) || empty($_POST['password']) ) {
			$error = "Please enter username and password.";
		} else {
			// User did enter username/password but need to check if the username/pw combination is correct
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if($mysqli->connect_errno) {
				echo $mysqli->connect_error;
				exit();
			}

			// Hash whatever user typed in for password, then compare this to the hashed password in the DB
			$passwordInput = hash("sha256", $_POST["password"]);

			$sql = "SELECT * FROM users
						WHERE username = '" . $_POST['username'] . "' AND password = '" . $passwordInput . "';";
			
			$results = $mysqli->query($sql);

			if(!$results) {
				echo $mysqli->error;
				exit();
			}

			if($results->num_rows > 0) {
				// Set sesssion variables to remember this user
				$_SESSION["username"] = $_POST["username"];
				$_SESSION["logged_in"] = true;
				$row = $results->fetch_assoc();
				// echo $row["is_admin"];
				if ($row["is_admin"]==1){
					$_SESSION["is_admin"] = true;
				}
				else {
					$_SESSION["is_admin"] = false;
				}

				header("Location: ../php/home.php");
			
			}
			else {
				$error = "Invalid username or password.";
			}
		} 
	}
} else { // Redirect logged in user to home
	header("Location: ../php/home.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Your Personal Beijing Guide</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../stylesheet.css">

	<style>

		#main-row {
			margin-top: 70px;
		}

		#login-title {
			margin-left: 5px;
		}

		h3, a {
			color: #068876;
			font-family: 'Grenze Gotisch', cursive;
		}

		#footer {
			position: fixed;
			bottom: 0px;
		}

		@media(max-width: 768px){
			#main-row {
				margin-top: 0px;
				height:50px;
			}
		}

	</style>
</head>
<body>
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

	<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light" style="background-color: #AA381E;">
	  <a class="navbar-brand" href="../php/home.php" style="color:#FFCA62">
	    Your Personal Beijing Guide
	  </a>

	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
			<li class="nav-item " >
			  <a class="nav-link" href="../php/home.php">Home </a>
			</li>
	        <li class="nav-item">
	          <a class="nav-link" href="../php/about_beijing.php">About Beijing</a>
	        </li>
			<li class="nav-item">
				<a class="nav-link" href="../php/attractions.php">Attractions<span class="sr-only"></a>
			</li>
	        <li class="nav-item">
	          <a class="nav-link" href="../php/travel_suggestions.php">Travel Tips</a>
	        </li> 
	    </ul>
	  </div>
	</nav>
	
	<div class="container">
		<div id="main-row" class="row">
			<div id="login-img" class="col-12 col-md-6 col-lg-8"></div>
			<div class="col-12 col-md-6 col-lg-4">
				<div id="login-title" class="row">
					<h1 class="col-12 mt-4 mb-4">Login</h1>
					<h3 class="col-12 "> Please Log In First</h3>
				</div>

				<div class="container">
					<form action="login.php" method="POST">
						<div class="row mb-3">
							<div class="font-italic text-danger col-sm-9 ml-sm-auto">
								<!-- Show errors here. -->
								<?php
									if ( isset($error) && !empty($error) ) {
										echo $error;
									}
								?>
							</div>
						</div> <!-- .row -->
						
						<div class="form-group row">
							<label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="username-id" name="username">
							</div>
						</div> <!-- .form-group -->

						<div class="form-group row">
							<label for="password-id" class="col-sm-3 col-form-label text-sm-right">Password:</label>
							<div class="col-sm-9">
								<input type="password" class="form-control" id="password-id" name="password">
							</div>
						</div> <!-- .form-group -->

						<div class="form-group row">
							<div class="col-sm-3"></div>
							<div class="col-sm-9 mt-2">
								<button type="submit" class="btn btn-primary">Login</button>
								<a href="../php/home.php" role="button" class="btn btn-light">Cancel</a>
							
							</div>
						</div> <!-- .form-group -->
					</form>

					<div class="row">
						<div class="col-sm-9 ml-sm-auto">
							<a href="register_form.php">Create an account</a>
						</div>
					</div> 

				</div> 
			</div>
		</div>
	</div>

</body>
</html>