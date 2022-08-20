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

  <title>Beijing Travel Sueestions</title>
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

    #exchange-rate {
      color: #37378f;
    }

    .click {
      color:#068876;
    }

    img {
      filter: contrast(93%);
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
        <li class="nav-item">
          <a class="nav-link" href="about_beijing.php">About Beijing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="attractions.php">Attractions</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Travel Tips<span class="sr-only">(current)</span></a>
        </li>

        <?php if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]==true)   : ?>
        <li class="nav-item">
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
		<h1 class="text-center">出行建议 </h1>
    <h2 class="text-center">Travel Tips </h2>
	</div>

  <div class="section-guide container">
    <div class="row-bootstrap row-12 row-md-12 row-lg-12">
      <img class="map-icon" src="../images/map-regular.svg" alt="map-icon">
    </div>
    <div id="sections" class="row">
      <div class="section-link col-sm-6  col-md-4">
        <a href="#visa" >Visa</a>
      </div>
      <div class="section-link col-sm-6  col-md-4">
        <a href="#money" >Money</a>
      </div>
      <div class="section-link column col-sm-6  col-md-4">
        <a href="#communication" >Language</a>
      </div>
      <div class="section-link column col-sm-6  col-md-4">
        <a href="#climate" >Climate</a>
      </div>
      <div class="section-link column col-sm-6  col-md-4">
        <a href="#medical" >Medical Services</a>
      </div>
      <div class="section-link column col-sm-6  col-md-4">
        <a href="#forbidden-city" >Forbidden City</a>
      </div>
    </div>
  </div>

	<div class="container-fluid">
		<div class="row row-bootstrap intro p-5">
        <div class="col-lg-1">
        </div>
        <div id="visa" class="description col col-12 col-md-6 col-lg-7 ">
	        <h1>Visa</h1>
          <h2>Tourist Visa</h2>
          <ul><li>If you are coming to China for sightseeing, you should obtain a tourist visa from the Chinese Embassy or Consulate in your home country. It is more convenient for tourists booked through Chinese travel agencies to get group visas for their visit to China.</li>
          <li>Tourist visas are usually good for two months, but can be extended for an extra month at the Foreigners Section of the public Security Bureau in each big city in China.</li>
          <li>It is wise to carry your passport with you at all times, as you need it to register in hotels, buy plane tickets and change money. Also, sometimes there are random checkpoints at night for passengers riding in taxis.</li></ul>
          
          <h2>72-HR Visa-Free Transit</h2>
          <ul><li>Visa-free travelling to Beijing has come true for transit passengers from 51 countries including the US, Canada and all members of the EU to spend up to 72 hours in Beijing without a visa.</li>
          <li> This visa-free policy allow foreigners from these 51 countries with visas and plane tickets to a third country to transit through Beijing for a visa-free stay of up to 72 hours, a policy aimed at boosting tourism and smoothing the way for transiting passengers and business travelers.</li></ul>

        </div>

        <div class="images col col-12 col-md-6 col-lg-4 order-first order-md-last order-lg-last">
          <img src="../images/jie_dao.jpg" alt="jie_dao" width="100%">
        </div>

      </div>

      <hr style="width:92%">

		<div class="row row-bootstrap intro p-5">
        <div class="col-lg-1">
        </div>

        <div class="images col col-12 col-md-6 col-lg-4 ">
          <img src="../images/building_1.jpg" alt="building" width="100%">
        </div>

        <div id="money" class="description col col-12 col-md-6 col-lg-7 ">
          <h1>Money</h1>
          <h2>Chinese Currency-RMB</h2>
          <p>RMB, kuai, yuan, CNY, Renminbi - it all means the People's Money or the official currency of the People's Republic of China. </p>
          <a id="exchange-rate" href="https://www.bloomberg.com/quote/USDCNY:CUR" target="_blank"><p>[Click to see USD to CNY Exchange Rate]</p></a>
          <h2>Tipping in China</h2>
          <ul><li>The answer is no! Tipping is not required nor expected. You do not have to tip in China. Not anywhere. Not to service people, not to bellboys, not to chamber maids. Not at Starbucks even though they have a jar out!</li></ul>
        </div>
      </div>
        
      <hr style="width:92%">
      <div class="row row-bootstrap intro p-5">
        <div class="col-lg-1">
        </div>
        <div id="communication" class="description col col-12 col-md-6 col-lg-7 ">
          <h1>Language</h1>
          <ul><li>The official language of China is Mandarin Chinese, actually a northern dialect, and this is what the people of Beijing speak. Often when Chinese people from the countryside or far-flung regions of the country come to Beijing, they have a hard time communicating. So if you are having difficulty making yourself understood, you are not alone!</li>
          <li>Most people in the tourism industry speak English, but if you plan to explore Beijing on your own and find your language skills lacking, download a translation app such as Pleco.</li>
          <li>Street signs are both in Chinese and English, so if you have a map, it is easier to figure out where you are. </li></ul>
        </div>

        <div class="images col col-12 col-md-6 col-lg-4 order-first order-md-last order-lg-last">
          <img src="../images/people_3.jpg" alt="people" width="100%">
        </div>
        
      </div>
      <hr style="width:92%">
      <div class="row row-bootstrap intro p-5">
        <div class="col-lg-1">
        </div>

        <div class="images col col-12 col-md-6 col-lg-4">
          <img src="../images/winter_gu_gong_2.jpg" alt="winter_gu_gong" width="100%">
        </div>

        <div id="climate" class="description col col-12 col-md-6 col-lg-7 ">
          <h1>Climate</h1>
          <ul><li>Beijing Realtime Weather PhotosBeijing's climate is defined as "continental monsoon." The four seasons are distinctly recognizable. Autumn is the best time to be in Beijing; the temperature is mild and the sun is out a lot. The temperature in spring is nice, too, but it is very dry and winds whip sand around the ciyt.</li>
          <li>Summer can be unbearably hot, and winter is equally freezing cold, assisted by winds blowing down directly from siberia. Beijing nice clothes for going out at night, but for touring during the day wear casual clothes and comfortable sturdy shoes.</li>
          <li>In autumn, jeans and a sweater are usually enough. In the warmer months, T-shirts and light pants or shorts are the best bet. In the colder months, it is wise to dress in layers; long underwear and jeans, shirt, sweater and down jacket. </li>
          </ul>
        </div>
      </div>

      <hr style="width:92%">
      <div class="row row-bootstrap intro p-5">
        <div class="col-lg-1">
        </div>
        <div id="medical" class="description col col-12 col-md-6 col-lg-7 ">
          <h1>Medical Services</h1>
          <p>Below is a list of a few local hospitals and clinics catering to foreigners.</p>
          <p class="click">[Click Headers for More Information]</p>
          <a href="https://beijing.ufh.com.cn/locations/main-campus" target="_blank" ><h2>- Beijing United Family Hospital</h2></a>
          <ul><li>Address: 2 Jiangtai Road, Chaoyang District, Beijing 100016 </li>
          <li>Phone: 010-59277000</li></ul>

          <a href="https://www.pumch.cn/en.html" target="_blank"><h2>- Peking Union Medical College Hospital</h2></a>
          <ul><li>Address:1 Shuaifuyuan, Wangfujing, Dongcheng District </li>
          <li>Tel: 6529 5284, 24hr em: 6529 5269</li></ul>

          <a href="https://www.zryhyy.com.cn/" target="_blank"><h2>- Sino-Japanese Friendship Hospital</h2></a>
          <ul><li>Address: Ying Hua Dong Lu, He Ping Li, Beijing 100029</li>
          <li>Tel: 86-10-6422 2965, 86-10-6422 1122</li></ul>

          <a href="http://www.bjhmoh.cn/english/" target="_blank"><h2>- Beijing Hospital</h2></a>
          <ul><li>Call the Foreign Affairs Office: 010-85138505</li></ul>
        </div>

        <div class="images col col-12 col-md-6 col-lg-4 order-first order-md-last order-lg-last">
          <img src="../images/flower.jpg" alt="flower" width="100%">
        </div>

      </div>

      <hr style="width:92%">
      <div class="row row-bootstrap intro p-5">
        <div class="col-lg-1">
        </div>

        <div class="images col col-12 col-md-6 col-lg-4 ">
          <img src="../images/forbidden_city_3.jpg" alt="forbidden_city" width="100%">
        </div>

        <div id="forbidden-city" class="description col col-12 col-md-6 col-lg-7 ">
          <h1>Forbidden City</h1>
          <h2>Plan Ahead</h2>
          <p>Daniel Newman of Newman Tours advises: “Book your tickets in advance, since the government limits admissions to 80,000 people per day. Don’t forget your passport, because you can’t enter without it.”</p>
          <h2>Try to Avoid Weekends or Chinese Public Holidays</h2>
          <ul><li>Forbidden City is a must see highlight for every first-time visitor to Beijing. Be ready for crowds of people visiting this complex. Try to avoid visiting  Forbidden City on weekends or public holidays.</li>
          <li>Very often you have to elbow your way to see and take pictures. We recommend you come here either early in the morning or in the later afternoon ( not too late to be allowed to enter the museum ) to beat the crowds, enjoy the Forbidden City as it once is before the masses turn up and ruin your photo opportunities.</li></ul>
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