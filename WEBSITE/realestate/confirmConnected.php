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
		echo '<li><a href="newrequest.php">New request</a></li>';
		echo '<li class="current"><a href="confirmConnected.php">Confirm visits</a></li>';
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
			echo "<h3>" . "Fill the following form to visit these houses : " . "</h3>" ;
			include("variables.php");
			if($_SESSION['nbVisitesX'] != 0)
			{
				echo "<table border=1>";
				echo "<tr>";
				echo "<td><h4>House ID</h4></td>";
				echo "<td><h4>House adress</h4></td>";
				echo "<td><h4>House price</h4></td>";
				echo "<td><h4>Priority</h4></td>";
				echo "</tr>";
				$i = 0 ;
				while($i < $_SESSION['nbVisitesX'])
				{
					$var = $_SESSION['visitesX'][$i] ;
					$requete = "select b.idbien , b.prixbien, b.adrbien from bien b where b.idbien = '$var' ;";
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
						echo "</td></tr>";
					}
					$i++;
				}
				echo "</table>";
				
				//affichage du formulaire
				if(isset($_POST['dispo']))
				{
					$d = $_POST['dispo'] ;
				}
				else
				{
					$d ="";
				}
				if(!isset($_POST['valider']))
				{
				echo "<br/><form id='form' action='confirmConnected.php' method=post>" ;
				echo "<fieldset><label><strong>Disponibility : </strong><input class='text' name='dispo' type='text' value='".$d."'></label>";
				echo '<input class="button" name="valider" type="submit" value="Submit"><br>';
				echo "</form>" ;
				}
				if(isset($_POST['valider']))
				{	

					$requeteDemande = 'insert into demande (datedemande,disponibilite,idclient)
										values (NOW(),'."'".$_POST['dispo']."'".','."'".$_SESSION['idcli']."')".';';
					
					$resultDemande = mysql_query("$requeteDemande");
					
		
					
					$i=0;
					while($i<$_SESSION['nbVisitesX'])
					{
						
						$requeteVisite = "insert into visiter (idbien,iddemande,priorite) 
										values (".'"'.$_SESSION['visitesX'][$i].'"'.",LAST_INSERT_ID(),$i)";
						

						$resultVisite = mysql_query("$requeteVisite");
						$i++;
					
					}
					
					$message2='Your request has been completed successfully : '.$_POST['dispo'].'' ;
					
					echo "<br>".$message2;
				}
			}
			else
			{
				echo "No visit selected";
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
