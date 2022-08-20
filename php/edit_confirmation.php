<?php

// var_dump($_POST);
require '../config/config.php';

if ( !isset($_POST["district"]) || empty($_POST["district"])
	|| !isset($_POST["rating"]) || empty($_POST["rating"])
	|| !isset($_POST["attraction_ticket"]) || (empty($_POST["attraction_ticket"])&&($_POST["attraction_ticket"] != 0))) {
	$error = "Please fill out all required fields.";
} else {

	// DB Connection
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	if ( isset($_POST["district"]) && !empty($_POST["district"]) ) {
		// User selected bytes value.
		$district = $_POST["district"];
	} else {
		// User did not select bytes value.
		$district = "null";
	}

	if ( isset($_POST["rating"]) && !empty($_POST["rating"]) ) {
		// User typed in composer field.
		$rating = "'" . $_POST["rating"] . "'";
	} else {
		// User did not type in composer field.
		$rating = "null";
	}	

	if ( isset($_POST["attraction_ticket"]) && !empty($_POST["attraction_ticket"]) ) {
		// User typed in composer field.
		$admission_fee = $_POST["attraction_ticket"];
	} else {
		// User did not type in composer field.
		$admission_fee = "null";
	}	

	$sql = "UPDATE " . $_POST["field"] . "
					SET district_id = " . $_POST["district"] . ", 
					rating_id = " . $_POST["rating"] .", 
					price_usd = " . $_POST["attraction_ticket"] ." 
					WHERE " . $_POST["field"] .".name = '" .  $_POST["name"] . "';";

	$results = $mysqli->query($sql);
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Confirmation | Beijing Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../stylesheet.css">

	<style>
		
		.text-success {
			/*font-family: 'Syne Mono', monospace;*/
			font-family: 'Grenze Gotisch', cursive;
			font-size: 20px;
		}

		#footer {
			position: absolute;
			bottom: 0px;
		}

	</style>
</head>
<body>
	
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

	<!-- navbar -->
	<?php include "./navbar_management.php"; ?>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Edit Confirmation</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				<?php else : ?>
					<div class="text-success">
						<span class="font-italic"><?php echo $_POST['name']; ?></span> was successfully edited.
					</div>
				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="management.php" role="button" class="btn btn-primary">Back to Management Page</a>
			</div> <!-- .col -->
		</div> <!-- .row -->

	</div> <!-- .container -->
	
	<div id="footer">
        <h6>&reg; 2020 Your Personal Guide Co, Inc. Made by Enyan Xia</h6>
    </div>
</body>
</html>