<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light" style="background-color: #AA381E;">
	<a class="navbar-brand" href="home.php" style="color:#FFCA62">
		Your Personal Beijing Guide</a>

  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">	
    <span class="navbar-toggler-icon"></span>
  	</button>

	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item " >
				<a class="nav-link" href="home.php">Home </a>
			</li>
			<li class="nav-item">
			  	<a class="nav-link" href="about_beijing.php">About Beijing</a>
			</li>
			<li class="nav-item">
			  	<a class="nav-link" href="attractions.php">Attractions</a>
			</li>
			<li class="nav-item">
			  	<a class="nav-link" href="travel_suggestions.php">Travel Tips</a>
			</li> 
		<!-- this page only available to admin users -->
			<?php if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]==true)   : ?>
			<li class="edit-nav nav-item active">
				<a style="color:#FFCA62" class="nav-link" href="management.php"><i>Management</i></a>
			</li>
			<?php endif; ?>
		
			<?php if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) : ?>
			<li class="nav navbar-nav navbar-right">
				<div class="p-2">Hello <?php echo $_SESSION["username"]; ?>!</div>
				<a class="p-2" href="../login/logout.php">Logout</a>
			</li>
			<?php endif; ?>
		</ul>
	</div>

</nav>