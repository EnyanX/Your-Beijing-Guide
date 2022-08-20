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
		
		#main-row {
			margin-top: 70px;
		}

		#login-title {
			margin-left: 5px;
		}

		h3, a, small, span{
			color: #068876;
			font-family: 'Grenze Gotisch', cursive;
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
					<h1 class="col-12 mt-4 mb-4">User Registration</h1>
					<h3 class="col-12 "> </h3>
				</div> 

				<div class="container">
					<form action="register_confirmation.php" method="POST">
						<div class="form-group row">
							<label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username: <span class="text-danger">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="username-id" name="username">
								<small id="username-error" class="invalid-feedback">Username is required.</small>
							</div>
						</div> <!-- .form-group -->

						<div class="form-group row">
							<label for="email-id" class="col-sm-3 col-form-label text-sm-right">Email: <span class="text-danger">*</span></label>
							<div class="col-sm-9">
								<input type="email" class="form-control" id="email-id" name="email">
								<small id="email-error" class="invalid-feedback">Email is required.</small>
							</div>
						</div> <!-- .form-group -->	

						<div class="form-group row">
							<label for="password-id" class="col-sm-3 col-form-label text-sm-right">Password: <span class="text-danger">*</span></label>
							<div class="col-sm-9">
								<input type="password" class="form-control" id="password-id" name="password">
								<small id="password-error" class="invalid-feedback">Password is required.</small>
							</div>
						</div> <!-- .form-group -->

						<div class="row">
							<div class="ml-auto col-sm-9">
								<span class="text-danger font-italic">* Required</span>
							</div>
						</div> <!-- .form-group -->

						<div class="form-group row">
							<div class="col-sm-3"></div>
							<div class="col-sm-9 mt-3">
								<button type="submit" class="btn btn-primary">Register</button>
								<a href="../php/home.php" role="button" class="btn btn-light">Cancel</a>
							</div>
						</div> <!-- .form-group -->

						<div class="row">
							<div class="col-sm-9 ml-sm-auto">
								<a href="login.php">Already have an account</a>
							</div>
						</div> <!-- .row -->
					</form>
				</div>
			</div>
		</div>
	</div> <!-- .container -->
	
	<script>
		// Client-side input validation
		document.querySelector('form').onsubmit = function(){
			if ( document.querySelector('#username-id').value.trim().length == 0 ) {
				document.querySelector('#username-id').classList.add('is-invalid');
			} else {
				document.querySelector('#username-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#email-id').value.trim().length == 0 ) {
				document.querySelector('#email-id').classList.add('is-invalid');
			} else {
				document.querySelector('#email-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#password-id').value.trim().length == 0 ) {
				document.querySelector('#password-id').classList.add('is-invalid');
			} else {
				document.querySelector('#password-id').classList.remove('is-invalid');
			}

			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>
</body>
</html>
