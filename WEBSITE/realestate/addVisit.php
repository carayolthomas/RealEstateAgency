    <?php session_start();?>
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
		echo '<ul class="menu">';
		echo '<li><a href="welcome.php">Main</a></li>' ;
		echo '<li><a href="request.php">My requests</a></li>' ;
		echo '<li class="current"><a href="newrequest.php">New request</a></li>';
		echo '<li><a href="confirmConnected.php">Confirm visits</a></li>';
		echo '<li><a href="logout.php">Logout</a></li>' ;
		echo '</ul>';
	  ?>
        
      </nav>
    </div>
  </header>
  <!--==============================content================================-->
  <section id="content">
    <div class="container_12">
      <div class="grid_8"></div>
	<?php
		if(!isset($_SESSION['nbVisitesX']))
		{
			$_SESSION['nbVisitesX'] = 0	;	
			$_SESSION['visitesX'][$_SESSION['nbVisitesX']] = $_GET["id_bien"] ;
			$_SESSION['nbVisitesX'] ++ ;
		}
		else
		{
			if($_SESSION['nbVisitesX']<5)
			{
				$i=0 ;
				$trouve = 0;
				while($i < $_SESSION['nbVisitesX'] && ($trouve != 1))
				{
					if($_GET['id_bien'] == $_SESSION['visitesX'][$i])
					{
						$trouve = 1;
					}
					$i++ ;
				}
				
				if($trouve != 1)
				{
					$_SESSION['visitesX'][$_SESSION['nbVisitesX']] = $_GET["id_bien"] ;
					$_SESSION['nbVisitesX'] ++ ;
					echo "<br/><strong>This house has been added to your basket successfully</strong>"; 
				}
				else
				{
					echo "<br/><strong>You have already add this house</strong>"; 
				}
			}
			else
			{
				echo "<br/><strong>Too much houses added</strong>";
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
