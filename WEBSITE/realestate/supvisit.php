<?php   
session_start();
$i=0 ;
$trouve = 0;
while($i < $_SESSION['nbVisitesX'] && ($trouve != 1))
{
	if($_GET['id_bien'] == $_SESSION['visitesX'][$i])
	{
		unset($_SESSION['visitesX'][$i]);
		$trouve = 1;
	}
	$i++ ;
}
$i-- ;
while($i<$_SESSION['nbVisitesX']-1)
{
	$_SESSION['visitesX'][$i] = $_SESSION['visitesX'][$i+1];
	$i++;
}
$_SESSION['nbVisitesX'] -- ;	

?>

<script type="text/javascript">
<!--
var obj = 'window.location.replace("http://localhost/realestate/request.php");';
setTimeout(obj,0000);
-->
</script>
