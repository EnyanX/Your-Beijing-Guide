<?php

require '../config/config.php';

// Server-side input validation

if ( !isset($_POST['email']) || empty($_POST['email'])
	|| !isset($_POST['username']) || empty($_POST['username'])
	|| !isset($_POST['password']) || empty($_POST['password']) ) {
	$error = "Please fill out all required fields.";
}
else {
	// Store this user into the database!
	// connect to db
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	// Check if username or email address is already taken (aka exists in the users table)
	$sql_registered = "SELECT * FROM users 
	WHERE username = '" . $_POST["username"] . 
	"' OR email = '" . $_POST["email"] . "';";

	$results_registered = $mysqli->query($sql_registered);
	if(!$results_registered) {
		echo $mysqli->error;
		exit();
	}
	// var_dump($results_registered);

	// num_rows is the # of matches
	if($results_registered->num_rows > 0) {
		$error = "Username or email has been already taken. Please choose another one.";
	}
	else {
		$password = hash("sha256", $_POST["password"]);
		$sql = "INSERT INTO users(username, email, password, is_admin) VALUES('" . $_POST["username"] . "','" . $_POST["email"] . "','" . $password . "', false);";

		//echo "<hr>" . $sql . "<hr>";

		$results = $mysqli->query($sql);
		if(!$results) {
			echo $mysqli->error;
			exit();
		}
	}

	$mysqli->close();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register | Your Personal Beijing Guide</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../stylesheet.css">

	<style>
		.text-danger {
			font-family: 'Grenze Gotisch', cursive;
			color: #800000;
			font-size: 20px;
		}
		#footer {
			position: fixed;
			bottom: 0px;
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
		<div class="row">
			<h1 class="col-12 mt-4">User Registration</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger"><?php echo $error; ?></div>
				<?php else : ?>
					<div class="text-success"><?php echo $_POST['username']; ?> was successfully registered.</div>
				<?php endif; ?>
		</div> <!-- .col -->
	</div> <!-- .row -->

	<div class="row mt-4 mb-4">
		<div class="col-12">
			<a href="login.php" role="button" class="btn btn-primary">Login</a>
			<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-light">Back</a>
		</div> <!-- .col -->
	</div> <!-- .row -->

</div> <!-- .container -->

<div id="footer">
    <h6>&reg; 2020 Your Personal Guide Co, Inc. Made by Enyan Xia</h6>
</div>

</body>
</html>
