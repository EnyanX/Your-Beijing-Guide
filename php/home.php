<?php
  require '../config/config.php';
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <title>Your Personal Beijing Guide</title>
  <link rel="stylesheet" type="text/css" href="../stylesheet.css">

  <style>
    
    .btn-primary{
      font-family: 'ZCOOL XiaoWei', serif;
    }
    
    .navbar-right .p-2{
      color:#aacfdd;
    }

  </style>
</head> 
<body>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

	<!-- navbar -->
	<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light" style="background-color: #AA381E;">
	  <a class="navbar-brand" href="#" style="color:#FFCA62">
	    Your Personal Beijing Guide
	  </a>

	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
    
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active" >
	        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
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
        <li class="edit-nav nav-item">
          <a style="color:#FFCA62" class="nav-link" href="management.php"><i>Management</i></a>
        </li>
        <?php endif; ?>

        <?php if(!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) : ?>
          <li class="nav navbar-nav navbar-right">
            <a class="p-2 text-right" href="../login/login.php">Login</a>
            <a class="p-2 text-right" href="../login/register_form.php">Sign up</a>
          </li>
        <?php else: ?>
          <li class="nav navbar-nav navbar-right">
            <div class="p-2">Hello <?php echo $_SESSION["username"]; ?>!</div>
            <a class="p-2" href="../login/logout.php">Logout</a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
	</nav>

	<!-- background photo -->
	<div class="container-fluid" id="bg-img">
		<h1 class="text-center">北京欢迎你 </h1>
    <h2 class="text-center">Beijing Welcomes You </h2>
	</div>

	<div class="container-fluid">
		<div class="row row-bootstrap intro p-5">
      <div class="col-lg-1"></div>
      <div class="description col col-12 col-md-6 col-lg-7 ">
        <h1>Where Is Beijing</h1>
        <p> Beijing, or Peking, is the capital of the People’s Republic of China. It is a mega-city where the traditional and the modern blend, the nature and the culture integrate, and the east and the west co-exist. Its unique charm draws thousands of tourists there every year.</p>
        <a class="btn btn-primary" href="about_beijing.php" role="button" style="background-color:#37375e;">Learn More about Beijing</a>
      </div>
      <div class="images col col-12 col-md-6 col-lg-4 order-first order-md-last order-lg-last">
        <img src="../images/qi_fu_dian_2.jpg" alt="qi_fu_dian" width="100%">
      </div>
    </div>

    <hr style="width:92%">

		<div class="row row-bootstrap intro p-5">
      <div class="description col col-12 col-md-6 col-lg-7 ">
        <h1>Why Beijing</h1>
        <p> Beijing is a global city, and one of the world's leading centers for culture, diplomacy and politics, business and economy, education, language, and science and technology. Having served as the capital of the country for more than 800 years, it is home to some of the finest remnants of China's imperial past.</p>
        <ul>
          <li><strong>The Great Wall</strong>, the longest man-made structure</li>
          <li><strong>The Forbidden City</strong>, the largest ancient architectural complex</li>
          <li><strong>Tian'anmen Square</strong>, the largest famous city square in the world</li>
        </ul>
        <a class="btn btn-primary" href="attractions.php" role="button" style="background-color:#37375e;">Learn More about Attractions</a>
      </div>
      <div class="images col col-12 col-md-6 col-lg-4 order-first">
        <img src="../images/niao_long.jpg" alt="niao_long" width=100%>
      </div>
    </div>

    <hr style="width:92%">

    <div class="row row-bootstrap intro p-5">
      <div class="col-lg-1">
      </div>
      <div class="description col col-12 col-md-6 col-lg-7 ">
        <h1>When to Visit Beijing</h1>
        <p> The best times to visit Beijing are from March to May and from September to October. These temperate seasons provide the best climate, not to mention colorful scenery. In contrast, summer brings sweltering heat, and winter ushers in cold temps and sometimes snow. While you should be mindful of the weather, you should also steer clear of national public holidays. Millions of domestic tourists flood Beijing's historic and sacred sites. The surge pushes room rates through the roof. </p>
        <a class="btn btn-primary" href="travel_suggestions.php" role="button" style="background-color:#37375e;">Learn More about Travel Tips</a>
      </div>
      <div class="images col col-12 col-md-6 col-lg-4 order-first order-md-last order-lg-last">
        <img src="../images/you_chuan.jpg" alt="you_chuan" width=100%>
      </div>
    </div>

    <hr style="width:92%">

    <a href="#main-navbar">
        <div id="back-to-top-box">Back to Top</div>
    </a>

    <div id="footer">
        <h6>&reg; 2020 Your Personal Guide Co, Inc. Made by Enyan Xia</h6>
    </div>
	</div>
  
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

  <script>
    
    $(document).ready(function(){
      let background_section = $('#bg-img');

      let backgrounds = new Array(
        'url("../images/forbidden_city_3.jpg")'
        , 'url("../images/building_2.jpg")'
        , 'url("../images/qing_hua_2.jpg")'
        ,'url("../images/palace_museum_2.jpg")'
      );

      let current = 0;

      function nextBackground() {
          current++;
          current = current % backgrounds.length;
          background_section.css('background-image', backgrounds[current]);
      }
      setInterval(nextBackground, 5000);

      background_section.css('background-image', backgrounds[0]);
    });

  </script>

</body>
</html>