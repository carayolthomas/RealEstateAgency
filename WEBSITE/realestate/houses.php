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
		echo '<li class="current"><a href="houses.php">Houses</a></li>' ;
		echo '<li><a href="research.php">Research houses</a></li>';
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
			echo '<h2 class="top-1 p3">List of houses</h2>';
			echo "<form id='form' action='houses.php' method=post>" ;
			echo "<h3>" . "Choose a price range : " . "</h3>" ;
			$var1 = '<input name="radio" type="radio" value="1"' ;
			$var2 = '<input name="radio" type="radio" value="2"' ;
			$var3 = '<input name="radio" type="radio" value="3"' ;
			if(isset($_POST['radio']))
			{
				if($_POST['radio'] == '1')
				{
					$var1 .="checked = 'checked'";
				}
			}
			if(isset($_POST['radio']))
			{
				if($_POST['radio'] == '2')
				{
					$var2 .="checked = 'checked'";
				}
			}
			if(isset($_POST['radio']))
			{
				if($_POST['radio'] == '3')
				{
					$var3 .="checked = 'checked'";
				}
			}

			$var1 .= "> < 200.000 €<br>" ;
			$var2 .= "> from 200.000 € to 300.000 €<br>" ;
			$var3 .= "> > 300.000 €<br>" ;

			echo "<div>".$var1;
			echo $var2;
			echo $var3."</div>";
			echo '<input class="button" name="afficher" type="submit" value="Submit"><br>'; 
			echo "</form>";
			if(isset($_POST['afficher']))
			{
				if(isset($_POST["radio"]))
				{
					$tranche = $_POST["radio"] ;

					include("variables.php");
					if($tranche == 1)
					{
						//Requete avec prix < 200000
						$requete = "select b.titrebien , b.detailbien , b.prixbien , t.nomtype , b.photobien from bien b , typebien t
									where b.idtype = t.idtype and b.prixbien < 200000" ;
					}
					if($tranche == 2)
					{
						//Requete avec prix comprit entre 200000 et 300000
						$requete = "select b.titrebien , b.detailbien , b.prixbien , t.nomtype , b.photobien from bien b , typebien t
									where b.idtype = t.idtype and b.prixbien >= 200000 and b.prixbien <= 300000" ;
					}
					if($tranche == 3)
					{
						//Requete avec prix > 300000
						$requete = "select b.titrebien , b.detailbien , b.prixbien , t.nomtype , b.photobien from bien b , typebien t
									where b.idtype = t.idtype and b.prixbien > 300000" ;
					}	
					
					$result = mysql_query("$requete");
					

						if (mysql_errno()==0)
						{ 
							if (mysql_num_rows($result)!=0)
							{
								echo "<table>";
								echo "<tr>";
								echo "<th><center><h4>House name</h4></th>";
								echo "<th><center><h4>House detail</h4></th>";
								echo "<th><center><h4>House price</h4></th>";
								echo "<th><center><h4>House type</h4></th>";
								echo "<th><center><h4>House photo</h4></th>";
								echo "</tr>";
								echo "<strong><center>Number of houses found : ".mysql_num_rows($result);
								while($row = mysql_fetch_array($result))
								{
									echo "<tr><td>";
									echo $row["titrebien"];
									echo "</td><td>"; 
									echo $row["detailbien"];
									echo "</td><td>"; 
									echo $row["prixbien"];
									echo "</td><td>"; 
									echo $row["nomtype"];
									echo "</td><td>"; 
									echo "<img src='img/".$row["photobien"]."' width=200px>";
									echo "</td></tr>";
								}
							}
							else
							{
								echo "No house found<br>";
							}
						}
						else
						{
							echo "Probleme .... ";
							echo (mysql_error());
						}
					echo "</table>";
				}
				else
				{
					echo "Please check at least one option";
					echo (mysql_error());
				}	
			}
			?>
      
      <div class="clear"></div>
    </div>
  </section>
</div>
<!--==============================footer=================================-->
<footer>
  <p>� 2013 Real Estate : Thomas Carayol</p>
</footer>
<script>Cufon.now();</script>
</body>
</html>
