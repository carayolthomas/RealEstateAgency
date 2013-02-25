 <?php session_start(); include("variables.php");?>
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
		echo '<li><a href="index.php">Main</a></li>' ;
		echo '<li><a href="houses.php">Houses</a></li>' ;
		echo '<li class="current"><a href="research.php">Research houses</a></li>';
		echo '<li><a href="admin.php">Administration</a></li>';
		echo '</ul>';		
	  ?>      
      </nav>
    </div>
  </header>
  <!--==============================content================================-->
  <section id="content">
    <div class="container_12">
		<?php
			echo "<h3>" . "Fill the following form to visit this house : " . "</h3>\n" ;
			if(isset($_GET["id_bien"]))
			{
				$var = $_GET["id_bien"] ;
				$requete = "select b.idbien , b.detailbien , b.photobien  from bien b , typebien t 
							where b.idtype = t.idtype and b.idbien = '$var'  ;";	
						
				$result = mysql_query("$requete");
				if (mysql_errno()==0)
				{ 
						echo "<table>";
						echo "<tr>";
						echo "<td><h4><center>House detail</h4></td>";
						echo "<td><h4><center>House photo</h4></td>";
						echo "</tr>";
						 
						while($row = mysql_fetch_array($result))
						{
							echo "<tr><td>";
							echo $row["detailbien"];
							echo "</td><td>"; 
							$buff = $row["photobien"] ;
							$buff1 = "<img src='img/".$row["photobien"]."'>";
							echo '<a href="detailsHouse.php?id_photo=' ;
							echo $buff ;
							echo '">' ;
							echo $buff1 ;
							echo '</a>';
							echo "</td></tr>"; 
						}
						echo "</table>";
				}
				else
				{
					echo "Probleme .... ";
					echo (mysql_error());
				}
				
				//affichage du formulaire
				if(isset($_POST['nom']))
				{
					$n = $_POST['nom'] ;
				}
				else
				{
					$n ="";
				}
				if(isset($_POST['adr']))
				{
					$a = $_POST['adr'] ;
				}
				else
				{
					$a ="";
				}
				if(isset($_POST['tel']))
				{
					$t = $_POST['tel'] ;
				}
				else
				{
					$t ="";
				}
				if(isset($_POST['mail']))
				{
					$m = $_POST['mail'] ;
				}
				else
				{
					$m ="";
				}
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
				echo "<form id='form' action='confirmVisit.php?id_bien=".$_GET['id_bien']."' method=post>" ;
				echo "<fieldset><label><strong>Name:<strong><input class='text' name='nom' type='text' value='".$n."'></label>";
				echo "<label><strong>Adress:<strong><input class='text' name='adr' type='text' value='".$a."'></label>";
				echo "<label><strong>Phone number:<strong><input class='text' name='tel' type='text' value='".$t."'></label>";
				echo "<label><strong>Mail:<strong><input class='text' name='mail' type='text' value='".$m."'></label>";
				echo "<label><strong>Disponibility:<strong><input class='text' name='dispo' type='text' value='".$d."'></label></fieldset>";
				echo '<input class="button" name="valider" type="submit" value="Submit">';
				echo "</form>" ;
				}
				if(isset($_POST['valider']))
				{
					$requeteClient = "insert into client (nomclient,adrclient,telclient,emailclient) values (".'"'.$_POST['nom'].'"'.",".'"'.$_POST['adr'].'"'.",".'"'.$_POST['tel'].'"'.",".'"'.$_POST['mail'].'"'.")";
					$requeteDemande = "insert into demande (datedemande,disponibilite,idclient) values (NOW(),".'"'.$_POST['dispo'].'"'.",LAST_INSERT_ID());";
					$requeteVisite = "insert into visiter (idbien,priorite) values (".'"'.$var.'"'.",'1')";
					
					$resultClient = mysql_query("$requeteClient");
					$cle_pere = mysql_insert_id($db);
					$resultDemande = mysql_query("$requeteDemande");
					$resultVisite = mysql_query("$requeteVisite");

					
					$message='Your request has been considered with this number : '.$cle_pere.'';
					//$message2='Votre demande de visite a bien été enregistrée avec vos disponibilités suivantes : '.$_POST['dispo'].'' ;
					echo "<br><br><center>".$message;
					//echo "<center>".$message2;	
				}	
			}
			else		
			{
				echo "Probleme .... ";
				echo (mysql_error());
			}		
		?> 
      <div class="clear"></div>
    </div>
  </section>
</div>
<!--==============================footer=================================-->
<footer>
  <p>?2013 Real Estate : Thomas Carayol</p>
</footer>
<script>Cufon.now();</script>
</body>
</html>
