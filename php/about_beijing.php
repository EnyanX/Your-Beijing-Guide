<?php
  require '../config/config.php';
?>

<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>About Beijing</title>
    <link rel="stylesheet" type="text/css" href="../stylesheet.css">
  
  <style>

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
      background-color:#d44626;
    }

    .section-link {
    text-align: center;
    }

    .section-link a{
      color:#FFCA62;
      font-family: 'Grenze Gotisch', cursive;
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
    <a class="navbar-brand" href="home.php" style="color:#FFCA62">
      Your Personal Beijing Guide
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item " >
          <a class="nav-link" href="home.php">Home </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">About Beijing<span class="sr-only">(current)</span></a>
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
		<h1 class="text-center">关于北京 </h1>
    <h2 class="text-center">About Beijing </h2>
	</div>


  <div class="section-guide" class="container">
    <div class="row-bootstrap row-12 row-md-12 row-lg-12">
      <img class="map-icon" src="../images/map-regular.svg" alt="map-icon">
    </div>
    <div id="sections" class="row">
      <div class="section-link col-sm-6 col-md-4">
        <a href="#facts">Facts</a>
      </div>
      <div class="section-link col-sm-6  col-md-4">
        <a href="#history">History</a>
      </div>
      <div class="section-link column col-sm-6  col-md-4">
        <a href="#culture" >Culture</a>
      </div>
    </div>

		<div class="row row-bootstrap intro p-5">
        <div class="col-lg-1">
        </div>
        
        <div id="facts" class="description col col-12 col-md-6 col-lg-7 ">
	        <h1>Facts about Beijing</h1>
          <h2>Basic Facts</h2>
          <ul>
            <li><strong>English Name:</strong> Beijing, Peking</li>
            <li><strong>Chinese Name:</strong> 北京(běi jīng)</li>
            <li><strong>Government:</strong> Capital of China</li>
            <li><strong>Location:</strong> Northern China (39°54′N, 116°23′E)</li>
            <li><strong>International Events:</strong> 2022 Winter Olympic Games, 2008 Summer Olympic Games</li>
          </ul>
          <h2>Fun Facts</h2>
          <ol>
            <li>Manderin is based on the Beijing Dialect</li>
            <li>Beijing is one of the bicycle capitals of the world</li>
            <li>Beijing is a 6-times capital city.</li>
            <li>Beijing Capital International Airport is the world's second busiest airport</li>

          </ol>
        </div>
        <div class="images col col-12 col-md-6 col-lg-4 order-first order-lg-last">
          <img src="../images/shi_xiang.jpg" alt="shi_xiang" width="95%">
        </div>
      </div>
      <hr style="width:92%">

		<div class="row row-bootstrap intro p-5">
        <div class="col-lg-1">
        </div>
        <div class="images col col-12 col-md-6 col-lg-4">
          <img src="../images/door.jpg" alt="door" width="95%">
        </div>
        <div id="history" class="description col col-12 col-md-6 col-lg-7 ">
          <h1>Beijing History</h1>
          <p> Beijing is one of the four ancient cities of China (together with Xi'an, Luoyang, Nanjing), the best preserved, and famous around the world. The city is also known as a cradle of humanity. It was the capital city in the Liao (916-1125), Jin (1115-1234), Yuan (1271-1368), Ming (1368-1644) and Qing (1644-1911) dynasties. During these 800 years, 34 emperors lived and ruled here. The world renowned Forbidden City was built during this period.
          </p>
          
        </div>
        
      </div>
      <hr style="width:92%">
      <div class="row row-bootstrap intro p-5">
        <div class="col-lg-1">
        </div>
        <div id="culture" class="description col col-12 col-md-6 col-lg-7 ">
          <h1>Culture Life</h1>
          <h2>Peking Opera</h2>
          <li> Peking opera, or Beijing opera, is the most dominant form of Chinese opera which combines music, vocal performance, mime, dance and acrobatics. It arose in Beijing in the mid-Qing dynasty (1636–1912) and became fully developed and recognized by the mid-19th century. The form was extremely popular in the Qing court and has come to be regarded as one of the cultural treasures of China.</li>

          <h2>Xiangsheng</h2>
          <li>Xiangsheng, also known as crosstalk, is a traditional performing art in Chinese comedy, and one of the most popular elements in Chinese culture. It is typically performed as a dialogue between two performers, or rarely as a monologue by a solo performer (similar to most forms of stand-up comedy in Western culture). The Xiangsheng language, rich in puns and allusions, is delivered in a rapid, bantering style, typically in the Beijing dialect. The acts would sometimes include singing, Chinese rapping, and musical instruments.</li>
        </div>
        <div class="images col col-12 col-md-6 col-lg-4 order-first order-md-last order-lg-last">
          <img src="../images/jing_jv_1.jpg" alt="jing_jv" width="95%">
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