<?php
  require '../config/config.php';
  if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
    header('Location: ../login/login.php');
  } else {
    // DB Connection
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check for errors
    if( $mysqli->connect_errno){
      echo $mysqli->connect_error;
      exit();
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

<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Beijing Attractions</title>
    <link rel="stylesheet" type="text/css" href="../stylesheet.css">
  
  <style>

    @import url('https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap');
    
    .map-marker-alt-solid {
      width:50px;
      display: block;
      margin:auto;
      position: relative;
      top:25px;
    }

    #category-guide {
      position: relative;
      height: 250px;
      top:30px;
    }

    #category-guide a{
      /*font-family: 'Long Cang', cursive;*/
      font-family: 'Grenze Gotisch', cursive;
      color:#005F69;
      text-align: center;
      position: relative;
      top:55px;
      display: block;
    }

    img {
      filter: contrast(70%);
    }
    
    #category-guide img{
      width:100%;
      height: 100%;
    }

    #history-section{
      background-image: url("../images/shui_li_fang_2.jpg");
      background-size: 400px;
    }

    #art-section{
      background-image: url("../images/history_3.jpg");
    }

    #architecture-section{
      background-image: url("../images/qing_hua_1.jpg");
    }

    #universities-section{
      background-image: url("../images/gu_wu.jpg");
      background-size: 340px;
    }

    .sections{
      background-size: 350px;
      height: 200px;
      background-color: black;
    }

    .sections:hover{
      opacity: 75%;
    }

    #category-guide a:hover{
      color:#800000;
    }

    .clearfloat {
      clear: both;
    }

    .section {
      width: 350px;
      margin: auto;
    }

    h1, p {
      text-align: center;
      font-family: 'Grenze Gotisch', cursive;
    }

    .hidden {
      display: none;
    }

    .thumbnail, .art-thumbnail {
      cursor: pointer;
      width: 50px;
      height: 50px;
      margin: 4px;
      float: left;
      overflow: hidden;
      opacity: 0.75;
    }

    .thumbnail:hover, .art-thumbnail:hover {
      opacity: 1.0
    }

    .thumbnail > img,.art-thumbnail > img {
      height: 100%;
    }

    #main-img-container, #art-main-img-container {
      text-align: center;
      margin-top: 30px;
    }

    #main-img-container img,#art-main-img-container img {
      max-width: 100%;
      filter: contrast(88%);
    }

    #main-img-container p , #art-main-img-container p {
      font-size: 1.5em;
    }

    .sort-by-section {
      position: relative;
      right: 0px;
      top:0px;
    }

    /* Tablets */
    @media (max-width: 991px) {
      .content {
        position: relative;
        top:150px;
      }
      #category-guide {
        top:0;
        height:80px;
      }
    }

    /* Phones */
    @media (max-width: 767px) {
      #history-section{
      background-image: url("../images/history_1.jpg");
    }

      #art-section{
        background-image: url("../images/history_2.jpg");

        background-size: 370px;
      }

      #thumbnail-wrapper, #art-main-img-container p  {
        width: 300px;
        margin: auto;
      }

      .section{
        width:300px;
      }

      .content {
        position: relative;
        top:10px;
      }

      .section{
        margin-top:10px;
      }

      #category-guide {
        top:0;
        height:420px;
      }

      #category-guide a h1{
        font-size: 35px;
      }
    }

    .form-check-label {
      padding-top: calc(.5rem - 1px * 2);
      padding-bottom: calc(.5rem - 1px * 2);
      margin-bottom: 0;
    }

    .navbar-right .p-2{
      color:#aacfdd;
    }

    .prev,
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
        <li class="nav-item">
          <a class="nav-link" href="about_beijing.php">About Beijing</a>
        </li>
	      <li class="nav-item active">
	        <a class="nav-link" href="#">Attractions<span class="sr-only">(current)</span></a>
	      </li>
        <li class="nav-item">
          <a class="nav-link" href="travel_suggestions.php">Travel Tips</a>
        </li> 
        <?php if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]==true)   : ?>
        <li class="edit-nav nav-item">
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

	<!-- background photo -->
	<div class="container-fluid" id="bg-img">
		<h1 class="text-center">景点一览 </h1>
    <h2 class="text-center">Featured Attractions </h2>
	</div>

  <div id="category-guide" class="container-fluid">
    <div class="row">

      <div id="history-section" class="sections column col-6 col-md-3 col-lg-3">
        <a id="history-topic" class="category" href="#history-content"><h1>History</h1></a>
      </div>
      
      <div id="art-section" class="sections column col-6 col-md-3 col-lg-3">
        <a class="category" href="#art-content"><h1>Art & Culture</h1></a>
      </div>

      <div id="architecture-section" class="sections column col-6 col-md-3 col-lg-3">
       <a class="category" href="#architecture-content"><h1>Architecture</h1></a>
      </div>
      
      <div id="universities-section" class="sections column col-6 col-md-3 col-lg-3">
        <a class="category" href="#universities-content"><h1>Universities</h1></a>
      </div>

    </div>
  </div>
  
