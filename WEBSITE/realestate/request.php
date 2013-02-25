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
		echo '<li class="current"><a href="request.php">My requests</a></li>' ;
		echo '<li><a href="newrequest.php">New request</a></li>';
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
		<div class="grid_4">
        <div class="left-1">
          <h2 class="top-1 p3">List of your request :</h2>
      
		<?php
			if(!isset($_SESSION['username']))
			{
				header("Location: identification.php");
				exit;
			}
			include("variables.php");
			$id = $_SESSION['idcli'];
			$query="select * from demande where idclient='$id'";
			$result = mysql_query($query);
			if (mysql_num_rows($result)!= 0)
			{
				echo "<p><br/>";
				while($row = mysql_fetch_array($result))
				{
					$dateEx = $row['datedemande'];
					$annee = substr($dateEx,0,4);
					$mois = array('','Janvier','Février','Mars','Avril','Mai','Juin',
					'Juillet','Août','Septembre','Octobre','Novembre','Décembre');
					$jour = substr($dateEx,8,2);
					if ($dateEx[5]==0)
						$moisComplet = substr($dateEx,6,1);
					else
						$moisComplet = substr($dateEx,5,2);			

					echo "<strong>o<a href=\"visits.php?idd=".$row["iddemande"]."\">
					Request of " . $jour . " " . $mois[$moisComplet] . " " . $annee . "</a></strong>";
					echo "<br/>";
					
				}
				echo "</p>";
			}
			else
			{
				echo "<strong>No request found</strong>" ;
			}
			echo '</div></div><div class="grid_8"><br/><br/>';
			//THE BASKET
			if(isset($_SESSION['nbVisitesX']))
			{	
				if($_SESSION['nbVisitesX'] != 0)
				{
					echo "<center><table border=1>";
					echo "<tr>";
					echo "<td><h4>House ID</h4></td>";
					echo "<td><h4>House adress</h4></td>";
					echo "<td><h4>House price</h4></td>";
					echo "<td><h4>Priority</h4></td>";
					echo "<td><h4>Del</h4></td>";
					echo "</tr>";
					$i = 0 ;
					
					while($i < $_SESSION['nbVisitesX'])
					{
			
						$var = $_SESSION['visitesX'][$i] ;
						$requete = "select b.idbien , b.prixbien, b.adrbien from bien b 
									where b.idbien = '$var' ;";
	
						$result = mysql_query("$requete");
						while($row = mysql_fetch_array($result))
						{
							$buff = $row["idbien"] ;
							echo "<tr><td>";
							echo $row["idbien"];
							echo "</td><td>"; 
							echo $row["adrbien"];
							echo "</td><td>"; 
							echo $row["prixbien"]." â‚¬";
							echo "</td><td>"; 
							echo $i+1 ;
							echo "</td><td>";
							$buff1 = "<center><img src='img/corbeille.png'>";
							echo '<a href="supvisit.php?id_bien=' ;
							echo $buff ;
							echo '">' ;
							echo $buff1 ;
							echo '</a>';
							echo "</td></tr>";
						}
						$i++;
					}
				}
				else
				{
					echo "No visit selected !!" ;
				}
			}
			else
			{
				echo "No visit selected !!" ;
			}
			echo "</table>";			
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
