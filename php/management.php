<?php

require '../config/config.php';

if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
	header('Location: ../login/login.php');
} else {
  	if ($_SESSION["is_admin"]==true){
		// DB Connection
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		// Check for errors
		if( $mysqli->connect_errno){
			echo $mysqli->connect_error;
			exit();
		}
	} else {
		header('Location: home.php');
	}

	$sql_history = "SELECT name, districts.district, ratings.rating, price_usd
	FROM history_attractions
	JOIN ratings
	ON history_attractions.rating_id = ratings.id
	JOIN districts
	ON history_attractions.district_id = districts.id
	ORDER BY name;";

	$result = $mysqli->query($sql_history);

	if( !$result) {
		echo $mysqli->error;
		exit();
	}

	$sql_art = "SELECT name, districts.district, ratings.rating, price_usd
	FROM art_attractions
	JOIN ratings
	ON art_attractions.rating_id = ratings.id
	JOIN districts
	ON art_attractions.district_id = districts.id
	ORDER BY name;";

	$result_art = $mysqli->query($sql_art);

	if( !$result_art) {
		echo $mysqli->error;
		exit();
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Management Page</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../stylesheet.css">

	<style>

		#section-guide {
			background-color: lightyellow;
		}

		.map-icon {
			width:50px;
			display: block;
			margin:auto;
			position: relative;
			top:25px;
	    }

	    #sections {
			padding:10px;
			margin-left:100px;
			margin-right: 100px;
			position:relative;
			top:30px;
			background-color:#aa381e;
	    }

	    .section-link {
	    	text-align: center;
	    }

	    .section-link a{
			color:#FFCA62;
			font-family: 'Grenze Gotisch', cursive;
	    }

	    #history-content, #art-content {
	    	padding-left: 150px;
	    }

	    #attraction-content {
	    	margin-top: 40px;
	    }

	    form {
	    	margin-left: 250px;
	    }

	    .int-td {
	    	text-align: center;
	    }

	    .title-block {
	    	/*background-color: pink;*/
	    	font-family: 'ZCOOL XiaoWei', serif;
	    	font-size: 25px;
	    }

	    .add-btn {
	    	padding-left: 35px;
	    	padding-right: 35px;
	    	position:absolute;
	    	left:800px;
	    }

	    @media (max-width: 991px){
	    	#history-content, #art-content {
		    	padding-left: 0px;
		    }
	    	form {
	    		margin-left: 0px;
	    	}
	    	.add-btn {
	    		left:600px;
	    	}
	    }

	    @media (max-width: 768px){
	    	.add-btn {
	    		left:500px;
	    	}
	    }

	    @media (max-width: 576px){
	    	.add-btn {
	    		left:300px;
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

	<div class="section-guide" class="container">
	    <div class="row-bootstrap row-12 row-md-12 row-lg-12">
	    	<img class="map-icon" src="../images/map-regular.svg" alt="map-icon">
	    </div>
	    <div id="sections" class="row">
	    	<div class="section-link col-sm-6  col-md-4">
	        	<a href="#history-content" >History Attractions</a>
	      	</div>
	      	<div class="section-link col-sm-6  col-md-4">
	        	<a href="#art-content" >Art & Culture</a>
	      	</div>
	    </div>
  	</div>

	<!-- main secion: attraction -->
	<!-- with 4 sub-sections: history, art, architecture, universities -->
	<div id="attraction-content" class="container-fluid">
		<div id="history-content" class="row">
			<div class="title-block col-6 col-md-12">
				<strong>History Attractions</strong>
				<a onclick="return" href="add.php?field=history_attractions" class="add-btn btn btn-warning">Add</a>
			</div>

			<div class="col-12">
				<table style='font-family: "ZCOOL XiaoWei", serif' id="table-history"  class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>Delete</th>
							<th>Edit</th>
							<th>Attraction</th>
							<th>District</th>
							<th>Rating</th>
							<th>Admission Fee [USD]</th>
						</tr>
					</thead>

					<tbody>
						<?php while($row = $result->fetch_assoc() ): ?>
						  <tr>
						  	<td>
								<a onclick="return confirm('Are you sure you want to delete this attraction?')" href="delete.php?field=history_attractions&name=<?php echo $row['name'] ?>" class="btn btn-outline-danger delete-btn">Delete </a>
							</td>
							<td>
								<a onclick="return" href="edit.php?field=history_attractions&name=<?php echo $row['name'] ?>" class="btn btn-outline-info delete-btn">Edit</a>
							</td>
						    <td><?php echo $row["name"];?></td>
						    <td><?php echo $row["district"];?></td>
						    <td><?php echo $row["rating"];?></td>
						    <td class="int-td"><?php echo $row["price_usd"];?></td>
						  </tr>
						<?php endwhile;?>
					</tbody>
				</table>
			</div>	
		</div>

		<hr style="width:88%">
		<div id="art-content" class="row">
			<div class="title-block col-6 col-md-12">
				<strong>Art & Culture Attractions</strong>
				<a onclick="return" href="add.php?field=art_attractions" class="add-btn btn btn-warning">Add</a>
			</div>

			<div class="col-12">
				<table style='font-family: "ZCOOL XiaoWei", serif' id="table-art"  class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
						  	<th>Delete</th>
							<th>Edit</th>
						    <th>Attraction</th>
						    <th>District</th>
						    <th>Rating</th>
						    <th>Admission Fee [USD]</th>
						</tr>
					</thead>
					<tbody>
						<?php while($row = $result_art->fetch_assoc() ): ?>
						<tr>
							<td>
								<a onclick="return confirm('Are you sure you want to delete this attraction?')" href="delete.php?field=art_attractions&name=<?php echo $row['name'] ?>" class="btn btn-outline-danger delete-btn">Delete </a>
							</td>
							<td>
								<a onclick="return" href="edit.php?field=art_attractions&name=<?php echo $row['name'] ?>" class="btn btn-outline-info delete-btn">Edit</a>
							</td>
						    <td><?php echo $row["name"];?></td>
						    <td><?php echo $row["district"];?></td>
						    <td><?php echo $row["rating"];?></td>
						    <td class="int-td"><?php echo $row["price_usd"];?></td>
						</tr>
						<?php endwhile;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<hr style="width:88%">
	
	<a href="#main-navbar">
      	<div id="back-to-top-box">Back to Top</div>
    </a>

	<!-- </div> -->
	<div id="footer">
        <h6>&reg; 2020 Your Personal Guide Co, Inc. Made by Enyan Xia</h6>
    </div>

<script
  src="http://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  
<script>
	$('.map-icon').click(function(){
    	$('#sections').slideToggle();
  	});
</script>

</body>
</html>