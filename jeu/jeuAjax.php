<?php
session_start();
require "../connect/connect2.php";

$d=array();
//$da=array();*/

extract ($_POST);/** enlve les $_POST devant les variables posts */
$login= mysql_escape_string($_SESSION["login"]);

     
        
    /**
  * Action:enregistrerdeplacement
    *Permet d'enregistrer les déplacments pour ensuite les anvoyés au autre
	**/
	if($_POST["action"]=="enregistrement_donnee"){
		$sql2="UPDATE deplacement SET abscisse=$abscisse,ordonnee=$ordonnee,map_abscisse=$map_abscisse,map_ordonnee=$map_ordonnee WHERE pseudo='$login'";
		$req= mysql_query($sql2) or die (mysql_error());
		$da["erreur"]="ok";
		$da["abscisse"]=$abscisse;
		$da["ordonnee"]=$ordonnee;
		$da["map_abscisse"]=$map_abscisse;
		$da["map_ordonnee"]=$map_ordonnee;
	}
        echo json_encode($da);

    if($_POST["action"]=="enregistrement_donnee"){
		$sql3="UPDATE inventaire SET epee=$epee,jambon=$jambon,vie=$vie,xp=$xp,pomme=$pomme WHERE pseudo='$login'";
		$req3= mysql_query($sql3) or die (mysql_error());
		$da3["erreur"]="ok";
		$da3["epee"]=$epee;
		$da3["jambon"]=$jambon;
		$da3["vie"]=$vie;
		$da3["xp"]=$xp;
        $da3["pomme"]=$xp;
	}
        echo json_encode($da3);

?>