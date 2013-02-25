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

<script language="Javascript">
		function verif_prix(prix){
			var reg=new RegExp(/^([1-9]{1}[0-9]{0,7})\.[0-9]{2}$/);
			return reg.test(prix);
		}
		function verif_type(type){
			var reg=new RegExp(/^F{1}[1-9]$/);
			return reg.test(type);
		}
		function verif_form_bien(){
			var formulaire=document.formB;
			var bool=true;
			var message='Erreurs, champs invalides ou inexistant : \n';
			if((formulaire.type.value.length!=2)||(!verif_type(formulaire.type.value))){
				message+='--> Type : FX où X est un chiffre supérieur à 0\n';
				bool=false;
			}
			if((formulaire.nom.value.length<3)||(formulaire.nom.value.length>30)){
				message+='--> Nom : 4 caractères min, 30 max\n';
				bool=false;
			}
			if((formulaire.detail.value.length<10)||(formulaire.detail.value.length>50)){
				message+='--> Details : 10 caractères min, 50 max\n';
				bool=false;
			}
			if((formulaire.adr.value.length<5)||(formulaire.adr.value.length>30)){
				message+='--> Adresse : 5 caractères min, 30 max\n';
				bool=false;
			}
			if(formulaire.fichier.value.length<5){
				message+='--> Fichier : 5 caractères min\n';
				bool=false;
			}
			if((!verif_prix(formulaire.prix.value))||(formulaire.prix.value.length<4)){
				message+='--> Prix : supérieur à 0, au format XXXXX.XX\n';
				bool=false;
			}
			if(bool==false){
				alert(message);
				return false;
			}else{
				return true;
			}
		}
</script>
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
		echo '<li><a href="newHouse.php">New house</a></li>' ;
		echo '<li class="current"><a href="modifyHouse.php?id_bien=all">Modify house</a></li>';
		echo '<li><a href="deleteHouse.php">Delete house</a></li>';
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
		include("variables.php");
		if($_GET['id_bien'] == "all")
		{
			$requete = "select * from bien";
			$result = mysql_query("$requete");
			if (mysql_errno()==0)
			{ 
				if(mysql_num_rows($result) != 0)
				{
					
					echo "<table>";
					echo "<tr>";
					echo "<td><h4>House detail</h4></td>";
					echo "<td><h4>House photo</h4></td>";
					echo "<td><h4>Modify this house</h4></td>";
					echo "</tr>";
					
					while($row = mysql_fetch_array($result))
					{
						
						echo "<tr><td>";
						echo $row["detailbien"] ;
						echo "</td><td>"; 	
						$buff = $row["photobien"] ;
						$buff1 = "<img src='./img/".$row["photobien"]."' width='150px'>";
						echo '<a href="/detailsHouse.php?id_photo=' ;
						echo $buff ;
						echo '">' ;
						echo $buff1 ;
						echo '</a>';
						echo "</td><td>";
						echo '<form id="form1"><input class="button1" name="modify" type="button" value="Modify" OnClick="window.location.href=\'modifyHouse.php?id_bien='.$row['idbien'].'\'"></form>';
						echo "</td></tr>";
					}
					echo "</table>";	
				}
				else
				{
					echo "Pas de bien trouvé";
				}
			}
		}
		else
		{
			$requete = "select * from bien where idbien = '".$_GET['id_bien']."';";
			$result = mysql_query("$requete");
			if (mysql_errno()==0)
			{ 
				if(mysql_num_rows($result) != 0)
				{
					while($row = mysql_fetch_array($result))
					{
						if(!isset($_POST['valider']))
						{
							echo "<form id='form' class='form-1 bot-2' action='modifyHouse.php?id_bien=".$_GET['id_bien']."' method=post enctype='multipart/form-data'>" ;
							echo "<br/><img src='./img/".$row["photobien"]."'>";
							echo "<fieldset>";
							echo "<label><strong>House name : </strong><input class='text' name='titre' type='text' value='".$row['titrebien']."'></label>";
							echo "<label><strong>House detail : </strong><textarea name='detail' type='text'>".$row['detailbien']."</textarea></label>";
							echo "<label><strong>House adress : </strong><input class='text' name='adr' type='text' value='".$row['adrbien']."'></label>";
							echo "<label><strong>House price : </strong><input class='text' name='prix' type='text' value='".$row['prixbien']."'></label>";
							echo "<label><strong>Sell date : </strong><input class='text' name='date' type='text' value='".$row['vendule']."'></label>";
							echo "<label><strong>House photo : </strong><input class='text' type='file' name='fichier' value='.\img'".$row['photobien']."'></label></fieldset>";
							echo '<input class="button" name="valider" type="submit" value="Submit">';
							echo "</form>" ;
						}				
					}
					
					if(isset($_POST['valider']))
					{
						$requete = "update bien set titrebien='".$_POST['titre']."' , 
															detailbien='".$_POST['detail']."' , 
															adrbien='".$_POST['adr']."' , 
															prixbien=".$_POST['prix']." , 
															vendule='".$_POST['date']."'
															where idbien='".$_GET['id_bien']."' ;" ;
						
						$result = mysql_query($requete);
						if($result)
						{
							if($_FILES['fichier']['name'] != "")
							{
								$destination = "./img/";
								unlink("./img/".$_GET['id_bien'].".jpg");
								move_uploaded_file($_FILES['fichier']['tmp_name'], $destination.$_GET['id_bien'].".jpg");
							}
						}
						echo "Your modification has been done successfully !!";									
					}
				}
				else
				{
					echo "Pas de bien trouvé";
				}
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
  <p> 2013 Real Estate : Thomas Carayol</p>
</footer>
<script>Cufon.now();</script>
</body>
</html>
