 <?php session_start(); $_SESSION['coAdm']="";?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>TREA : Toulouse</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/grid_12.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/slider.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/jqtransform.css">
<script src="js/jquery-1.7.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/cufon-yui.js"></script>
<script src="js/vegur_400.font.js"></script>
<script src="js/Vegur_bold_700.font.js"></script>
<script src="js/cufon-replace.js"></script>
<script src="js/tms-0.4.x.js"></script>
<script src="js/jquery.jqtransform.js"></script>
<script src="js/FF-cash.js"></script>
<script>
$(document)
    .ready(function () {
    $('.form-1')
        .jqTransform();
    $('.slider')
        ._TMS({
        show: 0,
        pauseOnHover: true,
        prevBu: '.prev',
        nextBu: '.next',
        playBu: false,
        duration: 1000,
        preset: 'fade',
        pagination: true,
        pagNums: false,
        slideshow: 7000,
        numStatus: false,
        banners: false,
        waitBannerAnimation: false,
        progressBar: false
    })
});
</script>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
<![endif]-->
</head>
<body>
<div class="main">
  <!--==============================header=================================-->
  <header>
    <div>
      <h1><a href="index.html"><img src="images/logo.jpg" alt=""></a></h1>
      <div class="social-icons"></div>
      <div id="slide">
        <div class="slider">
          <ul class="items">
            <li><img src="images/slider-1.jpg" alt=""></li>
            <li><img src="images/slider-2.jpg" alt=""></li>
            <li><img src="images/slider-3.jpg" alt=""></li>
          </ul>
        </div>
        <a href="#" class="prev"></a><a href="#" class="next"></a> </div>
      <nav>
	  <?php
		if($_SESSION['coAdm'] != "") {
			echo '<ul class="menu">';
			echo '<li><a href="newHouse.php">New house</a></li>' ;
			echo '<li><a href="modifyHouse.php?id_bien=all">Modify house</a></li>';
			echo '<li><a href="deleteHouse.php">Delete house</a></li>';
			echo '<li><a href="logout.php">Logout</a></li>' ;
			echo '</ul>';
		}
		else {
			echo '<ul class="menu">';
			echo '<li><a href="index.php">Main</a></li>' ;
			echo '<li><a href="houses.php">Houses</a></li>' ;
			echo '<li><a href="research.php">Research houses</a></li>';
			echo '<li class="current"><a href="admin.php">Administration</a></li>';
			echo '</ul>';
		}
	  ?>
        
      </nav>
    </div>
  </header>
  <!--==============================content================================-->
  <section id="content">
    <div class="container_12">
      <div class="grid_8"> 
		<?php
		include("variables.php");
		if($_SESSION['coAdm']=="")
		{
			echo "<br/><br/><form id='form' action='admin.php' method=post>" ;
			echo "<fieldset><label>";
			echo "<input class='text' name='idcli' type='text' placeholder='Username'></label>" ;
			echo "<label>";
			echo "<input class='text' name='password' type='password' placeholder='Password'></label></fieldset>" ;
			echo '<input class="button" name="connection" type="submit" value="Login"/>'; 
			echo '</form>';
		}
		if(isset($_POST["connection"]))
		{
			if($_POST['idcli'] == "adm" && $_POST['password'] == "adm")
			{
				$_SESSION['coAdm'] = "Connecter" ;
					?>
					<script type="text/javascript">
					<!--
					var obj = 'window.location.replace("http://localhost/realestate/welcomeAdmin.php");';
					setTimeout(obj,0000);
					-->
					</script>
					<?php
			}
			else
			{
				echo "Wrong username/password" ;
			}
		}	
		?>
      </div>
      <div class="clear"></div>
    </div>
  </section>
</div>
<!--==============================footer=================================-->
<footer>
  <p>© 2013 Real Estate : Thomas Carayol</p>
</footer>
<script>Cufon.now();</script>
</body>
</html>