<div id="history-content" class="content container-fluid hidden">
  <hr style="width:92%">
  <div class="row">
    <div class="col-12 col-sm-3 col-md-2 col-lg-4">
      <div id="gallery" class="section">
        <h1>Historical Sites</h1>
        <div id="main-img-container">
          <img src="../images/yi_he_yuan_4.jpg" alt="Summer Palace" id="main-img">
          <p>Summer Palace</p>
        </div> <!-- #main-img-container -->
        <div id="thumbnail-wrapper">
          <div class="thumbnail">
            <img src="../images/yi_he_yuan_4.jpg" alt="Summer Palace">
          </div>
          <div class="thumbnail">
            <img src="../images/yi_he_yuan.jpg" alt="Summer Palace">
          </div>
          <div class="thumbnail">
            <img src="../images/history_1.jpg" alt="Forbidden City">
          </div>
          <div class="thumbnail">
            <img src="../images/great_wall_1.jpg" alt="Great Wall">
          </div>
          <div class="thumbnail">
            <img src="../images/tian_tan_park.jpg" alt="Heavenly Temple">
          </div>
          <div class="thumbnail">
            <img src="../images/lu_gou_bridge.jpg" alt="Lugou Bridge">
          </div>
          <div class='clearfloat'></div>
        </div> <!-- #thumbnail-wrapper -->
      </div>
      <div id="history-close-box" class="col-12 col-lg-8 close-box">Close</div>
    </div>
      
    <div class="col-0 col-sm-0 col-md-4 col-lg-1"></div>

    <div class="col-12 col-sm-7 col-md-6 col-lg-7">
      
      <div class="sort-by-section">
        <form action="" method="" class="form-inline col-12  mt-5">
          <div class="form-group col-10">
            <label style='font-family: "Grenze Gotisch", cursive' for="sort-id" class="col-sm-4 col-lg-8 col-form-label text-sm-right">Sort By:</label>
         
            <select style='font-family: "Grenze Gotisch", cursive' name="sort_item" id="sort_item" class="form-control">
              <option value="name" selected>-- Default --</option>
              <option value="ratings.id" >Rating</option>
              <option value="price_cny">Admission Fee</option>
            </select>
          </div> <!-- .form-group -->
        </form>
      </div>

      <div class="row">
        <div class="col-12">
          <table style='font-family: "ZCOOL XiaoWei", serif' id="table-history"  class="table table-hover table-responsive mt-4">
            <thead>
              <tr>
                <th>Attraction</th>
                <th>District</th>
                <th>Rating</th>
                <th>Admission Fee [USD]</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = $result->fetch_assoc() ): ?>
                <tr>
                  <td><?php echo $row["name"];?></td>
                  <td><?php echo $row["district"];?></td>
                  <td><?php echo $row["rating"];?></td>
                  <td><?php echo $row["price_usd"];?></td>
                </tr>
              <?php endwhile;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> 
</div>


