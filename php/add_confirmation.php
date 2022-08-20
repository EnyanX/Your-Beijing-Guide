<?php

require '../config/config.php';

if ( !isset($_POST["attraction_name"]) || empty($_POST["attraction_name"]) 
	|| !isset($_POST["district"]) || empty($_POST["district"])
	|| !isset($_POST["rating"]) || empty($_POST["rating"])
	|| (empty($_POST["ticket-price"])&&($_POST["ticket-price"] != 0))
	|| !isset($_POST["field"]) || empty($_POST["field"]) ) {

	// Missing required fields.
	$error = "Please fill out all required fields.";
} else {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	if ($_POST["field"]=="history_attractions"){
		$stmt = $mysqli->prepare("INSERT INTO history_attractions (history_attractions.name, district_id, rating_id, price_usd) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("siii", $_POST["attraction_name"], $_POST["district"], $_POST["rating"], $_POST["ticket-price"]);
	}
	else if ($_POST["field"]=="art_attractions"){
		$stmt = $mysqli->prepare("INSERT INTO art_attractions (art_attractions.name, district_id, rating_id, price_usd) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("siii", $_POST["attraction_name"], $_POST["district"], $_POST["rating"], $_POST["ticket-price"]);	
	}

	$stmt->execute();
	$results_attraction = $stmt->get_result();
	$stmt->close();

	$mysqli->close();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../stylesheet.css">
	
	<style>

		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}

		label, option, .form-group, #invalid, .error-message  {
			font-family: 'ZCOOL XiaoWei', serif;
		}

		#invalid, {
			font-size: 25px;
			margin-left: 130px;
			color:#b22222;
		}

		.error-message  {
			margin-left: 285px;
			font-size: 15px;
			color:#b22222;
		}

		@media (max-width: 1199px){
			.error-message  {
				margin-left: 0px;
				font-size: 15px;
				color:#b22222;
			}
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
			<h1 class="col-12 mt-4">Add an Attraction</h1>
		</div> 
	</div> 
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				<?php else : ?>
					<div class="text-success">
						<span class="font-italic"><?php echo $_POST["attraction_name"]; ?></span> was successfully added.
					</div>
				<?php endif; ?>
			</div> 
		</div> 
		
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="add.php?field=<?php echo $_POST["field"]; ?>" role="button" class="btn btn-primary">Back to Add Form</a>
			</div> 
		</div> 
	</div> 
</body>
</html>