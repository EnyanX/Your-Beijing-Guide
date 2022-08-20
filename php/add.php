<?php

require '../config/config.php';
if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
	header('Location: ../login/login.php');
}
if ($_SESSION["is_admin"]==false){
	header('Location: home.php');
}

if ( !isset($_GET["field"]) || empty($_GET["field"]) || ($_GET["field"] != "history_attractions" && $_GET["field"] != "art_attractions")  ) {
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

		$mysqli->close();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Attraction | Your Personal Beijing Guide</title>
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
	<!-- navbar -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

	<!-- navbar -->
	<?php include "./navbar_management.php"; ?>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Add an Attraction</h1>
		</div> 
	</div> 

	<?php if (isset($error) && !empty($error)): ?>
		<div class="text-danger">
			<?php echo $error; ?>
		</div>
	<?php else: ?>
		
	<div class="container">
		<form id="add-form" action="add_confirmation.php" method="POST">

			<div class="form-group row">
				<label for="name-id" class="col-sm-3 col-form-label text-sm-right">
					Attraction: <span class="text-danger">*</span>
				</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name-id" name="attraction_name">
				</div>
			</div> 

			<div class="form-group row">
				<label for="rating-id" class="col-sm-3 col-form-label text-sm-right">
					District: <span class="text-danger">*</span>
				</label>
				<div class="col-sm-9">
					<select name="district" id="district-id" class="form-control">
						<option value="-1" selected disabled>-- Select One --</option>
						<?php while( $row = $results_districts->fetch_assoc() ): ?>
							<option value="<?php echo $row["id"]; ?>">
								<?php echo $row["district"]; ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label for="rating-id" class="col-sm-3 col-form-label text-sm-right">
					Rating: <span class="text-danger">*</span>
				</label>
				<div class="col-sm-9">
					<select name="rating" id="rating-id" class="form-control">
						<option value="-1" selected disabled>-- Select One --</option>

						<?php while( $row = $results_ratings->fetch_assoc() ): ?>
							<option value="<?php echo $row["id"]; ?>">
								<?php echo $row["rating"]; ?>
							</option>

						<?php endwhile; ?>

					</select>
				</div>
			</div> 

			<div class="form-group row">
				<label for="ticket-price" class="col-sm-3 col-form-label text-sm-right">
					Admission Fee: <span class="text-danger">*</span>
				</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="ticket-price" name="ticket-price">
				</div>
			</div>

			<div class="form-group row">
				<input type="hidden" name="field" value="<?php echo $_GET["field"]; ?>">
			</div>

			<div id="name-error" class="error-message row"></div>
			<div id="district-error" class="error-message row"></div>
			<div id="rating-error" class="error-message row"></div>
			<div id="fee-error" class="error-message row"></div>

			<div class="form-group row">
				<div class="col-sm-3"></div>
				
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> 
		</form>
	</div> 
	<?php endif; ?>

<script
  src="http://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>

<script>
let name_errorMsg = document.querySelector("#name-error");
let district_errorMsg = document.querySelector("#district-error");
let rating_errorMsg = document.querySelector("#rating-error");
let fee_errorMsg = document.querySelector("#fee-error");

document.querySelector("#add-form").onsubmit = function(event){
	event.preventDefault();
	let feeInput = document.querySelector("#ticket-price").value;
	let nameInput = document.querySelector("#name-id").value;
	let districtSelected = document.querySelector("#district-id").value;
	let ratingSelected = document.querySelector("#rating-id").value;
	
	if (feeInput.trim().length == 0 || nameInput.trim().length == 0 || districtSelected == "-1" || ratingSelected == "-1"){
		if(feeInput.trim().length == 0){
			document.querySelector("#ticket-price").classList.add("is-invalid");
			fee_errorMsg.innerHTML="Admission fee is required";
		}
		if(nameInput.trim().length == 0) {
			document.querySelector("#name-id").classList.add("is-invalid");
			name_errorMsg.innerHTML="Attraction name is required";
		}
		if (districtSelected == "-1"){
			document.querySelector("#district-id").classList.add("is-invalid");
			district_errorMsg.innerHTML="District is required";
		}
		if (ratingSelected == "-1"){
			document.querySelector("#rating-id").classList.add("is-invalid");
			rating_errorMsg.innerHTML="Rating is required";
		}
	} else {
		name_errorMsg.innerHTML="";
		district_errorMsg.innerHTML="";
		rating_errorMsg.innerHTML="";
		fee_errorMsg.innerHTML="";
		event.currentTarget.submit();
	}
}


let admissionFee = document.querySelector("#ticket-price");
admissionFee.oninput = function(event){
	if (admissionFee.value.length > 0) {
		document.querySelector("#ticket-price").classList.remove("is-invalid");
		fee_errorMsg.innerHTML="";
	} else {
 		document.querySelector("#ticket-price").classList.add("is-invalid");
	}
}

let attractionName = document.querySelector("#name-id");
attractionName.oninput = function(event){			
	if (attractionName.value.length > 0) {
		document.querySelector("#name-id").classList.remove("is-invalid");
		name_errorMsg.innerHTML="";
	} else {
 		document.querySelector("#name-id").classList.add("is-invalid");
	}
}

let district = document.querySelector("#district-id");
district.onchange = function(event){			
	document.querySelector("#district-id").classList.remove("is-invalid");
	district_errorMsg.innerHTML="";
}

let rating = document.querySelector("#rating-id");
rating.onchange = function(event){			
	document.querySelector("#rating-id").classList.remove("is-invalid");
	rating_errorMsg.innerHTML="";
}
</script>

</body>
</html>