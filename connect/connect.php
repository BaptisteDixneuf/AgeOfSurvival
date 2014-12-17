<?php 
//Fichier a donné sensible
$adresse='mysql0.db.koding.com';
$nom_bdd='ageofsurvival_fi';
$utilisateur='ageofsurvival_fi';
$mot_de_passe='TrMTbR1_HedCYiBeLuvu4UvWAJLPLzKj8y12ZDhu';
// On se connecte à MySQL
try{
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host='.$adresse.';dbname='.$nom_bdd, $utilisateur, $mot_de_passe, $pdo_options);
}
catch(Exception $e){
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());
}
?>