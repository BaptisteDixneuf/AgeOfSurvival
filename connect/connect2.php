<?php 
//Fichier a donné sensible
$adresse='mysql0.db.koding.com';
$nom_bdd='ageofsurvival_fi';
$utilisateur='ageofsurvival_fi';
$mot_de_passe='TrMTbR1_HedCYiBeLuvu4UvWAJLPLzKj8y12ZDhu';


     $base = mysql_connect ($adresse, $utilisateur, $mot_de_passe) or die('Impossible de se connecter à la base de données. Veuillez nous contacter (qewarynonline@gmail.com). Merci'); ; 
      mysql_select_db ($nom_bdd, $base) or die('impossible d\'accéder à la base de données. Veuillez nous contacter (qewarynonline@gmail.com). Merci'); 
      mysql_query('SET NAMES UTF8');

?>