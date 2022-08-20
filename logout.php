
<?php
	session_start();
	session_destroy();
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
	h3, .col-12 {
		font-family: 'Grenze Gotisch', cursive;
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
			<h1 class="col-12 mt-4 mb-4">Logout</h1>
			<div class="col-12">You are now logged out.</div>
			<div class="col-12 mt-3">You can go to <a href="../php/home.php">home page</a> or <a href="login.php">log in</a> again.</div>
		</div> <!-- .row -->
	</div> <!-- .container -->
	
	<div id="footer">
        <h6>&reg; 2020 Your Personal Guide Co, Inc. Made by Enyan Xia</h6>
    </div>

</body>
</html>