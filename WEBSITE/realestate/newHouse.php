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
		echo '<li class="current"><a href="newHouse.php">New house</a></li>' ;
		echo '<li><a href="modifyHouse.php?id_bien=all">Modify house</a></li>';
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
      <div class="grid_8">
		<form id="form" class="form-1 bot-2" name="formB" action="newHouse.php" method="post" enctype="multipart/form-data" onSubmit="return verif_form_bien();">
			<fieldset>
				<div class="select-1">
				<label><strong>Kind of house : </strong></label>
					<select name="type">	
						<option value="F1">One room</option><option value="F2">Two rooms</option><option value="F3">Three rooms</option>
						<option value="F4">Four rooms</option><option value="F5">Five rooms</option><option value="F6">Six rooms</option>
						<option value="F7">Seven rooms</option><option value="FG">More than seven rooms</option></select>	
				</div>
				<label><strong>House name : </strong><input class="text" type="text" name="nom"/></label>
				<label><strong>House details : </strong><textarea name="detail"></textarea></label>
				<label><strong>House adress : </strong><input class="text" type="text" name="adr"/></label>
				<label><strong>House price (€) : </strong><input class="text" type="text" name="prix"/></label>
				<label><strong>House photo : </strong><input class="text" type="file" name="fichier"/></label>
			</fieldset>
			<input class="button2" id="button2" name="valider" type="submit" value="Submit"/><br/><br/>
		</form>
	
		<?php
			if(isset($_POST["valider"]))
			{
				include("variables.php");
				$requete = "select max(idbien) from bien;";
				$result1 = mysql_query($requete) ;
				$result = mysql_fetch_row($result1);
				$max = substr($result[0],1,5);
				$max = $max +1 ;
				$max = "b00".$max ;
				
				$requete = "insert into bien values ('".$max."','".$max.".jpg'".",'".$_POST['nom']."'
							,'".$_POST['detail']."','".$_POST['adr']."',".$_POST['prix'].",'".$_POST['type']."','0000-00-00');";	
				$result = mysql_query($requete) ;
				
				if($result)
				{
					$destination = "./img/";
					move_uploaded_file($_FILES['fichier']['tmp_name'], $destination.$max.".jpg");
					echo "Your house has been added successfully !";
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