<div id="art-content" class="content container-fluid hidden">
  <hr style="width:92%">
  <div class="row">
    <div class="col-12 col-sm-3 col-md-2 col-lg-4">
      <div id="art-gallery" class="section">
        <h1>Art & Culture</h1>
        <div id="art-main-img-container">
          <img src="../images/xing_le.jpg" alt="xiě shēng zhēn qín tú" id="art-main-img">
          <p> Palace Museum Collection</p>
        </div> <!-- #main-img-container -->
        
        <div id="art-thumbnail-wrapper">
          <div class="art-thumbnail">
            <img src="../images/xing_le.jpg" alt="Palace Museum Collection ">
          </div>
          <div class="art-thumbnail">
            <img src="../images/zhen_qin.jpg" alt="Palace Museum Collection">
          </div>
          <div class="art-thumbnail">
            <img src="../images/si_he_yuan.jpg" alt="sì hé yuàn ">
          </div>
          <div class="art-thumbnail">
            <img src="../images/hu_tong.jpg" alt="hú tóng">
          </div>
          <div class="art-thumbnail">
            <img src="../images/798_2.jpg" alt="798 Art Zone">
          </div>
          <div class="art-thumbnail">
            <img src="../images/798_3.jpg" alt="798 Art Zone">
          </div>
          <div class='clearfloat'></div>
          </div> <!-- #thumbnail-wrapper -->
      </div>
      <div id="art-close-box" class="col-12 col-lg-8 close-box">Close</div>
    </div>
      
    <div class="col-0 col-sm-0 col-md-4 col-lg-1"></div>

    <div class="col-12 col-sm-7 col-md-6 col-lg-6">
      <div class="sort-by-section">
        <form action="" method="" class="form-inline col-12  mt-5">
          <div class="form-group col-10">
            <label style='font-family: "Grenze Gotisch", cursive' for="art-sort-id" class="col-sm-4 col-lg-8 col-form-label text-sm-right">Sort By:</label>
        
            <select style='font-family: "Grenze Gotisch", cursive' name="art-sort-item" id="art-sort-item" class="form-control">
              <option value="name" selected>-- Default --</option>
              <option value="ratings.id" >Rating</option>
              <option value="price_usd">Admission Fee</option>
            </select>
          </div> <!-- .form-group -->
        </form>
      </div>
      <div class="row">
        <div class="col-12">
          <table style='font-family: "ZCOOL XiaoWei", serif' id="table-art"  class="table table-hover table-responsive mt-4">
            <thead>
              <tr>
                <th>Attraction</th>
                <th>District</th>
                <th>Rating</th>
                <th>Admission Fee [USD]</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = $result_art->fetch_assoc() ): ?>
                <tr>
                  <td><?php echo $row["name"];?></td>
                  <td><?php echo $row["district"];?></td>
                  <td><?php echo $row["rating"];?></td>
                  <td><?php echo $row["price_usd"];?></td>
                </tr>
              <?php endwhile;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> <!-- .container -->
</div>

<div id="architecture-content" class="container-fluid hidden">
  <hr style="width:92%">
  <div class="row">
    <div class="column col-12 col-md-2 col-lg-2">
      <div id="architecture-gallery" class="section">
        <h1>Coming Soon</h1>
        <h1>Stay Tuned</h1>
        </div>
      </div>
    </div> <!-- .section -->
    <div id="architecture-close-box" class="row close-box">Close</div>
</div>

<div id="universities-content" class="container-fluid hidden">
  <hr style="width:92%">
  <div class="row">
    <div class="column col-12 col-md-2 col-lg-2">
      <div id="universities-gallery" class="section">
        <h1>Coming Soon</h1>
        <h1>Stay Tuned</h1>
      </div>
    </div>
  </div> <!-- .section -->
  <div id="universities-close-box" class="row close-box">Close</div>
</div>

  <div id="footer">
    <hr style="width:92%">
    <h6>&reg; 2020 Your Personal Guide Co, Inc. Made by Enyan Xia</h6>
  </div>
</div>

<script
  src="http://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>

<script>
  
$('#history-section').click(function(){
  $('#history-content').slideToggle();
});
$('#art-section').click(function(){
  $('#art-content').slideToggle();
});
$('#architecture-section').click(function(){
  $('#architecture-content').slideToggle();
});
$('#universities-section').click(function(){
  $('#universities-content').slideToggle();
});
 

