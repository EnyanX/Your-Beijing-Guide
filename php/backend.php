<?php

$host = "303.itpwebdev.com";
$user = "enyanxia_db_user";
$password = "******";
$db = "enyanxia_final_project_db";
$mysqli = new mysqli($host, $user, $password, $db);

// Check for errors
// connect_errno will return an error code if there is an error when attempting to connect to the db.
if( $mysqli->connect_errno){
	// Display the exact error message
	echo $mysqli->connect_error;
	// exit() terminates the program. Subsequent code will not run.
	exit();
}

if ($_GET["field"]=="history_attractions"){
	$sql = "SELECT name, districts.district, ratings.rating, price_usd
	FROM history_attractions
	JOIN ratings
		ON history_attractions.rating_id = ratings.id
	JOIN districts
		ON history_attractions.district_id = districts.id
	ORDER BY " . $_GET["order"] . ";";

	$result = $mysqli->query($sql);

	if( !$result) {
		echo $mysqli->error;
		exit();
	}

	$results_array = [];
	while ($row = $result->fetch_assoc()){
		array_push($results_array, $row);
	}

	echo json_encode($results_array);
} else if ($_GET["field"]=="art_attractions"){
	$sql = "SELECT name, districts.district, ratings.rating, price_usd
	FROM art_attractions
	JOIN ratings
		ON art_attractions.rating_id = ratings.id
	JOIN districts
		ON art_attractions.district_id = districts.id
	ORDER BY " . $_GET["order"] . ";";

	$result = $mysqli->query($sql);

	if( !$result) {
		echo $mysqli->error;
		exit();
	}

	$results_array = [];
	while ($row = $result->fetch_assoc()){
		array_push($results_array, $row);
	}

	echo json_encode($results_array);
}

$mysqli->close();

?>
