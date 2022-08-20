<?php

require '../config/config.php';

if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
	header('Location: ../login/login.php');
}

if ($_SESSION["is_admin"]==false){
	header('Location: home.php');
}

if ( !isset($_GET["field"]) || empty($_GET["field"]) 
		|| !isset($_GET["name"]) || empty($_GET["name"]) ) {
	$error = "Invalid URL.";
} else {

	// DB Connection
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');

	$sql_ratings = "SELECT * FROM ratings;";
	$results_ratings = $mysqli->query($sql_ratings);
	if ( $results_ratings == false ) {
		echo $mysqli->error;
		exit();
	}

	$sql_districts = "SELECT * FROM districts;";
	$results_districts = $mysqli->query($sql_districts);
	if ( $results_districts == false ) {
		echo $mysqli->error;
		exit();
	}

	if ($_GET["field"]=="history_attractions"){
		$stmt = $mysqli->prepare("SELECT * FROM history_attractions
		WHERE history_attractions.name = ?");
		$stmt->bind_param("s", $_GET["name"]);
		$stmt->execute();
		$results_attraction = $stmt->get_result();

		$stmt->close();
	} else if ($_GET["field"]=="art_attractions"){
		$stmt = $mysqli->prepare("SELECT * FROM art_attractions
		WHERE art_attractions.name = ?");
		$stmt->bind_param("s", $_GET["name"]);
		$stmt->execute();
		$results_attraction = $stmt->get_result();

		$stmt->close();
	}

	if ( $results_attraction == false ) {
		echo $mysqli->error;
		exit();
	}

	$row_attraction = $results_attraction->fetch_assoc();
	
	$mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Attraction | Your Personal Beijing Guide</title>
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

		#footer {
			position: absolute;
			bottom: 0px;
		}

</style>
</head>
<body>
	<!-- navbar -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

	<!-- navbar -->
	<?php include "./navbar_management.php"; ?>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Edit an Attraction</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<?php if (isset($error) && !empty($error)): ?>
		<div class="text-danger">
			<?php echo $error; ?>
		</div>
	<?php elseif ($results_attraction->num_rows==0): ?> 
		<div id="invalid"> Invalid attraction name or field. </div>
	<?php else: ?>
	<div class="container">
		<form id="edit-form" action="edit_confirmation.php" method="POST">
			<div class="form-group row">
				<label for="name-id" class="col-sm-3 col-form-label text-sm-right">
					Attraction Name: <span class="text-danger"></span>
				</label>
				<div class="col-sm-9">
					<input disabled type="text" class="form-control" id="name-id" name="attraction_name" value="<?php echo $_GET["name"]; ?>">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="rating-id" class="col-sm-3 col-form-label text-sm-right">
					District: <span class="text-danger">*</span>
				</label>
				<div class="col-sm-9">
					<select name="district" id="district-id" class="form-control">
						<option value="" selected disabled>-- Select One --</option>
						<?php while( $row = $results_districts->fetch_assoc() ): ?>
							<?php if ( $row["id"] == $row_attraction["district_id"] ) : ?>
								<option selected value="<?php echo $row["id"]; ?>">
									<?php echo $row["district"]; ?>
								</option>
							<?php else : ?>
								<option value="<?php echo $row["id"]; ?>">
									<?php echo $row["district"]; ?>
								</option>
							<?php endif; ?>
						<?php endwhile; ?>
					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="rating-id" class="col-sm-3 col-form-label text-sm-right">
					Rating: <span class="text-danger">*</span>
				</label>
				<div class="col-sm-9">
					<select name="rating" id="rating-id" class="form-control">
						<option value="" selected disabled>-- Select One --</option>
						<?php while( $row = $results_ratings->fetch_assoc() ): ?>
							<?php if ( $row["id"] == $row_attraction["rating_id"] ) : ?>
								<option selected value="<?php echo $row["id"]; ?>">
									<?php echo $row["rating"]; ?>
								</option>
							<?php else : ?>
								<option value="<?php echo $row["id"]; ?>">
									<?php echo $row["rating"]; ?>
								</option>
							<?php endif; ?>
						<?php endwhile; ?>
					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="ticket-price" class="col-sm-3 col-form-label text-sm-right">
					Admission Fee: <span class="text-danger">*</span>
				</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="ticket-price" name="attraction_ticket" value="<?php echo $row_attraction["price_usd"]; ?>">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<input type="hidden" name="field" value="<?php echo $_GET["field"]; ?>">
				<input type="hidden" name="name" value="<?php echo $_GET["name"]; ?>">
			</div>

			<div class="error-message row"></div>
			<div class="form-group row">
				<div class="col-sm-3"></div>
				
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
	<?php endif; ?>

	<div id="footer">
        <h6>&reg; 2020 Your Personal Guide Co, Inc. Made by Enyan Xia</h6>
    </div>

	<script
	  src="http://code.jquery.com/jquery-3.5.1.min.js"
	  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	  crossorigin="anonymous"></script>

	<script>
		let errorMsg = document.querySelector(".error-message");
		document.querySelector("#edit-form").onsubmit = function(event){
			event.preventDefault();
			let textInput = document.querySelector("#ticket-price").value;
			if (textInput.trim().length == 0){
				console.log("Admission Fee is empty!");
				// error msg
				errorMsg.innerHTML="Text is required";
				document.querySelector("#ticket-price").classList.add("is-invalid");

			}
			else {
				errorMsg.innerHTML="";
				event.currentTarget.submit();
			}

		}

		let admissionFee = document.querySelector("#ticket-price");
		admissionFee.oninput = function(event){		
			if (admissionFee.value.length > 0) {
				document.querySelector("#ticket-price").classList.remove("is-invalid");
				errorMsg.innerHTML="";
			}
			else {
		 		document.querySelector("#ticket-price").classList.add("is-invalid");
			}
		}
	</script>

</body>
</html>