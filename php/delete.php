<?php

require '../config/config.php';

if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
	header('Location: ../login/login.php');
}

if ($_SESSION["is_admin"]==false){
	header('Location: home.php');
}

if ( !isset($_GET['field']) || empty($_GET['field']) 
		|| !isset($_GET['name']) || empty($_GET['name']) ) {
	$error = "Invalid URL.";
} else {
	
	// DB Connection
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}
	$mysqli->set_charset('utf8');

	// prepared statement
	if ($_GET["field"]=="history_attractions"){
		$stmt = $mysqli->prepare("DELETE FROM history_attractions
		WHERE history_attractions.name = ?");
		$stmt->bind_param("s", $_GET["name"]);		
	} else if ($_GET["field"]=="art_attractions"){
		$stmt = $mysqli->prepare("DELETE FROM art_attractions
		WHERE art_attractions.name = ?");
		$stmt->bind_param("s", $_GET["name"]);
	}

	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delete | Your Personal Beijing Guide</title>
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
	
	<?php include "./navbar_management.php"; ?>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Delete an Attraction Recommendation</h1>
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
					<div class="text-success"><span class="font-italic"><?php echo $_GET["name"]; ?></span> was successfully deleted.</div>
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