</script>

<script>
let images = document.querySelectorAll(".thumbnail");

for (let i=0;i<images.length;i++){
  images[i].onclick=function(){
    document.querySelector("#main-img").src=this.querySelector("img").src;
    document.querySelector("#main-img").alt=this.querySelector("img").alt;
    document.querySelector("#main-img").nextElementSibling.innerHTML=document.querySelector("#main-img").alt;

    // reset
    for (let j=0;j<images.length;j++){
      images[j].style.borderColor = "#000000";
      images[j].style.opacity=0.6;
    }
    
    this.style.borderColor="#F00000";
    this.style.opacity=1;
  }
}


let art_images = document.querySelectorAll(".art-thumbnail");

for (let i=0;i<art_images.length;i++){
  art_images[i].onclick=function(){
    document.querySelector("#art-main-img").src=this.querySelector("img").src;
    document.querySelector("#art-main-img").alt=this.querySelector("img").alt;
    document.querySelector("#art-main-img").nextElementSibling.innerHTML=document.querySelector("#art-main-img").alt;

    // reset
    for (let j=0;j<art_images.length;j++){
      // reset default bordor color
      art_images[j].style.borderColor = "#000000";
      art_images[j].style.opacity=0.6;
    }
    
    this.style.borderColor="#F00000";
    this.style.opacity=1;
  }
}

$('#history-close-box').click(function(){
  $('#history-content').slideToggle();
});


$('#art-close-box').click(function(){
  $('#art-content').slideToggle();
});

$('#architecture-close-box').click(function(){
  $('#architecture-content').slideToggle();
});


$('#universities-close-box').click(function(){
  $('#universities-content').slideToggle();
});


function ajaxGet(endpointUrl, returnFunction){
  var xhr = new XMLHttpRequest();
  xhr.open('GET', endpointUrl, true);
  xhr.onreadystatechange = function(){
    if (xhr.readyState == XMLHttpRequest.DONE) {
      if (xhr.status == 200) {
        returnFunction( xhr.responseText );
      } else {
        alert('AJAX Error.');
        console.log(xhr.status);
      }
    }
  }
  xhr.send();
};


document.querySelector("#history-content #sort_item").onchange = function(){
  let sortItem = document.querySelector("#sort_item").value;
  console.log(sortItem);
  ajaxGet("backend.php?field=history_attractions&order=" + sortItem, function(results){

    // The following code will only run when we get a response from backend.php
    results = JSON.parse(results);

    let resultsTable = document.querySelector("#table-history tbody");
    while( resultsTable.hasChildNodes()) {
      resultsTable.removeChild(resultsTable.lastChild);
    }
    for (let i = 0; i < results.length; i++) {
      let attraction = results[i];
      console.log(attraction);

      let row = document.createElement('tr');
      let properties = ['name', 'district', 'rating', 'price_usd'];
      for (let j=0; j<properties.length; j++){
        let cell = document.createElement('td');
        cell.innerHTML = attraction[properties[j]];
        row.appendChild(cell);
      }
      resultsTable.appendChild(row);

    }
  });
}
document.querySelector("#art-sort-item ").onchange = function(){
let sortItem = document.querySelector("#art-sort-item").value;
console.log(sortItem);
ajaxGet("backend.php?field=art_attractions&order=" + sortItem, function(results){
  
  // The following code will only run when we get a response from backend.php
  results = JSON.parse(results);
  // console.log(results);

  let resultsTable = document.querySelector("#table-art tbody");
  while( resultsTable.hasChildNodes()) {
    resultsTable.removeChild(resultsTable.lastChild);
  }
  for (let i = 0; i < results.length; i++) {
    let attraction = results[i];
    console.log(attraction);

    let row = document.createElement('tr');
    let properties = ['name', 'district', 'rating', 'price_usd'];
    for (let j=0; j<properties.length; j++){
      let cell = document.createElement('td');
      cell.innerHTML = attraction[properties[j]];
      row.appendChild(cell);
    }
    resultsTable.appendChild(row);
    }
  });
}
</script>

</body>
</html>